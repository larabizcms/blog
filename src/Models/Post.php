<?php

namespace LarabizCMS\Modules\Blog\Models;

use Illuminate\Database\Eloquent\Builder;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Relations\BelongsToMany;
use LarabizCMS\Core\Models\Model;
use LarabizCMS\Core\Traits\HasAPI;
use LarabizCMS\Core\Translations\Contracts\Translatable as WithTranslatable;
use LarabizCMS\Core\Translations\Traits\Translatable;
use LarabizCMS\Modules\Blog\Database\Factories\PostFactory;
use LarabizCMS\Modules\Blog\Http\Resources\PostCollection;
use LarabizCMS\Modules\Blog\Http\Resources\PostResource;
use LarabizCMS\Modules\Blog\Models\Enums\PostStatus;

class Post extends Model implements WithTranslatable
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
        'thumbnail',
    ];

    protected static function newFactory(): PostFactory
    {
        return PostFactory::new();
    }

    public static function getResource(): string
    {
        return PostResource::class;
    }

    public static function getCollectionResource(): string
    {
        return PostCollection::class;
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

    public function scopeWherePublished(Builder $builder): Builder
    {
        return $builder->where('status', PostStatus::PUBLISHED);
    }

    public function scopeRelatedBy(Builder $builder, Post $post): Builder
    {
        return $builder->where('id', '!=', $post->id);
            // ->whereHas(
            //     'taxonomies',
            //     fn ($q) => $q->whereIn('taxonomy_id', $post->taxonomies->pluck('id'))
            // );
    }

    public function publish(): bool
    {
        return $this->update(['status' => PostStatus::PUBLISHED]);
    }

    public function draft(): bool
    {
        return $this->update(['status' => PostStatus::DRAFT]);
    }
}
