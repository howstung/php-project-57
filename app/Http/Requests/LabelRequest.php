<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class LabelRequest extends FormRequest
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
     * @return array<string, \Illuminate\Contracts\Validation\ValidationRule|array<mixed>|string>
     */
    public function rules(): array
    {
        $rules = [
            'name' => 'required|max:255|unique:labels',
            'description' => 'nullable'
        ];
        if ($this->getMethod() === 'PATCH') {
            $rules['name'] .= ",name," . $this->route('label')->id;
        }
        return $rules;
    }

    public function messages(): array
    {
        return [
            'name.unique' => __('validation.unique', ['model' => __('views.label.name')]),
        ];
    }
}
