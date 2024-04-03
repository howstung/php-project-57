<?php

namespace App\Http\Controllers;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Foundation\Auth\Access\AuthorizesRequests;
use Illuminate\Foundation\Validation\ValidatesRequests;
use Illuminate\Http\Request;
use Illuminate\Routing\Controller as BaseController;

class Controller extends BaseController
{
    use AuthorizesRequests;
    use ValidatesRequests;

    private function getRules(?Model $model): array
    {
        $rules = $this->rules();
        foreach ($rules as $field => $rule) {
            if (in_array($field, $this->uniqueFields())) {
                $unique = '';
                if (!is_null($model)) {
                    $unique = ",$field," . $model->id;
                }
                $rules[$field] = $rule . $unique;
            }
        }
        return $rules;
    }
    protected function uniqueFields(): array
    {
        return [
            'name'
        ];
    }

    protected function messages(): array
    {
        return [];
    }
    protected function getValidatedData(Request $request, Model $model = null)
    {
        return $this->validate(
            $request,
            $this->getRules($model),
            $this->messages()
        );
    }
}
