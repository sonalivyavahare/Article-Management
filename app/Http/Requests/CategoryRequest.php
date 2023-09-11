<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;
use Illuminate\Validation\Rule;

class CategoryRequest extends FormRequest
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
                'category_name' =>  [ 'required',
                    Rule::unique('categories', 'name')->ignore($this->id)->whereNull('deleted_at')],
            ];
        } else {
            return [
                'category_name' =>  [ 'required',
                    Rule::unique('categories', 'name')->whereNull('deleted_at')],
            ];
        }
    }
}
