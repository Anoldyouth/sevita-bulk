<?php

namespace App\Actions;

use App\Models\Perfume;

class ReplacePerfumeAction
{
    public function execute(Perfume|int $model, array $fields): Perfume
    {
        if (is_int($model)) {
            $model = Perfume::query()->findOrFail($model);
        }

        $model->fill($fields)->save();

        return $model;
    }
}
