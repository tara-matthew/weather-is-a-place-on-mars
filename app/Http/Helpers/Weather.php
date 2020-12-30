<?php

namespace App\Http\Helpers;

class Weather
{
    public function getTemperatureData($response)
    {
        $solKeys = $response['sol_keys'];
        $temperatures = [];

        foreach ($response as $key => $data) {
            if (!in_array($key, $solKeys)) {
                continue;
            }
            if (!isset($response[$key]['AT'])) {
                continue;
            }
            $temperatures[$key]['min'] = $response[$key]['AT']['mn'];
            $temperatures[$key]['max'] = $response[$key]['AT']['mx'];
        }

        return $temperatures;
    }
}
