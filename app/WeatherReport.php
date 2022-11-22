<?php declare(strict_types=1);

namespace App;

class WeatherReport
{
    private float $temperature;
    private int $humidity;
    private int $pressure;
    private string $icon;

    public function __construct(float $temperature, int $humidity, int $pressure, string $icon)
    {
        $this->temperature = $temperature;
        $this->humidity = $humidity;
        $this->pressure = $pressure;
        $this->setIcon($icon);
    }

    public function getHumidity(): int
    {
        return $this->humidity;
    }

    public function getTemperature(): float
    {
        return $this->temperature;
    }

    public function getPressure(): int
    {
        return $this->pressure;
    }

    public function getIcon(): string
    {
        return $this->icon;
    }

    public function setIcon(string $icon): void
    {
        $url = "https://openweathermap.org/img/wn/$icon.png";
        $this->icon = $url;
    }
}
