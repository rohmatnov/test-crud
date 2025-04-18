<?php session_start();

use Rohmat\CrudTest\Controllers\ProgramController;
use Rohmat\CrudTest\Controllers\StudentController;
use Rohmat\CrudTest\Database;
use Rohmat\CrudTest\FlashMessage;
use Rohmat\CrudTest\Router;


require_once __DIR__ . '/../src/helpers.php';
require __DIR__ . '/../vendor/autoload.php';
$config = require __DIR__ . '/../src/config/database.php';

Database::connect($config);

$router = new Router();

$router->useController('/', StudentController::class);
$router->useController('/programs', ProgramController::class);

$router->run();

Database::close();

FlashMessage::unset();
