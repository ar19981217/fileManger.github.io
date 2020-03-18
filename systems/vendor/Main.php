<?php
namespace systems\vendor;
class Main
{
    public function __construct()
    {
        spl_autoload_register(function ($class){
           $path = str_replace('\\', '/', $class);
           if (file_exists($path.'.php')){
               require $path;
           }
        });
    }

    public function dd($parm)
    {
        echo "<pre>";
        print_r($parm, true);
        echo "</pre>";
    }
}
//$main = new Main();