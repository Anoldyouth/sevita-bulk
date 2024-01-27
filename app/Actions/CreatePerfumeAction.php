<?php

namespace App\Actions;

use App\Models\Perfume;

class CreatePerfumeAction
{
    public function execute(array $fields): Perfume
    {
        $model = (new Perfume())->fill($fields);
        $model->save();

        return $model;
    }
}
