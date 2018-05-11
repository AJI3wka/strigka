<?php
function ValidateEmail($email)
{
   $pattern = '/^([0-9a-z]([-.\w]*[0-9a-z])*@(([0-9a-z])+([-\w]*[0-9a-z])*\.)+[a-z]{2,6})$/i';
   return preg_match($pattern, $email);
}
if ($_SERVER['REQUEST_METHOD'] == 'POST' && $_POST['formid'] == 'form2')
{
   $mailto = 'andreymail18@gmail.com';
   $mailfrom = isset($_POST['email']) ? $_POST['email'] : $mailto;
   $subject = 'обратный звонок косы';
   $message = 'Values submitted from web site form:';
   $success_url = './form-ok.php';
   $error_url = '';
   $error = '';
   $eol = "\n";
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
   $internalfields = array ("submit", "reset", "send", "filesize", "formid", "captcha_code", "recaptcha_challenge_field", "recaptcha_response_field");
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
<title>Untitled Page</title>
<meta name="generator" content="WYSIWYG Web Builder 10 - http://www.wysiwygwebbuilder.com">
<link href="zakaz.css" rel="stylesheet" type="text/css">
<script type="text/javascript" src="jquery-1.7.2.min.js"></script>
<script type="text/javascript" src="wb.rotate.min.js"></script>
<script type="text/javascript" src="wwb10.min.js"></script>
</head>
<body>
   <a href="http://www.wysiwygwebbuilder.com" target="_blank"><img src="images/builtwithwwb10.png" alt="WYSIWYG Web Builder" id="wb_uid0"></a>
   <div id="wb_Shape10">
      <img src="images/img0014.png" id="Shape10" alt="">
   </div>
   <div id="wb_Text3">
      <span id="wb_uid1">Оставить заявку</span>
   </div>
   <div id="wb_Text24">
<span id="wb_uid2">ваше имя:</span>
   </div>
   <div id="wb_Text25">
<span id="wb_uid3">ваш e-mail:</span>
   </div>
   <div id="wb_Text26">
<span id="wb_uid4">ваш телефон:</span>
   </div>
   <div id="wb_Form2">
      <form name="Form1" method="post" action="<?php echo basename(__FILE__); ?>" enctype="multipart/form-data" accept-charset="UTF-8" target="_top" id="Form2">
         <input type="hidden" name="formid" value="form2">
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
</body>
</html>