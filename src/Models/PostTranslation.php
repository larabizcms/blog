<?php

namespace LarabizCMS\Modules\Blog\Models;

use LarabizCMS\Core\Models\Model;
use LarabizCMS\Core\Traits\HasSlug;

class PostTranslation extends Model
{
    use HasSlug;

    protected $table = 'post_translations';

    protected $fillable = [
        'locale',
        'title',
        'slug',
        'content',
    ];
}
