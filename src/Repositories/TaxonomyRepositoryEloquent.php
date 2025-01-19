<?php
/**
 * LARABIZ CMS - Full SPA Laravel CMS
 *
 * @package    larabizcms/larabiz
 * @author     The Anh Dang
 * @link       https://larabiz.com
 */

namespace LarabizCMS\Modules\Blog\Repositories;

use LarabizCMS\Core\Repositories\EloquentRepository;
use LarabizCMS\Core\Repositories\Traits\HasBulkActions;
use LarabizCMS\Modules\Blog\Models\Taxonomy;

class TaxonomyRepositoryEloquent extends EloquentRepository implements TaxonomyRepository
{
    use HasBulkActions;

    public function model(): string
    {
        return Taxonomy::class;
    }
}
