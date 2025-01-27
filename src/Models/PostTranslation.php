<?php

namespace LarabizCMS\Modules\Blog\Models;

use Illuminate\Database\Eloquent\Builder;
use Illuminate\Database\Eloquent\Relations\BelongsTo;
use LarabizCMS\Core\Casts\Media;
use LarabizCMS\Core\Contracts\Sitemapable;
use LarabizCMS\Core\Media\Traits\HasMediaColumns;
use LarabizCMS\Core\Models\Media as MediaModel;
use LarabizCMS\Core\Models\Model;
use LarabizCMS\Core\Traits\HasSlug;
use LarabizCMS\Modules\Blog\Models\Enums\PostStatus;
use Spatie\Sitemap\Tags\Url;

class PostTranslation extends Model implements Sitemapable
{
    use HasSlug, HasMediaColumns;

    protected $table = 'post_translations';

    protected $fillable = [
        'locale',
        'title',
        'slug',
        'content',
        'thumbnail',
    ];

    protected $casts = [
        'thumbnail' => Media::class,
    ];

    public $mediaColumns = [
        'thumbnail',
    ];

    public static function getSitemapPage(): string
    {
        return 'posts';
    }

    public function media(): BelongsTo
    {
        return $this->belongsTo(MediaModel::class, 'thumbnail', 'id');
    }

    public function scopeForSitemap(Builder $builder): Builder
    {
        return $builder->join('posts', 'posts.id', '=', 'post_translations.post_id')
            ->where('posts.status', PostStatus::PUBLISHED->value);
    }

    public function toSitemapTag(): Url
    {
        return Url::create("/{$this->locale}/blog/{$this->slug}")
            ->setLastModificationDate($this->updated_at)
            ->setChangeFrequency(Url::CHANGE_FREQUENCY_YEARLY)
            ->setPriority(0.8);
    }
}
