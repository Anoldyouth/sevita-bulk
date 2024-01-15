<?php

namespace App\Http\Requests;

use App\Http\Support\Requests\BaseFormRequest;
use Illuminate\Foundation\Http\FormRequest;

class PatchPerfumeRequest extends BaseFormRequest
{
    public function rules(): array
    {
        return [
            'id' => ['sometimes', 'required', 'integer', 'unique:perfumes'],
            'name' => ['sometimes', 'required', 'string'],
            'price' => ['sometimes', 'required', 'integer', 'min:1'],
        ];
    }
}
