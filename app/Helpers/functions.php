<?php
use Illuminate\Http\UploadedFile;

function updateImage($imageFile, $imageName, $imagePath) {
    if (!empty($imageFile) && $imageFile instanceof UploadedFile) {
        $file = $imageFile;
        $ext = $file->extension();
        $fileName =  $imageName . '.' . $ext;
        $file->move(public_path($imagePath), $fileName);

        return $imagePath . '/' . $fileName;
    }

    return '';
}
