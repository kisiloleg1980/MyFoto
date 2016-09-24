<?php
class Route{
    const CONROLLER = 'Main';
    const ACTION = 'index';

    public static function run(){
        $arParams = filter_input_array(INPUT_GET);
        $_SERVER['REQUEST_URI'] = trim($_SERVER['REQUEST_URI'],'/');
        $routes = explode('/', $_SERVER['REQUEST_URI']);
        $controller = (string)$routes[0] ? $routes[0] : self::CONROLLER;
        $action = (string)isset($routes[1]) ? $routes[1] : self::ACTION;
        $model = $controller."_Model";
        $controller .= "_Ctrl";
        $action .= "_Action";

        $modelFile = strtolower($model).".php";
        $modelPath = $_SERVER['DOCUMENT_ROOT'].'/models/'.$modelFile;

        $ctrlFile = strtolower($controller).'.php';
        $ctrlPath = $_SERVER['DOCUMENT_ROOT']."/controllers/".$ctrlFile;
        
        //var_dump($action);


        
        if(file_exists($modelPath)){
            include $modelPath;
        }

        if(file_exists($ctrlPath)){
            include $ctrlPath;
        }else{
            self::error404();
        }

        $ctrl = new $controller;

         

        if(method_exists($ctrl, $action)){
            $ctrl->$action($arParams);
        }else{
            self::error404();
        }

    }

    public static function error404(){
        $host = 'http://'.$_SERVER['HTTP_HOST'].'/';
        header('HTTP/1.1 404 Not Found');
        header("Status: 404 Not Found");
        header('Location:'.$host.'404');
    }
}