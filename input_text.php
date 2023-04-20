<?php

require_once 'autoload.php';
require 'vendor/PHPMailer/phpmailer/src/PHPMailer.php';
require 'vendor/phpmailer/phpmailer/src/SMTP.php';
require 'vendor/phpmailer/phpmailer/src/Exception.php';


function errorFinder($error, $key, &$arr)
{
    $error = [$key => $error];
    array_push($arr, $error);

}

function exceptionHandler($e)
{
    $errorMessage = 'Исключение: ' . $e->getMessage();
    $html = "<div class='form_wrapper_elem'>
                        <p class='error' style='color: white;'>" . $errorMessage . "</p>
                       </div>";
    return $html;
}

$error = [];
$success = [];

if (isset($_POST['submit'])) {

    $author = $_POST['author'];
    $text = $_POST['text'];
    $email = $_POST['email'];

    if (!empty($author) && !empty(($text))) {


        $telegraph = new TelegraphText($author, 'text');
        try {
            $result = $telegraph->checkText($text);
        } catch (Exception $e) {
            $html = exceptionHandler($e);
        }


        $fileStorage = new FileStorage();
        $fileStorage = $fileStorage->create($telegraph);

        if (!empty($email)) {
            $title = "Заголовок письма";
            $body = "
        <h2>Новое письмо</h2>
        <b>Имя:</b> $author<br>
        <b>Почта:</b> $email<br><br>
        <b>Сообщение:</b><br>$text
        ";

            $mail = new \PHPMailer\PHPMailer\PHPMailer();
            try {
                $mail->isSMTP();
                $mail->CharSet = "UTF-8";
                $mail->SMTPAuth = true;
                //$mail->SMTPDebug = 2;
                $mail->Debugoutput = function ($str, $level) {
                    $GLOBALS['status'][] = $str;
                };

                // Настройки вашей почты
                $mail->Host = 'smtp.gmail.com'; // SMTP сервера вашей почты
                $mail->Username = 'serega.kuzovkin@gmail.com'; // Логин на почте
                $mail->Password = 'flhqouvntqukihir'; // Пароль на почте
                $mail->SMTPSecure = 'ssl';
                $mail->Port = 465;
                $mail->setFrom('serega.kuzovkin@gmail.com', 'Серунчик'); // Адрес самой почты и имя отправителя

                // Получатель письма
                $mail->addAddress('serega_kuzovkin@mail.ru');

                // Отправка сообщения
                $mail->isHTML(true);
                $mail->Subject = $title;
                $mail->Body = $body;

                // Проверяем отравленность сообщения
                if ($mail->send()) {
                    $result = "success";
                } else {
                    $result = "error";
                }

                errorFinder('Письмо успешно отправлено!', 'success', $success);

            } catch (Exception $e) {
                $result = "error";
                $status = "Сообщение не было отправлено. Причина ошибки: {$mail->ErrorInfo}";
            }
        }


    } else {
        errorFinder('Не заполнены автор или текст!', 'error', $error);
    }
}


?>

<!doctype html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport"
          content="width=device-width, user-scalable=no, initial-scale=1.0, maximum-scale=1.0, minimum-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <title>Document</title>
    <link rel="stylesheet" href="style.css">
</head>
<body>
<div class="wrapper">
    <form class="form" method="post" action="input_text.php">
        <div class="form_wrapper">
            <h1>Телеграф</h1>
            <div class="form_wrapper_elem">
                <label for="author">Автор: </label>
                <input type="text" name="author" class="">
            </div>
            <div class="form_wrapper_elem">
                <label for="author">Текст: </label>
                <textarea name="text" class="textarea" id=""></textarea>
            </div>
            <div class="form_wrapper_elem">
                <label for="email">Почта: </label>
                <input type="text" name="email" class="">
            </div>

            <?php
            if (!empty($error)) {
                foreach ($error as $value) {
                    echo "<div class='form_wrapper_elem'>
                        <p class='error' style='color: white;'>" . $value['error'] . "</p>
                       </div>";
                }
            };
            if (!empty($success)) {
                foreach ($success as $value) {
                    echo "<div class='form_wrapper_elem'>
                        <p class='success' style='color: white;'>" . $value['success'] . "</p>
                       </div>";
                }
            }
            if (!empty($html)) {
                echo $html;;
            }

            ?>


            <input class="button" type="submit" name="submit" value="Отправить" class="">
        </div>
    </form>
</div>

</body>
</html>