<?php declare(strict_types=1);

namespace App;

use GuzzleHttp\Client;

class Api
{
    private string $apiKey;
    private Client $client;

    public function __construct(string $apiKey)
    {
        $this->apiKey = $apiKey;
        $this->client = new Client();
    }

    public function getCity($city): ?City
    {
        $response = $this->client->request('GET', "https://api.openweathermap.org/geo/1.0/direct?q=$city&limit=1&appid=$this->apiKey");
        $response = json_decode($response->getBody()->getContents(), true);
        if (!$response) {
            return null;
        }
        return new City(
            $response[0]["name"],
            $response[0]["lat"],
            $response[0]["lon"]
        );
    }

    public function getWeather(City $city): ?WeatherReport
    {
        $response = $this->client->request('GET', "https://api.openweathermap.org/data/2.5/weather?lat={$city->getLat()}&lon={$city->getLon()}&appid=$this->apiKey&units=metric");
        $response = json_decode($response->getBody()->getContents(), true);
        if (!$response) {
            return null;
        }
        return new WeatherReport(
            $response["main"]["temp"],
            $response["main"]["humidity"],
            $response["main"]["pressure"],
            $response["weather"][0]["icon"]
        );
    }
}
