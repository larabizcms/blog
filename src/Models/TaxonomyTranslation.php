<?php

namespace LarabizCMS\Modules\Blog\Models;

use LarabizCMS\Core\Models\Model;
use Illuminate\Database\Eloquent\Factories\HasFactory;

class TaxonomyTranslation extends Model
{
    use HasFactory;

    protected $fillable = [
        'locale',
        'title',
        'slug',
        'description',
        'content',
    ];

    protected static function newFactory()
    {
        return \LarabizCMS\Modules\Blog\Database\Factories\TaxonomyTranslationFactory::new();
    }
}
