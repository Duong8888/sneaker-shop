<?php

use App\Models\Brand;

function uploadFile($folder, $files, $multiple)
{

        $result = '';
        if ($multiple == 'true'){
            $uploadFile = [];
            foreach ($files as $file){
                $fileName = time().$file->getClientOriginalName();
                $uploadFile[] = [
                  'url' => $file->storeAs($folder, $fileName, 'public'),
                ];
            }
          $result = $uploadFile;
        }else{

            if (is_array($files)){
                $file = $files[0];
            }else{
                $file = $files;
            }

            $fileName = time().$file->getClientOriginalName();

             $result = $file->storeAs($folder, $fileName, 'public');

        }
        return $result;
}
