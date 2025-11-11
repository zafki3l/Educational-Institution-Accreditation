<?php

use Core\Container;
use Core\App;

$container = new Container();

require_once 'database.php';
require_once 'repositories.php';
require_once 'services.php';

App::setContainer($container);