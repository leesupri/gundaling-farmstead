<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Reservation extends Model
{
    protected $fillable = [
        'name', 'email', 'phone', 'date', 'time', 'guests', 'occasion',
        'notes', 'status', 'wa_sent', 'beo_file', 'group_name',
    ];

    protected $casts = [
        'date' => 'date',
        'wa_sent' => 'boolean',
    ];
}
