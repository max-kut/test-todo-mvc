<?php


if (!function_exists('dump')) {
    /**
     * Inspecting variables
     *
     * @param  mixed $data
     *
     * @return void
     */
    function dump($data)
    {
        if (php_sapi_name() !== 'cli') {
            echo '<pre style="padding:3px;margin - bottom:3px;font - size:11px">';
        switch (gettype($data)) {
            case 'boolean':
            case 'bool':
                print_r($data ? "true" : "false");
                break;
    
            default:
                print_r($data);
        }
        echo "</pre>";
    } else {
            echo print_r($data, 1) . PHP_EOL;
        }
    }
}

if(!function_exists('dd')){
    function dd($data){
        dump($data);
        die();
    }
}

if(!function_exists('writeToLog')){
    function writeToLog($data)
    {
        $log = '================| ' . date('Y.m.d H:i:s') . PHP_EOL;
        $log .= print_r($data, 1);
        if (!is_array($data) && !is_object($data)) {
            $log .= PHP_EOL;
        }
        return file_put_contents(
            __DIR__.'/logs/log_' . date('Y-m-d') . '.log',
            $log,
            FILE_APPEND
        );
    }
}

if(!function_exists('view')){
    /**
     * @param string $viewName имя шаблона
     * @param string $title - заголовок страницы
     * @param array $viewData - параметры шаблона
     *
     * @return mixed
     */
    function view($viewName, $title, $viewData = []){
        return require TEMPLATE_PATH . 'root.php';
    }
}
