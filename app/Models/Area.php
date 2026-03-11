<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;
use Illuminate\Database\Eloquent\Relations\HasMany;
use Illuminate\Database\Eloquent\Relations\HasOne;

class Area extends Model
{
    use HasFactory;

    protected $table = 'areas';

    protected $fillable = [
        'name',
        'slug',
        'description',
        'icon',
        'image',
        'order',
        'active',
        'coordinator_id',
        'formal_education_description',
        'formal_education_icon',
        'formal_education_color',
        'non_formal_education_description',
        'non_formal_education_icon',
        'non_formal_education_color',
        'educational_materials_description',
        'educational_materials_icon',
        'educational_materials_color',
        'created_by',
        'updated_by',
    ];

    protected $casts = [
        'active' => 'boolean',
        'order' => 'integer',
    ];

    /**
     * Boot model for automatic order and audit
     */
    protected static function boot()
    {
        parent::boot();

        // Assign automatic order on create
        static::creating(function ($model) {
            if (empty($model->order)) {
                $maxOrder = static::max('order') ?? 0;
                $model->order = $maxOrder + 1;
            }

            // Assign creator user
            if (auth()->check()) {
                $model->created_by = auth()->id();
            }
        });

        // Update modifier user
        static::updating(function ($model) {
            if (auth()->check()) {
                $model->updated_by = auth()->id();
            }
        });

        // Reorganize orders on delete
        static::deleted(function ($model) {
            static::where('order', '>', $model->order)->decrement('order');
        });
    }

    /**
     * Relationships
     */
    public function coordinator(): BelongsTo
    {
        return $this->belongsTo(Team::class, 'coordinator_id');
    }

    public function formalEducationSections(): HasMany
    {
        return $this->hasMany(FormalEducationSection::class);
    }

    public function courses(): HasMany
    {
        return $this->hasMany(Course::class);
    }

    public function educationalMaterials(): HasMany
    {
        return $this->hasMany(EducationalMaterial::class);
    }

    public function publications(): HasMany
    {
        return $this->hasMany(Publication::class);
    }

    public function researchGroup(): HasOne
    {
        return $this->hasOne(ResearchGroup::class);
    }

    public function healthPromotionCategories(): HasMany
    {
        return $this->hasMany(HealthPromotionCategory::class);
    }

    /**
     * Audit users
     */
    public function createdBy()
    {
        return $this->belongsTo(User::class, 'created_by');
    }

    public function updatedBy()
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
}