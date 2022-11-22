<?php declare(strict_types=1);

use Dotenv\Dotenv;
use App\Api;

require_once "vendor/autoload.php";

$dotenv = Dotenv::createImmutable(__DIR__);
$dotenv->load();

$apiClient = new Api($_ENV['API_KEY']);
$defaultCity = "Riga";
$city = $apiClient->getCity(
    $_GET["city"] ?? $defaultCity
);
$weatherReport = $apiClient->getWeather($city);
?>

<!doctype html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport"
          content="width=device-width, user-scalable=no, initial-scale=1.0, maximum-scale=1.0, minimum-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <link rel="stylesheet" href="styles.css">
    <title>Weather report</title>
</head>
<body>
<div class="container">
    <div>
        <div class="links">
            <a href="/?city=Riga">Riga</a>
            <a href="/?city=Vilnius">Vilnius</a>
            <a href="/?city=Tallinn">Tallinn</a>
        </div>
        <form class="form" action="index.php" method="get">
            <label>
                <input type="text" placeholder="City..." name="city">
            </label>
            <button type="submit">Search</button>
        </form>
    </div>
    <div class="weather-container">
        <?php if ($weatherReport) { ?>
            <h2 class="city-name"><?= $city->getName() ?></h2>
            <div class="temperature-container">
                <img src="<?= $weatherReport->getIcon() ?>" alt="icon">
                <h2><?= $weatherReport->getTemperature() ?>°C</h2>
            </div>
            <hr>
            <span>Humidity: <?= $weatherReport->getHumidity() ?>%</span>
            <span>Pressure: <?= $weatherReport->getPressure() ?>hPa</span>
        <?php } ?>
    </div>
</div>
</body>
</html>
