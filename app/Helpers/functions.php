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

function mapStatusProduct($status){
    $array = [
       0 => 'Off',
       1 => 'On'
    ];

    return $array[$status] ?? '';
}
function mapStatusBanner($status){
    $array = [
        0 => 'Off',
        1 => 'On'
    ];

    return $array[$status] ?? '';
}

