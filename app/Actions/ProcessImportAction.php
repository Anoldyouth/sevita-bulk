<?php

namespace App\Actions;

use App\Enums\ImportStatusEnum;
use App\Http\Support\Models\BaseImportModel;
use App\Readers\PerfumeReader;
use Illuminate\Support\Facades\Storage;
use Maatwebsite\Excel\Facades\Excel;
use Spatie\QueueableAction\QueueableAction;
use Throwable;

class ProcessImportAction
{
    use QueueableAction;

    public function execute(BaseImportModel $import): void
    {
        if ($import->status !== ImportStatusEnum::NEW->label()) {
            return;
        }

        $disk = Storage::disk('local');

        try {
            $reader = resolve(PerfumeReader::class, ['import' => $import]);

            Excel::import(
                $reader,
                $disk->path($import->file),
            );
        } catch (Throwable $e) {
            $import->status = ImportStatusEnum::FAILED;
            $import->message = $e->getMessage();
            $import->save();
        }

        $disk->delete($import->file);
    }
}
