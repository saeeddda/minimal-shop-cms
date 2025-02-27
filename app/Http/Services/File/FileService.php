<?php

namespace App\Http\Services\File;

class FileService extends FileToolService
{
    public function moveToPublic($file){
        //set file
        $this->setFile($file);

        //execute provider
        $this->provider();

        //save file
        $result = $file->move(public_path($this->getFinalFileDirectory()), $this->getFinalFileName());
        return $result ? $this->getFileAddress() : false;
    }

    public function moveToStorage($file){
        //set file
        $this->setFile($file);

        //execute provider
        $this->provider();

        //save file
        $result = $file->move(storage_path($this->getFinalFileDirectory()), $this->getFinalFileName());
        return $result ? $this->getFileAddress() : false;
    }

    public function deleteFile($filePath, $storage = false){

        if($storage) {
            if (file_exists($filePath)) {
                unlink(storage_path($filePath));
                return true;
            }
        }

        if(file_exists($filePath)){
            unlink($filePath);
            return true;
        }

        return false;
    }
}
