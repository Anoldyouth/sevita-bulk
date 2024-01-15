<?php

namespace App\Http\Requests;

use App\Http\Support\Requests\BaseFormRequest;
use Illuminate\Foundation\Http\FormRequest;

class CreatePerfumeRequest extends BaseFormRequest
{
    public function rules(): array
    {
        return [
            'id' => ['required', 'integer', 'unique:perfumes'],
            'name' => ['required', 'string'],
            'price' => ['required', 'integer', 'min:1'],
        ];
    }
}
