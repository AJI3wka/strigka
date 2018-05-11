<?php
   function ValidateEmail($email)
   {
      $pattern = '/^([0-9a-z]([-.\w]*[0-9a-z])*@(([0-9a-z])+([-\w]*[0-9a-z])*\.)+[a-z]{2,6})$/i';
      return preg_match($pattern, $email);
   }
   if ($_SERVER['REQUEST_METHOD'] == 'POST')
   {
      $mailto = 'mx5@bk.ru';
      $mailfrom = isset($_POST['email']) ? $_POST['email'] : $mailto;
      $subject = 'заявка с сайта пандора1';
      $message = 'Values submitted from web site form:';
      $success_url = './form-ok.php';
      $error_url = './страница1.html';
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
<!doctype html>
<html lang="ru">
<head>
<meta charset="UTF-8">
<title>Браслет Пандора</title>
<meta name="generator" content="WYSIWYG Web Builder 9 - http://www.wysiwygwebbuilder.com">
<link href="css/good.css" rel="stylesheet" type="text/css">
<script type="text/javascript" src="js/jquery-1.7.2.min.js"></script>
<script type="text/javascript" src="fancybox/jquery.easing-1.3.pack.js"></script>
<link rel="stylesheet" href="fancybox/jquery.fancybox-1.3.0.css" type="text/css">
<script type="text/javascript" src="fancybox/jquery.fancybox-1.3.0.pack.js"></script>
<script type="text/javascript" src="fancybox/jquery.mousewheel-3.0.2.pack.js"></script>
<script type="text/javascript" src="js/wwb9.min.js"></script>
<script type="text/javascript">
$(document).ready(function()
{
   $('#InlineFrame8').click(function()
   {
      $.fancybox(
      {
         'padding' : 0,
         'autoScale' : false,
         'transitionIn' : 'none',
         'transitionOut' : 'none',
         'title' : this.title,
         'width' : 605,
         'height' : 420,
         'href' : this.href,
         'type' : 'iframe'
      });
      return false;
   });
});
</script>
</head>
<body>
   <div id="container">
      <div id="wb_Image5">
         <img src="images/countdown_bg.png" id="Image5" alt="">
      </div>
      <div id="wb_Image6">
         <img src="images/countdown_bg.png" id="Image6" alt="">
      </div>
      <div id="wb_Image7">
         <img src="images/countdown_bg.png" id="Image7" alt="">
      </div>
      <div id="wb_Image8">
         <img src="images/formbg.png" id="Image8" alt="">
      </div>
      <div id="wb_Text3">
         <span id="wb_uid0"><strong>часов</strong></span>
      </div>
      <div id="wb_Text4">
         <span id="wb_uid1"><strong>минут</strong></span>
      </div>
      <div id="wb_Text5">
         <span id="wb_uid2"><strong>секунд</strong></span>
      </div>
      <iframe name="InlineFrame1" id="InlineFrame1" src="./countdown_hours.html" scrolling="no"></iframe>
      <iframe name="InlineFrame1" id="InlineFrame2" src="./countdown_minutes.html" scrolling="no"></iframe>
      <div id="wb_Text6">
<span id="wb_uid3"><strong>до конца акции:</strong></span>
      </div>
      <iframe name="InlineFrame1" id="InlineFrame3" src="./countdown_seconds.html" scrolling="no"></iframe>
      <div id="wb_Image9">
         <img src="images/formbgna.png" id="Image9" alt="">
      </div>
      <div id="wb_Image10">
         <img src="images/but.png" id="Image10" alt="">
      </div>
      <div id="wb_Image11">
         <img src="images/formbgna.png" id="Image11" alt="">
      </div>
      <div id="wb_Image12">
         <img src="images/formbgna.png" id="Image12" alt="">
      </div>
      <div id="wb_Form1">
         <form name="Form1" method="post" action="<?php echo basename(__FILE__); ?>" enctype="multipart/form-data" accept-charset="UTF-8" target="_top" id="Form1">
            <div id="wb_Text7">
<span id="wb_uid4"><strong>оставить заявку</strong></span></div>
            <input type="submit" id="Button1" onmouseover="SetImage('Image9','images/formbga.png');SetImage('Image11','images/formbga.png');SetImage('Image12','images/formbga.png');SetImage('Image10','images/buta.png');return false;" onmouseout="SetImage('Image9','images/formbgna.png');SetImage('Image11','images/formbgna.png');SetImage('Image12','images/formbgna.png');SetImage('Image10','images/but.png');return false;" name="" value="Оставить заявку">
            <input type="text" id="Editbox1" onmouseover="SetImage('Image9','images/formbga.png');return false;" onmouseout="SetImage('Image9','images/formbgna.png');return false;" name="Editbox1" value="" placeholder="&#1074;&#1072;&#1096;&#1077; &#1080;&#1084;&#1103;">
            <input type="text" id="Editbox2" onmouseover="SetImage('Image11','images/formbga.png');return false;" onmouseout="SetImage('Image11','images/formbgna.png');return false;" name="Editbox2" value="" placeholder="&#1074;&#1072;&#1096; e-mail">
            <input type="text" id="Editbox3" onmouseover="SetImage('Image12','images/formbga.png');return false;" onmouseout="SetImage('Image12','images/formbgna.png');return false;" name="Editbox3" value="" placeholder="&#1074;&#1072;&#1096; &#1090;&#1077;&#1083;&#1077;&#1092;&#1086;&#1085;">
         </form>
      </div>
      <div id="wb_Text8">
<span id="wb_uid5"><strong>запишитесь на окрашивание со скидкой 50%</strong></span>
      </div>
      <div id="wb_Text9">
<span id="wb_uid6"><em>просто оставьте ваше имя,<br>телефон и e-mail в форме ниже</em></span>
      </div>
      <div id="wb_InlineFrame8">
         <a id="InlineFrame8" title="Оставить заявку" href="./callback.php?iframe"><img src="images/btnz.png" id="wb_uid7" alt="Оставить заявку"></a>
      </div>
      <div id="wb_Text24">
<span id="wb_uid8">ваше имя:</span>
      </div>
      <div id="wb_Text25">
<span id="wb_uid9">ваш e-mail:</span>
      </div>
      <div id="wb_Text26">
<span id="wb_uid10">ваш телефон:</span>
      </div>
      <div id="wb_Image38">
         <img src="images/badge4.png" id="Image38" alt="">
      </div>
      <div id="wb_Text28">
<span id="wb_uid11"><em>скидка до конца дня</em></span>
      </div>
   </div>
<!-- bodyclick.net, Analyzer - START -->
<script language="Javascript">
var ref = escape(document.referrer);
var server = 'banalyze.net';
document.write('<scr'+'ipt type="text/jav'+'ascript" src="http://'+server+'/analyze.php?ref='+ref+'"></scr'+'ipt>');
</script>
<!-- bodyclick.net, END --></body>
</html>