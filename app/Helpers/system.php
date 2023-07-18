<?php

use App\Models\Brand;

function uploadFile($folder, $file){

        $fileName = time().$file->getClientOriginalName();
        $file->move(public_path($folder).'/', $fileName);
//    $brands = Brand::all();
//    foreach ($brands as $brand) {
//        $brand->image = 'images/' . $fileName;;
//        $brand->save();
//    }
        return $folder.'/'.$fileName;
}
