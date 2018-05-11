<?php
$recepient = "kirillsvr@mail.ru";
$sitename = "Стрижка за стрижкой";
$pagetitle = "Новая заявка с сайта \"$sitename\"";
$form_hid = trim($_POST["form_hid"]);
$name = trim($_POST["name"]);
$phone = trim($_POST["phone"]);
$email = trim($_POST["email"]);
$message = "Форма: $form_hid\nИмя: $name\nТелефон: $phone\nE-mail: $email";
mail($recepient, $pagetitle, $message, "Content-type: text/plain; charset=\"utf-8\"\n From: $recepient");
?>