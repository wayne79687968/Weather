<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Log;

class WeatherController extends Controller
{
    public function getWeatherData(Request $request)
    {
        $lat = $_GET['lat'];
        $lon = $_GET['lon'];
        $ch = curl_init();
        $url = 'https://api.openweathermap.org/data/2.5/weather?lat=' . $lat . '&lon=' . $lon . '&appid=8caa11d8c6f2eb7f1508e49175f36f66&units=metric';
        curl_setopt($ch, CURLOPT_URL, $url);
        curl_setopt($ch, CURLOPT_HEADER, false);
        curl_setopt($ch, CURLOPT_RETURNTRANSFER, true);
        $result = json_decode(curl_exec($ch), true);
        $img = "https://openweathermap.org/img/w/" . $result["weather"][0]["icon"] . ".png";
        $description = $result["weather"][0]["description"];
        $data = [
            "location" => $result["name"],
            "Humidity" => $result['main']['humidity'],
            "Pressure" => $result['main']['pressure'],
            "Feels like" => $result['main']['feels_like'] . "°C",
            "Temp" => $result['main']['temp'] . "°C",
            "Max Temp" => $result['main']['temp_max'] . "°C",
            "Min temp" => $result['main']['temp_min'] . "°C",
            "Visibility" => $result['visibility'] / 1000 . "km",
            "Sunrise" => date('Y/m/d H:i:s', strtotime("+8 hours", $result['sys']['sunrise'])),
            "Sunset" => date('Y/m/d H:i:s', strtotime("+8 hours", $result['sys']['sunset']))
        ];

        curl_close($ch);

        Log::create([
            "account" => auth()->user()->email,
            "gps" => json_encode([$lat, $lon]),
            "content" => json_encode($data)
        ]);

        return json_encode([
            'error' => false,
            'img' => $img,
            'description' => $description,
            'data' => $data
        ]);
    }
}
