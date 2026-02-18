<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;
use Illuminate\Database\Eloquent\SoftDeletes;

class FormalEducationSection extends Model
{
    use HasFactory, SoftDeletes;

    protected $table = 'formal_education_sections';

    protected $fillable = [
        'area_id',
        'section',
        'title',
        'description',
        'image',
        'pdf_file',
        'url',
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

        // Automatic order by section
        static::creating(function ($model) {
            if (empty($model->order)) {
                $maxOrder = static::where('section', $model->section)->max('order') ?? 0;
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

        // Reorganize orders on delete (within same section)
        static::deleted(function ($model) {
            static::where('section', $model->section)
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

    public function scopeSection($query, $section)
    {
        return $query->where('section', $section);
    }

    /**
     * Accessors
     */
    public function getSectionLabelAttribute(): string
    {
        return match($this->section) {
            'generalities' => 'Generalidades',
            'modalities' => 'Modalidades',
            'procedures' => 'Procedimientos',
            'intern_commitments' => 'Compromisos del Pasante',
            'institute_commitments' => 'Compromisos del Instituto',
            default => $this->section,
        };
    }
}