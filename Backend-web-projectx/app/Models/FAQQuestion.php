<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class FAQQuestion extends Model
{
    protected $table = 'faq_questions';
    protected $fillable = [
        'category_id',
        'question',
        'answer',
        'order',
        'is_active'
    ];

    protected $casts = [
        'is_active' => 'boolean',
    ];

    public function category()
    {
        return $this->belongsTo(FAQCategory::class, 'category_id');
    }
}