<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;
use Illuminate\Database\Eloquent\SoftDeletes;

class Institutional extends Model
{
    use HasFactory, SoftDeletes;

    protected $table = 'institutional_resources';

    protected $fillable = [
        'type',
        'title',
        'name',
        'url',
        'image',
        'order',
        'active',
        'created_by',
        'updated_by',
    ];

    protected $casts = [
        'active' => 'boolean',
        'order' => 'integer',
    ];

    /**
     * Boot model
     */
    protected static function boot()
    {
        parent::boot();

        // Automatic order by type
        static::creating(function ($model) {
            if (empty($model->order)) {
                $maxOrder = static::where('type', $model->type)->max('order') ?? 0;
                $model->order = $maxOrder + 1;
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

        // Reorganize orders on delete (within same type)
        static::deleted(function ($model) {
            static::where('type', $model->type)
                ->where('order', '>', $model->order)
                ->decrement('order');
        });
    }

    /**
     * Relationships
     */
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

    public function scopeOrdered($query)
    {
        return $query->orderBy('order', 'asc');
    }

    public function scopeInterestLinks($query)
    {
        return $query->where('type', 'interest_link');
    }

    public function scopePartners($query)
    {
        return $query->where('type', 'partner');
    }

    /**
     * Accessors
     */
    public function getTypeLabelAttribute(): string
    {
        return match($this->type) {
            'interest_link' => 'Link de Interés',
            'partner' => 'Socio/Aliado',
            default => $this->type,
        };
    }
}