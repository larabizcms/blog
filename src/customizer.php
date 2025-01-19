<?php
/**
 * LARABIZ CMS - Full SPA Laravel CMS
 *
 * @package    larabizcms/larabiz
 * @author     The Anh Dang
 * @link       https://larabiz.com
 */

larabiz()->crud('posts', \LarabizCMS\Modules\Blog\Http\Controllers\Admin\PostController::class);
