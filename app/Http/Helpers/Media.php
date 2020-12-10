<?php

namespace App\Http\Helpers;

class Media
{
    protected const VIDEO = 'video';
    protected const IMAGE = 'image';
    public function generateMedia($response, $days)
    {
        is_numeric($days) ? $days -= 1 : $days = -1;
        $mediaType = $response['media_type'];
        if ($mediaType == self::VIDEO) {
            return $this->generatePhoto($days);
        }
        return $response;
    }

    public function generatePhoto($days)
    {
        return redirect()->action(['App\Http\Controllers\MediaController', 'index'], ['days' => $days]);
    }
}
