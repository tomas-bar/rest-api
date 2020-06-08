<?php

namespace App\Http\Controllers\Api;

use App\Category;
use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Http;


class ProductController extends Controller
{
    /**
     *
     * Returns product recommendations depending on the weather of selected city
     *
     * @param string $city
     * @return string JSON encoded string
     */
    public function getRecommendedProducts($city) {
        $weather_condition = self::getCurrentWeatherCondition($city);

        if (!$weather_condition) {
            return response([
                'message' => 'No products found.'
            ], 404);
        }

        $category = Category::where('code', $weather_condition)->with(['products' => function ($query) {
            $query->get(['sku', 'name', 'price']);
        }])->first();

        if (empty($category) OR empty($category->products)) {
            return response([
                'message' => 'No products found.'
            ], 404);
        }

        $response = [
            'city' => ucfirst($city),
            'current_weather' => $weather_condition,
            'recommended_products' => $category->products
        ];

        return response($response, 200);
    }

    /**
     *
     * Fetch public weather API and return current weather condition code
     *
     * @param string $city
     * @return string
     */
    public function getCurrentWeatherCondition($city) {
        date_default_timezone_set('Europe/Vilnius');

        // Fetch weather information from API
        $response = Http::withOptions(['verify' => false])
            ->get("https://api.meteo.lt/v1/places/{$city}/forecasts/long-term");

        // Check if there is no error from request
        if (isset($response['error'])) {
            return false;
        }

        // Get closest forecast timestamp to current date time from array of timestamps
        $forecast_timestamps = [];
        foreach ($response['forecastTimestamps'] AS $timestamp) {
            $forecast_timestamps[] = $timestamp['forecastTimeUtc'];
            $intervals[] = abs(strtotime(date('Y-m-d H:i:s')) - strtotime($timestamp['forecastTimeUtc']));
        }

        asort($intervals);
        $closest = key($intervals);

        $current_forecast = $response['forecastTimestamps'][array_search($forecast_timestamps[$closest], array_column($response['forecastTimestamps'], 'forecastTimeUtc'))];
        return $current_forecast['conditionCode'];
    }
}
