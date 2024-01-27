<?php

namespace App\Readers;

use App\Enums\ImportStatusEnum;
use App\Http\Support\Models\BaseImportErrorModel;
use App\Http\Support\Models\BaseImportModel;
use Maatwebsite\Excel\Concerns\Importable;
use Maatwebsite\Excel\Concerns\RegistersEventListeners;
use Maatwebsite\Excel\Events\AfterImport;
use Maatwebsite\Excel\Events\BeforeImport;
use Maatwebsite\Excel\Validators\Failure;
use Throwable;

abstract class ImportReader implements ImportReaderInterface
{
    use Importable;
    use RegistersEventListeners;

    abstract protected function handle(array $rows): void;

    public function __construct(
        protected readonly BaseImportModel $import,
    ) {
    }

    public function getImport(): BaseImportModel
    {
        return $this->import->fresh('errors');
    }

    public function array(array $array): void
    {
        $this->handle($array);

        $this->import->chunks_finished++;
        $this->import->save();
    }

    public function chunkSize(): int
    {
        return 500;
    }

    public function startRow(): int
    {
        return 2;
    }

    public function onFailure(Failure ...$failures): void
    {
        foreach ($failures as $failure) {
            foreach ($failure->errors() as $message) {
                $this->createError(
                    $this->import->id,
                    $failure->row(),
                    $message,
                );
            }
        }
    }

    public function onError(Throwable $e): void
    {
        $this->import->status = ImportStatusEnum::FAILED;
        $this->import->save();
    }

    abstract protected function createErrorModel(): BaseImportErrorModel;

    protected function createError(int $importId, int $rowNum, string $message): void
    {
        $error = $this->createErrorModel();
        $error->import_id = $importId;
        $error->row_num = $rowNum;
        $error->message = $message;


        $error->save();
    }

    public static function beforeImport(BeforeImport $event): void
    {
        /** @var static $importReader */
        $importReader = $event->getConcernable();

        $sheetReader = $event->getReader();
        $sheetReader->readSpreadsheet();

        $totalRows = iterator_count(
            $sheetReader
                ->getActiveSheet()
                ->getRowIterator()
        );

        $totalRows -= $importReader->startRow() - 1;

        if ($totalRows > 0) {
            $importModel = $importReader->getImport();

            $importModel->chunks_count = (int) ceil($totalRows / $importReader->chunkSize());
            $importModel->chunks_finished = 0;
            $importModel->status = ImportStatusEnum::IN_PROCESS;
            $importModel->save();
        }
    }

    public static function afterImport(AfterImport $event): void
    {
        /** @var static $importReader */
        $importReader = $event->getConcernable();
        $importModel = $importReader->getImport();

        $importModel->status = $importModel->errors->isEmpty() ? ImportStatusEnum::DONE : ImportStatusEnum::FAILED;
        $importModel->prepareMessage();
        $importModel->save();
    }
}
