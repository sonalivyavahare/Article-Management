<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;
use Illuminate\Validation\Rule;

class TagRequest extends FormRequest
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
                'tag_name' =>  [ 'required',
                    Rule::unique('tags', 'name')->ignore($this->id)->whereNull('deleted_at')],
            ];
        } else {
            return [
                'tag_name' =>  [ 'required',
                    Rule::unique('tags', 'name')->whereNull('deleted_at')],
            ];
        }
    }
}
