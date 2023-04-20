<?php
 spl_autoload_register(function ($class) {

    include 'entities/' . $class . '.php';

});


require_once 'vendor/autoload.php';

?>