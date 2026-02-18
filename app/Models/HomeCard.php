<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class HomeCard extends Model
{
    use HasFactory;

    /**
     * Campos asignables en masa
     */
    protected $fillable = [
        'title',
        'description',
        'type',
        'file_path',
        'url',
        'button_text',
        'order',
        'estado',
    ];

    /**
     * Conversión de tipos
     */
    protected $casts = [
        'estado' => 'boolean',
        'order' => 'integer',
    ];

    /**
     * Scope: Solo tarjetas activas
     */
    public function scopeActive($query)
    {
        return $query->where('estado', true);
    }

    /**
     * Scope: Ordenadas por campo order
     */
    public function scopeOrdered($query)
    {
        return $query->orderBy('order', 'asc');
    }

    /**
     * Scope: Tarjetas visibles en home (activas y limitadas a 6)
     */
    public function scopeVisibleInHome($query)
    {
        return $query->active()->ordered()->limit(6);
    }

    /**
     * Accessor: Obtener la URL del archivo PDF
     */
    public function getFileUrlAttribute()
    {
        if ($this->type === 'pdf' && $this->file_path) {
            return asset('storage/' . $this->file_path);
        }
        return null;
    }

    /**
     * Accessor: Obtener el enlace correcto según el tipo
     */
    public function getLinkAttribute()
    {
        return $this->type === 'pdf' ? $this->file_url : $this->url;
    }
}