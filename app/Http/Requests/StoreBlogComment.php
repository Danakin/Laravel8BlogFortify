<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class StoreBlogComment extends FormRequest
{
    /**
     * Determine if the user is authorized to make this request.
     *
     * @return bool
     */
    public function authorize()
    {
        return true;
    }

    /**
     * Get the validation rules that apply to the request.
     *
     * @return array
     */
    public function rules()
    {
        return [
            "title" => "required|max:255",
            "description" => "required",
        ];
    }

    protected function prepareForValidation()
    {
        $this->title = strip_tags($this->title);
        $this->description = strip_tags($this->description);
    }
}
