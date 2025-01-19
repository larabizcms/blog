<?php

namespace LarabizCMS\Modules\Blog\Models;

use Illuminate\Database\Eloquent\Builder;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Relations\BelongsToMany;
use LarabizCMS\Core\Models\Model;
use LarabizCMS\Core\Traits\HasAPI;
use LarabizCMS\Core\Translations\Traits\Translatable;
use LarabizCMS\Modules\Blog\Database\Factories\PostFactory;
use LarabizCMS\Modules\Blog\Models\Enums\PostStatus;

class Post extends Model
{
    use HasFactory, Translatable, HasAPI;

    protected $fillable = [
        'type',
        'status',
    ];

    protected $casts = [
        'status' => PostStatus::class,
    ];

    public $translatedAttributes = [
        'locale',
        'title',
        'slug',
        'description',
        'content',
    ];

    protected static function newFactory(): PostFactory
    {
        return PostFactory::new();
    }

    public function taxonomies(): BelongsToMany
    {
        return $this->belongsToMany(
            Taxonomy::class,
            'post_has_taxonomies',
            'post_id',
            'taxonomy_id',
            'id',
            'id'
        );
    }

    public function scopeInApiGuest(Builder $builder): Builder
    {
        return $builder->where('status', PostStatus::PUBLISHED);
    }
}
