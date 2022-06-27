<?php

namespace App\Controllers;

use App\Models\ApiTokenModel;
use CodeIgniter\API\ResponseTrait;

class ForecastController extends BaseController
{
    use ResponseTrait;

    /**
     * If an authorized Api-Token is passed in the header, return the forecast in JSON format
     * and increment usage of the token in the tokens table.
     *
     * @return \CodeIgniter\HTTP\Response
     */
    public function forecast(): \CodeIgniter\HTTP\Response
    {
        $accessToken = trim(stristr($this->request->header('Api-Token'), " "));
        $apiTokenModel = new ApiTokenModel();
        if ($apiTokenModel->find($accessToken)) {
            $apiTokenModel->updateUsage($accessToken);
            return $this->respond($this->callForecastApi());
        } else {
            return $this->failUnauthorized();
        }
    }

    /**
     * Get weather forecast for a specific location using the following url:
     * https://api.weather.gov/gridpoints/OKX/31,34/forecast
     *
     * @return array
     */
    private function callForecastApi(): array
    {
        $url = "https://api.weather.gov/gridpoints/OKX/31,34/forecast";
        $headers = [
            "User-Agent: weather-api-noaa-demo",
            "Content-Type: application/geo+json",
            "Accept: application/geo+json",
        ];
        $ch = curl_init();
        curl_setopt($ch, CURLOPT_URL, $url);
        curl_setopt($ch, CURLOPT_RETURNTRANSFER, true);
        curl_setopt($ch, CURLOPT_CONNECTTIMEOUT, 10);
        curl_setopt($ch, CURLOPT_FOLLOWLOCATION, true);
        curl_setopt($ch, CURLOPT_HTTPHEADER, $headers);

        $arrData = json_decode(curl_exec($ch), true);
        curl_close($ch);

        $forecast = $forecastPeriod = [];
        foreach ($arrData['properties']['periods'] as $period) {
            $forecastPeriod['name'] = $period['name'];
            $forecastPeriod['startTime'] = $period['startTime'];
            $forecastPeriod['endTime'] = $period['endTime'];
            $forecastPeriod['temperature'] = $period['temperature'];
            $forecastPeriod['temperatureUnit'] = $period['temperatureUnit'];
            $forecastPeriod['temperatureTrend'] = $period['temperatureTrend'];
            $forecastPeriod['icon'] = $period['icon'];
            $forecastPeriod['shortForecast'] = $period['shortForecast'];
            $forecast[] = $forecastPeriod;
            $forecastPeriod = [];
        }

        return $forecast;
    }
}
