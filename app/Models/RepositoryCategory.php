<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class RepositoryCategory extends Model
{
    use HasFactory;

    protected $fillable = [
        'title',
        'description',
        'image',
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

    // Relación: Tiene muchos documentos
    public function documents()
    {
        return $this->hasMany(RepositoryDocument::class)->orderBy('order');
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