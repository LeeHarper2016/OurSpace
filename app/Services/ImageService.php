<?php

namespace App\Services;

use Illuminate\Http\UploadedFile;

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
}
