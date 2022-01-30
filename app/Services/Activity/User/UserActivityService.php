<?php

namespace App\Services\Activity\User;

use App\Models\User;
use App\Models\UserActivityLog;

class UserActivityService
{
    public static function log($email, $activity, $title, $description, array $data = null)
    {
        $user = User::find($email);
        $payload = [
            "reference" => self::generateReference(),
            "email" => $user->email,
            "activity" => $activity,
            "title" => $title,
            "description" => $description,
            "data" => !empty($data) ? json_encode($data) : null
        ];

        return  UserActivityLog::create($payload);
    }


    public static function generateReference()
    {
        $code = strtoupper(getRandomToken(6));
        if (UserActivityLog::where("reference", $code)->count() > 0) {
            return self::generateReference();
        }
        return $code;
    }
}
