<?php

abstract class View {

    public $storage;

    public function __construct($obj)
    {

    }

    abstract function displayTextById($id);
    abstract function displayTextByUrl ($id);

}


?>