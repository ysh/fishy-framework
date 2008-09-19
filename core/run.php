<?php

//set some system definitios
define('FISHY_SYSTEM_CLASS_PREFIX', 'Fishy_');

//autoloader for classes
include_once FISHY_SYSTEM_CORE_PATH . '/autoloader.php';

//load configuration basics
$conf = include FISHY_CONFIG_PATH . '/config.php';

define('FISHY_BASE_URL', $conf->base_url);
define('FISHY_INDEX_PAGE', $conf->index_page);

//some simple usefull helpers functions
require_once FISHY_SYSTEM_CORE_PATH . '/core_helpers.php';

//load database
require_once FISHY_SYSTEM_DATABASE_PATH . '/ActiveRecord.php';

$db_conf = include FISHY_CONFIG_PATH . '/db.php';

DBCommand::configure($db_conf->host, $db_conf->user, $db_conf->password, $db_conf->database);

//load uri
$current_uri = Fishy_Uri::get_querystring();

//load router configuration
$router_conf = include FISHY_CONFIG_PATH . '/router.php';

$router = new Fishy_Router($router_conf->get_data());
$current_route = $router->parse($current_uri);

Fishy_Controller::run($current_route);
