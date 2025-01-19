<?php
/**
 * LARABIZ CMS - Full SPA Laravel CMS
 *
 * @package    larabizcms/larabiz
 * @author     The Anh Dang
 * @link       https://larabiz.com
 */

use LarabizCMS\Modules\Blog\Http\Controllers\Admin\PostController;
use LarabizCMS\Modules\Blog\Http\Controllers\Admin\TaxonomyController;

larabiz()->adminMenu('blog')
    ->title('Blog')
    ->icon('Article');

larabiz()->crud('posts', PostController::class)
    ->menuParent('blog')
    ->menuIcon('Article');

larabiz()->crud('taxonomies', TaxonomyController::class)
    ->menuParent('blog')
    ->menuIcon('Tag');
