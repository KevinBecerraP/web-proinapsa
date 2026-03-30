<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;
use Illuminate\Database\Eloquent\SoftDeletes;

class EducationalMaterial extends Model
{
    use HasFactory, SoftDeletes;

    protected $table = 'educational_materials';

    protected $fillable = [
        'area_id',
        'category',
        'display_name',
        'type',
        'title',
        'short_description',
        'main_image',
        'full_description',
        'gallery_image_1',
        'gallery_image_2',
        'gallery_image_3',
        'gallery_image_4',
        'gallery_image_5',
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

        // Automatic order by category
        static::creating(function ($model) {
            if (empty($model->order)) {
                $maxOrder = static::where('category', $model->category)->max('order') ?? 0;
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
            static::where('category', $model->category)
                ->where('order', '>', $model->order)
                ->decrement('order');
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

    public function scopeOrdered($query)
    {
        return $query->orderBy('order', 'asc');
    }

    public function scopeCategory($query, $category)
    {
        return $query->where('category', $category);
    }

    public function scopeType($query, $type)
    {
        return $query->where('type', $type);
    }

    public function scopeEarlyChildhood($query)
    {
        return $query->where('category', 'early_childhood');
    }

    /**
     * Accessors
     */
    public function getCategoryLabelAttribute(): string
    {
        return match($this->category) {
            'early_childhood' => 'Primera Infancia',
            'childhood'       => 'Niñez, Adolescencia y Juventud',
            'women'           => 'Mujer',
            'workers'         => 'Trabajadores',
            default           => $this->category,
        };
    }

    public function getTypeLabelAttribute(): string
    {
        return match($this->type) {
            'guides_manuals' => 'Guías y Manuales',
            'games' => 'Juegos',
            default => $this->type,
        };
    }

    /**
     * Get all gallery images
     */
    public function getGalleryImagesAttribute(): array
    {
        return array_filter([
            $this->gallery_image_1,
            $this->gallery_image_2,
            $this->gallery_image_3,
            $this->gallery_image_4,
            $this->gallery_image_5,
        ]);
    }
}