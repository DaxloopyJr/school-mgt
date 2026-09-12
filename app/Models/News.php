<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class News extends Model
{
    protected $table = 'news';

    protected $fillable = [
        'title',
        'news_category_id',
        'image',
        'description',
        'publish_date',
    ];

    protected $casts = ['publish_date' => 'date'];

    public function newsCategory()
    {
        return $this->belongsTo(NewsCategory::class, 'news_category_id');
    }
}
