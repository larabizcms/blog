<?php

namespace LarabizCMS\Modules\Blog\Models;

use LarabizCMS\Core\Models\Model;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use LarabizCMS\Modules\Blog\Database\Factories\TaxonomyTranslationFactory;

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

    protected static function newFactory(): TaxonomyTranslationFactory
    {
        return TaxonomyTranslationFactory::new();
    }
}
