<?php

namespace App\Http\Helpers;

use Illuminate\Support\Facades\Storage;

class Media
{
    protected const VIDEO = 'video';
    protected const IMAGE = 'image';
    protected const TODAY = 'today';

    /**
     * @param $response
     * @param $days
     * @return \Illuminate\Http\RedirectResponse
     */
    public function checkFormat($response, $days)
    {
        $mediaType = $response['media_type'];
        if ($mediaType == self::VIDEO) {
            is_numeric($days) ? $days -= 1 : $days = -1;
            return redirect()->action(['App\Http\Controllers\MediaController', 'index'], ['days' => $days]);
        }
        return $this->generateImage($response, $days);
    }

    public function generateImage($response)
    {
        $url = $response['url'];
        $fileName = str_replace(' ', '-', $response['title']);
        $fileName = strtolower(str_replace(':', '', $fileName) . '.jpg');
        if (!Storage::disk('uploads')->exists($fileName)) {
            return redirect()->action(
                ['App\Http\Controllers\MediaController', 'compressImage'],
                ['filename' => $fileName, 'url' => $url]
            );
        }
        $response['compressed_url'] = $fileName;
        return $response;
    }

    /**
     * @param $request
     * @return string
     */
    public function calculateDays($request)
    {
        $days = self::TODAY;
        if (isset($request->days)) {
            $days = $request->days . ' days';
        }

        return $days;
    }
    public function compressImage($fileName, $imageContents, $response)
    {
        Storage::disk('uploads')->put($fileName, $imageContents);

        $response['compressed_url'] = $fileName;
        return $response;
    }
}
