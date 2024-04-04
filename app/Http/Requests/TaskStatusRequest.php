<?php

namespace App\Http\Requests;

use App\Models\TaskStatus;
use Illuminate\Foundation\Http\FormRequest;

class TaskStatusRequest extends FormRequest
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
            'name' => 'required|max:255|unique:task_statuses',
        ];
        if ($this->getMethod() === 'PATCH' && $this->route('task_status') instanceof TaskStatus) {
            $rules['name'] .= ',name,' . $this->route('task_status')->id;
        }

        return $rules;
    }

    public function messages(): array
    {
        return [
            'name.unique' => __('validation.unique', ['model' => __('views.task_status.name')]),
        ];
    }
}
