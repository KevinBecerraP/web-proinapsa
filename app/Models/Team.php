<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Facades\Storage;

class Team extends Model
{
    use HasFactory;

    /**
     * The attributes that are mass assignable.
     *
     * @var array<int, string>
     */
    protected $fillable = [
        'name',
        'image',
        'position',
        'description',
        'status',
    ];

    /**
     * Get the attributes that should be cast.
     *
     * @return array<string, string>
     */
    protected function casts(): array
    {
        return [
            'status' => 'boolean',
        ];
    }

    /**
     * Boot method para eventos del modelo
     */
    protected static function boot()
    {
        parent::boot();

        // Antes de actualizar, verificar si cambió la imagen
        static::updating(function ($team) {
            if ($team->isDirty('image')) {
                // Eliminar imagen anterior si existe
                if ($team->getOriginal('image')) {
                    Storage::disk('public')->delete($team->getOriginal('image'));
                }
            }
        });

        // Antes de eliminar, borrar la imagen
        static::deleting(function ($team) {
            if ($team->image) {
                Storage::disk('public')->delete($team->image);
            }
        });
    }

    /**
     * Scope a query to only include active team members.
     */
    public function scopeActive($query)
    {
        return $query->where('status', true);
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