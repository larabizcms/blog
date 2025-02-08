<?php

namespace LarabizCMS\Modules\Blog\Models;

use LarabizCMS\Core\Models\Model;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use LarabizCMS\Core\Traits\HasSlug;
use LarabizCMS\Modules\Blog\Database\Factories\TaxonomyTranslationFactory;

class TaxonomyTranslation extends Model
{
    use HasFactory, HasSlug;

    protected $fillable = [
        'locale',
        'name',
        'slug',
        'description',
    ];

    protected static function newFactory(): TaxonomyTranslationFactory
    {
        return TaxonomyTranslationFactory::new();
    }
}
