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
use LarabizCMS\Modules\Blog\Repositories\TaxonomyRepository;

class TaxonomyActionsRequest extends FormRequest
{
    /**
     * Get the validation rules that apply to the request.
     *
     * @return array
     */
    public function rules(): array
    {
        return [
            'action' => ['required', Rule::in(app(TaxonomyRepository::class)->bulkActions())],
            'ids' => ['required', 'array', 'min:1', new AllExist('taxonomies', 'id')],
        ];
    }
}
