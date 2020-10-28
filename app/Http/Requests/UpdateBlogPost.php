<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

use Illuminate\Validation\Rule;

use App\Helper\MakeSlug;

class UpdateBlogPost extends FormRequest
{
    /**
     * Determine if the user is authorized to make this request.
     *
     * @return bool
     */
    public function authorize()
    {
        return true;
        // $post = $this->route('post');
        // if ($this->user()->can('update', $post)) {
        //     return true;
        // } else {
        //     return false;
        // }
    }

    /**
     * Get the validation rules that apply to the request.
     *
     * @return array
     */
    public function rules()
    {
        $post = $this->route('post');
        return [
            "title" => [
                "required",
                Rule::unique('posts')->ignore($post->id),
                "max:255",
            ],
            "description" => "required",
        ];
    }

    // https://laravel.com/docs/8.x/validation#prepare-input-for-validation
    protected function prepareForValidation()
    {
        $this->merge([
            'slug' => MakeSlug::makeSlug($this->title),
        ]);
    }
}
