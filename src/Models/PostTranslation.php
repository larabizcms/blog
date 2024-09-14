<?php

namespace LarabizCMS\Modules\Blog\Models;

use Illuminate\Database\Eloquent\Model;

class PostTranslation extends Model
{

    protected $fillable = [
        'locale',
        'title',
        'slug',
        'content',
    ];
}
