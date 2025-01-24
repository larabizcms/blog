<?php
/**
 * LARABIZ CMS - Full SPA Laravel CMS
 *
 * @package    larabizcms/larabiz
 * @author     The Anh Dang
 * @link       https://larabiz.com
 */

use LarabizCMS\Core\Facades\RouteResource;
use LarabizCMS\Modules\Blog\Http\Controllers\APIs\Management;

RouteResource::api('taxonomies', Management\TaxonomyController::class);
RouteResource::api('{type}', Management\PostController::class);
