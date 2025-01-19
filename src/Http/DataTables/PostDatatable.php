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

class PostDatatable extends DataTable
{
    protected ?string $dataUrl = '/posts';

    protected ?string $bulkActionUrl = '/posts/bulk';

    protected ?string $deleteUrl = '/posts/{id}';

    protected ?string $editUrl = '/admin-cp/posts/{id}/edit';

    public function columns(): array
    {
        return [
			Column::make('status'),
			Column::make('created_at')->disabledFlex()->width(200)->format(Column::FORMAT_DATETIME)
		];
    }

    public function bulkActions(): array
    {
        return [
			
		];
    }
}
