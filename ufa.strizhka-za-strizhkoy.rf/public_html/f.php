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
<link href="1.css" rel="stylesheet" type="text/css">
<style type="text/css">
#Layer1
{
   background-color: transparent;
   background-image: url(images/footer.jpg);
   background-repeat: no-repeat;
   background-position: center top;
}
#Image3
{
   border: 0px #000000 solid;
}
#wb_Text5 
{
   background-color: transparent;
   border: 0px #000000 solid;
   padding: 0;
   text-align: center;
}
#wb_Text5 div
{
   text-align: center;
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
#Image2
{
   border: 0px #000000 solid;
}
#Image1
{
   border: 0px #000000 solid;
}
#Image4
{
   border: 0px #000000 solid;
}
#Image5
{
   border: 0px #000000 solid;
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
#Button1
{
   border: 1px #F5F5F5 solid;
   -moz-border-radius: 20px;
   -webkit-border-radius: 20px;
   border-radius: 20px;
   background-color: #EE7711;
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
#Editbox1
{
   position: absolute;
   left: 18px;
   top: 21px;
   width: 192px;
   height: 28px;
   line-height: 28px;
   z-index: 8;
}
#wb_Text1
{
   position: absolute;
   left: 272px;
   top: 612px;
   width: 269px;
   height: 150px;
   z-index: 15;
   text-align: left;
}
#Editbox2
{
   position: absolute;
   left: 18px;
   top: 57px;
   width: 192px;
   height: 28px;
   line-height: 28px;
   z-index: 9;
}
#Shape2
{
   border-width: 0;
   width: 372px;
   height: 243px;
}
#Editbox4
{
   position: absolute;
   left: 19px;
   top: 125px;
   width: 192px;
   height: 28px;
   line-height: 28px;
   z-index: 11;
}
#Editbox5
{
   position: absolute;
   left: 659px;
   top: 678px;
   width: 192px;
   height: 28px;
   line-height: 28px;
   z-index: 14;
}
#wb_Form1
{
   position: absolute;
   left: 639px;
   top: 585px;
   width: 252px;
   height: 216px;
   z-index: 13;
}
#Button1
{
   position: absolute;
   left: 4px;
   top: 163px;
   width: 239px;
   height: 37px;
   z-index: 10;
}
#wb_Shape2
{
   position: absolute;
   left: 234px;
   top: 567px;
   width: 372px;
   height: 243px;
   z-index: 12;
}
#wb_uid0
{
   color: #2F4F4F;
   font-family: Verdana;
   font-size: 21px;
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
<body>
   <div id="container">
      <div id="wb_Shape2">
         <img src="images/img0069.png" id="Shape2" alt="">
      </div>
      <div id="wb_Form1">
         <form name="Form1" method="post" action="<?php echo basename(__FILE__); ?>" enctype="multipart/form-data" accept-charset="UTF-8" target="_top" id="Form1">
            <input type="hidden" name="formid" value="form1">
            <input type="text" id="Editbox1" name="Имя" value="" required="" placeholder="&#1048;&#1084;&#1103;">
            <input type="text" id="Editbox2" name="Телефон" value="" required="" placeholder="&#1058;&#1077;&#1083;&#1077;&#1092;&#1086;&#1085;">
            <input type="submit" id="Button1" name="" value="Запрос на франшизу">
            <input type="text" id="Editbox4" name="Город" value="" required="" placeholder="&#1042;&#1072;&#1096; &#1075;&#1086;&#1088;&#1086;&#1076;">
         </form>
      </div>
      <input type="text" id="Editbox5" name="Почта" value="" required="" placeholder="E-mail">
      <div id="wb_Text1">
         <span id="wb_uid0"><strong>Приняли решение?<br>Отлично!<br>Заполните форму и наш менеджер свяжется с вами для уточнения деталей.</strong></span>
      </div>
   </div>
   <div id="Layer1" style="position:absolute;text-align:center;left:0%;top:0%;width:100%;height:597px;z-index:16;" title="">
      <div id="Layer1_Container" style="width:967px;position:relative;margin-left:auto;margin-right:auto;text-align:left;">
         <div id="wb_Shape1" style="position:absolute;left:156px;top:100px;width:572px;height:82px;z-index:0;">
            <img src="images/img0068.png" id="Shape1" alt="" style="border-width:0;width:572px;height:82px;"></div>
         <div id="wb_Text5" style="position:absolute;left:159px;top:123px;width:555px;height:32px;text-align:center;z-index:1;">
            <span style="color:#363636;font-family:'open sans';font-size:27px;">&#8226; СЕТЬ САЛОНОВ-ПАРИКМАХЕРСКИХ &#8226;</span></div>
         <div id="wb_Image3" style="position:absolute;left:15px;top:19px;width:212px;height:44px;z-index:2;">
            <img src="images/strizhka11.png" id="Image3" alt="" style="width:212px;height:44px;"></div>
         <div id="wb_Image2" style="position:absolute;left:170px;top:340px;width:50px;height:50px;z-index:3;">
            <img src="images/2_3.png" id="Image2" alt="" style="width:50px;height:50px;"></div>
         <div id="wb_Image4" style="position:absolute;left:170px;top:431px;width:50px;height:50px;z-index:4;">
            <img src="images/2_3.png" id="Image4" alt="" style="width:50px;height:50px;"></div>
         <div id="wb_Image5" style="position:absolute;left:170px;top:385px;width:50px;height:50px;z-index:5;">
            <img src="images/2_3.png" id="Image5" alt="" style="width:50px;height:50px;"></div>
         <div id="wb_Image1" style="position:absolute;left:170px;top:295px;width:50px;height:50px;z-index:6;">
            <img src="images/2_3.png" id="Image1" alt="" style="width:50px;height:50px;"></div>
         <div id="wb_Text4" style="position:absolute;left:60px;top:199px;width:882px;height:360px;z-index:7;text-align:left;">
            <span style="color:#000000;font-family:'open sans';font-size:21px;">Хотите открыть салон- парикмахерскую &quot;Стрижка за Стрижкой&quot; в своем городе? Нет ничего проще. Наши салоны- парикмахерские одинаково успешно работают как в городе с населением до 100 тыс. так и в городе-миллионике!<br>&nbsp;&nbsp; &nbsp;&nbsp; &nbsp;&nbsp; &nbsp;&nbsp; &nbsp;&nbsp; &nbsp;&nbsp; &nbsp;&nbsp; &nbsp;&nbsp; &nbsp;&nbsp; &nbsp;&nbsp; &nbsp;&nbsp; &nbsp;&nbsp; &nbsp;&nbsp; &nbsp;&nbsp; &nbsp;&nbsp; &nbsp;&nbsp; Окажем полноценную поддержку:<br>&nbsp;&nbsp; &nbsp;&nbsp; &nbsp;&nbsp; &nbsp;&nbsp; &nbsp;&nbsp; &nbsp;&nbsp; &nbsp;&nbsp; &nbsp;&nbsp; &nbsp;&nbsp; &nbsp;&nbsp;&nbsp;&nbsp; Выберем&nbsp; помещение для успешной деятельности<br>&nbsp;&nbsp; &nbsp;&nbsp; &nbsp;&nbsp; &nbsp;&nbsp; &nbsp;&nbsp; &nbsp;&nbsp; &nbsp;&nbsp; &nbsp;&nbsp; &nbsp;&nbsp; &nbsp;&nbsp;&nbsp;&nbsp; при необходимости приедем на место.&nbsp;&nbsp; &nbsp;&nbsp; &nbsp;&nbsp; &nbsp;&nbsp; &nbsp;&nbsp; &nbsp;&nbsp; &nbsp;&nbsp; &nbsp;&nbsp; &nbsp;&nbsp; &nbsp;&nbsp;&nbsp;&nbsp; <br>&nbsp;&nbsp; &nbsp;&nbsp; &nbsp;&nbsp; &nbsp;&nbsp; &nbsp;&nbsp; &nbsp;&nbsp; &nbsp;&nbsp; &nbsp;&nbsp; &nbsp;&nbsp; &nbsp;&nbsp;&nbsp;&nbsp; Закупим все необходимое оборудование и материалы.<br>&nbsp;&nbsp; &nbsp;&nbsp; &nbsp;&nbsp; &nbsp;&nbsp; &nbsp;&nbsp; &nbsp;&nbsp; &nbsp;&nbsp; &nbsp;&nbsp; &nbsp;&nbsp; &nbsp;&nbsp;&nbsp;&nbsp; <br>&nbsp;&nbsp; &nbsp;&nbsp; &nbsp;&nbsp; &nbsp;&nbsp; &nbsp;&nbsp; &nbsp;&nbsp; &nbsp;&nbsp; &nbsp;&nbsp; &nbsp;&nbsp; &nbsp;&nbsp;&nbsp;&nbsp; Наймем персонал и обучим его. <br><br>&nbsp;&nbsp; &nbsp;&nbsp; &nbsp;&nbsp; &nbsp;&nbsp; &nbsp;&nbsp; &nbsp;&nbsp; &nbsp;&nbsp; &nbsp;&nbsp; &nbsp;&nbsp; &nbsp;&nbsp;&nbsp;&nbsp; Привлечем Вам клиентов и сделаем их постоянными.<br><br>&nbsp;&nbsp; &nbsp;&nbsp; &nbsp;&nbsp; &nbsp;&nbsp; &nbsp;&nbsp; &nbsp;&nbsp; &nbsp;&nbsp; &nbsp;&nbsp; &nbsp;&nbsp; &nbsp;&nbsp;&nbsp;&nbsp; В общем все сделаем вместе с Вами или даже за Вас.&nbsp; <br> <br>&nbsp;&nbsp; </span></div>
      </div>
   </div>
<!-- Yandex.Metrika counter -->
<script type="text/javascript">
(function (d, w, c) {
    (w[c] = w[c] || []).push(function() {
        try {
            w.yaCounter27657525 = new Ya.Metrika({id:27657525,
                    webvisor:true,
                    clickmap:true});
        } catch(e) { }
    });
    var n = d.getElementsByTagName("script")[0],
        s = d.createElement("script"),
        f = function () { n.parentNode.insertBefore(s, n); };
    s.type = "text/javascript";
    s.async = true;
    s.src = (d.location.protocol == "https:" ? "https:" : "http:") + "//mc.yandex.ru/metrika/watch.js";
    if (w.opera == "[object Opera]") {
        d.addEventListener("DOMContentLoaded", f, false);
    } else { f(); }
})(document, window, "yandex_metrika_callbacks");
</script>
   <noscript><div><img src="//mc.yandex.ru/watch/27657525" style="position:absolute; left:-9999px;" alt=""/></div></noscript>
<!-- /Yandex.Metrika counter --></body>
</html>