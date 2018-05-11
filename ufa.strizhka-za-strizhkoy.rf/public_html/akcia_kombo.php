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
   $subject = 'комбо';
   $message = 'комбо';
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
   margin-bottom: -602px;
   float:left
}
div#container
{
   width: 603px;
   height: 1205px;
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
   white-space: nowrap;
}
#wb_Form1
{
   background-color: #FAFAFA;
   border: 1px #F5F5F5 solid;
   -moz-border-radius: 5px;
   -webkit-border-radius: 5px;
   border-radius: 5px;
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
#Editbox3
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
#Combobox1
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
#Button1
{
   border: 1px #F5F5F5 solid;
   -moz-border-radius: 20px;
   -webkit-border-radius: 20px;
   border-radius: 20px;
   background-color: #FFFF00;
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
#wb_Text2 
{
   background-color: transparent;
   border: 0px #000000 solid;
   padding: 0;
   text-align: left;
}
#wb_Text2 div
{
   text-align: left;
   white-space: nowrap;
}
#Image1
{
   border: 0px #000000 solid;
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
#wb_uid19
{
   color: #000000;
   font-family: Bookman Old Style;
   font-size: 16px;
}
#Editbox1
{
   position: absolute;
   left: 18px;
   top: 21px;
   width: 192px;
   height: 28px;
   line-height: 28px;
   z-index: 0;
}
#wb_uid1
{
   line-height: 33px;
}
#Editbox2
{
   position: absolute;
   left: 18px;
   top: 57px;
   width: 192px;
   height: 28px;
   line-height: 28px;
   z-index: 1;
}
#wb_uid2
{
   color: #000000;
   font-family: Calibri;
   font-size: 15px;
}
#wb_Text1
{
   position: absolute;
   left: 15px;
   top: 204px;
   width: 581px;
   height: 69px;
   z-index: 5;
   text-align: left;
}
#wb_uid3
{
   line-height: 36px;
}
#wb_Text2
{
   position: absolute;
   left: 15px;
   top: 247px;
   width: 581px;
   height: 549px;
   z-index: 8;
   text-align: left;
}
#Editbox3
{
   position: absolute;
   left: 19px;
   top: 92px;
   width: 192px;
   height: 28px;
   line-height: 28px;
   z-index: 2;
}
#wb_Text3
{
   position: absolute;
   left: 16px;
   top: 985px;
   width: 250px;
   height: 28px;
   z-index: 10;
   text-align: left;
}
#wb_Image1
{
   position: absolute;
   left: 15px;
   top: 7px;
   width: 579px;
   height: 178px;
   z-index: 9;
}
#wb_uid4
{
   color: #000000;
   font-family: Bookman Old Style;
   font-size: 16px;
}
#wb_uid5
{
   line-height: 23px;
}
#wb_Text4
{
   position: absolute;
   left: 32px;
   top: 26px;
   width: 263px;
   height: 18px;
   z-index: 7;
   text-align: left;
}
#wb_uid40
{
   color: #A9A9A9;
   font-family: Open Sans;
   font-size: 11px;
}
#wb_uid6
{
   color: #000000;
   font-family: Bookman Old Style;
   font-size: 16px;
}
#wb_uid30
{
   color: #000000;
   font-family: Bookman Old Style;
   font-size: 16px;
}
#wb_uid7
{
   line-height: 36px;
}
#Image1
{
   width: 579px;
   height: 178px;
}
#wb_uid31
{
   line-height: 36px;
}
#wb_uid20
{
   color: #D14D18;
   font-family: Bookman Old Style;
   font-size: 19px;
}
#wb_uid8
{
   color: #000000;
   font-family: Bookman Old Style;
   font-size: 16px;
}
#wb_uid32
{
   color: #000000;
   font-family: Bookman Old Style;
   font-size: 16px;
}
#wb_uid21
{
   line-height: 38px;
}
#wb_uid10
{
   color: #000000;
   font-family: Bookman Old Style;
   font-size: 16px;
}
#wb_uid9
{
   line-height: 36px;
}
#wb_uid33
{
   color: #2D2D2D;
   font-family: Bookman Old Style;
   font-size: 19px;
}
#wb_uid22
{
   color: #000000;
   font-family: Bookman Old Style;
   font-size: 16px;
}
#wb_uid11
{
   line-height: 36px;
}
#wb_uid34
{
   color: #2D2D2D;
   font-family: Bookman Old Style;
   font-size: 19px;
}
#wb_uid23
{
   color: #D14D18;
   font-family: Bookman Old Style;
   font-size: 19px;
}
#wb_uid12
{
   color: #000000;
   font-family: Bookman Old Style;
   font-size: 16px;
}
#wb_uid35
{
   color: #000000;
   font-family: Bookman Old Style;
   font-size: 16px;
}
#wb_uid24
{
   line-height: 38px;
}
#wb_uid13
{
   line-height: 25px;
}
#wb_uid36
{
   color: #000000;
   font-family: Bookman Old Style;
   font-size: 16px;
}
#wb_uid25
{
   color: #000000;
   font-family: Bookman Old Style;
   font-size: 16px;
}
#wb_uid14
{
   color: #000000;
   font-family: Bookman Old Style;
   font-size: 16px;
}
#wb_Form1
{
   position: absolute;
   left: 15px;
   top: 779px;
   width: 252px;
   height: 216px;
   z-index: 6;
}
#wb_uid37
{
   color: #000000;
   font-family: Bookman Old Style;
   font-size: 16px;
}
#wb_uid26
{
   color: #D14D18;
   font-family: Bookman Old Style;
   font-size: 19px;
}
#wb_uid15
{
   color: #2D2D2D;
   font-family: Bookman Old Style;
   font-size: 19px;
}
#Button1
{
   position: absolute;
   left: 4px;
   top: 163px;
   width: 239px;
   height: 37px;
   z-index: 4;
}
#wb_uid38
{
   color: #A9A9A9;
   font-family: Open Sans;
   font-size: 11px;
}
#wb_uid27
{
   line-height: 25px;
}
#wb_uid16
{
   line-height: 38px;
}
#wb_uid39
{
   color: #A9A9A9;
   font-family: Calibri;
   font-size: 11px;
}
#wb_uid28
{
   color: #000000;
   font-family: Bookman Old Style;
   font-size: 16px;
}
#wb_uid17
{
   color: #2D2D2D;
   font-family: Bookman Old Style;
   font-size: 19px;
}
#Combobox1
{
   position: absolute;
   left: 20px;
   top: 129px;
   width: 203px;
   height: 26px;
   z-index: 3;
}
#wb_uid29
{
   color: #D14D18;
   font-family: Bookman Old Style;
   font-size: 19px;
}
#wb_uid18
{
   line-height: 38px;
}
#wb_uid0
{
   color: #2D2D2D;
   font-family: Bookman Old Style;
   font-size: 17px;
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
      <div id="wb_Text1">
         <div><span id="wb_uid0"><strong>КОМБО = СТРИЖКА+ОКРАШЕВАНИЕ+УКЛАДКА+МАТЕРИАЛ</strong></span></div>
         <div id="wb_uid1"><span id="wb_uid2"><br></span></div>
      </div>
      <div id="wb_Form1">
         <form name="Form1" method="post" action="<?php echo basename(__FILE__); ?>" enctype="multipart/form-data" accept-charset="UTF-8" target="_top" id="Form1">
            <input type="hidden" name="formid" value="form1">
            <input type="text" id="Editbox1" name="Имя" value="" required="" placeholder="&#1048;&#1084;&#1103;">
            <input type="text" id="Editbox2" name="Телефон" value="" required="" placeholder="&#1058;&#1077;&#1083;&#1077;&#1092;&#1086;&#1085;">
            <input type="text" id="Editbox3" name="Почта" value="" required="" placeholder="E-mail">
            <select name="Combobox1" size="1" id="Combobox1">
               <option value="Выберите адрес">Выберите адрес</option>
               <option value="Крупской.40">Крупской.40</option>
               <option value="Екатериненская.134">Екатериненская.134</option>
               <option value="Ким.83">Ким.83</option>
               <option value="Революции.8">Революции.8</option>
            </select>
            <input type="submit" id="Button1" name="" value="Получить купон на скидку">
         </form>
      </div>
      <div id="wb_Text4">
&nbsp;
      </div>
      <div id="wb_Text2">
         <div id="wb_uid3"><span id="wb_uid4">1. Потрясающая&nbsp; стрижка&nbsp; любой сложности на Ваш выбор</span></div>
         <div id="wb_uid5"><span id="wb_uid6">2. Безупречная укладка с неограниченным количеством средств для </span></div>
         <div id="wb_uid7"><span id="wb_uid8">профессионального ухода за волосами </span></div>
         <div id="wb_uid9"><span id="wb_uid10">3. Неограниченное количество материалов </span></div>
         <div id="wb_uid11"><span id="wb_uid12">4. Окрашевание любой сложности</span></div>
         <div id="wb_uid13"><span id="wb_uid14"> </span><span id="wb_uid15"><strong>Сколько будет стоить незабываемый образ, если </strong></span></div>
         <div id="wb_uid16"><span id="wb_uid17"><strong>делать КОМБО:</strong></span></div>
         <div id="wb_uid18"><span id="wb_uid19">- для коротких волос - </span><span id="wb_uid20"><strong>799 р.</strong></span></div>
         <div id="wb_uid21"><span id="wb_uid22">- для волос средней длины - </span><span id="wb_uid23"><strong>1299 р.</strong></span></div>
         <div id="wb_uid24"><span id="wb_uid25">- для длинных волос - </span><span id="wb_uid26"><strong>1799 р.</strong></span></div>
         <div id="wb_uid27"><span id="wb_uid28">Выгода акции: </span><span id="wb_uid29"><strong>до 65%</strong></span><span id="wb_uid30">. Стоимость на все типы стрижек и укладок </span></div>
         <div id="wb_uid31"><span id="wb_uid32">фиксированная.</span></div>
         <div><span id="wb_uid33"><strong><br></strong></span></div>
         <div><span id="wb_uid34"><strong>Как воспользоваться?</strong></span></div>
         <div><span id="wb_uid35"><br></span></div>
         <div><span id="wb_uid36">1. Заполните форму</span></div>
         <div><span id="wb_uid37">2. Запишитесь на удобное время, дождавшись звонка администратора</span></div>
      </div>
      <div id="wb_Image1">
         <img src="images/kombo.png" id="Image1" alt="">
      </div>
      <div id="wb_Text3">
         <span id="wb_uid38"><a href="./soglahenie.html">&#1057;&#1086;&#1075;&#1083;&#1072;&#1096;&#1077;&#1085;&#1080;&#1077; на &#1086;&#1073;&#1088;&#1072;&#1073;&#1086;&#1090;&#1082;</a></span><span id="wb_uid39"><a href="./soglahenie.html">у</a></span><span id="wb_uid40"><a href="./soglahenie.html"> &#1087;&#1077;&#1088;&#1089;&#1086;&#1085;&#1072;&#1083;&#1100;&#1085;&#1099;&#1093; &#1076;&#1072;&#1085;&#1085;&#1099;&#1093;</a></span>
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