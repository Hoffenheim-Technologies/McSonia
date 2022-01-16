<?php
namespace App\Helpers;

use Hashids\Hashids;
use Illuminate\Support\Facades\Auth;

class MS{


    public static function getFileMetaData($file)
    {
        $dataFile['ext'] = $file->getClientOriginalExtension();
        $dataFile['type'] = $file->getClientMimeType();
        $dataFile['size'] = self::formatBytes($file->getSize());
        return $dataFile;
    }

    public static function getUploadPath($user_type)
    {
        return 'public/' . $user_type . '/';
    }

    public static function formatBytes($size, $precision = 2)
    {
        $base = log($size, 1024);
        $suffixes = array('B', 'KB', 'MB', 'GB', 'TB');

        return round(pow(1024, $base - floor($base)), $precision) . ' ' . $suffixes[floor($base)];
    }

    public static function isAdmin(){
        return (Auth::user()->role == 'admin') ? true : false;
    }

    public static function isDriver(){
        return (Auth::user()->role == 'driver') ? true : false;
    }

}
