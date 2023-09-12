<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;
use Illuminate\Validation\Rule;

class ArticleRequest extends FormRequest
{
    /**
     * Determine if the user is authorized to make this request.
     */
    public function authorize(): bool
    {
        return true;
    }

    /**
     * Get the validation rules that apply to the request.
     *
     * @return array<string, \Illuminate\Contracts\Validation\ValidationRule|array|string>
     */
    public function rules(): array
    {
        if(isset($this->id)) {
            return [
                'title' => 'required',
                'image' => 'mimes:jpg,jpeg,png,webp',
                'description' => 'required',
                'slug' =>  [Rule::unique('articles', 'slug')->ignore($this->id)->whereNull('deleted_at')],
                'author' => 'required',
                'summary' => 'required',
                'publish_date' => 'required',
                'tags' => 'required',
                'categories' => 'required'
            ];
        } else {
            return [
                'title' => 'required',
                'image' => 'mimes:jpg,jpeg,png,webp',
                'description' => 'required',
                'slug' =>  [Rule::unique('articles', 'slug')->whereNull('deleted_at')],  
                'author' => 'required',
                'summary' => 'required',
                'publish_date' => 'required',
                'tags' => 'required',
                'categories' => 'required'
            ];
        }
    }


    public function messages(): array
    {
        return [
            'image.mimes' => 'Invalid image format'
        ];
    }
}
