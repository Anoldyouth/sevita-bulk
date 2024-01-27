<?php

namespace App\Http\Queries;

use App\Models\Perfume;
use Spatie\QueryBuilder\QueryBuilder;

class PerfumeQuery extends QueryBuilder
{
    public function __construct()
    {
        parent::__construct(Perfume::query());

        $this->allowedSorts([
            'id',
            'name',
            'price',
            'created_at',
            'updated_at'
        ]);

        $this->allowedFilters([
            'name',
        ]);

        $this->defaultSort('id');
    }
}
