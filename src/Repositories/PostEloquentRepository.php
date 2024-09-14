<?php
/**
 * LARABIZ CMS - Full SPA Laravel CMS
 *
 * @package    larabizcms/larabiz
 * @author     The Anh Dang
 * @link       https://larabiz.com
 */

namespace LarabizCMS\Modules\Blog\Repositories;

use LarabizCMS\Core\Models\Model;
use LarabizCMS\Core\Repositories\EloquentRepository;
use LarabizCMS\Modules\Blog\Models\Post;

/**
 * @mixin Model
 */
class PostEloquentRepository extends EloquentRepository implements PostRepository
{
    public function model(): string
    {
        return Post::class;
    }
}
