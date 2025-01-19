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

larabiz()->crud('posts', PostController::class)
    ->menuIcon('Article');

larabiz()->crud('taxonomies', TaxonomyController::class)
    ->menuIcon('Tag');
