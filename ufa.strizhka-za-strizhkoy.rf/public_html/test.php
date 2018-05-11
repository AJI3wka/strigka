<?php
function ValidateEmail($email)
{
   $pattern = '/^([0-9a-z]([-.\w]*[0-9a-z])*@(([0-9a-z])+([-\w]*[0-9a-z])*\.)+[a-z]{2,6})$/i';
   return preg_match($pattern, $email);
}
if ($_SERVER['REQUEST_METHOD'] == 'POST' && $_POST['formid'] == 'form1')
{
   $mailto = 'mx5@bk.ru';
   $mailfrom = isset($_POST['email']) ? $_POST['email'] : $mailto;
   $subject = 'заявка с сайта беговая дорожка';
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
<!doctype html>
<html lang="ru">
<head>
<meta charset="koi8-r">
<title>Заголовок страницы</title>
<meta name="generator" content="WYSIWYG Web Builder 9 - http://www.wysiwygwebbuilder.com">
<link href="test.css" rel="stylesheet">
<script src="jquery-1.7.2.min.js"></script>
<script src="wb.rotate.min.js"></script>
<script src="fancybox/jquery.easing-1.3.pack.js"></script>
<link rel="stylesheet" href="fancybox/jquery.fancybox-1.3.0.css">
<script src="fancybox/jquery.fancybox-1.3.0.pack.js"></script>
<script src="fancybox/jquery.mousewheel-3.0.2.pack.js"></script>
<script src="wwb9.min.js"></script>
<script>
$(document).ready(function()
{
   $('#InlineFrame9').click(function()
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
   $('#InlineFrame16').click(function()
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
   <div id="Layer2" style="position:absolute;text-align:center;left:1px;top:1065px;width:100%;height:191px;z-index:59;" title="">
      <div id="Layer2_Container" style="width:1000px;position:relative;margin-left:auto;margin-right:auto;text-align:left;">
         <div id="wb_Tex3" style="position:absolute;left:84px;top:95px;width:252px;height:73px;z-index:13;text-align:left;">
            <span style="color:#2c2c2c;font-family:'trebuchet ms';font-size:24px;"><strong>3000 причесок</strong></span><span style="color:#000000;font-family:'trebuchet ms';font-size:24px;"><strong><br></strong></span><span style="color:#2f4f4f;font-family:'trebuchet ms';font-size:16px;">и кос для любого случая Вы научитесь делать </span></div>
         <div id="wb_Text31" style="position:absolute;left:401px;top:96px;width:252px;height:51px;z-index:14;text-align:left;">
            <span style="color:#2c2c2c;font-family:'trebuchet ms';font-size:24px;"><strong>более 80 техник </strong></span><span style="color:#000000;font-family:'trebuchet ms';font-size:24px;"><strong><br></strong></span><span style="color:#2f4f4f;font-family:'trebuchet ms';font-size:16px;">Вы освоите за время обучения</span></div>
         <div id="wb_Text32" style="position:absolute;left:742px;top:93px;width:230px;height:73px;z-index:15;text-align:left;">
            <span style="color:#2c2c2c;font-family:'trebuchet ms';font-size:24px;"><strong>1-8 дней</strong></span><span style="color:#000000;font-family:'trebuchet ms';font-size:24px;"><strong><br></strong></span><span style="color:#2f4f4f;font-family:'trebuchet ms';font-size:16px;">Вам потребуется чтобы стать специалистом</span></div>
         <div id="wb_Image23" style="position:absolute;left:672px;top:103px;width:48px;height:48px;z-index:16;">
            <img src="images/i7.png" id="Image23" alt="" style="width:48px;height:48px;"></div>
         <div id="wb_Text1" style="position:absolute;left:84px;top:16px;width:851px;height:39px;z-index:17;text-align:left;">
            <span style="color:#696969;font-family:tahoma;font-size:32px;"><strong>Во время обучения в нашей школе плетения кос</strong></span></div>
         <div id="wb_Image1" style="position:absolute;left:329px;top:103px;width:48px;height:48px;z-index:18;">
            <img src="images/i7.png" id="Image1" alt="" style="width:48px;height:48px;"></div>
         <div id="wb_Image3" style="position:absolute;left:20px;top:103px;width:48px;height:48px;z-index:19;">
            <img src="images/i7.png" id="Image3" alt="" style="width:48px;height:48px;"></div>
      </div>
   </div>
   <div id="Layer4" style="position:absolute;text-align:center;left:0px;top:1873px;width:100%;height:282px;z-index:60;" title="">
      <div id="Layer4_Container" style="width:1000px;position:relative;margin-left:auto;margin-right:auto;text-align:left;">
         <div id="wb_Image32" style="position:absolute;left:31px;top:33px;width:108px;height:119px;z-index:20;">
            <img src="images/cdbg.png" id="Image32" alt="" style="width:108px;height:119px;"></div>
         <div id="wb_Image31" style="position:absolute;left:141px;top:33px;width:108px;height:119px;z-index:21;">
            <img src="images/cdbg.png" id="Image31" alt="" style="width:108px;height:119px;"></div>
         <div id="wb_Image30" style="position:absolute;left:250px;top:33px;width:108px;height:119px;z-index:22;">
            <img src="images/cdbg.png" id="Image30" alt="" style="width:108px;height:119px;"></div>
         <iframe name="InlineFrame1" id="InlineFrame1" style="position:absolute;left:45px;top:43px;width:77px;height:58px;z-index:23;" src="./countdown_hours.html" scrolling="no"></iframe>
         <iframe name="InlineFrame1" id="InlineFrame2" style="position:absolute;left:152px;top:43px;width:85px;height:59px;z-index:24;" src="./countdown_minutes.html" scrolling="no"></iframe>
         <iframe name="InlineFrame1" id="InlineFrame3" style="position:absolute;left:258px;top:45px;width:89px;height:58px;z-index:25;" src="./countdown_seconds.html" scrolling="no"></iframe>
         <div id="wb_Text16" style="position:absolute;left:275px;top:103px;width:60px;height:18px;text-align:center;z-index:26;">
            <span style="color:#1f1f1f;font-family:'trebuchet ms';font-size:13px;"><strong>секунд</strong></span></div>
         <div id="wb_Text17" style="position:absolute;left:164px;top:103px;width:60px;height:18px;text-align:center;z-index:27;">
            <span style="color:#1f1f1f;font-family:'trebuchet ms';font-size:13px;"><strong>минут</strong></span></div>
         <div id="wb_Text20" style="position:absolute;left:54px;top:103px;width:60px;height:18px;text-align:center;z-index:28;">
            <span style="color:#1f1f1f;font-family:'trebuchet ms';font-size:13px;"><strong>часов</strong></span></div>
         <div id="wb_Image49" style="position:absolute;left:304px;top:40px;width:235px;height:165px;z-index:29;">
            <img src="images/badge4.png" id="Image49" alt="" style="width:235px;height:165px;"></div>
         <div id="wb_InlineFrame9" style="position:absolute;left:615px;top:165px;width:265px;height:53px;z-index:30;">
            <a id="InlineFrame9" title="Оставить заявку" href="./zakaz.php?iframe"><img src="images/btnz.png" style="width:265px;height:53px;" alt="Оставить заявку"></a>
         </div>
         <div id="wb_Text21" style="position:absolute;left:352px;top:63px;width:138px;height:81px;text-align:center;z-index:31;">
<span style="color:#ffffff;font-family:'trebuchet ms';font-size:64px;"><strong>-80</strong></span><span style="color:#ffffff;font-family:'trebuchet ms';font-size:35px;"><strong>%</strong></span></div>
         <div id="wb_Text44" style="position:absolute;left:346px;top:140px;width:155px;height:18px;text-align:center;z-index:32;">
<span style="color:#000000;font-family:'trebuchet ms';font-size:13px;"><em>скидка до конца дня</em></span></div>
         <div id="wb_Text15" style="position:absolute;left:532px;top:43px;width:426px;height:111px;text-align:center;z-index:33;">
            <span style="color:#000000;font-family:'trebuchet ms';font-size:29px;">НЕОБХОДИМО РЕШИТЬ ЗАДАЧУ<br>ПО ВЫПОЛНЕНИЮ </span><span style="color:#ffffff;font-family:'trebuchet ms';font-size:29px;">НАШИХ<br>УСЛУГ ИЛИ ТОВАРА?</span></div>
         <div id="wb_Text45" style="position:absolute;left:532px;top:237px;width:426px;height:18px;text-align:center;z-index:34;">
            <span style="color:#000000;font-family:'trebuchet ms';font-size:13px;"><em>или позвоните нам по номеру 8 800 333-22-11</em></span></div>
      </div>
   </div>
   <div id="Layer5" style="position:absolute;text-align:center;left:0px;top:2617px;width:100%;height:67px;z-index:61;" title="">
      <div id="Layer5_Container" style="width:1000px;position:relative;margin-left:auto;margin-right:auto;text-align:left;">
         <div id="wb_Text22" style="position:absolute;left:233px;top:14px;width:534px;height:40px;text-align:center;z-index:35;">
            <span style="color:#000000;font-family:'trebuchet ms';font-size:32px;"><strong>ПРОЦЕСС РАБОТЫ</strong></span></div>
      </div>
   </div>
   <div id="Layer6" style="position:absolute;text-align:center;left:0px;top:3016px;width:100%;height:282px;z-index:62;" title="">
      <div id="Layer6_Container" style="width:1000px;position:relative;margin-left:auto;margin-right:auto;text-align:left;">
         <div id="wb_Image63" style="position:absolute;left:31px;top:33px;width:108px;height:119px;z-index:36;">
            <img src="images/cdbg.png" id="Image63" alt="" style="width:108px;height:119px;"></div>
         <div id="wb_Image64" style="position:absolute;left:141px;top:33px;width:108px;height:119px;z-index:37;">
            <img src="images/cdbg.png" id="Image64" alt="" style="width:108px;height:119px;"></div>
         <div id="wb_Image65" style="position:absolute;left:250px;top:33px;width:108px;height:119px;z-index:38;">
            <img src="images/cdbg.png" id="Image65" alt="" style="width:108px;height:119px;"></div>
         <iframe name="InlineFrame1" id="InlineFrame8" style="position:absolute;left:45px;top:43px;width:77px;height:58px;z-index:39;" src="./countdown_hours.html" scrolling="no"></iframe>
         <iframe name="InlineFrame1" id="InlineFrame14" style="position:absolute;left:152px;top:43px;width:85px;height:59px;z-index:40;" src="./countdown_minutes.html" scrolling="no"></iframe>
         <iframe name="InlineFrame1" id="InlineFrame15" style="position:absolute;left:258px;top:45px;width:89px;height:58px;z-index:41;" src="./countdown_seconds.html" scrolling="no"></iframe>
         <div id="wb_Text53" style="position:absolute;left:275px;top:103px;width:60px;height:18px;text-align:center;z-index:42;">
            <span style="color:#1f1f1f;font-family:'trebuchet ms';font-size:13px;"><strong>секунд</strong></span></div>
         <div id="wb_Text54" style="position:absolute;left:164px;top:103px;width:60px;height:18px;text-align:center;z-index:43;">
            <span style="color:#1f1f1f;font-family:'trebuchet ms';font-size:13px;"><strong>минут</strong></span></div>
         <div id="wb_Text55" style="position:absolute;left:54px;top:103px;width:60px;height:18px;text-align:center;z-index:44;">
            <span style="color:#1f1f1f;font-family:'trebuchet ms';font-size:13px;"><strong>часов</strong></span></div>
         <div id="wb_Image66" style="position:absolute;left:304px;top:40px;width:235px;height:165px;z-index:45;">
            <img src="images/badge4.png" id="Image66" alt="" style="width:235px;height:165px;"></div>
         <div id="wb_InlineFrame16" style="position:absolute;left:615px;top:165px;width:265px;height:53px;z-index:46;">
            <a id="InlineFrame16" title="Оставить заявку" href="./zakaz.php?iframe"><img src="images/btnz.png" style="width:265px;height:53px;" alt="Оставить заявку"></a>
         </div>
         <div id="wb_Text56" style="position:absolute;left:352px;top:63px;width:138px;height:81px;text-align:center;z-index:47;">
<span style="color:#ffffff;font-family:'trebuchet ms';font-size:64px;"><strong>-80</strong></span><span style="color:#ffffff;font-family:'trebuchet ms';font-size:35px;"><strong>%</strong></span></div>
         <div id="wb_Text57" style="position:absolute;left:346px;top:140px;width:155px;height:18px;text-align:center;z-index:48;">
<span style="color:#000000;font-family:'trebuchet ms';font-size:13px;"><em>скидка до конца дня</em></span></div>
         <div id="wb_Text58" style="position:absolute;left:532px;top:43px;width:426px;height:111px;text-align:center;z-index:49;">
            <span style="color:#000000;font-family:'trebuchet ms';font-size:29px;">НЕОБХОДИМО РЕШИТЬ ЗАДАЧУ<br>ПО ВЫПОЛНЕНИЮ </span><span style="color:#ffffff;font-family:'trebuchet ms';font-size:29px;">НАШИХ<br>УСЛУГ ИЛИ ТОВАРА?</span></div>
         <div id="wb_Text59" style="position:absolute;left:532px;top:237px;width:426px;height:18px;text-align:center;z-index:50;">
            <span style="color:#000000;font-family:'trebuchet ms';font-size:13px;"><em>или позвоните нам по номеру 8 800 333-22-11</em></span></div>
      </div>
   </div>
   <div id="Layer7" style="position:absolute;text-align:center;left:0px;top:3592px;width:100%;height:159px;z-index:63;" title="">
      <div id="Layer7_Container" style="width:1000px;position:relative;margin-left:auto;margin-right:auto;text-align:left;">
         <div id="wb_Image67" style="position:absolute;left:37px;top:88px;width:350px;height:1px;z-index:51;">
            <img src="images/line.jpg" id="Image67" alt="" style="width:350px;height:1px;"></div>
         <div id="wb_soc5" style="position:absolute;left:891px;top:61px;width:32px;height:32px;z-index:52;">
            <a href="#" onmouseover="Animate('wb_soc2', '', '', '', '', '40', 500, '');Animate('wb_soc3', '', '', '', '', '40', 500, '');Animate('wb_soc4', '', '', '', '', '40', 500, '');Animate('wb_soc1', '', '', '', '', '40', 500, '');Animate('soc6', '', '', '', '', '40', 500, '');return false;" onmouseout="Animate('wb_soc2', '', '', '', '', '100', 500, '');Animate('wb_soc3', '', '', '', '', '100', 500, '');Animate('wb_soc4', '', '', '', '', '100', 500, '');Animate('wb_soc1', '', '', '', '', '100', 500, '');Animate('soc6', '', '', '', '', '100', 500, '');return false;"><img src="images/soc5.png" id="soc5" alt="" style="width:32px;height:32px;"></a></div>
         <div id="wb_soc4" style="position:absolute;left:851px;top:61px;width:32px;height:32px;z-index:53;">
            <a href="http://twitter.com" onmouseover="Animate('wb_soc2', '', '', '', '', '40', 500, '');Animate('wb_soc3', '', '', '', '', '40', 500, '');Animate('wb_soc1', '', '', '', '', '40', 500, '');Animate('wb_soc5', '', '', '', '', '40', 500, '');Animate('soc6', '', '', '', '', '40', 500, '');return false;" onmouseout="Animate('wb_soc2', '', '', '', '', '100', 500, '');Animate('wb_soc3', '', '', '', '', '100', 500, '');Animate('wb_soc1', '', '', '', '', '100', 500, '');Animate('wb_soc5', '', '', '', '', '100', 500, '');Animate('soc6', '', '', '', '', '100', 500, '');return false;"><img src="images/soc4.png" id="soc4" alt="" style="width:32px;height:32px;"></a></div>
         <div id="wb_soc3" style="position:absolute;left:813px;top:61px;width:32px;height:32px;z-index:54;">
            <a href="http://google.com" onmouseover="Animate('wb_soc2', '', '', '', '', '40', 500, '');Animate('wb_soc1', '', '', '', '', '40', 500, '');Animate('wb_soc4', '', '', '', '', '40', 500, '');Animate('wb_soc5', '', '', '', '', '40', 500, '');Animate('soc6', '', '', '', '', '40', 500, '');return false;" onmouseout="Animate('wb_soc2', '', '', '', '', '100', 500, '');Animate('wb_soc1', '', '', '', '', '100', 500, '');Animate('wb_soc4', '', '', '', '', '100', 500, '');Animate('wb_soc5', '', '', '', '', '100', 500, '');Animate('soc6', '', '', '', '', '100', 500, '');return false;"><img src="images/soc3.png" id="soc3" alt="" style="width:32px;height:32px;"></a></div>
         <div id="wb_soc2" style="position:absolute;left:774px;top:61px;width:32px;height:32px;z-index:55;">
            <a href="http://facebook.com" onmouseover="Animate('wb_soc1', '', '', '', '', '40', 500, '');Animate('wb_soc3', '', '', '', '', '40', 500, '');Animate('wb_soc4', '', '', '', '', '40', 500, '');Animate('wb_soc5', '', '', '', '', '40', 500, '');Animate('soc6', '', '', '', '', '40', 500, '');return false;" onmouseout="Animate('wb_soc1', '', '', '', '', '100', 500, '');Animate('wb_soc3', '', '', '', '', '100', 500, '');Animate('wb_soc4', '', '', '', '', '100', 500, '');Animate('wb_soc5', '', '', '', '', '100', 500, '');Animate('soc6', '', '', '', '', '100', 500, '');return false;"><img src="images/soc2.png" id="soc2" alt="" style="width:32px;height:32px;"></a></div>
         <div id="wb_soc1" style="position:absolute;left:734px;top:61px;width:32px;height:32px;z-index:56;">
            <a href="http://vk.com" onmouseover="Animate('wb_soc2', '', '', '', '', '40', 500, '');Animate('wb_soc3', '', '', '', '', '40', 500, '');Animate('wb_soc4', '', '', '', '', '40', 500, '');Animate('wb_soc5', '', '', '', '', '40', 500, '');Animate('soc6', '', '', '', '', '40', 500, '');return false;" onmouseout="Animate('wb_soc2', '', '', '', '', '100', 500, '');Animate('wb_soc3', '', '', '', '', '100', 500, '');Animate('wb_soc4', '', '', '', '', '100', 500, '');Animate('wb_soc5', '', '', '', '', '100', 500, '');Animate('soc6', '', '', '', '', '100', 500, '');return false;"><img src="images/soc1.png" id="soc1" alt="" style="width:32px;height:32px;"></a></div>
         <div id="wb_Text63" style="position:absolute;left:36px;top:20px;width:315px;height:54px;text-align:right;z-index:57;">
            <span style="color:#c0c0c0;font-family:'trebuchet ms';font-size:29px;">8 (495)</span><span style="color:#000000;font-family:'trebuchet ms';font-size:21px;"> </span><span style="color:#ffffff;font-family:'trebuchet ms';font-size:43px;"><strong>226-74-30</strong></span></div>
         <div id="wb_Text64" style="position:absolute;left:47px;top:93px;width:315px;height:44px;z-index:58;text-align:left;">
            <span style="color:#c0c0c0;font-family:'trebuchet ms';font-size:16px;"><strong>info@mail.ru<br>адрес вашей компании</strong></span></div>
      </div>
   </div>
   <div id="Layer8" style="position:absolute;text-align:center;left:0px;top:78px;width:100%;height:29px;z-index:64;" title="">
      <div id="Layer8_Container" style="width:1000px;position:relative;margin-left:auto;margin-right:auto;text-align:left;">
      </div>
   </div>
   <div id="container">
      <div id="wb_Shape3">
         <img src="images/img0001.png" id="Shape3" alt="">
      </div>
      <div id="wb_Image2">
         <img src="images/logo.png" id="Image2" alt="">
      </div>
      <div id="wb_Text8">
         <span id="wb_uid0"><strong>получите VIP подарок</strong></span>
      </div>
      <div id="wb_Text9">
         <span id="wb_uid1"><em>просто оставьте ваше имя,<br>телефон и e-mail в форме ниже</em></span>
      </div>
      <div id="wb_Form1">
         <form name="Form1" method="post" action="<?php echo basename(__FILE__); ?>" enctype="multipart/form-data" accept-charset="UTF-8" target="_top" id="Form1">
            <input type="hidden" name="formid" value="form1">
            <div id="wb_Image11">
               <img src="images/formbgna2.png" id="Image11" alt=""></div>
            <div id="wb_Image12">
               <img src="images/formbgna2.png" id="Image12" alt=""></div>
            <div id="wb_Image9">
               <img src="images/formbgna2.png" id="Image9" alt=""></div>
            <div id="wb_Text25">
               <span id="wb_uid2">ваш e-mail:</span></div>
            <input type="text" id="Editbox1" onmouseover="SetImage('Image9','images/formbga2.png');return false;" onmouseout="SetImage('Image9','images/formbgna2.png');return false;" name="Editbox1" value="" placeholder="&#1074;&#1072;&#1096;&#1077; &#1080;&#1084;&#1103;">
            <input type="text" id="Editbox2" onmouseover="SetImage('Image11','images/formbga2.png');return false;" onmouseout="SetImage('Image11','images/formbgna2.png');return false;" name="Editbox2" value="" placeholder="&#1074;&#1072;&#1096; e-mail">
            <input type="text" id="Editbox3" onmouseover="SetImage('Image12','images/formbga2.png');return false;" onmouseout="SetImage('Image12','images/formbgna2.png');return false;" name="Editbox3" value="" placeholder="&#1074;&#1072;&#1096; &#1090;&#1077;&#1083;&#1077;&#1092;&#1086;&#1085;">
            <div id="wb_Text24">
               <span id="wb_uid3">ваше имя:</span></div>
            <div id="wb_Text26">
               <span id="wb_uid4">ваш телефон:</span></div>
            <div id="wb_Image10">
               <img src="images/but.png" id="Image10" alt=""></div>
            <div id="wb_Text7">
<span id="wb_uid5"><strong>оставить заявку</strong></span></div>
            <input type="submit" id="Button1" onmouseover="SetImage('Image9','images/formbga2.png');SetImage('Image11','images/formbga2.png');SetImage('Image12','images/formbga2.png');SetImage('Image10','images/buta.png');return false;" onmouseout="SetImage('Image9','images/formbgna2.png');SetImage('Image11','images/formbgna2.png');SetImage('Image12','images/formbgna2.png');SetImage('Image10','images/but.png');return false;" name="" value="Оставить заявку">
         </form>
      </div>
      <div id="wb_Image18">
         <img src="images/i5.png" id="Image18" alt="">
      </div>
      <div id="wb_Text33">
         <span id="wb_uid6"><strong>ПОЧЕМУ 95% КЛИЕНТОВ<br></strong></span>
      </div>
      <div id="wb_Text2">
         <span id="wb_uid7"><strong>ПРИНИМАЮТ РЕШЕНИЕ РАБОТАТЬ С НАМИ:</strong></span>
      </div>
      <div id="wb_Text11">
         <span id="wb_uid8">Удобное время обучения<br></span><span id="wb_uid9">у нас есть дневное, вечернее и выходное время обучения</span>
      </div>
      <div id="wb_Text12">
         <span id="wb_uid10">Гарантия 3 года<br></span><span id="wb_uid11">Описание вашего приемущества (несколько предложений)</span>
      </div>
      <div id="wb_Text13">
         <span id="wb_uid12">Доступная цена<br></span><span id="wb_uid13">Можно подобрать для себя курс по оптимальной стоимости </span>
      </div>
      <div id="wb_Text34">
         <span id="wb_uid14">Производство под заказ<br></span><span id="wb_uid15">Описание вашего приемущества (несколько предложений)</span>
      </div>
      <div id="wb_Text35">
         <span id="wb_uid16">Огромный ассортимент<br></span><span id="wb_uid17">Описание вашего приемущества (несколько предложений)</span>
      </div>
      <div id="wb_Text36">
         <span id="wb_uid18">Квалифицированные преподаватели<br></span><span id="wb_uid19">У нас работают преподаватели высшей категории, научим&nbsp; даже мужчин!)</span>
      </div>
      <div id="wb_Image17">
         <img src="images/sm1.png" id="Image17" alt="">
      </div>
      <div id="wb_Image19">
         <img src="images/sm2.png" id="Image19" alt="">
      </div>
      <div id="wb_Image22">
         <img src="images/sm3.png" id="Image22" alt="">
      </div>
      <div id="wb_Image24">
         <img src="images/sm4.png" id="Image24" alt="">
      </div>
      <div id="wb_Image25">
         <img src="images/sm5.png" id="Image25" alt="">
      </div>
      <div id="wb_Image26">
         <img src="images/sm6.png" id="Image26" alt="">
      </div>
      <div id="wb_Image53">
         <img src="images/p1.png" id="Image53" alt="">
      </div>
      <div id="wb_Text23">
         <span id="wb_uid20"><strong>НАЧАЛО<br>РАБОТЫ<br></strong></span><span id="wb_uid21">несолько слов описания</span>
      </div>
      <div id="wb_Text39">
         <span id="wb_uid22"><strong>ПРОДОЛЖЕНИЕ РАБОТЫ<br></strong></span><span id="wb_uid23">несолько слов описания</span>
      </div>
      <div id="wb_Text51">
         <span id="wb_uid24"><strong>ПРОДОЛЖЕНИЕ РАБОТЫ<br></strong></span><span id="wb_uid25">несолько слов описания<br></span>
      </div>
      <div id="wb_Text52">
         <span id="wb_uid26"><strong>ОКОНЧАНИЕ<br>РАБОТЫ<br></strong></span><span id="wb_uid27">несолько слов описания</span>
      </div>
      <div id="wb_Image55">
         <img src="images/p3.png" id="Image55" alt="">
      </div>
      <div id="wb_Image56">
         <img src="images/p2.png" id="Image56" alt="">
      </div>
      <div id="wb_Image33">
         <img src="images/p2.png" id="Image33" alt="">
      </div>
      <div id="wb_Image54">
         <img src="images/arrow.png" id="Image54" alt="">
      </div>
      <div id="wb_Image57">
         <img src="images/arrow.png" id="Image57" alt="">
      </div>
      <div id="wb_Image58">
         <img src="images/arrow.png" id="Image58" alt="">
      </div>
      <div id="wb_Image59">
         <img src="images/pro1.png" id="Image59" alt="">
      </div>
      <div id="wb_Image60">
         <img src="images/pro2.png" id="Image60" alt="">
      </div>
      <div id="wb_Image61">
         <img src="images/pro3.png" id="Image61" alt="">
      </div>
      <div id="wb_Image62">
         <img src="images/pro4.png" id="Image62" alt="">
      </div>
      <div id="wb_Text60">
         <span id="wb_uid28"><strong>ФИНАЛЬНАЯ<br>ФРАЗА</strong></span>
      </div>
      <div id="wb_Text61">
         <span id="wb_uid29">Фраза, которая подведет итог всего содержания сайта и вашего продукта</span>
      </div>
      <div id="wb_Shape2">
         <img src="images/img0009.gif" id="Shape2" alt="">
      </div>
      <div id="wb_Text3">
         <span id="wb_uid30">Плетение кос - это модная тенденция, которая актуална как для парикмахеров,<br>стремящихся расширить перечень своих услуг в салоне красоты,так и для девушек и женщин, желающих выглядеть стильно и подчеркнуть свою индивидуальность.<br>Молодые мамы, следуя модному направлению,<br>предпочитают самостоятельно заплетать косы ребенку и хотят это делать красиво.<br><br>Мы приглашаем всех желающих посетить наши курсы, на которых Вы сможете быстро научиться плести косы и создавать стильные прически без каких-либо начальных навыков.<br><br></span>
      </div>
   </div>
   <div id="Layer1" style="position:absolute;text-align:center;left:0%;top:146px;width:99%;height:586px;z-index:105;" title="">
      <div id="Layer1_Container" style="width:998px;position:relative;margin-left:auto;margin-right:auto;text-align:left;">
         <div id="wb_Shape1" style="position:absolute;left:33px;top:30px;width:926px;height:111px;filter:alpha(opacity=60);-moz-opacity:0.60;opacity:0.60;z-index:0;">
            <img src="images/img0002.png" id="Shape1" alt="" style="border-width:0;width:926px;height:111px;"></div>
      </div>
   </div>
</body>
</html>