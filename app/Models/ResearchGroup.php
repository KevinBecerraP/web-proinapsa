<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;

class ResearchGroup extends Model
{
    use HasFactory;

    protected $table = 'research_group';

    protected $fillable = [
        'area_id',
        'name',
        'description',
        'mini_description',
        'link',
        'active',
        'created_by',
        'updated_by',
    ];

    protected $casts = [
        'active' => 'boolean',
    ];

    /**
     * Boot model
     */
    protected static function boot()
    {
        parent::boot();

        // Prevent creating more than one record (Singleton)
        static::creating(function ($model) {
            if (static::count() > 0) {
                throw new \Exception('Solo puede existir un registro de Grupo de Investigación. Por favor, edite el existente.');
            }

            if (auth()->check()) {
                $model->created_by = auth()->id();
            }
        });

        static::updating(function ($model) {
            if (auth()->check()) {
                $model->updated_by = auth()->id();
            }
        });
    }

    /**
     * Relationships
     */
    public function area(): BelongsTo
    {
        return $this->belongsTo(Area::class);
    }

    public function createdBy(): BelongsTo
    {
        return $this->belongsTo(User::class, 'created_by');
    }

    public function updatedBy(): BelongsTo
    {
        return $this->belongsTo(User::class, 'updated_by');
    }

    /**
     * Scopes
     */
    public function scopeActive($query)
    {
        return $query->where('active', true);
    }

    /**
     * Accessor: Total publications (automatic counter)
     */
    public function getTotalPublicationsAttribute(): int
    {
        return Publication::where('area_id', $this->area_id)
            ->where('status', 'active')
            ->count();
    }

    /**
     * Get the only record of the group (static helper)
     */
    public static function getGroup()
    {
        return static::first();
    }
}