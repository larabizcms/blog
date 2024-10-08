<?php

namespace LarabizCMS\Modules\Blog\Http\Controllers;

use Illuminate\Contracts\Support\Renderable;
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

        return $this->restSuccess(
            $this->postRepository->api($request->all())
                ->where('type', $type)
                ->paginate($this->getQueryLimit($request))
        );
    }

    /**
     * Store a newly created resource in storage.
     * @param Request $request
     * @return Renderable
     */
    public function store(Request $request)
    {
        //
    }

    public function show(string $type, string $slug): JsonResponse
    {
        $type = Str::singular($type);

        $post = $this->postRepository->api()
            ->where('type', $type)
            ->with(['translations' => fn ($q) => $q->where('locale', app()->getLocale())])
            ->whereHas('translations', fn ($q) => $q->where('slug', $slug))
            ->first();

        abort_if($post === null, 404, __('Post not found'));

        return $this->restSuccess($post);
    }

    /**
     * Update the specified resource in storage.
     * @param Request $request
     * @param int $id
     * @return Renderable
     */
    public function update(Request $request, $id)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     * @param int $id
     * @return Renderable
     */
    public function destroy(string $id)
    {
        //
    }
}
