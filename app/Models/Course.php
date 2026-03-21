<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;
use Illuminate\Database\Eloquent\SoftDeletes;
use Illuminate\Support\Str;

class Course extends Model
{
    use HasFactory, SoftDeletes;

    protected $table = 'courses';

    protected $fillable = [
        'area_id',
        'title',
        'slug',
        'short_description',
        'main_image',
        'full_description',
        'gallery_image_1',
        'pdf_file',
        'status',
        'registration_link',
        'duration_hours',
        'order',
        'created_by',
        'updated_by',
    ];

    protected $casts = [
        'order' => 'integer',
        'duration_hours' => 'integer',
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

            if (empty($model->slug)) {
                $model->slug = Str::slug($model->title);
            }

            if (auth()->check()) {
                $model->created_by = auth()->id();
            }
        });

        static::updating(function ($model) {
            if ($model->isDirty('title')) {
                $model->slug = Str::slug($model->title);
            }

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
        return $query->where('status', 'active');
    }

    public function scopeFinished($query)
    {
        return $query->where('status', 'finished');
    }

    public function scopeInactive($query)
    {
        return $query->where('status', 'inactive');
    }

    public function scopeOrdered($query)
    {
        return $query->orderBy('order', 'asc');
    }

    /**
     * Accessors
     */
    public function getStatusLabelAttribute(): string
    {
        return match($this->status) {
            'active' => 'Activo',
            'finished' => 'Finalizado',
            'inactive' => 'Inactivo',
            default => $this->status,
        };
    }

    public function getStatusBadgeColorAttribute(): string
    {
        return match($this->status) {
            'active' => 'success',
            'finished' => 'gray',
            'inactive' => 'danger',
            default => 'gray',
        };
    }

    /**
     * Get all gallery images
     */
    public function getGalleryImagesAttribute(): array
    {
        return array_filter([
            $this->gallery_image_1,
        ]);
    }
}