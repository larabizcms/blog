<?php
/**
 * LARABIZ CMS - Full SPA Laravel CMS
 *
 * @package    larabizcms/larabiz
 * @author     The Anh Dang
 * @link       https://larabiz.com
 */

namespace LarabizCMS\Modules\Blog\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class TaxonomyRequest extends FormRequest
{
    public function rules(): array
    {
        $locale = $this->input('locale') ?? app()->getLocale();

        return [
			'type' => ['required'],
			'parent_id' => ['nullable', 'exists:taxonomies,id'],
            "{$locale}.name" => ['required', 'string', 'max:255'],
            "{$locale}.description" => ['nullable', 'string', 'max:255'],
            "{$locale}.slug" => ['nullable', 'string', 'max:255', 'unique:taxonomies,slug'],
		];
    }
}
