<?php
function ValidateEmail($email)
{
   $pattern = '/^([0-9a-z]([-.\w]*[0-9a-z])*@(([0-9a-z])+([-\w]*[0-9a-z])*\.)+[a-z]{2,6})$/i';
   return preg_match($pattern, $email);
}
if ($_SERVER['REQUEST_METHOD'] == 'POST' && $_POST['formid'] == 'form1')
{
   $mailto = 'andreymail18@gmail.com';
   $mailfrom = isset($_POST['email']) ? $_POST['email'] : $mailto;
   $subject = 'заявка_вакансия';
   $message = 'заявка_вакансия';
   $success_url = './prin.php';
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
<title>Безымянная страница</title>
<meta name="generator" content="WYSIWYG Web Builder 9 - http://www.wysiwygwebbuilder.com">
<link href="Sait0.png" rel="shortcut icon">
<style type="text/css">
div#container
{
   width: 970px;
   position: relative;
   margin: 0 auto 0 auto;
   text-align: left;
}
body
{
   background-color: #FFFFFF;
   color: #000000;
   font-family: Arial;
   font-size: 13px;
   margin: 0;
   text-align: center;
}
</style>
<link href="2.css" rel="stylesheet" type="text/css">
<style type="text/css">
#Image2
{
   border: 0px #000000 solid;
}
#Editbox1
{
   border: 1px #363636 solid;
   background-color: #FFFFFF;
   color :#000000;
   font-family: 'Open Sans';
   font-size: 19px;
   padding: 0px 0px 0px 10px;
   text-align: left;
   vertical-align: middle;
}
#Editbox2
{
   border: 1px #363636 solid;
   background-color: #FFFFFF;
   color :#000000;
   font-family: 'Open Sans';
   font-size: 19px;
   padding: 0px 0px 0px 10px;
   text-align: left;
   vertical-align: middle;
}
#wb_Text12 
{
   background-color: transparent;
   border: 0px #000000 solid;
   padding: 0;
   text-align: center;
}
#wb_Text12 div
{
   text-align: center;
}
#Button2
{
   border: 1px #A9A9A9 solid;
   -moz-border-radius: 3px;
   -webkit-border-radius: 3px;
   border-radius: 3px;
   background-color: #FF8C00;
   color: #000000;
   font-family: Arial;
   font-size: 19px;
}
#Editbox3
{
   border: 1px #363636 solid;
   background-color: #FFFFFF;
   color :#000000;
   font-family: 'Open Sans';
   font-size: 19px;
   padding: 0px 0px 0px 10px;
   text-align: left;
   vertical-align: middle;
}
#wb_Text11 
{
   background-color: transparent;
   border: 0px #000000 solid;
   padding: 0;
   text-align: center;
}
#wb_Text11 div
{
   text-align: center;
}
#wb_Form1
{
   background-color: transparent;
   border: 0px #000000 solid;
}
#Editbox1
{
   position: absolute;
   left: 20px;
   top: 20px;
   width: 267px;
   height: 36px;
   line-height: 36px;
   z-index: 0;
}
#wb_uid1
{
   color: #000000;
   font-family: Open Sans;
   font-size: 16px;
}
#wb_YouTube1
{
   position: absolute;
   left: 17px;
   top: 99px;
   width: 566px;
   height: 366px;
   z-index: 7;
}
#Editbox2
{
   position: absolute;
   left: 20px;
   top: 130px;
   width: 267px;
   height: 36px;
   line-height: 36px;
   z-index: 1;
}
#wb_uid2
{
   color: #363636;
   font-family: Open Sans;
   font-size: 19px;
}
#Shape1
{
   border-width: 0;
   width: 376px;
   height: 445px;
}
#Editbox3
{
   position: absolute;
   left: 20px;
   top: 73px;
   width: 267px;
   height: 36px;
   line-height: 36px;
   z-index: 4;
}
#wb_uid3
{
   color: #363636;
   font-family: Open Sans;
   font-size: 13px;
}
#Shape2
{
   border-width: 0;
   width: 985px;
   height: 579px;
}
#wb_Image2
{
   position: absolute;
   left: 0px;
   top: 0px;
   width: 985px;
   height: 1201px;
   z-index: 5;
}
#Image2
{
   width: 985px;
   height: 1201px;
}
#wb_Text11
{
   position: absolute;
   left: 615px;
   top: 86px;
   width: 348px;
   height: 108px;
   text-align: center;
   z-index: 9;
}
#wb_Text12
{
   position: absolute;
   left: 14px;
   top: 254px;
   width: 292px;
   height: 32px;
   text-align: center;
   z-index: 2;
}
#wb_Form1
{
   position: absolute;
   left: 625px;
   top: 198px;
   width: 318px;
   height: 305px;
   z-index: 10;
}
#Button2
{
   position: absolute;
   left: 22px;
   top: 194px;
   width: 275px;
   height: 40px;
   z-index: 3;
}
#wb_Shape1
{
   position: absolute;
   left: 598px;
   top: 75px;
   width: 376px;
   height: 445px;
   z-index: 8;
}
#wb_Shape2
{
   position: absolute;
   left: 0px;
   top: 1px;
   width: 985px;
   height: 579px;
   z-index: 6;
}
#wb_uid0
{
   color: #363636;
   font-family: Arial;
   font-size: 27px;
}
</style>
<script type="text/javascript" src="swfobject.js"></script>
<script>
$(document).ready(function(){
    setInterval(function(){
        var now = new Date();
	// Months start from 0 !!!! (0 - january.... 8 - september) 
//        var curd = new Date(2014,00,14,00,00,00).getTime();
//        var totalRemains = (curd-now.getTime());
var startdate = new Date(2014,00,14,00,00,00).getTime();
var nowdate = now.getTime();
var period = 36*60*60*1000;
while(startdate < nowdate)
{
  startdate=startdate+period;
}
	var totalRemains = (startdate-nowdate);
        if (totalRemains>1){
            var RemainsSec=(parseInt(totalRemains/1000));
            var RemainsFullDays=(parseInt(RemainsSec/(24*60*60)));
            var secInLastDay=RemainsSec-RemainsFullDays*24*3600;
	    if (RemainsFullDays<10){RemainsFullDays="0"+RemainsFullDays};
            var RemainsFullHours=(parseInt(secInLastDay/3600));
            if (RemainsFullHours<10){RemainsFullHours="0"+RemainsFullHours};
            var secInLastHour=secInLastDay-RemainsFullHours*3600;
            var RemainsMinutes=(parseInt(secInLastHour/60));
            if (RemainsMinutes<10){RemainsMinutes="0"+RemainsMinutes};
            var lastSec=secInLastHour-RemainsMinutes*60;
            if (lastSec<10){lastSec="0"+lastSec};
            //var fullHours = parseInt(RemainsFullHours,10) + RemainsFullDays * 24;
            //$('.timer>.digits').html(fullHours+":"+RemainsMinutes+":"+lastSec);
	    $('.timer>.digits').html(RemainsFullDays+" "+RemainsFullHours+" "+RemainsMinutes+" "+lastSec);
        }
        else {$(".timer").remove();}
    },1000);
});
</script>
</head>
<body <!--="" Yandex.Metrika="" counter="" --="">
<script type="text/javascript">
    (function (d, w, c) {
        (w[c] = w[c] || []).push(function() {
            try {
                w.yaCounter34061520 = new Ya.Metrika({
                    id:34061520,
                    clickmap:true,
                    trackLinks:true,
                    accurateTrackBounce:true,
                    webvisor:true
                });
            } catch(e) { }
        });
        var n = d.getElementsByTagName("script")[0],
            s = d.createElement("script"),
            f = function () { n.parentNode.insertBefore(s, n); };
        s.type = "text/javascript";
        s.async = true;
        s.src = "https://mc.yandex.ru/metrika/watch.js";
        if (w.opera == "[object Opera]") {
            d.addEventListener("DOMContentLoaded", f, false);
        } else { f(); }
    })(document, window, "yandex_metrika_callbacks");
</script>
   <noscript><div><img src="https://mc.yandex.ru/watch/34061520" style="position:absolute; left:-9999px;" alt=""/></div></noscript>
<!-- /Yandex.Metrika counter -->>
<!-- Yandex.Metrika counter -->
<script type="text/javascript">
    (function (d, w, c) {
        (w[c] = w[c] || []).push(function() {
            try {
                w.yaCounter34061520 = new Ya.Metrika({
                    id:34061520,
                    clickmap:true,
                    trackLinks:true,
                    accurateTrackBounce:true,
                    webvisor:true
                });
            } catch(e) { }
        });
        var n = d.getElementsByTagName("script")[0],
            s = d.createElement("script"),
            f = function () { n.parentNode.insertBefore(s, n); };
        s.type = "text/javascript";
        s.async = true;
        s.src = "https://mc.yandex.ru/metrika/watch.js";
        if (w.opera == "[object Opera]") {
            d.addEventListener("DOMContentLoaded", f, false);
        } else { f(); }
    })(document, window, "yandex_metrika_callbacks");
</script>
   <noscript><div><img src="https://mc.yandex.ru/watch/34061520" style="position:absolute; left:-9999px;" alt=""/></div></noscript>
<!-- /Yandex.Metrika counter -->
   <div id="container">
      <div id="wb_Image2">
         <img src="images/Sait39.png" id="Image2" alt="">
      </div>
      <div id="wb_Shape2">
         <img src="images/img0041.png" id="Shape2" alt="">
      </div>
      <div id="wb_YouTube1">
         <iframe width="566" height="366" src="http://www.youtube.com/embed/1IRztletG0o?rel=1&amp;border=1&amp;autoplay=1&amp;modestbranding=1&amp;version=3&amp;autohide=1&amp;theme=light&amp;color=white" frameborder="0"></iframe>
      </div>
      <div id="wb_Shape1">
         <img src="images/img0044.png" id="Shape1" alt="">
      </div>
      <div id="wb_Text11">
         <span id="wb_uid0"><strong>ОСТАВЬТЕ ЗАЯВКУ НА ВАКАНСИЮ</strong></span><span id="wb_uid1"><br></span><span id="wb_uid2">и мы свяжемся с Вами <br>в ближайшее время</span>
      </div>
      <div id="wb_Form1">
         <form name="Form1" method="post" action="<?php echo basename(__FILE__); ?>" enctype="multipart/form-data" accept-charset="UTF-8" target="_top" id="Form1">
            <input type="hidden" name="formid" value="form1">
            <input type="text" id="Editbox1" name="Editbox1" value="" required="" placeholder="&#1042;&#1074;&#1077;&#1076;&#1080;&#1090;&#1077; &#1080;&#1084;&#1103;">
            <input type="text" id="Editbox2" name="Editbox3" value="" required="" placeholder="&#1042;&#1074;&#1077;&#1076;&#1080;&#1090;&#1077; &#1090;&#1077;&#1083;&#1077;&#1092;&#1086;&#1085;">
            <div id="wb_Text12">
               <span id="wb_uid3">*&#1042;&#1072;&#1096;&#1080; &#1082;&#1086;&#1085;&#1090;&#1072;&#1082;&#1090;&#1085;&#1099;&#1077; &#1076;&#1072;&#1085;&#1085;&#1099;&#1077; &#1074; &#1073;&#1077;&#1079;&#1086;&#1087;&#1072;&#1089;&#1085;&#1086;&#1089;&#1090;&#1080;<br>&#1080; &#1085;&#1077; &#1073;&#1091;&#1076;&#1091;&#1090; &#1087;&#1077;&#1088;&#1077;&#1076;&#1072;&#1085;&#1099; &#1090;&#1088;&#1077;&#1090;&#1100;&#1080;&#1084; &#1083;&#1080;&#1094;&#1072;&#1084;</span></div>
            <input type="submit" id="Button2" name="Оставить заявку на вакансию" value="Оставить заявку на вакансию">
            <input type="text" id="Editbox3" name="Editbox2" value="" required="" placeholder="&#1042;&#1074;&#1077;&#1076;&#1080;&#1090;&#1077; &#1074;&#1072;&#1082;&#1072;&#1085;&#1089;&#1080;&#1102;">
         </form>
      </div>
   </div>
<!-- Yandex.Metrika counter -->
<script type="text/javascript">
    (function (d, w, c) {
        (w[c] = w[c] || []).push(function() {
            try {
                w.yaCounter34061520 = new Ya.Metrika({
                    id:34061520,
                    clickmap:true,
                    trackLinks:true,
                    accurateTrackBounce:true,
                    webvisor:true
                });
            } catch(e) { }
        });
        var n = d.getElementsByTagName("script")[0],
            s = d.createElement("script"),
            f = function () { n.parentNode.insertBefore(s, n); };
        s.type = "text/javascript";
        s.async = true;
        s.src = "https://mc.yandex.ru/metrika/watch.js";
        if (w.opera == "[object Opera]") {
            d.addEventListener("DOMContentLoaded", f, false);
        } else { f(); }
    })(document, window, "yandex_metrika_callbacks");
</script>
   <noscript><div><img src="https://mc.yandex.ru/watch/34061520" style="position:absolute; left:-9999px;" alt=""/></div></noscript>
<!-- /Yandex.Metrika counter --></body>
</html>