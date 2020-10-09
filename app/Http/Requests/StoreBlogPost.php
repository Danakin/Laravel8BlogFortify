<?php

// php artisan make:request StoreBlogPost

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

use App\Helper\MakeSlug;

class StoreBlogPost extends FormRequest
{
    /**
     * Determine if the user is authorized to make this request.
     *
     * @return bool
     */
    public function authorize()
    {
        if ($this->user()->can('create-posts')) return true;
        else return false;
    }

    /**
     * Get the validation rules that apply to the request.
     *
     * @return array
     */
    public function rules()
    {
        return [
            "title" => "required|unique:posts|max:255",
            "slug" => "unique:posts",
            "description" => "required"
        ];
    }

    // https://laravel.com/docs/8.x/validation#prepare-input-for-validation
    protected function prepareForValidation()
    {
        $this->merge([
            'slug' => MakeSlug::makeSlug($this->title)
        ]);
    }
}
