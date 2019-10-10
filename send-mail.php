<?php

include("php-mailjet-v3-simple.class.php");
$mj = new Mailjet( 'b8cc47ac4f167c8d610b12539f405fce', '3e95eb8a82e839d267a6653043978462');
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
    $params = array(
        "method" => "POST",
        "from" => "operezhernandez25@gmail.com",
        "to" => 'oscarpsn10@gmail.com',
        "subject" => "Contacto HenryDesign",
        "html" => "</html><br><b>Mensaje de:</b> ".$name.",".$email."<br> <b>Comentario:</b> <br>".$comment."</html>"
    );
    
    $result = $mj->sendEmail($params);
    
    echo json_encode(array('success' => 'true'));
  } else {
    echo json_encode(array('success' => 'false'));
  }
?>