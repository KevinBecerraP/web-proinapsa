<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;
use Illuminate\Database\Eloquent\Relations\HasMany;

class EducationalMaterialGroup extends Model
{
    protected $table = 'educational_material_groups';

    protected $fillable = [
        'category',
        'display_name',
        'type',
        'title',
        'slug',
        'description',
        'icon',
        'color',
        'is_active',
        'order',
        'created_by',
        'updated_by',
    ];

    protected $casts = [
        'is_active' => 'boolean',
        'order'     => 'integer',
    ];

    protected static function boot()
    {
        parent::boot();

        static::creating(function ($model) {
            if (empty($model->order)) {
                $model->order = (static::max('order') ?? 0) + 1;
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

    public function scopeOrdered($query)
    {
        return $query->orderBy('order', 'asc');
    }

    public function educationalMaterials(): HasMany
    {
        return $this->hasMany(EducationalMaterial::class, 'category', 'category')
            ->where('type', $this->type);
    }

    public function createdBy(): BelongsTo
    {
        return $this->belongsTo(User::class, 'created_by');
    }

    public function updatedBy(): BelongsTo
    {
        return $this->belongsTo(User::class, 'updated_by');
    }

    public function scopeActive($query)
    {
        return $query->where('is_active', true);
    }

    public function getCategoryLabelAttribute(): string
    {
        if ($this->display_name) {
            return $this->display_name;
        }

        return match ($this->category) {
            'early_childhood'    => 'Primera Infancia',
            'childhood'          => 'Niñez, Adolescencia y Juventud',
            'women'              => 'Mujer',
            'workers'            => 'Trabajadores',
            'school_adolescence' => 'Escolar y Adolescencia',
            default              => $this->category,
        };
    }

    public function getTypeLabelAttribute(): string
    {
        return match ($this->type) {
            'guides_manuals' => 'Guías y Manuales',
            'games'          => 'Juegos',
            default          => $this->type,
        };
    }
}
