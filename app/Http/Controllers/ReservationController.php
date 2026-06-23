<?php

namespace App\Http\Controllers;

use App\Models\Reservation;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Storage;

class ReservationController extends Controller
{
    public function create()
    {
        return view('reservations.create');
    }

    public function store(Request $request)
    {
        $data = $request->validate([
            'name' => ['required', 'string', 'max:255'],
            'email' => ['required', 'email', 'max:255'],
            'phone' => ['required', 'string', 'max:30'],
            'date' => ['required', 'date', 'after_or_equal:today'],
            'time' => ['required'],
            'guests' => ['required', 'integer', 'min:1', 'max:500'],
            'occasion' => ['nullable', 'string', 'max:255'],
            'notes' => ['nullable', 'string'],
            'is_group_event' => ['nullable', 'boolean'],
            'group_name' => ['nullable', 'string', 'max:255'],
        ]);

        unset($data['is_group_event']);

        $reservation = Reservation::create($data);

        return redirect()->route('reservations.confirmation', $reservation->id);
    }

    public function confirmation(Reservation $reservation)
    {
        return view('reservations.confirmation', ['reservation' => $reservation]);
    }

    public function downloadBeo(Reservation $reservation)
    {
        abort_unless($reservation->beo_file, 404);

        return Storage::disk('local')->download($reservation->beo_file);
    }
}
