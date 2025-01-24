<?php

namespace LarabizCMS\Modules\Blog\Http\Resources;

use Illuminate\Http\Request;
use Illuminate\Http\Resources\Json\ResourceCollection;
use Illuminate\Database\Eloquent\Collection;
use LarabizCMS\Modules\Blog\Models\Post;

/**
 * @property-read Collection<Post> $collection
 */
class PostCollection extends ResourceCollection
{
    /**
     * Transform the resource collection into an array.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return array
     */
    public function toArray(Request $request): array
    {
        return $this->collection->map(
            function ($item) {
                return [
					'id' => $item->id,
					'locale' => $item->locale,
					'title' => $item->title,
					'slug' => $item->slug,
					'description' => $item->description,
					'thumbnail' => $item->thumbnail?->getConversionResponse(),
					'created_at' => $item->created_at,
					'updated_at' => $item->updated_at,
				];
            }
        )->toArray();
    }
}
