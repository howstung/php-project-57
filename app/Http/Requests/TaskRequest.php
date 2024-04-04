<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class TaskRequest extends FormRequest
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
            'name' => 'required|unique:tasks',
            'description' => 'nullable',
            'status_id' => 'required',
            'assigned_to_id' => 'nullable',
        ];
        if ($this->getMethod() === 'PATCH') {
            $rules['name'] .= ",name," . $this->route('task')->id;
        }
        return $rules;
    }

    public function messages(): array
    {
        return [
            'name.unique' => __('validation.unique', ['model' => __('views.task.name')]),
            'status_id.required' => __('validation.required'),
        ];
    }
}
