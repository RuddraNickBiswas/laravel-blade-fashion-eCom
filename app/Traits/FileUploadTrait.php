<?php

namespace App\Traits;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\File;

trait FileUploadTrait {
    function uploadImage(Request $request, $inputName, $oldPath = NULL, $path = '/uploads'){

// will add image formater packege for formating syze 
        if($request->hasFile($inputName)){
            $image = $request->{$inputName};
            $ext = $image->getClientOriginalExtension();
            $imageName = 'media_'.uniqid().'.'.$ext;

            $image->move(public_path($path), $imageName);


            if($oldPath && File::exists(public_path($oldPath))){
                File::delete(public_path($oldPath));
            }
            
            return $path.'/'.$imageName;
        }

        return null;
    }

    function destroyImage($oldPath) {
        if ($oldPath && File::exists(public_path($oldPath))) {
            File::delete(public_path($oldPath));
        }
        return;
    }
}