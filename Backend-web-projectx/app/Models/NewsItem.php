<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class NewsItem extends Model
{
    use HasFactory;

    protected $table = 'news_items';
    
    protected $fillable = [
        'title',
        'image',
        'content',
        'publication_date'
    ];

    protected $casts = [
        'publication_date' => 'date',
    ];
}