<?php
/**
 * LARABIZ CMS - Full SPA Laravel CMS
 *
 * @package    larabizcom/larabiz
 * @author     The Anh Dang
 * @link       https://larabiz.com
 */

namespace LarabizCMS\Modules\Blog\Http\Controllers\Admin;

use LarabizCMS\Core\Facades\Breadcrumb;
use LarabizCMS\Core\Http\Controllers\AdminController;
use LarabizCMS\Core\PageBuilder\Page;
use LarabizCMS\Modules\Blog\Repositories\PostRepository;
use LarabizCMS\Modules\Blog\Http\DataTables\PostDatatable;
use LarabizCMS\Modules\Blog\Http\Forms\PostForm;

class PostController extends AdminController
{
    public function __construct(
        protected PostRepository $postRepository
    ) {
        //
    }

    public function index(): Page
    {
        Breadcrumb::add(__('Posts'));

        $page = Page::make()->template('crud-index');

        $page->fill(['title' => __('Posts'), 'description' => __('Posts')]);

        $page->add(PostDatatable::make());

        return $page;
    }

    public function create(): Page
    {
        Breadcrumb::add(__('Posts'), '/admin-cp/posts');
        Breadcrumb::add(__('New Post'));

        $page = Page::make();

        $page->fill(['title' => __('New Post'), 'description' => __('New Post')]);

        $page->add(PostForm::make(['method' => 'POST', 'action' => '/blog/internal/posts']));

        return $page;
    }

    public function edit(string $id): Page
    {
        $model = $this->postRepository->find($id);

        abort_if($model === null, 404, __('Post not found'));

        $page = Page::make(
            [
                'title' => __('Edit Post: :name', ['name' => $model->name]),
                'description' => __('Edit Post: :name', ['name' => $model->name]),
            ]
        );
        Breadcrumb::add(__('Posts'), '/admin-cp/posts');
        Breadcrumb::add(__('Edit Post: :name', ['name' => $model->name]));

        $page->add(PostForm::make(['method' => 'PUT', 'action' => "/blog/internal/posts/{$model->id}"])->withModel($model));

        return $page;
    }
}
