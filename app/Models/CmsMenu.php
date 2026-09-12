<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class CmsMenu extends Model
{
    protected $table = 'cms_menus';

    protected $fillable = [
        'title',
        'url',
        'position',
        'sort_order',
        'is_active',
    ];

    protected $casts = ['is_active' => 'boolean'];

}
