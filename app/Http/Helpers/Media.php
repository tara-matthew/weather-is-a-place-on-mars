<?php

namespace App\Http\Helpers;

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
    public function generateMedia($response, $days)
    {
        $mediaType = $response['media_type'];
        if ($mediaType == self::VIDEO) {
            is_numeric($days) ? $days -= 1 : $days = -1;
            return redirect()->action(['App\Http\Controllers\MediaController', 'index'], ['days' => $days]);
        }
        $fileName = str_replace(' ','-', $response['title']);
        $fileName = str_replace(':', '', $fileName);

        if (!is_file($fileName)) {
            $this->compressImage($response);
        }
        $response['compressed_path'] = $fileName;
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
    public function compressImage($response)
    {
        \Tinify\setKey(getenv('TINIFY_API_KEY'));
        $source = \Tinify\fromUrl($response['url']);
        $fileName = str_replace(' ','-', $response['title']);
        $fileName = str_replace(':', '', $fileName);
        $source->toFile($fileName);
    }
}
