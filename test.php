<?php
/*
$stringTrue = 'Леся я тебя люблю пожалуйста не бей!';
$stringFalse = 'Серунчик гей!';

function checkString($string) {
    try {
        if($string < 15){

        } else {
            throw new Exception('Строка меньше 15 символов!');
        }
    } catch (Exception $e) {
        echo "Исключение: " . $e->getMessage();
    }
}

$try = set_error_handler('checkString');

var_dump($try);
*/

// Определяемая пользователем функция обработчика исключений
function exception_handler(Throwable $exception) {
    echo "Неперехваченное исключение: " , $exception->getMessage(), "\n";
}

set_exception_handler('exception_handler');

throw new Exception('Неперехваченное исключение');
echo "Не выполнено\n";






?>