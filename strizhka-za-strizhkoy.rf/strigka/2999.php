<?php
   function ValidateEmail($email)
   {
      $pattern = '/^([0-9a-z]([-.\w]*[0-9a-z])*@(([0-9a-z])+([-\w]*[0-9a-z])*\.)+[a-z]{2,6})$/i';
      return preg_match($pattern, $email);
   }
   if ($_SERVER['REQUEST_METHOD'] == 'POST')
   {
      $mailto = 'andreymail18@gmail.com';
      $mailfrom = isset($_POST['email']) ? $_POST['email'] : $mailto;
      $subject = 'заявка на абон пермь';
      $message = 'Values submitted from web site form:';
      $success_url = './form-ok.php';
      $error_url = '';
      $error = '';
      $eol = "\r\n";
      $max_filesize = isset($_POST['filesize']) ? $_POST['filesize'] * 1024 : 1024000;
      $boundary = md5(uniqid(time()));
      $header  = 'From: '.$mailfrom.$eol;
      $header .= 'Reply-To: '.$mailfrom.$eol;
      $header .= 'MIME-Version: 1.0'.$eol;
      $header .= 'Content-Type: multipart/mixed; boundary="'.$boundary.'"'.$eol;
      $header .= 'X-Mailer: PHP v'.phpversion().$eol;
      if (!ValidateEmail($mailfrom))
      {
         $error .= "The specified email address is invalid!\n<br>";
      }
      if (!empty($error))
      {
         $errorcode = file_get_contents($error_url);
         $replace = "##error##";
         $errorcode = str_replace($replace, $error, $errorcode);
         echo $errorcode;
         exit;
      }
      $internalfields = array ("submit", "reset", "send", "captcha_code");
      $message .= $eol;
      $message .= "IP Address : ";
      $message .= $_SERVER['REMOTE_ADDR'];
      $message .= $eol;
      foreach ($_POST as $key => $value)
      {
         if (!in_array(strtolower($key), $internalfields))
         {
            if (!is_array($value))
            {
               $message .= ucwords(str_replace("_", " ", $key)) . " : " . $value . $eol;
            }
            else
            {
               $message .= ucwords(str_replace("_", " ", $key)) . " : " . implode(",", $value) . $eol;
            }
         }
      }
      $body  = 'This is a multi-part message in MIME format.'.$eol.$eol;
      $body .= '--'.$boundary.$eol;
      $body .= 'Content-Type: text/plain; charset=UTF-8'.$eol;
      $body .= 'Content-Transfer-Encoding: 8bit'.$eol;
      $body .= $eol.stripslashes($message).$eol;
      if (!empty($_FILES))
      {
          foreach ($_FILES as $key => $value)
          {
             if ($_FILES[$key]['error'] == 0 && $_FILES[$key]['size'] <= $max_filesize)
             {
                $body .= '--'.$boundary.$eol;
                $body .= 'Content-Type: '.$_FILES[$key]['type'].'; name='.$_FILES[$key]['name'].$eol;
                $body .= 'Content-Transfer-Encoding: base64'.$eol;
                $body .= 'Content-Disposition: attachment; filename='.$_FILES[$key]['name'].$eol;
                $body .= $eol.chunk_split(base64_encode(file_get_contents($_FILES[$key]['tmp_name']))).$eol;
             }
         }
      }
      $body .= '--'.$boundary.'--'.$eol;
      if ($mailto != '')
      {
         mail($mailto, $subject, $body, $header);
      }
      header('Location: '.$success_url);
      exit;
   }
?>
<!DOCTYPE HTML PUBLIC "-//W3C//DTD HTML 4.01 Transitional//EN" "http://www.w3.org/TR/html4/loose.dtd">
<html>
<head>
<meta http-equiv="Content-Type" content="text/html; charset=UTF-8">
<title>Акция "Абон за 2999"</title>
<meta name="generator" content="WYSIWYG Web Builder 9 - http://www.wysiwygwebbuilder.com">
<link href="nicubunu_Scissors.png" rel="shortcut icon">
<link href="css/2999.css" rel="stylesheet" type="text/css">
<script type="text/javascript" src="js/jquery-1.7.2.min.js"></script>
<script type="text/javascript" src="js/wb.rotate.min.js"></script>
<script type="text/javascript" src="js/wwb9.min.js"></script>
</head>
<body>
   <div id="wb_Shape1">
      <img src="images/img0010.png" id="Shape1" alt="">
   </div>
   <div id="wb_Image7">
      <img src="images/121.png" id="Image7" alt="">
   </div>
   <div id="wb_Text3">
      <span id="wb_uid0">Оставить заявку<br> на абонементы <br></span>
   </div>
   <div id="wb_Text24">
<span id="wb_uid1">ваше имя:</span>
   </div>
   <div id="wb_Text25">
