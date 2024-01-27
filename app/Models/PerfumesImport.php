<?php

namespace App\Models;

use App\Enums\ImportStatusEnum;
use App\Http\Support\Models\BaseImportModel;
use Illuminate\Database\Eloquent\Relations\HasMany;

class PerfumesImport extends BaseImportModel
{
    protected $table = 'perfumes_imports';

    protected string $entityNameForMessage = "парфюма";

    public function errors(): HasMany
    {
        return $this->hasMany(PerfumesImportError::class, 'import_id', 'id');
    }
}
