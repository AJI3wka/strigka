<?php
function ValidateEmail($email)
{
   $pattern = '/^([0-9a-z]([-.\w]*[0-9a-z])*@(([0-9a-z])+([-\w]*[0-9a-z])*\.)+[a-z]{2,6})$/i';
   return preg_match($pattern, $email);
}
if ($_SERVER['REQUEST_METHOD'] == 'POST' && $_POST['formid'] == 'form1')
{
   $mailto = 'yourname@yourdomain.com';
   $mailfrom = isset($_POST['email']) ? $_POST['email'] : $mailto;
   $subject = 'Website form';
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
   $body .= 'Content-Type: text/plain; charset=ISO-8859-1'.$eol;
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
   margin-bottom: -419px;
   float:left
}
div#container
{
   width: 603px;
   height: 839px;
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
#Image2
{
   border: 0px #000000 solid;
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
#wb_uid1
{
   color: #2D2D2D;
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
#wb_Text1
{
   position: absolute;
   left: 14px;
   top: 802px;
   width: 250px;
   height: 28px;
   z-index: 8;
   text-align: left;
}
#wb_uid2
{
   color: #000000;
   font-family: Bookman Old Style;
   font-size: 16px;
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
#wb_uid3
{
   color: #D14D18;
   font-family: Bookman Old Style;
   font-size: 19px;
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
#wb_uid4
{
   color: #000000;
   font-family: Bookman Old Style;
   font-size: 16px;
}
#wb_Image2
{
   position: absolute;
   left: 15px;
   top: 0px;
   width: 582px;
   height: 233px;
   z-index: 7;
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
   top: 245px;
   width: 587px;
   height: 362px;
   z-index: 6;
   text-align: left;
}
#wb_uid6
{
   color: #000000;
   font-family: Times New Roman;
   font-size: 16px;
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
   font-size: 19px;
}
#Image2
{
   width: 582px;
   height: 233px;
}
#wb_uid10
{
   color: #000000;
   font-family: Bookman Old Style;
   font-size: 16px;
}
#wb_uid9
{
   color: #000000;
   font-family: Open Sans;
   font-size: 16px;
}
#wb_uid11
{
   color: #A9A9A9;
   font-family: Open Sans;
   font-size: 11px;
}
#wb_uid12
{
   color: #A9A9A9;
   font-family: Calibri;
   font-size: 11px;
}
#wb_uid13
{
   color: #A9A9A9;
   font-family: Open Sans;
   font-size: 11px;
}
#wb_Form1
{
   position: absolute;
   left: 15px;
   top: 589px;
   width: 252px;
   height: 216px;
   z-index: 5;
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
#Combobox1
{
   position: absolute;
   left: 20px;
   top: 129px;
   width: 203px;
   height: 26px;
   z-index: 3;
}
#wb_uid0
{
   color: #2D2D2D;
   font-family: Bookman Old Style;
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
<body>
   <div id="space"><br></div>
   <div id="container">
      <div id="wb_Form1">
         <form name="Form1" method="post" action="<?php echo basename(__FILE__); ?>" enctype="multipart/form-data" id="Form1">
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
         <span id="wb_uid0"><strong>Покрытие Shellaс за 499 рублей<br></strong></span><span id="wb_uid1"><strong><br></strong></span><span id="wb_uid2">Оптимально: для любого типа ногтей.<br>- Shellac не смазывается, не скалывается, не оставляет разводов и полос, не утяжеляет ногти.<br>- Shellac не травмирует ноготь, возможно частое повторение процедуры.<br>- Shellac держится от 10 дней до 3 недель, сохраняя вид только что сделанного маникюра.<br><br></span><span id="wb_uid3"><strong>Выгода акции: 36%</strong></span><span id="wb_uid4"><br></span><span id="wb_uid5"><strong><br></strong></span><span id="wb_uid6"><br></span><span id="wb_uid7"><strong>К&#1072;&#1082; &#1074;&#1086;&#1089;&#1087;&#1086;&#1083;&#1100;&#1079;&#1086;&#1074;&#1072;&#1090;&#1100;&#1089;&#1103;?</strong></span><span id="wb_uid8"><strong><br></strong></span><span id="wb_uid9"><br></span><span id="wb_uid10">1. &#1047;&#1072;&#1087;&#1086;&#1083;&#1085;&#1080;&#1090;&#1077; &#1092;&#1086;&#1088;&#1084;&#1091;<br>2. &#1047;&#1072;&#1087;&#1080;&#1096;&#1080;&#1090;&#1077;&#1089;&#1100; &#1085;&#1072; &#1091;&#1076;&#1086;&#1073;&#1085;&#1086;&#1077; &#1074;&#1088;&#1077;&#1084;&#1103;, &#1076;&#1086;&#1078;&#1076;&#1072;&#1074;&#1096;&#1080;&#1089;&#1100; &#1079;&#1074;&#1086;&#1085;&#1082;&#1072; &#1072;&#1076;&#1084;&#1080;&#1085;&#1080;&#1089;&#1090;&#1088;&#1072;&#1090;&#1086;&#1088;&#1072;<br></span>
      </div>
      <div id="wb_Image2">
         <img src="images/499_akcia.jpg" id="Image2" alt="">
      </div>
      <div id="wb_Text1">
         <span id="wb_uid11"><a href="./soglahenie.php">&#1057;&#1086;&#1075;&#1083;&#1072;&#1096;&#1077;&#1085;&#1080;&#1077; на &#1086;&#1073;&#1088;&#1072;&#1073;&#1086;&#1090;&#1082;</a></span><span id="wb_uid12"><a href="./soglahenie.php">у</a></span><span id="wb_uid13"><a href="./soglahenie.php"> &#1087;&#1077;&#1088;&#1089;&#1086;&#1085;&#1072;&#1083;&#1100;&#1085;&#1099;&#1093; &#1076;&#1072;&#1085;&#1085;&#1099;&#1093;</a></span>
      </div>
   </div>
<!-- Yandex.Metrika counter -->
<script type="text/javascript">
(function (d, w, c) {
    (w[c] = w[c] || []).push(function() {
        try {
            w.yaCounter27990870 = new Ya.Metrika({id:27990870,
                    webvisor:true,
                    clickmap:true,
                    trackLinks:true,
                    accurateTrackBounce:true});
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
   <noscript><div><img src="//mc.yandex.ru/watch/27990870" style="position:absolute; left:-9999px;" alt=""/></div></noscript>
<!-- /Yandex.Metrika counter --></body>
</html>