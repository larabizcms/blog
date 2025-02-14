<?php

namespace LarabizCMS\Modules\Blog\Http\Controllers\APIs\Management;

use Illuminate\Http\JsonResponse;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Str;
use LarabizCMS\Core\Http\Controllers\APIController;
use LarabizCMS\Modules\Blog\Http\Requests\PostActionsRequest;
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
                ->withTranslation(with: ['media'])
                ->where('type', $type)
                ->paginate($this->getQueryLimit($request))
        );
    }

    public function store(string $type, PostRequest $request): JsonResponse
    {
        DB::transaction(fn () => $this->postRepository->createEntity($request->safe()->all()));

        return $this->restSuccess([], 'Post created successfully');
    }

    public function show(Request $request, string $type, string $slug): JsonResponse
    {
        $type = Str::singular($type);

        $post = $this->postRepository->api()
            ->where('type', $type)
            ->withTranslation(with: ['media'])
            ->whereHas('translations', fn ($q) => $q->where('slug', $slug))
            ->first();

        abort_if($post === null, 404, __('Post not found'));

        return $this->restSuccess($post);
    }

    public function update(PostRequest $request, string $type, $id): JsonResponse
    {
        $locale = $request->input('locale');

        $post = $this->postRepository->withTranslation($locale, with: ['media'])->find($id);

        abort_if($post === null, 404, __('Post not found'));

        DB::transaction(fn () => $this->postRepository->updateEntity($post, $request->safe()->all()));

        return $this->restSuccess([], 'Post updated successfully');
    }

    public function destroy(string $type, string $id): JsonResponse
    {
        $post = $this->postRepository->find($id);

        abort_if($post === null, 404, __('Post not found'));

        $post->delete();

        return $this->restSuccess([], 'Post deleted successfully');
    }

    public function bulk(string $type, PostActionsRequest $request): JsonResponse
    {
        $action = $request->post('action');
        $ids = $request->post('ids');

        DB::transaction(fn () => $this->postRepository->bulk($action, $ids));

        return $this->restSuccess([], 'Post updated successfully');
    }
}
