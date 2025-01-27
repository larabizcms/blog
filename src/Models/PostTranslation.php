<?php

namespace LarabizCMS\Modules\Blog\Models;

use Illuminate\Database\Eloquent\Builder;
use LarabizCMS\Core\Contracts\Sitemapable;
use LarabizCMS\Core\Media\Traits\HasMedia;
use LarabizCMS\Core\Models\Media;
use LarabizCMS\Core\Models\Model;
use LarabizCMS\Core\Traits\HasSlug;
use LarabizCMS\Modules\Blog\Models\Enums\PostStatus;
use Spatie\Sitemap\Tags\Url;

class PostTranslation extends Model implements Sitemapable
{
    use HasSlug, HasMedia;

    protected $table = 'post_translations';

    protected $fillable = [
        'locale',
        'title',
        'slug',
        'content',
        'thumbnail',
    ];

    public $mediaChannels = [
        'thumbnail',
    ];

    protected $appends = [
        'thumbnail',
    ];

    public static function getSitemapPage(): string
    {
        return 'posts';
    }

    public function scopeForSitemap(Builder $builder): Builder
    {
        return $builder->with(['media'])
            ->join('posts', 'posts.id', '=', 'post_translations.post_id')
            ->where('posts.status', PostStatus::PUBLISHED->value);
    }

    public function getThumbnailAttribute(): ?Media
    {
        return $this->getFirstMedia('thumbnail');
    }

    public function setThumbnailAttribute($value): void
    {
        if (! $value) {
            return;
        }

        $this->attachMedia($value, 'thumbnail');
    }

    public function toSitemapTag(): Url
    {
        $url = Url::create("/{$this->locale}/blog/{$this->slug}")
            ->setLastModificationDate($this->updated_at)
            ->setChangeFrequency(Url::CHANGE_FREQUENCY_YEARLY)
            ->setPriority(0.8);

        if ($this->thumbnail) {
            $url->addImage($this->thumbnail->getUrl());
        }

        return $url;
    }
}
