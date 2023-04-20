<?php

class FileStorage extends Storage
{

    public function logMessage($error)
    {

    }

    public function lastMessages($countMessages)
    {

    }

    public function attachEvent($nameFunction, $callback)
    {

    }

    public function detouchEvent($nameFunction)
    {

    }

    public function create($obj)
    {
        $newSlug = $obj->slug . "_" . date('Y-m-d');

        $i = 1;

        if(file_exists($newSlug . '.txt')) {
            while (file_exists($newSlug . '_' . $i . '.txt')) {
                $i++;
            }
            $newSlug = $newSlug . '_' . $i . '.txt';
        } else {
            $newSlug = $newSlug . '.txt';
        }

        serialize($obj = new TelegraphText('Lesya', $newSlug));

        $obj->slug = $newSlug;

        $obj->storeText;


    }

    public function read($id, $slug)
    {
        return $obj = new TelegraphText('Lesya', $slug);

    }

    public function update($obj, $id = null, $slug = null)
    {
        serialize($obj);
    }

    public function delete($id = null, $slug = null)
    {
        /* TODO */
    }

    public function list($arr = [])
    {

        $fileArr = scandir('../basics');
        foreach ($fileArr as $fileElem) {
            if (substr($fileElem, -4) == '.txt') {
                array_push($arr, unserialize($fileElem));
                return $arr;
            } else {
                return false;
            }

        };
    }
}


?>