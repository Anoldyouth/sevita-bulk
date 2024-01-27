<?php

namespace App\Models;

use App\Enums\ImportStatusEnum;
use App\Http\Support\Models\BaseImportErrorModel;
use Illuminate\Database\Eloquent\Relations\BelongsTo;

/**
 * @property-read PerfumesImport $import
 */

class PerfumesImportError extends BaseImportErrorModel
{
    protected $table = 'perfumes_import_errors';

    protected $casts = [
        'status' => ImportStatusEnum::class,
    ];

    public function import(): BelongsTo
    {
        return $this->belongsTo(PerfumesImport::class, 'import_id', 'id');
    }
}
