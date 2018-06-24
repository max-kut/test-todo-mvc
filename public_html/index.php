<?php
session_start();

require_once __DIR__ . '/../bootstrap.php';

$router = new \Bramus\Router\Router();

// Контроллеры в \App\Controllers
$router->setNamespace('\App\Controllers');


// главная страница
$router->get('/', 'TaskListController@index');

// Создание задачи
$router->get('/add', 'TaskCreateController@index');
$router->post('/add', 'TaskCreateController@create');

// Редактирование задачи
$router->post('/close-task', 'TaskEditController@closeTask');
$router->post('/edit-task', 'TaskEditController@editTask');

// Работа с изображениями
$router->post('/load-image', 'ImageController@loadImage');
$router->post('/remove-image', 'ImageController@removeImage');

// авторизация
$router->post('/login', 'LoginController@login');
// выход
$router->get('/logout', 'LoginController@logout');

$router->set404(function () {
    header($_SERVER['SERVER_PROTOCOL'] . ' 404 Not Found');
    
    return view('404', 'Страница не найдена');
});

$router->run();
