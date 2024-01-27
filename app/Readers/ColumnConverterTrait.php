<?php

namespace App\Readers;

trait ColumnConverterTrait
{
    abstract public function columnsToAttributes(): array;

    public function prepareForValidation($data, $index): array
    {
        $prepared = [];
        foreach ($this->columnsToAttributes() as $column => $attribute) {
            $prepared[$attribute] = $data[$column] ?? null;
        }

        return $prepared;
    }
}
