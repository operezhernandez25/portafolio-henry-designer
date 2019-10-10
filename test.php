<?php

// using SendGrid's PHP Library
    // https://github.com/sendgrid/sendgrid-php
    require './sendgrid-php/sendgrid-php.php';
    $sendgrid = new SendGrid("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");
    $email    = new SendGrid\Email();

    $email->addTo("operezhernandez25@gmail.com")
        ->setFrom("you@youremail.com")
        ->setSubject("Sending with SendGrid is Fun")
        ->setHtml("and easy to do anywhere, even with PHP");

    $sendgrid->send($email);
?>