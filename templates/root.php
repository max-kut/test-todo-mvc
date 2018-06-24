<?php
/**
 * Здесь логика очень простых шаблонов с ограничением области видимости
 */

/**
 * Подключает нужный view
 * @param $viewName
 */
function getTemplateView($viewName, $viewData = []){
    $_viewFile = __DIR__ . "/views/{$viewName}.view.php";
    if($viewName && file_exists($_viewFile)){
        require_once $_viewFile;
    } else {
        require_once __DIR__ . "/views/404.view.php";
    }
}

/**
 * Подключает навигационный шаблон
 */
function getTemplateNav(){
    require_once __DIR__ . '/blocks/nav.php';
}

/**
 * Подключает пагинацию
 * @param $currentPage
 * @param $lastPage
 */
function getTemplatePagination($currentPage, $lastPage){
    require_once __DIR__ . '/blocks/pagination.php';
}

/**
 * Подключает сиртировщик задач
 */
function getTemplateSortTasks(){
    require_once __DIR__ . '/blocks/sort_tasks.php';
}

/**
 * Формирует строку запроса с нужными параметрами, не перезаписывая остальные
 * @param $params
 *
 * @return string
 */
function getQueryString($params){
    return '?'.http_build_query(array_merge($_GET,$params));
}

require_once __DIR__ . '/layout.php';