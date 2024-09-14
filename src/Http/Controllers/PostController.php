<?php

namespace LarabizCMS\Modules\Blog\Http\Controllers;

use Illuminate\Contracts\Support\Renderable;
use Illuminate\Http\Request;
use LarabizCMS\Core\Http\Controllers\Controller;
use LarabizCMS\Modules\Blog\Repositories\PostRepository;

class PostController extends Controller
{
    public function __construct(
        protected PostRepository $postRepository
    ) {
        //
    }

    public function index(Request $request)
    {
        return $this->restSuccess(
            $this->postRepository->api($request->all())
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

    /**
     * Show the specified resource.
     * @param int $id
     * @return Renderable
     */
    public function show($id)
    {
        return view('blog::show');
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
    public function destroy($id)
    {
        //
    }
}
