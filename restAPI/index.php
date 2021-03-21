<?php 


require_once  __DIR__ . '/vendor/autoload.php';
require_once  __DIR__ . '/Controllers/Login.php';
require_once  __DIR__ . '/Controllers/Item.php';



require_once  __DIR__ . '/jwt/vendor/autoload.php';

require_once  __DIR__ . '/models/Database.php';
require_once  __DIR__ . '/Control.php';






// Create Router instance
$router = new \Bramus\Router\Router();

$router->set404(function () {
	header($_SERVER['SERVER_PROTOCOL'] . ' 404 Not Found');
	echo '404, route not found!';
});


$router->get('/', function() {
	echo 'Home Page';
});



/* Login / All - Single - Register - Login Update - Login Delete */


$router->post('/login', 'login@index');
$router->post('/login/all', 'login@all');
$router->post('/login/single', 'login@single');
$router->post('/login/register', 'login@register');
$router->post('/login/update', 'login@update');
$router->post('/login/delete', 'login@delete');


/* Item / All - Single - Create - Update - Delete */


$router->post('/item/all', 'Item@all');
$router->post('/item/single', 'Item@single');
$router->post('/item/create', 'Item@create');
$router->post('/item/update', 'Item@update');
$router->post('/item/delete', 'Item@delete');






$router->run();





?>