<?php

namespace LarabizCMS\Modules\Blog\Http\Controllers\APIs;

use Illuminate\Http\JsonResponse;
use Illuminate\Http\Request;
use Illuminate\Support\Str;
use LarabizCMS\Core\Http\Controllers\APIController;
use LarabizCMS\Modules\Blog\Repositories\PostRepository;

class PostController extends APIController
{
    public function __construct(
        protected PostRepository $postRepository
    ) {
        //
    }

    public function index(Request $request, string $type): JsonResponse
    {
        $type = Str::singular($type);
        $locale = app()->getLocale();

        return $this->restSuccess(
            $this->postRepository->api($request->all())
                ->wherePublished()
                ->withTranslation()
                ->translatedIn($locale)
                ->where('type', $type)
                ->paginate($this->getQueryLimit($request))
        );
    }

    public function show(Request $request, string $type, string $slug): JsonResponse
    {
        $type = Str::singular($type);

        $post = $this->postRepository->api()
            ->where('type', $type)
            ->withTranslation()
            ->whereHas('translations', fn ($q) => $q->where('slug', $slug))
            ->first();

        abort_if($post === null, 404, __('Post not found'));

        return $this->restSuccess($post);
    }
}
