<?php

namespace App\Filament\Pages;

use App\Models\Setting;
use BackedEnum;
use Filament\Actions\Action;
use Filament\Forms\Components\TextInput;
use Filament\Forms\Concerns\InteractsWithForms;
use Filament\Forms\Contracts\HasForms;
use Filament\Notifications\Notification;
use Filament\Pages\Page;
use Filament\Schemas\Components\Section;
use Filament\Schemas\Schema;
use Filament\Support\Icons\Heroicon;

class ManageSettings extends Page implements HasForms
{
    use InteractsWithForms;

    protected static string|BackedEnum|null $navigationIcon = Heroicon::OutlinedCog6Tooth;

    protected static ?string $navigationLabel = 'Settings';

    protected static ?string $title = 'Site Settings';

    protected static ?int $navigationSort = 100;

    protected string $view = 'filament.pages.manage-settings';

    public ?array $data = [];

    /**
     * Only Admins can change site-wide contact info / links — Managers and
     * Staff can see the effect (e.g. WhatsApp buttons) but not edit the source.
     */
    public static function canAccess(): bool
    {
        return auth()->user()?->hasRole('Admin') ?? false;
    }

    public function mount(): void
    {
        $this->form->fill(Setting::current()->toArray());
    }

    public function form(Schema $schema): Schema
    {
        return $schema
            ->components([
                Section::make('WhatsApp')
                    ->description('Used for the floating chat button, reservation confirmations, promo/error page links, and the admin reservation "Send WA" action.')
                    ->components([
                        TextInput::make('whatsapp_number')
                            ->label('WhatsApp number (digits only)')
                            ->helperText('Country code + number, no spaces or symbols. Example: 6282162599980')
                            ->required()
                            ->regex('/^[0-9]+$/')
                            ->maxLength(20),
                        TextInput::make('whatsapp_display')
                            ->label('WhatsApp number (displayed)')
                            ->helperText('Example: +62 821-6259-9980')
                            ->required()
                            ->maxLength(30),
                    ])
                    ->columns(2),

                Section::make('Contact')
                    ->components([
                        TextInput::make('email')
                            ->label('Email address')
                            ->email()
                            ->required(),
                        TextInput::make('instagram_handle')
                            ->label('Instagram handle')
                            ->helperText('Without the @ — example: gundaling_farmstead')
                            ->prefix('@')
                            ->nullable(),
                        TextInput::make('address')
                            ->label('Restaurant address')
                            ->required()
                            ->columnSpanFull(),
                    ])
                    ->columns(2),

                Section::make('Cross-site links')
                    ->description('Every "Visit Gundaling Farm" link and footer link site-wide points here.')
                    ->components([
                        TextInput::make('farm_url')
                            ->label('Gundaling Farm URL')
                            ->url()
                            ->required(),
                        TextInput::make('pims_url')
                            ->label('PIMS Gundaling URL')
                            ->url()
                            ->required(),
                    ])
                    ->columns(2),
            ])
            ->statePath('data');
    }

    public function save(): void
    {
        $data = $this->form->getState();

        Setting::current()->update($data);

        Notification::make()
            ->title('Settings saved')
            ->body('Changes are live across the whole site immediately.')
            ->success()
            ->send();
    }

    protected function getHeaderActions(): array
    {
        return [
            Action::make('save')
                ->label('Save changes')
                ->action('save')
                ->keyBindings(['mod+s']),
        ];
    }
}
