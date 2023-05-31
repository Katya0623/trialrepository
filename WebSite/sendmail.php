<?php
    use PHPMailer\PHPMailer\PHPMailer;
    use PHPMailer\PHPMailer\Exception;

    require 'phpmailer/src/Exception.php';
    require 'phpmailer/src/PHPMailer.php';

    $mail = new PHPMailer(true);
    $mail->CharSet = 'UTF-8';
    $mail->setLanguage('ru', 'phpmailer/language/');
    $mail->IsHTML(true);

    $mail->setFrom('katya.ivanushkina2000@yandex.ru');
    $mail->addAddress('katya.ivanushkina2000@yandex.ru');
    $mail->Subject = 'Здравствуй! Это моя история путешествия';

    $body = '<h1>Лови мое письмо!</h1>';

    if(trim(!empty($_POST['name']))){
        $body.='<p><strong>Имя:</strong> '.$_POST['name'].'</p>';
    }
    if(trim(!empty($_POST['age']))){
        $body.='<p><strong>Возраст:</strong> '.$POST['age'].'</p>';
    }
    if(trim(!empty($_POST['email']))){
        $body.='<p><strong>E-mail:</strong> '.$POST['email'].'</p>';
    }
    if(trim(!empty($_POST['number']))){
        $body.='<p><strong>Телефон:</strong> '.$POST['number'].'</p>';
    }
    if(trim(!empty($_POST['activity']))){
        $body.='<p><strong>Род деятельности:</strong> '.$POST['activity'].'</p>';
    }
    if(trim(!empty($_POST['continent']))){
        $body.='<p><strong>Континент:</strong> '.$POST['continent'].'</p>';
    }
    if(trim(!empty($_POST['country']))){
        $body.='<p><strong>Страна:</strong> '.$POST['country'].'</p>';
    }
    if(trim(!empty($_POST['message']))){
        $body.='<p><strong>История путешествия:</strong> '.$POST['message'].'</p>';
    }
    if(!empty($_FILES['image']['tmp_name'])){
       $filePath = __DIR__ . "/files/" . $_FILES['image']['name'];

       if(copy($_FILES['image']['tmp_name'], $filePath)){
        $fileAttach = $filePath;
        $body.='<p><strong>Фото в приложении</strong></p>';
        $mail->addAttachment($fileAttach);
       }
    }

    $mail->Body = $body;

    if (!$mail->send()){
        $message = 'Ошибка';
    }else{
        $message = 'Данные отправлены!';
    }

    $response =['message' => $message];

    header('Content-type: application/json');
    echo json_encode($response);
?>
