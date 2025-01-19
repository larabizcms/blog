<?php

namespace LarabizCMS\Modules\Blog\Models;

use Astrotomic\Translatable\Translatable;
use Illuminate\Database\Eloquent\Concerns\HasUuids;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Relations\BelongsTo;
use Illuminate\Database\Eloquent\Relations\BelongsToMany;
use Illuminate\Database\Eloquent\Relations\HasMany;
use LarabizCMS\Core\Models\Model;
use LarabizCMS\Core\Traits\HasAPI;
use LarabizCMS\Modules\Blog\Database\Factories\TaxonomyFactory;

class Taxonomy extends Model
{
    use HasFactory, HasAPI, HasUuids, Translatable;

    protected $fillable = [
        'type',
        'parent_id',
    ];

    public $translatedAttributes = [
        'name',
        'slug',
        'description',
    ];

    protected static function newFactory(): TaxonomyFactory
    {
        return TaxonomyFactory::new();
    }

    public function posts(): BelongsToMany
    {
        return $this->belongsToMany(
            Post::class,
            'post_has_taxonomies',
            'taxonomy_id',
            'post_id',
            'id',
            'id'
        );
    }

    public function parent(): BelongsTo
    {
        return $this->belongsTo(__CLASS__, 'parent_id');
    }

    public function children(): HasMany
    {
        return $this->hasMany(__CLASS__, 'parent_id');
    }
}
