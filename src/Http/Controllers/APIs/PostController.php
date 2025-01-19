<?php

namespace LarabizCMS\Modules\Blog\Http\Controllers\APIs;

use Illuminate\Http\JsonResponse;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Str;
use LarabizCMS\Core\Http\Controllers\APIController;
use LarabizCMS\Modules\Blog\Http\Requests\PostRequest;
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

        return $this->restSuccess(
            $this->postRepository->api($request->all())
                ->withTranslation()
                ->where('type', $type)
                ->paginate($this->getQueryLimit($request))
        );
    }

    public function store(PostRequest $request): JsonResponse
    {
        DB::transaction(fn () => $this->postRepository->create($request->safe()->all()));

        return $this->restSuccess([], 'Post created successfully');
    }

    public function show(string $type, string $slug): JsonResponse
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

    public function update(PostRequest $request, $id): JsonResponse
    {
        $post = $this->postRepository->find($id);

        abort_if($post === null, 404, __('Post not found'));

        DB::transaction(fn () => $post->update($request->safe()->all()));

        return $this->restSuccess([], 'Post updated successfully');
    }

    public function destroy(string $id): JsonResponse
    {
        $post = $this->postRepository->find($id);

        abort_if($post === null, 404, __('Post not found'));

        $post->delete();

        return $this->restSuccess([], 'Post deleted successfully');
    }
}
