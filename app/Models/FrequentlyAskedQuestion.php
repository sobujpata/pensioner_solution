<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class FrequentlyAskedQuestion extends Model
{
    protected $fillable = [
        'category_id',
        'name',
        'description',
        'respective_section',
        'image_url'
    ];
    public function category()
    {
        return $this->belongsTo(Category::class);
    }
}
