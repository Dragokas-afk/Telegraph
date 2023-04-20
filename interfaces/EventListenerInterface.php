<?php


interface EventListenerInterface {

    function attachEvent($nameFunction, $callback);

    function detouchEvent($nameFunction);

}


?>