<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;
use Illuminate\Database\Eloquent\Relations\HasMany;

class HealthPromotionCategory extends Model
{
    use HasFactory;

    protected $table = 'health_promotion_categories';

    protected $fillable = [
        'area_id',
        'category',
        'display_name',
        'image',
        'pdf_file',
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

        static::creating(function ($model) {
            if (empty($model->order)) {
                $maxOrder = static::max('order') ?? 0;
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

        static::deleted(function ($model) {
            static::where('order', '>', $model->order)->decrement('order');
        });
    }

    /**
     * Relationships
     */
    public function area(): BelongsTo
    {
        return $this->belongsTo(Area::class);
    }

    public function items(): HasMany
    {
        return $this->hasMany(HealthPromotionItem::class, 'category_id');
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

    public function scopeOrdered($query)
    {
        return $query->orderBy('order', 'asc');
    }

    public function scopeCategory($query, $category)
    {
        return $query->where('category', $category);
    }

    /**
     * Accessors
     */
    public function getCategoryLabelAttribute(): string
    {
        return match($this->category) {
            'early_childhood' => 'Primera Infancia',
            'childhood' => 'Niñez',
            'women' => 'Mujer',
            'workers' => 'Trabajadores',
            default => $this->category,
        };
    }

    /**
     * Get total active items
     */
    public function getTotalItemsAttribute(): int
    {
        return $this->items()->where('active', true)->count();
    }
}