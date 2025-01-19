<?php

namespace LarabizCMS\Modules\Blog\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;
use Illuminate\Validation\Rule;
use LarabizCMS\Modules\Blog\Models\Enums\PostStatus;

class PostRequest extends FormRequest
{
    public function rules(): array
    {
        $locale = $this->input('locale');

        return [
            'status' => ['required', Rule::in(PostStatus::all())],
            'locale' => ['required', 'string', 'max:5', Rule::in(config('translatable.locales'))],
            "{$locale}.title" => ['required', 'string', 'max:255'],
            "{$locale}.slug" => ['nullable', 'string', 'max:255'],
            "{$locale}.content" => ['required', 'string'],
        ];
    }
}
