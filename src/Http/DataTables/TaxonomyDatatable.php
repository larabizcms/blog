<?php
/**
 * LARABIZ CMS - Full SPA Laravel CMS
 *
 * @package    larabizcom/larabiz
 * @author     The Anh Dang
 * @link       https://larabiz.com
 */

namespace LarabizCMS\Modules\Blog\Http\DataTables;

use LarabizCMS\Core\DataTables\Abstracts\DataTable;
use LarabizCMS\Core\DataTables\Components\BulkAction;
use LarabizCMS\Core\DataTables\Components\Column;

class TaxonomyDatatable extends DataTable
{
    protected ?string $dataUrl = '/blog/taxonomies';

    protected ?string $bulkActionUrl = '/blog/taxonomies/bulk';

    protected ?string $deleteUrl = '/blog/taxonomies/{id}';

    protected ?string $editUrl = '/admin-cp/taxonomies/{id}/edit';

    public function columns(): array
    {
        return [
			Column::make('name'),
			Column::make('parent_id'),
			Column::make('created_at')->format(Column::FORMAT_DATETIME)
		];
    }

    public function bulkActions(): array
    {
        return [
			
		];
    }
}
