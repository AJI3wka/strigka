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
   $subject = 'м+п';
   $message = 'м+п';
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
<title>Подробности акции</title>
<meta name="generator" content="WYSIWYG Web Builder 9 - http://www.wysiwygwebbuilder.com">
<style type="text/css">
html, body
{
   height: 100%;
}
div#space
{
   width: 1px;
   height: 50%;
   margin-bottom: -567px;
   float:left
}
div#container
{
   width: 603px;
   height: 1135px;
   margin: 0 auto;
   position: relative;
   clear: left;
}
body
{
   background-color: #FFFFFF;
   color: #000000;
   font-family: "Open Sans";
   font-size: 16px;
   margin: 0;
   padding: 0;
}
</style>
<link href="2.css" rel="stylesheet" type="text/css">
<style type="text/css">
#Image1
{
   border: 0px #000000 solid;
}
#wb_Form2
{
   background-color: #FAFAFA;
   border: 1px #F5F5F5 solid;
   -moz-border-radius: 5px;
   -webkit-border-radius: 5px;
   border-radius: 5px;
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
#Editbox6
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
#Combobox2
{
   border: 1px #A9A9A9 solid;
   -moz-border-radius: 5px;
   -webkit-border-radius: 5px;
   border-radius: 5px;
   background-color: #FFFFFF;
   color: #000000;
   font-family: 'Open Sans';
   font-size: 16px;
}
#Button2
{
   border: 1px #F5F5F5 solid;
   -moz-border-radius: 20px;
   -webkit-border-radius: 20px;
   border-radius: 20px;
   background-color: #DCDCDC;
   color: #000000;
   font-family: 'Open Sans';
   font-size: 16px;
}
#wb_Text4 
{
   background-color: transparent;
   border: 0px #000000 solid;
   padding: 0;
   text-align: left;
}
#wb_Text4 div
{
   text-align: left;
}
#wb_Text3 
{
   background-color: transparent;
   border: 0px #000000 solid;
   padding: 0;
   text-align: left;
}
#wb_Text3 div
{
   text-align: left;
}
#wb_uid1
{
   color: #2D2D2D;
   font-family: Bookman Old Style;
   font-size: 19px;
}
#wb_uid2
{
   color: #000000;
   font-family: Bookman Old Style;
   font-size: 19px;
}
#wb_uid3
{
   color: #000000;
   font-family: Open Sans;
   font-size: 16px;
}
#wb_Text3
{
   position: absolute;
   left: 15px;
   top: 204px;
   width: 587px;
   height: 101px;
   z-index: 8;
   text-align: left;
}
#wb_uid4
{
   color: #000000;
   font-family: Bookman Old Style;
   font-size: 16px;
}
#Editbox4
{
   position: absolute;
   left: 18px;
   top: 21px;
   width: 192px;
   height: 28px;
   line-height: 28px;
   z-index: 0;
}
#wb_Image1
{
   position: absolute;
   left: 15px;
   top: 0px;
   width: 587px;
   height: 176px;
   z-index: 5;
}
#wb_uid5
{
   color: #2D2D2D;
   font-family: Bookman Old Style;
   font-size: 19px;
}
#wb_Text4
{
   position: absolute;
   left: 15px;
   top: 268px;
   width: 587px;
   height: 117px;
   z-index: 7;
   text-align: left;
}
#Editbox5
{
   position: absolute;
   left: 18px;
   top: 57px;
   width: 192px;
   height: 28px;
   line-height: 28px;
   z-index: 1;
}
#wb_uid6
{
   color: #FF8C00;
   font-family: Bookman Old Style;
   font-size: 19px;
}
#Editbox6
{
   position: absolute;
   left: 19px;
   top: 92px;
   width: 192px;
   height: 28px;
   line-height: 28px;
   z-index: 2;
}
#wb_uid7
{
   color: #2D2D2D;
   font-family: Bookman Old Style;
   font-size: 19px;
}
#wb_uid8
{
   color: #000000;
   font-family: Bookman Old Style;
   font-size: 16px;
}
#Image1
{
   width: 587px;
   height: 176px;
}
#wb_uid10
{
   color: #000000;
   font-family: Bookman Old Style;
   font-size: 16px;
}
#wb_uid9
{
   color: #D14D18;
   font-family: Bookman Old Style;
   font-size: 19px;
}
#wb_Form2
{
   position: absolute;
   left: 15px;
   top: 379px;
   width: 252px;
   height: 216px;
   z-index: 6;
}
#Button2
{
   position: absolute;
   left: 4px;
   top: 163px;
   width: 239px;
   height: 37px;
   z-index: 4;
}
#wb_uid0
{
   color: #000000;
   font-family: Times New Roman;
   font-size: 16px;
}
#Combobox2
{
   position: absolute;
   left: 20px;
   top: 129px;
   width: 203px;
   height: 26px;
   z-index: 3;
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
   <div id="space"><br></div>
   <div id="container">
      <div id="wb_Image1">
         <img src="images/banner.jpg" id="Image1" alt="">
      </div>
      <div id="wb_Form2">
         <form name="Form1" method="post" action="<?php echo basename(__FILE__); ?>" enctype="multipart/form-data" accept-charset="UTF-8" target="_top" id="Form2">
            <input type="hidden" name="formid" value="form2">
            <input type="text" id="Editbox4" name="Имя" value="" required="" placeholder="&#1048;&#1084;&#1103;">
            <input type="text" id="Editbox5" name="Телефон" value="" required="" placeholder="&#1058;&#1077;&#1083;&#1077;&#1092;&#1086;&#1085;">
            <input type="text" id="Editbox6" name="Почта" value="" required="" placeholder="E-mail">
            <select name="Combobox1" size="1" id="Combobox2">
               <option value="Выберите адрес">Выберите адрес</option>
               <option value="Крупской.40">Крупской.40</option>
               <option value="Екатериненская.134">Екатериненская.134</option>
               <option value="Ким.83">Ким.83</option>
               <option value="Революции.8">Революции.8</option>
            </select>
            <input type="submit" id="Button2" name="" value="Получить купон на скидку">
         </form>
      </div>
      <div id="wb_Text4">
         <span id="wb_uid0"><br></span><span id="wb_uid1"><strong>К&#1072;&#1082; &#1074;&#1086;&#1089;&#1087;&#1086;&#1083;&#1100;&#1079;&#1086;&#1074;&#1072;&#1090;&#1100;&#1089;&#1103;?</strong></span><span id="wb_uid2"><strong><br></strong></span><span id="wb_uid3"><br></span><span id="wb_uid4">1. &#1047;&#1072;&#1087;&#1086;&#1083;&#1085;&#1080;&#1090;&#1077; &#1092;&#1086;&#1088;&#1084;&#1091;<br>2. &#1047;&#1072;&#1087;&#1080;&#1096;&#1080;&#1090;&#1077;&#1089;&#1100; &#1085;&#1072; &#1091;&#1076;&#1086;&#1073;&#1085;&#1086;&#1077; &#1074;&#1088;&#1077;&#1084;&#1103;, &#1076;&#1086;&#1078;&#1076;&#1072;&#1074;&#1096;&#1080;&#1089;&#1100; &#1079;&#1074;&#1086;&#1085;&#1082;&#1072; &#1072;&#1076;&#1084;&#1080;&#1085;&#1080;&#1089;&#1090;&#1088;&#1072;&#1090;&#1086;&#1088;&#1072;<br></span>
      </div>
      <div id="wb_Text3">
         <span id="wb_uid5"><strong>МАНИКЮР+ПЕДИКЮР ЗА </strong></span><span id="wb_uid6"><strong>1499 рублей</strong></span><span id="wb_uid7"><strong><br></strong></span><span id="wb_uid8">Акция проходит с 15.04 по 15.05 в любом из салонов &quot;Стрижка за стрижкой&quot;</span><span id="wb_uid9"><strong> </strong></span><span id="wb_uid10"><strong><br><br></strong></span>
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