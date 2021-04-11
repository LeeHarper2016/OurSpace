<?php

namespace App\Services;

use Illuminate\Http\UploadedFile;
use Illuminate\Support\Facades\Storage;

class ImageService {

    /*********************************************************************************
     *
     * Function: ImageService::uploadImage(UploadedFile $image, string $path)
     * Purpose: Uploads a given image to the server at the given file path.
     * Precondition: N/A.
     * Postcondition: The image is uploaded to the server.
     *
     * @param UploadedFile $image The image file that is being uploaded.
     * @param string $path The path that the image will be uploaded to.
     * @return string The relative file path to the image.
     *
     ********************************************************************************/
    public static function uploadImage(UploadedFile $image, string $path) {
        $imageName = $image->hashName();
        $image->store($path);

        return $path . $imageName;
    }

    /*********************************************************************************
     *
     * Function: ImageService::deleteImage(string $path)
     * Purpose: Deletes an image, if it exists, from the server at the given file path.
     * Precondition: The image exists on the server.
     * Postcondition: The image is deleted from the server.
     *
     * @param string $path The path to the file which should be deleted.
     * @return void
     *
     ********************************************************************************/
    public static function deleteImage(string $path) {
        if (Storage::exists($path)) {
            Storage::delete($path);
        }
    }
}
