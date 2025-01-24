<?php
/**
 * LARABIZ CMS - Full SPA Laravel CMS
 *
 * @package    larabizcms/larabiz
 * @author     The Anh Dang
 * @link       https://larabiz.com
 */

namespace LarabizCMS\Modules\Blog\Repositories;

use Illuminate\Database\Eloquent\Collection;
use LarabizCMS\Core\Models\Model;
use LarabizCMS\Core\Repositories\EloquentRepository;
use LarabizCMS\Core\Repositories\Traits\HasBulkActions;
use LarabizCMS\Modules\Blog\Models\Post;

/**
 * @mixin Model
 */
class PostRepositoryEloquent extends EloquentRepository implements PostRepository
{
    use HasBulkActions;

    public function bulkActions(): array
    {
        return [
            'publish',
            'draft',
            'delete',
        ];
    }

    public function model(): string
    {
        return Post::class;
    }
}
