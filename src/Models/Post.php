<?php

namespace LarabizCMS\Modules\Blog\Models;

use Astrotomic\Translatable\Translatable;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use LarabizCMS\LaravelModelHelper\Traits\HasAPI;

class Post extends Model
{
    use HasFactory, Translatable, HasAPI;

    protected $fillable = [
        'type',
        'status',
    ];

    public $translatedAttributes = [
        'locale',
        'title',
        'slug',
        'description',
        'content',
    ];

    protected static function newFactory()
    {
        return \LarabizCMS\Modules\Blog\Database\Factories\PostFactory::new();
    }
}
