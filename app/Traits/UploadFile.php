<?php

namespace App\Traits;

use Illuminate\Http\File;
use Illuminate\Support\Facades\Storage;

trait UploadFile
{
    private function saveFile($file, $directory)
    {
        if($file){
            $extension = $file->extension();
            $fileName = time() . '' . random_int(11111, 99999) . '.' . $extension;
            $saveDirectory = 'public' . '/' . $directory . '/';
            Storage::putFileAs($saveDirectory, new File($file), $fileName);
            return '/storage' . '/' . $directory . '/' . $fileName;
        }
        return null;

    }

    private function deleteFile($fileLink = null)
    {
        if ($fileLink != null) {
            $fileLink = $this->replaceStorageFolder($fileLink);
            return Storage::delete($fileLink);
        }
    }

    private function replaceStorageFolder($fileLink)
    {
        $fileLink = str_replace('storage/', 'public/', $fileLink);
        return $fileLink;
    }
}
