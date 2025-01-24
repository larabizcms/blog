<?php

namespace LarabizCMS\Modules\Blog\Models;

use Illuminate\Database\Eloquent\Relations\BelongsTo;
use LarabizCMS\Core\Casts\Media;
use LarabizCMS\Core\Media\Traits\HasMediaColumns;
use LarabizCMS\Core\Models\Model;
use LarabizCMS\Core\Traits\HasSlug;

class PostTranslation extends Model
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

    public function media(): BelongsTo
    {
        return $this->belongsTo(\LarabizCMS\Core\Models\Media::class, 'thumbnail', 'id');
    }
}
