<?php


class TelegraphText
{

    private $title;
    private $text;
    private $author;
    private $published;
    private $slug;

    private $properties = [];

    public function __construct($author, $slug)
    {
        $this->author = $author;
        $this->slug = $slug;
        $published = $this->published = date('Y-m-d');
    }

    public function __get($name)
    {
        if ($name === 'loadText') {
            return $this->loadText();
        } elseif ($name === 'storeText') {
            return $this->storeText();
        } elseif ($name === 'author') {
            return $this->author;
        } elseif ($name === 'slug') {
            return $this->slug;
        } elseif ($name === 'published') {
            return $this->published;
        }

    }

    public function __set($name, $value)
    {
        if (is_callable($name)) {
            $this->properties[$name] = $value;
        } else {
            switch ($name) {
                case 'author':
                    if (strlen($value) < 120) {
                        $this->author = $value;
                    } else {
                        echo '120';
                    }
                    break;
                case 'slug':
                {
                    if (preg_match("/^[A-Za-z0-9]+$/", $value)) {
                        $this->slug = $value;

                    }
                    break;
                }
                case 'published':
                {
                    if (date($value) >= date('Y-m-d')) {
                        $this->published = $value;
                    }
                    break;
                }
            }

        }


    }

    //Создание файла
    private function storeText()
    {
        $arr = [

            'text' => $this->text,
            'title' => $this->title,
            'author' => $this->author,
            'published' => $this->published
        ];

        file_put_contents($this->slug, serialize($arr));
    }

    //Считывание текста из файла
    private function loadText()
    {
        if (file_exists($this->slug)) {
            $content = file_get_contents($this->slug);
            $arr = unserialize($content);

            $this->title = $arr['title'];
            $this->text = $arr['text'];
            $this->author = $arr['author'];
            $this->published = $arr['published'];

            return $this->text;
        } else {
            return false;
        }
    }

    //Редактирование файла
    public function editText($title, $text)
    {
        $this->title = $title;
        $this->text = $text;
    }


    public function checkText($text)
    {

        set_exception_handler('exceptionHandler');

        try {
            if(strlen($text) > 1 && strlen($text) < 500) {

            } else {
                throw new Exception('Текст должен быть от 1 до 500 символов!');
            }
        } catch(Exception $e) {
           throw $e;
        }
    }


}






?>