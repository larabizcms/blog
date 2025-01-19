<?php

namespace LarabizCMS\Modules\Blog\Models;

use LarabizCMS\Core\Models\Model;

class PostTranslation extends Model
{
    protected $table = 'posts_translations';

    protected $fillable = [
        'locale',
        'title',
        'slug',
        'content',
    ];
}
