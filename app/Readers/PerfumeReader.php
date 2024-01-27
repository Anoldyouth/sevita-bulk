<?php

namespace App\Readers;

use App\Actions\CreatePerfumeAction;
use App\Actions\ReplacePerfumeAction;
use App\Http\Support\Models\BaseImportErrorModel;
use App\Models\Perfume;
use App\Models\PerfumesImport;
use App\Models\PerfumesImportError;
use Maatwebsite\Excel\Concerns\WithHeadingRow;
use Maatwebsite\Excel\Concerns\WithValidation;

class PerfumeReader extends ImportReader implements WithValidation, WithHeadingRow
{
    use ColumnConverterTrait;

    public function __construct(
        PerfumesImport $import,
        protected readonly CreatePerfumeAction $createPerfumeAction,
        protected readonly ReplacePerfumeAction $replacePerfumeAction,
    ) {
        parent::__construct($import);
    }

    protected function handle(array $rows): void
    {
        $ids = array_filter(array_column($rows, 'id'));
        $perfumes = Perfume::query()->findMany($ids)->keyBy('id');

        foreach ($rows as $row) {
            ($template = $perfumes->get($row['id']))
                ? $this->replacePerfumeAction->execute($template, $row)
                : $this->createPerfumeAction->execute($row);
        }
    }

    public function rules(): array
    {
        return [
            'id' => ['required', 'integer'],
            'name' => ['required', 'string'],
            'price' => ['required', 'numeric'],
        ];
    }

    public function customValidationMessages(): array
    {
        return [
            'id.required' => "Поле \"Код\" обязательно для заполнения",
            'id.integer' => "Поле \"Код\" должно быть целочисленным",
            'name.required' => "Поле \"Наименование\" обязательно для заполнения",
            'name.string' => "Поле \"Наименование\" должно быть строкой",
            'price.required' => "Поле \"Цена\" обязательно для заполнения",
            'price.numeric' => "Поле \"Цена\" должно быть числом",
        ];
    }

    public function columnsToAttributes(): array
    {
        return [
            'Код' => 'id',
            'Наименование' => 'name',
            'Цена' => 'price',
            'kod' => 'id',
            'naimenovanie' => 'name',
            'cena' => 'price',
        ];
    }

    protected function createErrorModel(): BaseImportErrorModel
    {
        return new PerfumesImportError();
    }
}
