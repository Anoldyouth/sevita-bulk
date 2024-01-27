<?php

namespace App\Actions;

use Carbon\Carbon;
use Illuminate\Http\UploadedFile;
use Illuminate\Support\Facades\Storage;
use Illuminate\Support\Str;

class UploadFileAction
{
    public function execute(string $folderName, string $entityIdOrType, UploadedFile $file): string
    {
        $date = Carbon::now();
        $extension = $file->extension();
        $fileName = "{$entityIdOrType}_{$date}.{$extension}";

        $path = Storage::disk('local')->putFileAs("{$folderName}", $file, $fileName);
        if (!$path) {
            throw new \RuntimeException("Unable to save file $fileName to directory {$folderName}");
        }

        return $path;
    }
}
