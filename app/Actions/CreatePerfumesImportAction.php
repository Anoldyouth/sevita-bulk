<?php

namespace App\Actions;

use App\Enums\ImportStatusEnum;
use App\Models\PerfumesImport;
use Illuminate\Http\UploadedFile;

class CreatePerfumesImportAction
{
    public function __construct(
        protected readonly UploadFileAction $action,
    ) {
    }

    public function execute(UploadedFile $uploadedFile): PerfumesImport
    {
        $path = $this->action->execute('perfumes', 'import', $uploadedFile);

        $import = new PerfumesImport();
        $import->fill([
            'file' => $path,
            'status' => ImportStatusEnum::NEW,
        ]);
        $import->save();

        return $import;
    }
}
