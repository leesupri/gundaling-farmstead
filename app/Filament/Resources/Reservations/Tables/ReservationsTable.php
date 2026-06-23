<?php

namespace App\Filament\Resources\Reservations\Tables;

use App\Models\Reservation;
use Filament\Actions\Action;
use Filament\Actions\BulkActionGroup;
use Filament\Actions\DeleteBulkAction;
use Filament\Actions\EditAction;
use Filament\Actions\ViewAction;
use Filament\Forms\Components\DatePicker;
use Filament\Forms\Components\FileUpload;
use Filament\Tables\Columns\IconColumn;
use Filament\Tables\Columns\SelectColumn;
use Filament\Tables\Columns\TextColumn;
use Filament\Tables\Filters\Filter;
use Filament\Tables\Filters\SelectFilter;
use Filament\Tables\Filters\TernaryFilter;
use Filament\Tables\Table;
use Illuminate\Database\Eloquent\Builder;
use Illuminate\Support\Facades\Storage;
use Symfony\Component\HttpFoundation\StreamedResponse;

class ReservationsTable
{
    public static function configure(Table $table): Table
    {
        return $table
            ->defaultSort('date')
            ->columns([
                TextColumn::make('name')
                    ->searchable(),
                TextColumn::make('date')
                    ->date()
                    ->sortable(),
                TextColumn::make('time')
                    ->time()
                    ->sortable(),
                TextColumn::make('guests')
                    ->numeric()
                    ->sortable(),
                SelectColumn::make('status')
                    ->options([
                        'pending' => 'Pending',
                        'confirmed' => 'Confirmed',
                        'cancelled' => 'Cancelled',
                        'completed' => 'Completed',
                        'beo_uploaded' => 'BEO Uploaded',
                    ]),
                IconColumn::make('wa_sent')
                    ->boolean(),
                IconColumn::make('beo_file')
                    ->label('BEO')
                    ->boolean()
                    ->getStateUsing(fn (Reservation $record) => filled($record->beo_file)),
            ])
            ->filters([
                SelectFilter::make('status')
                    ->options([
                        'pending' => 'Pending',
                        'confirmed' => 'Confirmed',
                        'cancelled' => 'Cancelled',
                        'completed' => 'Completed',
                        'beo_uploaded' => 'BEO Uploaded',
                    ]),
                TernaryFilter::make('has_beo')
                    ->label('Has BEO')
                    ->queries(
                        true: fn (Builder $query) => $query->whereNotNull('beo_file'),
                        false: fn (Builder $query) => $query->whereNull('beo_file'),
                    ),
                Filter::make('date_range')
                    ->schema([
                        DatePicker::make('from'),
                        DatePicker::make('until'),
                    ])
                    ->query(function (Builder $query, array $data): Builder {
                        return $query
                            ->when($data['from'] ?? null, fn ($q, $date) => $q->whereDate('date', '>=', $date))
                            ->when($data['until'] ?? null, fn ($q, $date) => $q->whereDate('date', '<=', $date));
                    }),
            ])
            ->recordActions([
                ViewAction::make(),
                EditAction::make(),
                Action::make('uploadBeo')
                    ->label('Upload BEO')
                    ->icon('heroicon-o-document-arrow-up')
                    ->schema([
                        FileUpload::make('beo_file')
                            ->label('BEO (PDF)')
                            ->disk('local')
                            ->directory('beos')
                            ->visibility('private')
                            ->acceptedFileTypes(['application/pdf'])
                            ->maxSize(10240)
                            ->required(),
                    ])
                    ->action(function (Reservation $record, array $data) {
                        $record->update([
                            'beo_file' => $data['beo_file'],
                            'status' => 'beo_uploaded',
                        ]);
                    }),
                Action::make('waLink')
                    ->label('WA Link')
                    ->icon('heroicon-o-chat-bubble-left-right')
                    ->url(fn (Reservation $record) => 'https://wa.me/6281234567890?text=' . rawurlencode(
                        "Hi {$record->name}, your reservation at Gundaling Farmstead on {$record->date->format('d M Y')} at {$record->time} for {$record->guests} guests is confirmed. We look forward to welcoming you!"
                    ))
                    ->openUrlInNewTab(),
            ])
            ->toolbarActions([
                BulkActionGroup::make([
                    DeleteBulkAction::make(),
                ]),
            ])
            ->headerActions([
                Action::make('exportCsv')
                    ->label('Export CSV')
                    ->icon('heroicon-o-arrow-down-tray')
                    ->schema([
                        DatePicker::make('from'),
                        DatePicker::make('until'),
                    ])
                    ->action(function (array $data): StreamedResponse {
                        $query = Reservation::query()
                            ->when($data['from'] ?? null, fn ($q, $date) => $q->whereDate('date', '>=', $date))
                            ->when($data['until'] ?? null, fn ($q, $date) => $q->whereDate('date', '<=', $date))
                            ->orderBy('date');

                        return response()->streamDownload(function () use ($query) {
                            $handle = fopen('php://output', 'w');
                            fputcsv($handle, ['Name', 'Email', 'Phone', 'Date', 'Time', 'Guests', 'Occasion', 'Status', 'Group Name']);
                            $query->each(function (Reservation $r) use ($handle) {
                                fputcsv($handle, [
                                    $r->name, $r->email, $r->phone,
                                    $r->date->format('Y-m-d'), $r->time, $r->guests,
                                    $r->occasion, $r->status, $r->group_name,
                                ]);
                            });
                            fclose($handle);
                        }, 'reservations.csv');
                    }),
            ]);
    }
}
