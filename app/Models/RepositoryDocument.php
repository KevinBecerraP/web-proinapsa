<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class RepositoryDocument extends Model
{
    use HasFactory;

    protected $fillable = [
        'repository_category_id',
        'title',
        'authors',
        'topic',
        'description',
        'image',
        'document',
        'order',
        'status',
    ];

    protected function casts(): array
    {
        return [
            'status' => 'boolean',
            'order' => 'integer',
        ];
    }

    // Relación: Pertenece a una categoría
    public function category()
    {
        return $this->belongsTo(RepositoryCategory::class, 'repository_category_id');
    }

    // Scope: Solo activos
    public function scopeActive($query)
    {
        return $query->where('status', true);
    }

    // Scope: Ordenados
    public function scopeOrdered($query)
    {
        return $query->orderBy('order', 'asc');
    }
}