<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class FAQCategory extends Model
{
    protected $table = 'faq_categories';
    
    protected $fillable = ['name', 'description'];
    
    public function questions()
    {
        return $this->hasMany(FAQQuestion::class, 'category_id');
    }
}