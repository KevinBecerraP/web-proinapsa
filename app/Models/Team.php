<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\HasOne;
use Illuminate\Support\Facades\Storage;
use Illuminate\Support\Str;

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
        'slug',
        'image',
        'position',
        'profesion',
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

        // Generar slug automáticamente desde el nombre
        static::creating(function ($team) {
            $team->slug = static::generateUniqueSlug($team->name);
        });

        static::updating(function ($team) {
            if ($team->isDirty('name')) {
                $team->slug = static::generateUniqueSlug($team->name, $team->id);
            }
        });

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
     * Genera un slug único basado en el nombre.
     */
    public static function generateUniqueSlug(string $name, ?int $ignoreId = null): string
    {
        $slug = Str::slug($name);
        $original = $slug;
        $i = 1;

        $query = static::where('slug', $slug);
        if ($ignoreId) {
            $query->where('id', '!=', $ignoreId);
        }

        while ($query->exists()) {
            $slug = $original . '-' . $i++;
            $query = static::where('slug', $slug);
            if ($ignoreId) {
                $query->where('id', '!=', $ignoreId);
            }
        }

        return $slug;
    }

    /**
     * Get the area this team member coordinates.
     */
    public function coordinatorOf(): HasOne
    {
        return $this->hasOne(Area::class, 'coordinator_id');
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