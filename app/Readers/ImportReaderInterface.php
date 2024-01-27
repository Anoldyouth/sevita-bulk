<?php

namespace App\Readers;

use App\Http\Support\Models\BaseImportModel;
use Maatwebsite\Excel\Concerns\SkipsOnError;
use Maatwebsite\Excel\Concerns\SkipsOnFailure;
use Maatwebsite\Excel\Concerns\ToArray;
use Maatwebsite\Excel\Concerns\WithChunkReading;
use Maatwebsite\Excel\Concerns\WithEvents;
use Maatwebsite\Excel\Concerns\WithStartRow;

interface ImportReaderInterface extends
    ToArray,
    WithChunkReading,
    WithEvents,
    WithStartRow,
    SkipsOnError,
    SkipsOnFailure
{
    public function getImport(): BaseImportModel;
}
