<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Promo extends Model
{
    protected $fillable = [
        'title', 'title_id', 'description', 'description_id', 'image',
        'tag', 'tag_id', 'valid_until', 'is_active', 'sort_order',
    ];

    protected $casts = [
        'valid_until' => 'date',
        'is_active' => 'boolean',
    ];

    public function localTitle(): string
    {
        return app()->getLocale() === 'id' ? $this->title_id : $this->title;
    }

    public function localDescription(): string
    {
        return app()->getLocale() === 'id' ? $this->description_id : $this->description;
    }

    public function localTag(): string
    {
        return app()->getLocale() === 'id' ? $this->tag_id : $this->tag;
    }
}
