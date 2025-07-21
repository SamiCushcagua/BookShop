<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Book extends Model
{
    use HasFactory;

    protected $fillable = [
        'title',
        'author',
        'description',
        'price',
        'stock',
        'isbn',
        'publisher',
        'publication_year',
        'condition',
        'cover_image',
        'category',
        'language',
        'is_available',
        'user_id'
    ];

    protected $casts = [
        'price' => 'decimal:2',
        'stock' => 'integer',
        'publication_year' => 'integer',
        'is_available' => 'boolean',
    ];

    /**
     * Relación con el usuario que vende el libro
     */
    public function seller()
    {
        return $this->belongsTo(User::class, 'user_id');
    }

    /**
     * Scope para libros disponibles
     */
    public function scopeAvailable($query)
    {
        return $query->where('is_available', true)->where('stock', '>', 0);
    }

    /**
     * Scope para buscar por categoría
     */
    public function scopeByCategory($query, $category)
    {
        return $query->where('category', $category);
    }

    /**
     * Scope para buscar por precio
     */
    public function scopeByPriceRange($query, $minPrice, $maxPrice)
    {
        return $query->whereBetween('price', [$minPrice, $maxPrice]);
    }
}