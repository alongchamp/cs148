<?php

function sendMail($email, $name) {

  $to = $email;
  $bcc = "";
  $from = "alongcha@uvm.edu";
  $subject = "Thank You For Signing Up!";
  $message1 = "<p>We appreciate your use of our site for your online coupon needs. The following is the information for your account.</p>";
  $message2 = "<p>Username/Email: " . $email . "</p>";
  $message3 = "<p>Name: " . $name . "</p>";
  
  $message = $message1 . $message2 . $message3;

  $header = "MIME-Version: 1.0\r\n"
          . "Content-Type: text/html; charset=UTF-8\r\n"
          . "From: " . $from . "\r\n";

  $ifMailed = mail($to, $subject, $message, $header);

  return $ifMailed;

}

 ?>
