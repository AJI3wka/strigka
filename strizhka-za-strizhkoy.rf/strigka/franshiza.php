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
   $subject = 'франшиза';
   $message = 'Values submitted from web site form:';
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
<title>Стрижка за Стрижкой</title>
<meta name="generator" content="WYSIWYG Web Builder 9 - http://www.wysiwygwebbuilder.com">
<style type="text/css">
div#container
{
   width: 965px;
   position: relative;
   margin: 0 auto 0 auto;
   text-align: left;
}
body
{
   background-color: #FFFFFF;
   color: #000000;
   font-family: "Open Sans";
   font-size: 16px;
   margin: 0;
   text-align: center;
}
</style>
<link href="2.css" rel="stylesheet" type="text/css">
<style type="text/css">
#Layer1
{
   background-color: transparent;
   background-image: url(images/%21%30%39%4235.png);
   background-repeat: repeat;
   background-position: left top;
   background-size: накрывает;
   -moz-box-shadow: 0px 0px 10px #000000;
   -webkit-box-shadow: 0px 0px 10px #000000;
   box-shadow: 0px 0px 10px #000000;
}
#Editbox1
{
   border: 1px #A9A9A9 solid;
   -moz-border-radius: 5px;
   -webkit-border-radius: 5px;
   border-radius: 5px;
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
   border: 1px #A9A9A9 solid;
   -moz-border-radius: 5px;
   -webkit-border-radius: 5px;
   border-radius: 5px;
   background-color: #FFFFFF;
   color :#000000;
   font-family: 'Open Sans';
   font-size: 19px;
   padding: 0px 0px 0px 10px;
   text-align: left;
   vertical-align: middle;
}
#Button1
{
   border: 1px #F5F5F5 solid;
   -moz-border-radius: 20px;
   -webkit-border-radius: 20px;
   border-radius: 20px;
   background-color: #FFE4C4;
   color: #000000;
   font-family: 'Open Sans';
   font-size: 16px;
}
#Editbox4
{
   border: 1px #A9A9A9 solid;
   -moz-border-radius: 5px;
   -webkit-border-radius: 5px;
   border-radius: 5px;
   background-color: #FFFFFF;
   color :#000000;
   font-family: 'Open Sans';
   font-size: 19px;
   padding: 0px 0px 0px 10px;
   text-align: left;
   vertical-align: middle;
}
#Editbox5
{
   border: 1px #A9A9A9 solid;
   -moz-border-radius: 5px;
   -webkit-border-radius: 5px;
   border-radius: 5px;
   background-color: #FFFFFF;
   color :#000000;
   font-family: 'Open Sans';
   font-size: 19px;
   padding: 0px 0px 0px 10px;
   text-align: left;
   vertical-align: middle;
}
#wb_Text1 
{
   background-color: transparent;
   border: 0px #000000 solid;
   padding: 0;
   text-align: left;
}
#wb_Text1 div
{
   text-align: left;
}
#wb_Form1
{
   background-color: #F4A460;
   border: 1px #F5F5F5 solid;
   -moz-border-radius: 5px;
   -webkit-border-radius: 5px;
   border-radius: 5px;
}
#wb_Shape4 a img
{
   position: absolute;
}
#wb_Shape4 span
{
   position: absolute;
}
#wb_Shape4 a .hover
{
   visibility: hidden;
}
#wb_Shape4 a:hover .hover
{
   visibility: visible;
}
#wb_Shape4 a:hover span
{
   visibility: hidden;
}
#Image1
{
   border: 0px #000000 solid;
}
#wb_uid1
{
   border-width: 0;
   width: 706px;
   height: 105px;
}
#wb_Shape4
{
   position: absolute;
   left: 69px;
   top: 331px;
   width: 706px;
   height: 105px;
   filter: alpha(opacity=90);
   -moz-opacity: 0.90;
   opacity: 0.90;
   z-index: 12;
}
#Editbox1
{
   position: absolute;
   left: 17px;
   top: 21px;
   width: 192px;
   height: 28px;
   line-height: 28px;
   z-index: 1;
}
#Editbox2
{
   position: absolute;
   left: 18px;
   top: 57px;
   width: 192px;
   height: 28px;
   line-height: 28px;
   z-index: 2;
}
#wb_Text1
{
   position: absolute;
   left: 134px;
   top: 811px;
   width: 315px;
   height: 115px;
   z-index: 9;
   text-align: left;
}
#wb_Shape5
{
   position: absolute;
   left: 18px;
   top: 8px;
   width: 939px;
   height: 1009px;
   filter: alpha(opacity=90);
   -moz-opacity: 0.90;
   opacity: 0.90;
   z-index: 6;
}
#Shape2
{
   border-width: 0;
   width: 372px;
   height: 177px;
}
#Editbox4
{
   position: absolute;
   left: 19px;
   top: 125px;
   width: 192px;
   height: 28px;
   line-height: 28px;
   z-index: 4;
}
#Shape3
{
   border-width: 0;
   width: 689px;
   height: 249px;
}
#wb_Image1
{
   position: absolute;
   left: 25%;
   top: 3%;
   width: 48%;
   height: 19%;
   z-index: 0;
}
#Shape4
{
   border-width: 0;
   width: 706px;
   height: 105px;
}
#Editbox5
{
   position: absolute;
   left: 18px;
   top: 91px;
   width: 192px;
   height: 28px;
   line-height: 28px;
   z-index: 5;
}
#Layer1
{
   position: absolute;
   text-align: left;
   left: 21px;
   top: 8px;
   width: 937px;
   height: 1036px;
   z-index: 7;
}
#Shape5
{
   border-width: 0;
   width: 939px;
   height: 1009px;
}
#Image1
{
   width: 100%;
   height: 100%;
}
#wb_Form1
{
   position: absolute;
   left: 625px;
   top: 761px;
   width: 252px;
   height: 216px;
   z-index: 11;
}
#Button1
{
   position: absolute;
   left: 4px;
   top: 163px;
   width: 239px;
   height: 37px;
   z-index: 3;
}
#wb_Shape2
{
   position: absolute;
   left: 103px;
   top: 786px;
   width: 372px;
   height: 177px;
   z-index: 8;
}
#wb_Shape3
{
   position: absolute;
   left: 246px;
   top: 477px;
   width: 689px;
   height: 249px;
   filter: alpha(opacity=90);
   -moz-opacity: 0.90;
   opacity: 0.90;
   z-index: 10;
}
#wb_uid0
{
   color: #2F4F4F;
   font-family: Tahoma;
   font-size: 19px;
}
</style>
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
      <div id="wb_Shape5">
         <img src="images/img0021.png" id="Shape5" alt="">
      </div>
      <div id="Layer1" title="">
         <div id="wb_Image1">
            <img src="images/logo3.png" id="Image1" alt=""></div>
      </div>
      <div id="wb_Shape2">
         <img src="images/img0069.png" id="Shape2" alt="">
      </div>
      <div id="wb_Text1">
         <span id="wb_uid0">Приняли решение?<br>Отлично!<br>Заполните форму и наш менеджер свяжется с вами для уточнения деталей<strong>.</strong></span>
      </div>
      <div id="wb_Shape3">
         <img src="images/img0047.png" id="Shape3" alt="">
      </div>
      <div id="wb_Form1">
         <form name="Form1" method="post" action="<?php echo basename(__FILE__); ?>" enctype="multipart/form-data" accept-charset="UTF-8" target="_top" id="Form1">
            <input type="hidden" name="formid" value="form1">
            <input type="text" id="Editbox1" name="Имя" value="" required="" placeholder="&#1048;&#1084;&#1103;">
            <input type="text" id="Editbox2" name="Телефон" value="" required="" placeholder="&#1058;&#1077;&#1083;&#1077;&#1092;&#1086;&#1085;">
            <input type="submit" id="Button1" name="" value="Запрос на франшизу">
            <input type="text" id="Editbox4" name="Город" value="" required="" placeholder="&#1042;&#1072;&#1096; &#1075;&#1086;&#1088;&#1086;&#1076;">
            <input type="text" id="Editbox5" name="Почта" value="" required="" placeholder="E-mail">
         </form>
      </div>
      <div id="wb_Shape4">
         <a href=""><img class="hover" src="images/img0020_hover.png" alt="" id="wb_uid1"><span><img src="images/img0020.png" id="Shape4" alt=""></span></a>
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