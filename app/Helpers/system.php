<?php

use App\Models\Brand;

function uploadFile($folder, $files, $multiple)
{
        $result = '';
        if ($multiple == 'true'){
            $uploadFile = [];
            foreach ($files as $file){
                $fileName = time().$file->getClientOriginalName();
                $file->move(public_path($folder).'/', $fileName);
                $uploadFile[] = [
                  'url' => $folder.'/'.$fileName,
                ];
            }
          $result = $uploadFile;
        }else{

            $file = $files[0];
            $fileName = time().$file->getClientOriginalName();
            $file->move(public_path($folder).'/', $fileName);
            $result = $folder.'/'.$fileName;
        }
        return $result;
}
