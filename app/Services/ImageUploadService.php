<?php

namespace App\Services;

use Illuminate\Support\Facades\Storage;


class ImageUploadService
{

    public function upload($image, $path)
    {
        // Generate a unique filename using the current timestamp and original extension
        $fileName = time() . '.' . $image->getClientOriginalExtension();

        $directoryPath = 'admin-uploads/' . $path . '/';

        // Ensure the directory exists
        if (!is_dir($directoryPath)) {
            mkdir($directoryPath, 0755, true);
        }

        // Move the image to the specified path
        $image->move($directoryPath, $fileName);

        return $fileName; // Return only the filename to be stored in the database
    }

    public function delete($path)
    {
        if (\Illuminate\Support\Facades\Storage::exists($path)) {
            \Illuminate\Support\Facades\Storage::delete($path);
        }
    }
}
