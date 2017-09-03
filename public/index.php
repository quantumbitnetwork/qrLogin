<?php
use Rayac\qrlogin\cookieGenerator;
use Rayac\qrlogin\Database;
use Rayac\qrlogin\urlGenerator;


require_once '../vendor/autoload.php';


session_start();


$dotenv = new Dotenv\Dotenv('../');
$dotenv->load();

$pdo = Database::getPDO();

$url = new urlGenerator($pdo);

$route = new League\Route\RouteCollection;


$route->map('GET', '/', 'Rayac\qrlogin\controllers\homeController::action');
$route->map('GET', '/' . $url->getURL()["url"], 'Rayac\qrlogin\controllers\loginController::action');













$container = new League\Container\Container;

$container->share('response', Zend\Diactoros\Response::class);
$container->share('request', function () {
    return Zend\Diactoros\ServerRequestFactory::fromGlobals(
        $_SERVER, $_GET, $_POST, $_COOKIE, $_FILES
    );
});

$container->share('emitter', Zend\Diactoros\Response\SapiEmitter::class);

$response = $route->dispatch($container->get('request'), $container->get('response'));

$container->get('emitter')->emit($response);







/*
$router->addRoute('GET', '/hr', 'Rayac\skola\controllers\languageController::croatia');
$router->addRoute('GET', '/en', 'Rayac\skola\controllers\languageController::english');
$router->addRoute('GET', '/reg', 'Rayac\skola\controllers\regController::action');
$router->addRoute('GET', '/login', 'Rayac\skola\controllers\loginController::action');
$router->addRoute('GET', '/logout', 'Rayac\skola\controllers\loginController::logout');
$router->addRoute('GET', '/gallery', 'Rayac\skola\controllers\homeController::gallery');
$router->addRoute('GET', '/aboutus', 'Rayac\skola\controllers\homeController::aboutus');
$router->addRoute('GET', '/account', 'Rayac\skola\controllers\accountController::action');
$router->addRoute('GET', '/create', 'Rayac\skola\controllers\postController::action');
$router->addRoute('GET', '/plan/{id}', 'Rayac\skola\controllers\postController::show');
$router->addRoute('POST', '/create', 'Rayac\skola\controllers\postController::create');
$router->addRoute('POST', '/login', 'Rayac\skola\controllers\loginController::login');
$router->addRoute('POST', '/reg', 'Rayac\skola\controllers\regController::register');
$router->addRoute('POST', '/filipmail', 'Rayac\skola\controllers\homeController::filipmail');
*/
//$router->addRoute('GET', '/{link}!{from}', 'Rayac\peopleController::action');



/*
 * Create hash for url for phpsession?
 * Ping url every second
 * Send data to url via phone to "claim" that phpsession and login
 *
 *
 *
 */
