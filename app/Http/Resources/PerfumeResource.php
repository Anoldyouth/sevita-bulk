<?php

namespace App\Http\Resources;

use App\Http\Support\Resources\BaseJsonResource;
use App\Models\Perfume;
use Illuminate\Http\Request;

/**
 * @mixin Perfume
 */
class PerfumeResource extends BaseJsonResource
{
    public function toArray(Request $request): array
    {
        return [
            'id' => $this->id,
            'name' => $this->name,
            'price' => $this->price,
            'created_at' => $this->created_at,
            'updated_at' => $this->updated_at,
        ];
    }
}
