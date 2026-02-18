<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;
use Illuminate\Database\Eloquent\SoftDeletes;

class HealthPromotionItem extends Model
{
    use HasFactory, SoftDeletes;

    protected $table = 'health_promotion_items';

    protected $fillable = [
        'category_id',
        'title',
        'short_description',
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

        // Automatic order by category
        static::creating(function ($model) {
            if (empty($model->order)) {
                $maxOrder = static::where('category_id', $model->category_id)->max('order') ?? 0;
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

        // Reorganize orders on delete (within same category)
        static::deleted(function ($model) {
            static::where('category_id', $model->category_id)
                ->where('order', '>', $model->order)
                ->decrement('order');
        });
    }

    /**
     * Relationships
     */
    public function category(): BelongsTo
    {
        return $this->belongsTo(HealthPromotionCategory::class, 'category_id');
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

    public function scopeByCategory($query, $categoryId)
    {
        return $query->where('category_id', $categoryId);
    }
}