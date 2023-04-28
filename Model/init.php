<?php
// put all new includes/required files here

spl_autoload_register(function($class){
    require_once $_SERVER['DOCUMENT_ROOT'].'/5spectate/Model/'.$class.'.php';
});


?>