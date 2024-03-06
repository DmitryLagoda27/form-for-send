<?php
    use PHPMailer\PHPMailer\PHPMailer;
    use PHPMailer\PHPMailer\Exception;

    require 'phpmailer/src/Exception.php';
    require 'phpmailer/src/PHPMailer.php';

    $mail = new PHPMailer(true);
    $mail->CharSet = 'UTF-8';
    $mail->setLanguage('uk', 'phpmailer/language/'); 
    $mail->IsHTML(true);

    //від кого лист
    $mail->setFrom('dimylka2071@gmail.com', 'Замовлення на товар');
    // кому відправити
    $mail->addAddress('dimylka2071@gmail.com');
    // тема листа
    $mail->Subject = 'привіт я твоя сторінка';

    // рука
    $hand = "Права";
    if($_POST['hand'] == "left"){
        $hand = "Ліва";
    }

    // тіло листа
    $body = '<h1>Зустрічайте замовлення!</h1>';

    if(trim(!empty($_POST['name']))){
        $body.='<p><strong>Ім\'я:</strong> '.$_POST['name'].'</p>';
    }
    if(trim(!empty($_POST['email']))){
        $body.='<p><strong>Е-пошta:</strong> '.S_POST['email'].'</p>';
    }
    if(trim(!empty($_POST['hand']))){
    $body.='<p><strong>Рука:</strong> '.$hand.'</p>';
    }
    if(trim(!empty($_POST['age']))){
    $body.='<p><strong>Ваш вік:</strong> '.S_POST['age'].'</p>';
    }
    if(trim(!empty($_POST['message']))){
    $body.='<p><strong>Напишіть нам:</strong> '.S_POST['message'].'</p>';
    }

    if (!empty($_FILES['image']['tmp_name'])) {
        $filePath = __DIR__."/files/" . $_FILES['image']['name'];
        if(copy($_FILES['image']['tmp_name'], $filePath)){
            $fileAttach = $filePath;
            $body.='<p><strong>Фото у додатку</strong></p>';
            $mail->addAttachment($fileAttach);
        }
    }

    $mail->Body = $body;

    // відправка
    if(!$mail->send()) {
        $message = 'Помилка';
    } else {
        $message = 'Данні відправлено!';
    }

    $response = ['message' => $message];

    header('Content-type: application/json');
    echo json_encode($response);
    ?>


