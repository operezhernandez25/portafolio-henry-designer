<?php
  $email;$comment;$captcha;$name;
  $email = filter_input(INPUT_POST, 'email', FILTER_VALIDATE_EMAIL);
  $comment = filter_input(INPUT_POST, 'comment', FILTER_SANITIZE_STRING);
  $name = filter_input(INPUT_POST, 'name', FILTER_SANITIZE_STRING);
  $captcha = filter_input(INPUT_POST, 'token', FILTER_SANITIZE_STRING);
  if(!$captcha){
    echo '<h2>Please check the the captcha form.</h2>';
    exit;
  }
  $secretKey = "6LfH2LwUAAAAAAt74bbdMTIXX4rmjwkVIvRvATeE";
  $ip = $_SERVER['REMOTE_ADDR'];

  // post request to server
  $url = 'https://www.google.com/recaptcha/api/siteverify';
  $data = array('secret' => $secretKey, 'response' => $captcha);

  $options = array(
    'http' => array(
      'header'  => "Content-type: application/x-www-form-urlencoded\r\n",
      'method'  => 'POST',
      'content' => http_build_query($data)
    )
  );
  $context  = stream_context_create($options);
  $response = file_get_contents($url, false, $context);
  $responseKeys = json_decode($response,true);
  header('Content-type: application/json');
  if($responseKeys["success"]) {
    // using SendGrid's PHP Library
    // https://github.com/sendgrid/sendgrid-php
    require './sendgrid-php/vendor/autoload.php';
    $sendgrid = new SendGrid("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");
    $email    = new SendGrid\Email();

    $email->addTo("operezhernandez25@gmail.com")
        ->setFrom("you@youremail.com")
        ->setSubject("Sending with SendGrid is Fun")
        ->setHtml("and easy to do anywhere, even with PHP");

    $sendgrid->send($email);
    echo json_encode(array('success' => 'true'));
  } else {
    echo json_encode(array('success' => 'false'));
  }
?>