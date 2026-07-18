<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Facades\Cache;

/**
 * Singleton row holding site-wide contact info and cross-site links
 * (WhatsApp, email, Instagram, address, Gundaling Farm / PIMS URLs).
 * Edited once in the admin (Settings page) and read everywhere else.
 */
class Setting extends Model
{
    protected $fillable = [
        'whatsapp_number',
        'whatsapp_display',
        'email',
        'instagram_handle',
        'address',
        'farm_url',
        'pims_url',
    ];

    const CACHE_KEY = 'site.settings';

    /**
     * The single settings row, cached forever and auto-created with the
     * site's current real values on first access. Falls back to an
     * in-memory instance with those same values if the DB is unreachable,
     * so pages that render during an outage (error pages) never break.
     *
     * Caches the plain attributes array rather than the Eloquent model
     * itself — unserializing a cached Model object (database/file cache
     * drivers) is unreliable, since PHP's unserialize() can fail to
     * reconstruct it depending on class-autoload timing, silently
     * producing a non-persisted, "doesn't exist" model.
     */
    public static function current(): self
    {
        try {
            $attributes = Cache::rememberForever(
                self::CACHE_KEY,
                fn () => static::query()->firstOrCreate(['id' => 1], static::defaults())->getAttributes(),
            );

            return (new static)->newFromBuilder($attributes);
        } catch (\Throwable $e) {
            report($e);

            return new static(static::defaults());
        }
    }

    public static function defaults(): array
    {
        return [
            'whatsapp_number' => '6282162599980',
            'whatsapp_display' => '+62 821-6259-9980',
            'email' => 'info@gundalingfarmstead.com',
            'instagram_handle' => 'gundaling_farmstead',
            'address' => 'Jl. Jamin Ginting, Desa Jaranguda, Simpang Pelawi, Kabupaten Karo, Berastagi 22158, North Sumatra, Indonesia',
            'farm_url' => 'https://gundalingfarm.com',
            'pims_url' => 'https://pimsgundaling.com',
        ];
    }

    public function whatsappUrl(?string $prefillText = null): string
    {
        $url = 'https://wa.me/' . $this->whatsapp_number;

        return $prefillText ? $url . '?text=' . rawurlencode($prefillText) : $url;
    }

    public function instagramUrl(): ?string
    {
        return $this->instagram_handle ? 'https://instagram.com/' . ltrim($this->instagram_handle, '@') : null;
    }

    protected static function booted(): void
    {
        static::saved(fn () => Cache::forget(self::CACHE_KEY));
    }
}
