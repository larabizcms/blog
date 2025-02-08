<?php
/**
 * LARABIZ CMS - Full SPA Laravel CMS
 *
 * @package    larabizcom/larabiz
 * @author     The Anh Dang
 * @link       https://larabiz.com
 */

namespace LarabizCMS\Modules\Blog\Http\Controllers\APIs\Management;

use Illuminate\Http\JsonResponse;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use LarabizCMS\Core\Http\Controllers\APIController;
use LarabizCMS\Modules\Blog\Http\Requests\TaxonomyActionsRequest;
use LarabizCMS\Modules\Blog\Http\Requests\TaxonomyRequest;
use LarabizCMS\Modules\Blog\Repositories\TaxonomyRepository;

class TaxonomyController extends APIController
{
    public function __construct(
        protected TaxonomyRepository $taxonomyRepository
    ) {
    }

    public function index(Request $request): JsonResponse
    {
        $models = $this->taxonomyRepository
            ->api($request->all())
            ->withTranslation()
            ->paginate($this->getQueryLimit($request));

        return $this->restSuccess($models);
    }

    public function store(TaxonomyRequest $request): JsonResponse
    {
        DB::transaction(fn () => $this->taxonomyRepository->create($request->safe()->all()));

        return $this->restSuccess([], 'Taxonomy created successfully');
    }

    public function show(string $id): JsonResponse
    {
        $model = $this->taxonomyRepository->api()->find($id);

        abort_if($model === null, 404, __('Taxonomy not found'));

        return $this->restSuccess($model);
    }

    public function update(TaxonomyRequest $request, string $id): JsonResponse
    {
        $model = $this->taxonomyRepository->api()->find($id);

        abort_if($model === null, 404, __('Taxonomy not found'));

        DB::transaction(fn () => $model->update($request->safe()->all()));

        return $this->restSuccess($model, 'Taxonomy updated successfully');
    }

    public function destroy(string $id): JsonResponse
    {
        $model = $this->taxonomyRepository->api()->find($id);

        abort_if($model === null, 404, __('Taxonomy not found'));

        $model->delete();

        return $this->restSuccess([], 'Taxonomy deleted successfully');
    }

    public function bulk(TaxonomyActionsRequest $request): JsonResponse
    {
        $action = $request->post('action');
        $ids = $request->post('ids');

        DB::transaction(fn () => $this->taxonomyRepository->bulk($action, $ids));

        return $this->restSuccess([], 'Taxonomies updated successfully');
    }
}
