<?php

namespace App\Traits;

use Illuminate\Http\UploadedFile;

trait HelperTrait{

    // Upload File In Public Path.
    public function uploadFile($file, $folder = "")
    {
        $filename = $this->getUniqueId() . "." . $file->getClientOriginalExtension();
        $location = public_path(). '/'. $folder;
        $file->move($location, $filename);
        return ['fileName'=> $filename, "path" => $folder."/".$filename] ;
    }

    public function getUniqueId()
    {
        return md5(microtime().\Config::get('app.key'));
    }
    public function toSeconds($time)
    {
        $timeArr=explode(':',$time);
        $hour=$timeArr[0]*3600;
        $minute=$timeArr[1]*60;
        $second=$timeArr[2];
        return $hour+$minute+$second;
    }

    


}