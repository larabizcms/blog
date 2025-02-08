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
use LarabizCMS\Modules\Blog\Repositories\TaxonomyRepository;
use LarabizCMS\Modules\Blog\Http\DataTables\TaxonomyDatatable;
use LarabizCMS\Modules\Blog\Http\Forms\TaxonomyForm;

class TaxonomyController extends AdminController
{
    public function __construct(
        protected TaxonomyRepository $taxonomyRepository
    ) {
        //
    }

    public function index(): Page
    {
        Breadcrumb::add(__('Taxonomies'));

        $page = Page::make()->template('crud-index');

        $page->fill(['title' => __('Taxonomies'), 'description' => __('Taxonomies')]);

        $page->add(TaxonomyDatatable::make());

        return $page;
    }

    public function create(): Page
    {
        Breadcrumb::add(__('Taxonomies'), '/admin-cp/taxonomies');
        Breadcrumb::add(__('New Taxonomy'));

        $page = Page::make();

        $page->fill(['title' => __('New Taxonomy'), 'description' => __('New Taxonomy')]);

        $page->add(TaxonomyForm::make(['method' => 'POST', 'action' => '/blog/internal/taxonomies']));

        return $page;
    }

    public function edit(string $id): Page
    {
        $model = $this->taxonomyRepository->find($id);

        abort_if($model === null, 404, __('Taxonomy not found'));

        $page = Page::make(
            [
                'title' => __('Edit Taxonomy: :name', ['name' => $model->name]),
                'description' => __('Edit Taxonomy: :name', ['name' => $model->name]),
            ]
        );
        Breadcrumb::add(__('Taxonomies'), '/admin-cp/taxonomies');
        Breadcrumb::add(__('Edit Taxonomy: :name', ['name' => $model->name]));

        $page->add(TaxonomyForm::make(['method' => 'PUT', 'action' => "/blog/internal/taxonomies/{$model->id}"])->withModel($model));

        return $page;
    }
}
