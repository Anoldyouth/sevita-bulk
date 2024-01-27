<?php

namespace App\Http\Controllers;

use App\Http\Queries\PerfumeQuery;
use App\Http\Resources\PerfumeResource;
use App\Http\Support\Pagination\PageBuilderFactory;
use Illuminate\Http\Resources\Json\AnonymousResourceCollection;

class PerfumeController extends Controller
{
    public function search(PageBuilderFactory $factory, PerfumeQuery $query): AnonymousResourceCollection
    {
        return PerfumeResource::collectPage($factory->fromQuery($query)->build());
    }
}
