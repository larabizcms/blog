<?php
/**
 * LARABIZ CMS - Full SPA Laravel CMS
 *
 * @package    larabizcom/larabiz
 * @author     The Anh Dang
 * @link       https://larabiz.com
 */

namespace LarabizCMS\Modules\Blog\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;
use Illuminate\Validation\Rule;
use LarabizCMS\Core\Rules\AllExist;
use LarabizCMS\Modules\Blog\Repositories\PostRepository;

class PostActionsRequest extends FormRequest
{
    public function rules(): array
    {
        return [
            'action' => ['required', Rule::in(app(PostRepository::class)->bulkActions())],
            'ids' => ['required', 'array', 'min:1', new AllExist('posts', 'id')],
        ];
    }
}
