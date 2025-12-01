<?php

use Core\Container;
use Core\App;

/**
 * Binding dependencies into a container
 */

$container = new Container();

require_once 'database.php';
require_once 'repositories.php';
require_once 'validations.php';
require_once 'services.php';

App::setContainer($container);