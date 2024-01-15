<?php

namespace App\Http\Support\Queries\Sorts;

use Illuminate\Database\Eloquent\Builder;
use Spatie\QueryBuilder\Sorts\Sort;

class SortingSort implements Sort
{
    public function __invoke(Builder $query, bool $descending, string $property)
    {
        $direction = $descending ? 'ASC' : 'DESC';
        $query
            ->orderBy('sorting', $direction)
            ->orderBy('created_at', 'desc');
    }
}