<span id="wb_uid2">ваш e-mail:</span>
   </div>
   <div id="wb_Text26">
<span id="wb_uid3">ваш телефон:</span>
   </div>
   <div id="wb_Form2">
      <form name="Form1" method="post" action="<?php echo basename(__FILE__); ?>" enctype="multipart/form-data" accept-charset="UTF-8" target="_top" id="Form2">
         <div id="wb_Image3">
            <img src="images/filedbg2.png" id="Image3" alt=""></div>
         <div id="wb_Image1">
            <img src="images/filedbg2.png" id="Image1" alt=""></div>
         <div id="wb_Image2">
            <img src="images/filedbg2.png" id="Image2" alt=""></div>
         <input type="text" id="Editbox1" onmouseover="Animate('Shape6', '', '', '', '', '100', 500, '');return false;" onmouseout="Animate('Shape6', '', '', '', '', '70', 500, '');return false;" name="Editbox1" value="" placeholder="&#1074;&#1072;&#1096;&#1077; &#1080;&#1084;&#1103;">
         <input type="text" id="Editbox2" onmouseover="Animate('Shape7', '', '', '', '', '100', 500, '');return false;" onmouseout="Animate('Shape7', '', '', '', '', '70', 500, '');return false;" name="Editbox2" value="" placeholder="&#1074;&#1072;&#1096; e-mail">
         <input type="text" id="Editbox3" onmouseover="Animate('Shape8', '', '', '', '', '100', 500, '');return false;" onmouseout="Animate('Shape8', '', '', '', '', '70', 500, '');return false;" name="Editbox3" value="" placeholder="&#1074;&#1072;&#1096; &#1090;&#1077;&#1083;&#1077;&#1092;&#1086;&#1085;">
         <input type="submit" id="Button1" onmouseover="Animate('Shape6', '', '', '', '', '100', 2500, '');Animate('Shape7', '', '', '', '', '100', 1500, '');Animate('Shape8', '', '', '', '', '100', 500, '');return false;" onmouseout="Animate('Shape6', '', '', '', '', '70', 2500, '');Animate('Shape7', '', '', '', '', '70', 1500, '');Animate('Shape8', '', '', '', '', '70', 500, '');return false;" name="" value="Оставить заявку">
         <div id="wb_Image4">
            <img src="images/icon-person.png" id="Image4" alt=""></div>
         <div id="wb_Image5">
            <img src="images/icon-phone.png" id="Image5" alt=""></div>
         <div id="wb_Image6">
            <img src="images/icon-mail.png" id="Image6" alt=""></div>
      </form>
   </div>
   <div id="wb_Text1">
&nbsp;
   </div>
   <div id="wb_Text4">
      <span id="wb_uid4"><strong>&#1050;&#1072;&#1082; &#1074;&#1086;&#1089;&#1087;&#1086;&#1083;&#1100;&#1079;&#1086;&#1074;&#1072;&#1090;&#1100;&#1089;&#1103; &#1082;&#1091;&#1087;&#1086;&#1085;&#1086;&#1084;?</strong></span><span id="wb_uid5"><br><br></span><span id="wb_uid6">1. &#1047;&#1072;&#1087;&#1086;&#1083;&#1085;&#1080;&#1090;&#1077; &#1092;&#1086;&#1088;&#1084;&#1091;<br>2. &#1055;&#1086;&#1083;&#1091;&#1095;&#1080;&#1090;&#1077; &#1082;&#1086;&#1076; &#1087;&#1086; SMS<br>3. &#1047;&#1072;&#1087;&#1080;&#1096;&#1080;&#1090;&#1077;&#1089;&#1100; &#1085;&#1072; &#1091;&#1076;&#1086;&#1073;&#1085;&#1086;&#1077; &#1074;&#1088;&#1077;&#1084;&#1103;, &#1076;&#1086;&#1078;&#1076;&#1072;&#1074;&#1096;&#1080;&#1089;&#1100; &#1079;&#1074;&#1086;&#1085;&#1082;&#1072; &#1072;&#1076;&#1084;&#1080;&#1085;&#1080;&#1089;&#1090;&#1088;&#1072;&#1090;&#1086;&#1088;&#1072;</span>
   </div>
   <div id="wb_Text5">
      <span id="wb_uid7"><strong>Безлимитный загар в солярии на весь 2015 год! </strong></span>
   </div>
   <div id="wb_Text2">
      <span id="wb_uid8"><strong>Безлимитный абонемент - 2999 руб.<br><br>Безлимитный годовой абонемент.<br><br>Абонемент именной.<br><br>Действует во всех салонах &quot;Стрижка за Стрижкой&quot;.<br><br>Цена: 2999 руб</strong></span><span id="wb_uid9"><strong>. </strong></span>
   </div>
</body>
</html>