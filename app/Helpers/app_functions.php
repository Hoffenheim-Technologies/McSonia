<?php
use Illuminate\Support\Str;
use Illuminate\Support\Facades\Storage;
use Carbon\Carbon;
use Hashids\Hashids;
use Illuminate\Support\Facades\Response;

function myhash($id)
{
    $date = date('dMY') . 'CJ';
    $hash = new Hashids($date, 14);
    return $hash->encode($id);
}

function decodeHash($str, $toString = true)
{
    $date = date('dMY') . 'CJ';
    $hash = new Hashids($date, 14);
    $decoded = $hash->decode($str);
    return $toString ? implode(',', $decoded) : $decoded;
}

function getRandomToken($length, $typeInt = false)
{
    $token = "";
    $codeAlphabet = "ABCDEFGHIJKLMNOPQRSTUVWXYZ";
    $codeAlphabet .= strtolower($codeAlphabet);
    $codeAlphabet .= "0123456789";
    $max = strlen($codeAlphabet);

    if ($typeInt == true) {
        for ($i = 0; $i < $length; $i++) {
            $token .= rand(0, 9);
        }
        $token = intval($token);
    } else {
        for ($i = 0; $i < $length; $i++) {
            $token .= $codeAlphabet[random_int(0, $max - 1)];
        }
    }

    return $token;
}

// Returns full public path
function my_asset($path = null)
{
    return url("/") . env('RESOURCE_PATH') . '/' . $path;
}

/**Puts file in a public storage */
function putFileInStorage($file, $path)
{
    $filename = uniqid() . '.' . $file->getClientOriginalExtension();
    $file->storeAs($path, $filename);
    return "$path/$filename";
}

/**Gets file from public storage */
function getFileFromStorage($fullpath, $storage = 'storage')
{
    if ($storage == 'storage') {
        return route('read_file', encrypt($fullpath));
    }
    return my_asset($fullpath);
}

/**Deletes file from public storage */
function deleteFileFromStorage($path)
{
    if(file_exists($path)){
        unlink(public_path($path));
    }
}


/** Returns File type
 * @return Image || Video || Document
 */
function getFileType(String $type)
{
    $imageTypes = imageMimes();
    if (strpos($imageTypes, $type) !== false) {
        return 'Image';
    }

    $videoTypes = videoMimes();
    if (strpos($videoTypes, $type) !== false) {
        return 'Video';
    }

    $docTypes = docMimes();
    if (strpos($docTypes, $type) !== false) {
        return 'Document';
    }
}

function imageMimes()
{
    return "image/jpeg,image/png,image/jpg,image/svg";
}

function videoMimes()
{
    return "video/x-flv,video/mp4,video/MP2T,video/3gpp,video/quicktime,video/x-msvideo,video/x-ms-wmv,video/avi";
}

function docMimes()
{
    return "application/pdf,application/docx,application/doc";
}


function slugify($value)
{
    return Str::slug($value);
}
