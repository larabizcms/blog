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
use LarabizCMS\Modules\Blog\Repositories\PostRepository;

class PostDatatable extends DataTable
{
    protected ?string $dataUrl = '/blog/internal/posts';

    protected ?string $bulkActionUrl = '/blog/internal/posts/bulk';

    protected ?string $deleteUrl = '/blog/internal/posts/{id}';

    protected ?string $editUrl = '/admin-cp/posts/{id}/edit';

    public function columns(): array
    {
        return [
			Column::make('title')->minWidth(150),
			Column::make('status')->format(Column::FORMAT_STATUS),
			Column::make('created_at')->format(Column::FORMAT_DATETIME)
		];
    }

    public function bulkActions(): array
    {
        $actions = app(PostRepository::class)->bulkActions();
        return [
            ...array_map(
                function ($action) {
                    return BulkAction::make($action);
                },
                $actions
            )
        ];
    }
}
