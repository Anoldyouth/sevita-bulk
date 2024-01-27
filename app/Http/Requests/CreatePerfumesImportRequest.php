<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;
use Illuminate\Http\Request;
use Illuminate\Http\UploadedFile;
use Illuminate\Support\Facades\Validator;

class CreatePerfumesImportRequest extends FormRequest
{
    private static $rules = [
        'file-upload-input' => ['required', 'max:20480', 'mimes:xls,xlsx,csv'],
    ];

    private static $messages = [
        'file-upload-input.required' => 'Требуется файл для импорта',
        'file-upload-input.max' => 'Размер файла не должен превышать размер 20МБ',
        'file-upload-input.mimes' => 'Файл не является электронной таблицей',
    ];

    public function authorize(): bool
    {
        return true;
    }

    public function rules(): array
    {
        return self::$rules;
    }

    public function uploadedFile(): UploadedFile
    {
        return $this->file('file-upload-input');
    }

    public function messages(): array
    {
        return self::$messages;
    }

    public static function createFrom(Request $from, $to = null): CreatePerfumesImportRequest
    {
        $request = parent::createFrom($from, $to);
        $request->setValidator(Validator::make($from->all(), self::$rules, self::$messages));

        return $request;
    }
}
