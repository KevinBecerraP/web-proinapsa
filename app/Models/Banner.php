<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Facades\Storage;

class Banner extends Model
{
    use HasFactory;

    /**
     * The attributes that are mass assignable.
     *
     * @var array<int, string>
     */
    protected $fillable = [
        'title',
        'title_color',
        'image',
        'subtitle',
        'subtitle_color',
        'button_link',
        'button_color',
        'status',
        'type',
        'order',
        'page'
    ];

    /**
     * The attributes that should be cast.
     *
     * @var array<string, string>
     */
    protected $casts = [
        'status' => 'boolean',
    ];

    /**
     * Boot method para eventos del modelo
     */
    protected static function boot()
    {
        parent::boot();

        // Antes de actualizar, verificar si cambió la imagen
        static::updating(function ($banner) {
            if ($banner->isDirty('image')) {
                // Eliminar imagen anterior si existe
                if ($banner->getOriginal('image')) {
                    Storage::disk('public')->delete($banner->getOriginal('image'));
                }
            }
        });

        // Antes de eliminar, borrar la imagen
        static::deleting(function ($banner) {
            if ($banner->image) {
                Storage::disk('public')->delete($banner->image);
            }
        });
    }

    /**
     * Scope a query to only include active banners.
     */
    public function scopeActive($query)
    {
        return $query->where('status', true);
    }

    /**
     * Scope a query to order banners by order field.
     */
    public function scopeOrdered($query)
    {
        return $query->orderBy('order', 'asc');
    }

    /**
     * Scope a query to filter by type.
     */
    public function scopeOfType($query, string $type)
    {
        return $query->where('type', $type);
    }

    /**
     * Get the full URL of the image.
     */
    public function getImageUrlAttribute()
    {
        return $this->image ? Storage::url($this->image) : null;
    }

    /**
     * Eliminar imagen manualmente si es necesario
     */
    public function deleteImage()
    {
        if ($this->image && Storage::disk('public')->exists($this->image)) {
            Storage::disk('public')->delete($this->image);
            $this->update(['image' => null]);
            return true;
        }
        return false;
    }
}