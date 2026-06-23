<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\HasMany;

class MenuCategory extends Model
{
    protected $fillable = [
        'department', 'name', 'name_id', 'slug', 'sort_order', 'is_active', 'icon', 'image',
    ];

    protected $casts = [
        'is_active' => 'boolean',
    ];

    public function items(): HasMany
    {
        return $this->hasMany(MenuItem::class, 'category_id');
    }

    public function localName(): string
    {
        return app()->getLocale() === 'id' ? $this->name_id : $this->name;
    }
}
