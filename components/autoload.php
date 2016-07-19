<?php

class Autoload
{
    public static function load($className) {
        $libPath = ROOT . DS . 'components' . DS . strtolower($className) . '.php';
        $controllersPath = ROOT . DS . 'controllers' . DS . $className . '.php';
        $modelsPath = ROOT . DS . 'models' . DS . $className . '.php';



        if (file_exists($libPath)) {
            require_once ($libPath);
        } elseif (file_exists($controllersPath)) {
            require_once ($controllersPath);
        } elseif (file_exists($modelsPath)) {
            require_once ($modelsPath);
        } else throw new Exception('Failed to include file: ' . $className);
    }
}

spl_autoload_register(__NAMESPACE__ . 'Autoload::load');