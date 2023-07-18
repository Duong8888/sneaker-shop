<?php
function uploadFile($folder,$files,$multiple = false){
    $result = '';
    if($multiple){
        $uploadedFiles = [];
        foreach ($files as $file) {
            // Lưu tệp vào thư mục public/uploads
            $fileName = time().$file->getClientOriginalName();
            $file->move(public_path($folder).'/', $fileName);
            $uploadedFiles[] = [
                'url'  => $folder.'/' . $fileName // lấy url của các file thêm vào
            ];
        }
        $result = $uploadedFiles;
    }else{
        $fileName = time().$files->getClientOriginalName();
        $files->move(public_path($folder).'/', $fileName);
        $result = $folder.'/'.$fileName;
    }
    return $result;
}
