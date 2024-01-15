<?php

namespace App\Http\Controllers;

use App\Http\Queries\PerfumeQuery;
use App\Http\Requests\CreatePerfumeRequest;
use App\Http\Requests\PatchPerfumeRequest;
use App\Http\Resources\PerfumeResource;
use App\Http\Support\Pagination\PageBuilderFactory;
use App\Http\Support\Resources\EmptyResource;
use App\Models\Perfume;
use Illuminate\Http\Request;
use Illuminate\Http\Resources\Json\AnonymousResourceCollection;

class PerfumeController extends Controller
{
    public function create(CreatePerfumeRequest $request): PerfumeResource
    {
        $perfume = Perfume::query()->create($request->validated());

        return new PerfumeResource($perfume);
    }

    public function get(int $id): PerfumeResource
    {
        $perfume = Perfume::query()->findOrFail($id);

        return new PerfumeResource($perfume);
    }

    public function patch(int $id, PatchPerfumeRequest $request): PerfumeResource
    {
        $perfume = Perfume::query()->findOrFail($id);
        $perfume->fill($request->validated());
        $perfume->save();

        return new PerfumeResource($perfume);
    }

    public function delete(int $id): EmptyResource
    {
        Perfume::query()->find($id)?->delete();

        return new EmptyResource();
    }

    public function search(PageBuilderFactory $factory, PerfumeQuery $query): AnonymousResourceCollection
    {
        return PerfumeResource::collectPage($factory->fromQuery($query)->build());
    }
}
