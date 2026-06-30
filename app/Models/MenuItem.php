<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;

class MenuItem extends Model
{
    protected $fillable = [
        'category_id', 'name', 'name_id', 'description', 'description_id',
        'price', 'hot_price', 'cold_price', 'whole_price', 'slice_price', 'notes',
        'image', 'is_available', 'is_featured', 'is_sold_out',
        'badge', 'sort_order',
    ];

    protected $casts = [
        'price' => 'decimal:2',
        'hot_price' => 'decimal:2',
        'cold_price' => 'decimal:2',
        'whole_price' => 'decimal:2',
        'slice_price' => 'decimal:2',
        'is_available' => 'boolean',
        'is_featured' => 'boolean',
        'is_sold_out' => 'boolean',
    ];

    /**
     * Price fields with a value, keyed by localized label (e.g. 'Hot'/'Panas' => 38000.00).
     * The 'Price' key is a stable sentinel (never displayed) marking a flat single price.
     */
    public function activePrices(): array
    {
        $raw = array_filter([
            'Price' => $this->price,
            'Hot' => $this->hot_price,
            'Cold' => $this->cold_price,
            'Whole' => $this->whole_price,
            'Slice' => $this->slice_price,
        ], fn ($value) => $value !== null);

        $labels = [
            'Hot' => __('menu.price_hot'),
            'Cold' => __('menu.price_cold'),
            'Whole' => __('menu.price_whole'),
            'Slice' => __('menu.price_slice'),
        ];

        $result = [];
        foreach ($raw as $key => $value) {
            $result[$key === 'Price' ? 'Price' : $labels[$key]] = $value;
        }

        return $result;
    }

    public function category(): BelongsTo
    {
        return $this->belongsTo(MenuCategory::class, 'category_id');
    }

    public function localName(): string
    {
        return app()->getLocale() === 'id' ? $this->name_id : $this->name;
    }

    public function localDescription(): ?string
    {
        return app()->getLocale() === 'id' ? $this->description_id : $this->description;
    }
}
