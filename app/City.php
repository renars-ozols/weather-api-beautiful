<?php declare(strict_types=1);

namespace App;

class City
{
    private string $name;
    private float $lat;
    private float $lon;

    public function __construct(string $name, float $lat, float $lon)
    {
        $this->name = $name;
        $this->lat = $lat;
        $this->lon = $lon;
    }

    public function getName(): string
    {
        return $this->name;
    }

    public function getLat(): float
    {
        return $this->lat;
    }

    public function getLon(): float
    {
        return $this->lon;
    }
}
