<?php

require_once __DIR__ . "/vendor/autoload.php";

use GraphQL\Type\Schema;
use PimsTv\ApiReader\Edium;
use PimsTv\ApiReader\Etl;
use PimsTv\ApiReader\Vies;
use PimsTv\AppDataReader;
use PimsTv\AppReportTime;
use PimsTv\Controller\GraphQL;
use PimsTv\DataReader;
use PimsTv\FoodDataReader;
use PimsTv\Graphql\App;
use PimsTv\Graphql\Food;
use PimsTv\Graphql\Payday;
use PimsTv\Graphql\Report;
use PimsTv\Graphql\Root;
use PimsTv\Graphql\Weather;
use PimsTv\Graphql\WeatherTime;
use PimsTv\PaydayCalculate;
use PimsTv\WeatherApiReader;
use Slim\Factory\AppFactory;
use Symfony\Component\Cache\Adapter\FilesystemAdapter;

$app = AppFactory::create();

$app->addErrorMiddleware(false, true, true);

$dotenv = Dotenv\Dotenv::createImmutable(__DIR__);
$dotenv->load();

$cache = new FilesystemAdapter();

$weatherApiReader = new WeatherApiReader(
    $_ENV['OPENWEATHERMAP_APIKEY'],
    $_ENV['OPENWEATHERMAP_ENDPOINT'],
    $_ENV['OPENWEATHERMAP_LON'],
    $_ENV['OPENWEATHERMAP_LAT'],
    $cache
);
$paydayCalculate = new PaydayCalculate();

$dataReader = new DataReader($cache, $weatherApiReader, $paydayCalculate, $_ENV['WEATHER_FUTURE_TIME']);

$appReportTime = new AppReportTime($cache);

$appDataReader = new AppDataReader();
$appDataReader->addAppObject(new Etl($_ENV['ETL_HOST'], $appReportTime));
$appDataReader->addAppObject(new Edium($_ENV['EDIUM_HOST'], $appReportTime));
$appDataReader->addAppObject(new Vies($_ENV['VIES_HOST'], $appReportTime));

$foodDataReader = new FoodDataReader($_ENV['FOOD_LIST_FILE']);

$schema = new Schema([
    'query' => new Root(
        new WeatherTime(new Weather($dataReader)),
        new Payday($dataReader),
        new Food(),
        new App(new Report()),
        $appDataReader,
        $foodDataReader
    ),
]);

$app->post('/graphql', new GraphQL($schema));
$app->options('/{routes:.+}', function ($request, $response, $args) {
    return $response;
});

$app->add(function ($request, $handler) {
    $response = $handler->handle($request);

    return $response
        ->withHeader('Access-Control-Allow-Origin', $_ENV['CORS_ADDRESS'])
        ->withHeader('Access-Control-Allow-Headers', 'X-Requested-With, Content-Type, Accept, Origin, Authorization')
        ->withHeader('Access-Control-Allow-Methods', 'GET, POST, PUT, DELETE, PATCH, OPTIONS');
});

$app->run();
