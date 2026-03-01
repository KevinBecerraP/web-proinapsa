<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;

class ResearchLine extends Model
{
    use HasFactory;

    protected $table = 'research_lines';

    protected $fillable = [
        'research_group_id',
        'title',
        'description',
        'order',
        'active',
    ];

    protected $casts = [
        'active' => 'boolean',
        'order'  => 'integer',
    ];

    protected static function boot()
    {
        parent::boot();

        static::creating(function ($model) {
            if (empty($model->order)) {
                $max = static::where('research_group_id', $model->research_group_id)->max('order') ?? 0;
                $model->order = $max + 1;
            }
        });

        static::deleted(function ($model) {
            static::where('research_group_id', $model->research_group_id)
                ->where('order', '>', $model->order)
                ->decrement('order');
        });
    }

    public function researchGroup(): BelongsTo
    {
        return $this->belongsTo(ResearchGroup::class);
    }

    public function scopeActive($query)
    {
        return $query->where('active', true);
    }

    public function scopeOrdered($query)
    {
        return $query->orderBy('order', 'asc');
    }
}
