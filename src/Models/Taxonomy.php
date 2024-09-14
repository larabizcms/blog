<?php

namespace LarabizCMS\Modules\Blog\Models;

use Astrotomic\Translatable\Translatable;
use Illuminate\Database\Eloquent\Concerns\HasUuids;
use LarabizCMS\Core\Models\Model;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use LarabizCMS\LaravelModelHelper\Traits\HasAPI;

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

    protected static function newFactory()
    {
        return \LarabizCMS\Modules\Blog\Database\Factories\TaxonomyFactory::new();
    }

    public function posts()
    {
        return $this->hasMany(Post::class);
    }

    public function parent()
    {
        return $this->belongsTo(Taxonomy::class, 'parent_id');
    }

    public function children()
    {
        return $this->hasMany(Taxonomy::class, 'parent_id');
    }
}
