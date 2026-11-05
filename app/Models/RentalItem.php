<?php

namespace App\Models;

use Database\Factories\RentalItemFactory;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;
use Illuminate\Support\Facades\Storage;

class RentalItem extends Model
{
    /** @use HasFactory<RentalItemFactory> */
    use HasFactory;

    protected $fillable = ['service_id', 'category', 'availability', 'name', 'description', 'photo', 'price_per_day', 'sort_order', 'is_active'];

    protected function casts(): array
    {
        return ['price_per_day' => 'integer', 'is_active' => 'boolean'];
    }

    public function service(): BelongsTo
    {
        return $this->belongsTo(Service::class);
    }

    public function photoUrl(): ?string
    {
        if ($this->photo && filter_var($this->photo, FILTER_VALIDATE_URL)) {
            return $this->photo;
        }

        return $this->photo && Storage::disk('public')->exists($this->photo)
            ? Storage::disk('public')->url($this->photo)
            : null;
    }

    public function categoryLabel(): string
    {
        return config('rental.categories.'.$this->category, 'Lainnya');
    }

    public function categoryIcon(): string
    {
        return config('rental.icons.'.$this->category, 'fa-solid fa-box-open');
    }

    public function availabilityKey(): string
    {
        return in_array($this->availability, ['available', 'limited', 'unavailable'], true)
            ? $this->availability
            : 'available';
    }

    public function availabilityLabel(): string
    {
        return config('rental.availability.'.$this->availabilityKey().'.label', 'Tersedia');
    }

    public function availabilityIcon(): string
    {
        return config('rental.availability.'.$this->availabilityKey().'.icon', 'fa-solid fa-circle-check');
    }

    public function availabilityCta(): string
    {
        return config('rental.availability.'.$this->availabilityKey().'.cta', 'Tanya ketersediaan');
    }

    public function isAvailable(): bool
    {
        return $this->availabilityKey() === 'available';
    }

    public function dailyPriceLabel(): string
    {
        return $this->price_per_day > 0
            ? 'Rp '.number_format($this->price_per_day, 0, ',', '.').' / hari'
            : 'Harga berdasarkan kebutuhan';
    }
}
