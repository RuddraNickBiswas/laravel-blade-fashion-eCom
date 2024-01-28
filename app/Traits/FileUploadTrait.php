<?php

namespace App\Traits;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\File;
use Intervention\Image\Laravel\Facades\Image  as InterventionImage ;

trait FileUploadTrait
{
    /**
     * Upload and optionally resize an image.
     *
     * @param Request $request
     * @param string $inputName
     * @param string|null $oldPath
     * @param string $path
     * @param int|null $resizeWidth
     * @param int|null $resizeHeight
     * @return string|null
     */
    public function uploadImage(
        Request $request,
        $inputName,
        $oldPath = null,
        $path = '/uploads/image',
        $resizeWidth = null,
        $resizeHeight = null
    ) {
        if ($request->hasFile($inputName)) {
            $image = $request->{$inputName};
            $ext = $image->getClientOriginalExtension();
            $imageName = 'media_' . uniqid() . '.' . $ext;

            $imagePath = public_path($path) . '/' . $imageName;

            // Save the original image
            $image = InterventionImage::read($image->getRealPath());
            $image->save($imagePath);

            // Resize the image if width and height are provided
            if ($resizeWidth && $resizeHeight) {
                $this->resizeImage($imagePath, $resizeWidth, $resizeHeight);
            }

            // Delete the old image if it exists
            if ($oldPath && File::exists(public_path($oldPath))) {
                File::delete(public_path($oldPath));
            }

            return $path . '/' . $imageName;
        }

        return null;
    }

    /**
     * Resize an image.
     *
     * @param string $imagePath
     * @param int $width
     * @param int $height
     */
    private function resizeImage($imagePath, $width, $height)
    {
        $resizedImage = InterventionImage::read($imagePath)->resize($width, $height);
        $resizedImage->save($imagePath);
    }

    /**
     * Delete an image.
     *
     * @param string|null $oldPath
     */
    public function destroyImage($oldPath)
    {
        if ($oldPath && File::exists(public_path($oldPath))) {
            File::delete(public_path($oldPath));
        }
    }
}
