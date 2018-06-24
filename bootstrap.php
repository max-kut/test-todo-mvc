<?php

define('ROOT_PATH', __DIR__ . DIRECTORY_SEPARATOR);
define('PUBLIC_PATH', ROOT_PATH . 'public_html' . DIRECTORY_SEPARATOR);
define('CONFIG_PATH', ROOT_PATH . 'config' . DIRECTORY_SEPARATOR);
define('TEMPLATE_PATH', ROOT_PATH . 'templates' . DIRECTORY_SEPARATOR);
define('LOGS_PATH', ROOT_PATH . 'logs' . DIRECTORY_SEPARATOR);

require ROOT_PATH . 'vendor/autoload.php';
require ROOT_PATH . 'helpers.php';

// import .env file
(new \Symfony\Component\Dotenv\Dotenv())->load(ROOT_PATH.'.env');