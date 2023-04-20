<?php

require_once 'interfaces/EventListenerInterface.php';
require_once 'interfaces/LoggerInterface.php';

abstract class Storage implements LoggerInterface, EventListenerInterface
{

    abstract function logMessage($error);

    abstract function lastMessages($countMessages);

    abstract function attachEvent($nameFunction, $callback);

    abstract function detouchEvent($nameFunction);

    abstract function create($obj);

    abstract function read($id, $slug);

    abstract function update($obj, $id = null, $slug = null);

    abstract function delete($id = null, $slug = null);

    abstract function list($arr = []);

}


?>