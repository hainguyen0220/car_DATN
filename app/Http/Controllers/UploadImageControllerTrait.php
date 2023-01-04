<?php

namespace App\Http\Controllers;

use Facade\FlareClient\Http\Response;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Storage;
use Illuminate\Support\Facades\Log;
use Carbon\Carbon;
use Throwable;

trait UploadImageControllerTrait 
{
    use UpdateMessageTrait;
    public function upload($image,$newname,$folder){
        if(file($image)){
            $file_name = $image->getClientoriginalName();
            $file_name = explode(".",$file_name);
            $ext = end($file_name);
            $new_name = $newname.uniqid().'.'.$ext;
            $image->storeAs($folder, $new_name, 'public');
            $image = $new_name;
        }
        return $image;
    }

    public function deleteImage($pathImg,$folder){
        if($pathImg) {
            $destinationPath = 'storage/'.$folder.'/'.$pathImg;
            if(file_exists($destinationPath)){
                unlink($destinationPath);
            }
        }
    }

    public function downLoadImage($request,$filename,$folder){
        if(Storage::exists($folder.'/'.$filename)){
            try{
                return Storage::download($folder.'/'.$filename,  Carbon::now().'.png');
            } catch(Throwable $e){
                log::channel('admin_log')->error($e->getMessage());
                $this->updateFailMessage($request, __('message.download-fail'));
                return back();
            }
        }

        $this->updateFailMessage($request, __('message.download-fail'));
        
        return back();
        
    }
}
