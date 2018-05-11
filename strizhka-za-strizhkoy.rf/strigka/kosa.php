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
   $subject = 'заявка с сайта косы';
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
<title>Курсы плетения кос в Перми</title>
<meta name="generator" content="WYSIWYG Web Builder 10 - http://www.wysiwygwebbuilder.com">
<link href="i_023.png" rel="shortcut icon">
<link href="kosa.css" rel="stylesheet">
<script src="jquery-1.7.2.min.js"></script>
<script src="wb.rotate.min.js"></script>
<script src="fancybox/jquery.easing-1.3.pack.js"></script>
<link rel="stylesheet" href="fancybox/jquery.fancybox-1.3.0.css">
<script src="fancybox/jquery.fancybox-1.3.0.pack.js"></script>
<script src="fancybox/jquery.mousewheel-3.0.2.pack.js"></script>
<script src="wwb10.min.js"></script>
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
<body <!--="" Yandex.Metrika="" counter="" --="">
<script>
    (function (d, w, c) {
        (w[c] = w[c] || []).push(function() {
            try {
                w.yaCounter34896615 = new Ya.Metrika({
                    id:34896615,
                    clickmap:true,
                    trackLinks:true,
                    accurateTrackBounce:true,
                    webvisor:true,
                    trackHash:true
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
   <noscript><div><img src="https://mc.yandex.ru/watch/34896615" style="position:absolute; left:-9999px;" alt=""/></div></noscript>
<!-- /Yandex.Metrika counter -->>
<!-- Yandex.Metrika counter -->
<script>
    (function (d, w, c) {
        (w[c] = w[c] || []).push(function() {
            try {
                w.yaCounter34896615 = new Ya.Metrika({
                    id:34896615,
                    clickmap:true,
                    trackLinks:true,
                    accurateTrackBounce:true,
                    webvisor:true,
                    trackHash:true
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
   <noscript><div><img src="https://mc.yandex.ru/watch/34896615" style="position:absolute; left:-9999px;" alt=""/></div></noscript>
<!-- /Yandex.Metrika counter -->
   <div id="Layer2">
      <div id="Layer2_Container">
         <div id="wb_Tex3">
            <span id="wb_uid89"><strong>3000 причесок</strong></span><span id="wb_uid90"><strong><br></strong></span><span id="wb_uid91">и кос для любого случая Вы научитесь делать </span></div>
         <div id="wb_Text31">
            <span id="wb_uid92"><strong>более 80 техник </strong></span><span id="wb_uid93"><strong><br></strong></span><span id="wb_uid94">Вы освоите за время обучения</span></div>
         <div id="wb_Text32">
            <span id="wb_uid95"><strong>1-8 дней</strong></span><span id="wb_uid96"><strong><br></strong></span><span id="wb_uid97">Вам потребуется чтобы стать специалистом</span></div>
         <div id="wb_Image23">
            <img src="images/i7.png" id="Image23" alt=""></div>
         <div id="wb_Text1">
            <span id="wb_uid98"><strong>Во время обучения в нашей школе плетения кос</strong></span></div>
         <div id="wb_Image1">
            <img src="images/i7.png" id="Image1" alt=""></div>
         <div id="wb_Image3">
            <img src="images/i7.png" id="Image3" alt=""></div>
      </div>
   </div>
   <div id="Layer4">
      <div id="Layer4_Container">
         <div id="wb_InlineFrame9">
            <a id="InlineFrame9" title="Оставить заявку" href="./zakaz.php?iframe"><img src="images/btnz.png" id="wb_uid99" alt="Оставить заявку"></a>
         </div>
         <div id="wb_Text15">
            <span id="wb_uid100">Получить личную консультацию<br></span><span id="wb_uid101"> </span><span id="wb_uid102"><strong>оставьте номер телефона, мы созвонимся и подберем для вас оптимальную программу обучения</strong></span></div>
         <div id="wb_Text45">
            <span id="wb_uid103"><em>или позвоните нам по номеру 287-26-10</em></span></div>
      </div>
   </div>
   <div id="Layer5">
      <div id="Layer5_Container">
         <div id="wb_Text22">
            <span id="wb_uid104"><strong>ЧТО ВАМ ДАЛЬШЕ ДЕЛАТЬ</strong></span></div>
      </div>
   </div>
   <div id="Layer6">
      <div id="Layer6_Container">
         <div id="wb_Image66">
            <img src="images/badge4.png" id="Image66" alt=""></div>
         <div id="wb_InlineFrame16">
            <a id="InlineFrame16" title="Оставить заявку" href="./zakaz.php?iframe"><img src="images/btnz.png" id="wb_uid105" alt="Оставить заявку"></a>
         </div>
         <div id="wb_Text57">
<span id="wb_uid106"><em>скидка до 30 июня</em></span></div>
         <div id="wb_Text56">
<span id="wb_uid107"><strong>-35</strong></span><span id="wb_uid108"><strong>%</strong></span></div>
         <div id="wb_Text58">
            <span id="wb_uid109">оставьте заявку и получите скидку на любой курс</span></div>
         <div id="wb_Text59">
            <span id="wb_uid110"><em>или позвоните нам по номеру 287-26-10</em></span></div>
      </div>
   </div>
   <div id="Layer7">
      <div id="Layer7_Container">
         <div id="wb_Image67">
            <img src="images/line.jpg" id="Image67" alt=""></div>
         <div id="wb_soc5">
            <a href="#" onmouseover="Animate('wb_soc2', '', '', '', '', '40', 500, '');Animate('soc3', '', '', '', '', '40', 500, '');Animate('soc4', '', '', '', '', '40', 500, '');Animate('wb_soc1', '', '', '', '', '40', 500, '');Animate('soc6', '', '', '', '', '40', 500, '');return false;" onmouseout="Animate('wb_soc2', '', '', '', '', '100', 500, '');Animate('soc3', '', '', '', '', '100', 500, '');Animate('soc4', '', '', '', '', '100', 500, '');Animate('wb_soc1', '', '', '', '', '100', 500, '');Animate('soc6', '', '', '', '', '100', 500, '');return false;"><img src="images/soc5.png" id="soc5" alt=""></a></div>
         <div id="wb_soc2">
            <a href="http://facebook.com" onmouseover="Animate('wb_soc1', '', '', '', '', '40', 500, '');Animate('soc3', '', '', '', '', '40', 500, '');Animate('soc4', '', '', '', '', '40', 500, '');Animate('wb_soc5', '', '', '', '', '40', 500, '');Animate('soc6', '', '', '', '', '40', 500, '');return false;" onmouseout="Animate('wb_soc1', '', '', '', '', '100', 500, '');Animate('soc3', '', '', '', '', '100', 500, '');Animate('soc4', '', '', '', '', '100', 500, '');Animate('wb_soc5', '', '', '', '', '100', 500, '');Animate('soc6', '', '', '', '', '100', 500, '');return false;"><img src="images/soc2.png" id="soc2" alt=""></a></div>
         <div id="wb_soc1">
            <a href="http://vk.com" onmouseover="Animate('wb_soc2', '', '', '', '', '40', 500, '');Animate('soc3', '', '', '', '', '40', 500, '');Animate('soc4', '', '', '', '', '40', 500, '');Animate('wb_soc5', '', '', '', '', '40', 500, '');Animate('soc6', '', '', '', '', '40', 500, '');return false;" onmouseout="Animate('wb_soc2', '', '', '', '', '100', 500, '');Animate('soc3', '', '', '', '', '100', 500, '');Animate('soc4', '', '', '', '', '100', 500, '');Animate('wb_soc5', '', '', '', '', '100', 500, '');Animate('soc6', '', '', '', '', '100', 500, '');return false;"><img src="images/soc1.png" id="soc1" alt=""></a></div>
         <div id="wb_Text63">
            <span id="wb_uid111">8 (342)</span><span id="wb_uid112"> </span><span id="wb_uid113"><strong>287-26-10</strong></span></div>
         <div id="wb_Text64">
            <span id="wb_uid114"><strong>szs1@bk.ru<br>учебный центр &quot;Школа Кос&quot;</strong></span></div>
         <div id="wb_Image4">
            <img src="images/insta.png" id="Image4" alt=""></div>
         <a href="http://www.wysiwygwebbuilder.com" target="_blank"><img src="images/builtwithwwb10.png" alt="WYSIWYG Web Builder" id="wb_uid115"></a>
      </div>
   </div>
   <div id="Layer8">
      <div id="Layer8_Container">
      </div>
   </div>
   <div id="Layer3">
      <div id="Layer3_Container">
         <div id="wb_Text27">
            <span id="wb_uid116"><strong>Мы находимся по адресу: Бульвар Гагарина д.66а, офис 8</strong></span></div>
      </div>
   </div>
   <div id="container">
      <div id="wb_Image20">
         <img src="images/7167876.jpg" id="Image20" alt="">
      </div>
      <div id="wb_Image32">
         <img src="images/how-to-do-cute-hairstyles-top.jpg" id="Image32" alt="">
      </div>
      <div id="wb_Shape3">
         <img src="images/img0001.png" id="Shape3" alt="">
      </div>
      <div id="wb_Text8">
         <span id="wb_uid0"><strong>Хотите получить 35% скидку на курс</strong></span>
      </div>
      <div id="wb_Text9">
         <span id="wb_uid1"><em>просто оставьте ваше имя,<br>телефон и e-mail в форме справа</em></span>
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
         <span id="wb_uid6"><strong>ПОЧЕМУ 95% ЖЕЛАЮЩИХ<br></strong></span>
      </div>
      <div id="wb_Text2">
         <span id="wb_uid7"><strong>ПРИНИМАЮТ РЕШЕНИЕ УЧИТЬСЯ У НАС:</strong></span>
      </div>
      <div id="wb_Text11">
         <span id="wb_uid8">Удобное время обучения<br></span><span id="wb_uid9">У нас есть дневное, вечернее и выходное время обучения</span>
      </div>
      <div id="wb_Text12">
         <span id="wb_uid10">По окончании выдается сертификат<br></span><span id="wb_uid11">Который станет вашей визитной карточкой в индустрию краоты</span>
      </div>
      <div id="wb_Text13">
         <span id="wb_uid12">Доступная цена<br></span><span id="wb_uid13">Можно подобрать для себя курс по оптимальной стоимости </span>
      </div>
      <div id="wb_Text34">
         <span id="wb_uid14">Мини группы до 8 человек<br></span><span id="wb_uid15">А при желании, возможно индивидуальное обучение</span>
      </div>
      <div id="wb_Text35">
         <span id="wb_uid16">100% гарантия трудоустройства<br></span><span id="wb_uid17">Лучших возьмем к себе в команду</span>
      </div>
      <div id="wb_Text36">
         <span id="wb_uid18">Квалифицированные преподаватели<br></span><span id="wb_uid19">У нас работают лучшие преподаватели-практики, научим&nbsp; даже мужчин!)</span>
      </div>
      <div id="wb_Image17">
         <img src="images/sm1.png" id="Image17" alt="">
      </div>
      <div id="wb_Image19">
         <img src="images/sm2.png" id="Image19" alt="">
      </div>
      <div id="wb_Image22">
         <a href="./kosa.php"><img src="images/sm3.png" id="Image22" alt=""></a>
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
         <span id="wb_uid20"><strong>ЗВОНИТЕ НАМ ИЛИ ОСТАВЛЯЕТЕ ЗАЯВКУ НА САЙТЕ</strong></span><span id="wb_uid21"><strong> <br></strong></span>
      </div>
      <div id="wb_Text39">
         <span id="wb_uid22"><strong>МЫ СВЯЗЫВАЕМСЯ С ВАМИ И ПОДБИРАЕМ ВАМ КУРС</strong></span><span id="wb_uid23"><strong><br></strong></span>
      </div>
      <div id="wb_Text51">
         <span id="wb_uid24"><strong>ПРИХОДИТЕ К НАМ В ШКОЛУ И НАЧИНАЕТЕ УЧИТЬСЯ<br></strong></span><span id="wb_uid25"><br></span>
      </div>
      <div id="wb_Text52">
         <span id="wb_uid26"><strong>ПО ОКОНЧАНИИ ОБУЧЕНИЯ СТАНОВИТЕСЬ СПЕЦИАЛИСТОМ <br></strong></span>
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
         <span id="wb_uid27"><strong>ПОЗВОНИТЕ СЕГОДНЯ</strong></span>
      </div>
      <div id="wb_Text61">
         <span id="wb_uid28">И ЗАВТРА ВЫ УЖЕ ОСВОИТЕ НОВУЮ ПРОФЕССИЮ, А ВОЗМОЖНО И ИЗМЕНИЕ СВОЮ ЖИЗНЬ!</span>
      </div>
      <div id="wb_Shape2">
         <img src="images/img0009.gif" id="Shape2" alt="">
      </div>
      <div id="wb_Text3">
         <span id="wb_uid29">Плетение кос - это модная тенденция, которая актуална как для парикмахеров,<br>стремящихся расширить перечень своих услуг в салоне красоты,так и для девушек и женщин, желающих выглядеть стильно и подчеркнуть свою индивидуальность.<br>Молодые мамы, следуя модному направлению,<br>предпочитают самостоятельно заплетать косы ребенку и хотят это делать красиво.<br><br>Мы приглашаем всех желающих посетить наши курсы, на которых Вы сможете быстро научиться плести косы и создавать стильные прически без каких-либо начальных навыков.<br><br></span>
      </div>
      <div id="wb_Image5">
         <img src="images/POLE1.png" id="Image5" alt="">
      </div>
      <div id="wb_Image6">
         <img src="images/POLE1.png" id="Image6" alt="">
      </div>
      <div id="wb_Image7">
         <img src="images/POLE1.png" id="Image7" alt="">
      </div>
      <div id="wb_Text4">
         <span id="wb_uid30"><strong>1 ДЕНЬ</strong></span>
      </div>
      <div id="wb_Text5">
         <span id="wb_uid31"><strong>4 ДНЯ</strong></span>
      </div>
      <div id="wb_Text6">
         <span id="wb_uid32"><strong>8 ДНЕЙ</strong></span>
      </div>
      <div id="wb_Text10">
         <span id="wb_uid33">&nbsp;&nbsp;&nbsp;&nbsp; <u>&nbsp; Первый уровень</u><br><br>- Основы плетения кос и прически на основе французской косы<br>- Правила и законы плетения кос<br>- Свободные плетения и водопады<br>- Виды плетения по центру, по диагонали, зигзагом, цветы из кос, объемные косы</span>
      </div>
      <div id="wb_Text14">
         <span id="wb_uid34">&nbsp;&nbsp; &nbsp;&nbsp; <u> Второй уровень <br></u><br><strong><em>Дополнительно к Первому уровню:<br></em></strong><br>- Рыбий хвост, жгуты, узлы, вывернутая коса<br><br>- Многопрядные косы с лентами и без</span>
      </div>
      <div id="wb_Text16">
         <span id="wb_uid35">&nbsp;&nbsp; &nbsp;&nbsp; &nbsp;&nbsp; <u>Третий уровень <br><br></u><strong><em>Дополнительно ко второму уровню:</em></strong><u><br></u>- Плетения из 4, 5, 6, 7 прядей<br>- Эксклюзивные плетения кос с лентами<br>- Свадебные и вечерние прически<br>- Кудри и локоны на утюжок и щипцы<br>- Пучки из кудрей и гладкие валики<br>- Экзамен</span>
      </div>
      <div id="wb_Text17">
         <span id="wb_uid36"><strong>НАШИ КУРСЫ</strong></span>
      </div>
      <div id="wb_Text19">
         <span id="wb_uid37"> </span><span id="wb_uid38">&nbsp; </span><span id="wb_uid39">ПОДХОДИТ МОЛОДЫМ МАМОЧКАМ И ДЛЯ ПРИОБРЕТЕНИЯ ПЕРВЫХ НАВЫКОВ</span>
      </div>
      <div id="wb_Text20">
         <span id="wb_uid40"> </span><span id="wb_uid41">&nbsp; </span><span id="wb_uid42">УДИВИ СЕБЯ, ЗНАКОМЫХ ИЛИ ДЛЯ ДОП. УСЛУГ В САЛОНЕ</span>
      </div>
      <div id="wb_Text18">
         <span id="wb_uid43"> </span><span id="wb_uid44">&nbsp; </span><span id="wb_uid45">СТАНЬ МАСТЕРОМ ОСВОЙ НОВУЮ ПРОФЕССИЮ</span>
      </div>
      <div id="wb_Image2">
         <img src="images/logok2.png" id="Image2" alt="">
      </div>
      <div id="wb_Image8">
         <img src="images/karta2.PNG" id="Image8" alt="">
      </div>
      <div id="wb_Text29">
         <span id="wb_uid46"><strong>Позвоните нам</strong></span><span id="wb_uid47"><strong>&nbsp;&nbsp; </strong></span><span id="wb_uid48"><strong>8 (342) </strong></span><span id="wb_uid49"><strong>287-26-10</strong></span>
      </div>
      <div id="wb_Text28">
         <div id="wb_uid50"><span id="wb_uid51"><br></span></div>
      </div>
      <div id="wb_Text30">
         <div id="wb_uid52"><span id="wb_uid53"><strong>Вдовина Татьяна Александровна</strong></span><span id="wb_uid54">, стаж&nbsp; педагогической работы 29 лет в </span></div>
         <div id="wb_uid55"><span id="wb_uid56">системе НПО, СПО в качестве преподавателя и мастера производственного </span></div>
         <div id="wb_uid57"><span id="wb_uid58">обучения по специальности <Парикмахерское искусство>.</span></div>
         <div id="wb_uid59"><span id="wb_uid60"> В основе&nbsp; педагогической концепции преподавателя - принцип <Творческий </span></div>
         <div id="wb_uid61"><span id="wb_uid62">поиск педагога - гарантия успешности выпускника>. Последнее место работы </span></div>
         <div id="wb_uid63"><span id="wb_uid64"><Пермский государственный технологический колледж>, бывший <Альтер>.</span></div>
         <div id="wb_uid65"><span id="wb_uid66"> За время работы в системе профессионального образования&nbsp; подготовлено </span></div>
         <div id="wb_uid67"><span id="wb_uid68">более 600 специалистов сферы сервиса, из которых большинство успешно </span></div>
         <div id="wb_uid69"><span id="wb_uid70">реализует себя в профессиональной деятельности. С 2007 года является </span></div>
         <div id="wb_uid71"><span id="wb_uid72">тренером студенческой команды парикмахеров и визажистов <Камские огни>, </span></div>
         <div id="wb_uid73"><span id="wb_uid74">успешно выступающих на&nbsp; Олимпийских международных играх по </span></div>
         <div id="wb_uid75"><span id="wb_uid76">парикмахерскому искусству и декоративной косметике, фестивале <Невские </span></div>
         <div id="wb_uid77"><span id="wb_uid78">берега>. </span></div>
         <div id="wb_uid79"><span id="wb_uid80">Награждена нагрудным знаком <Почетный работник среднего </span></div>
         <div id="wb_uid81"><span id="wb_uid82">профессионального образования>. </span></div>
         <div id="wb_uid83"><span id="wb_uid84"><br></span></div>
      </div>
      <div id="wb_Image13">
         <img src="images/1_1.jpg" id="Image13" alt="">
      </div>
      <div id="wb_Text37">
         <span id="wb_uid85"><strong>НАШИ ПРЕПАДОВАТЕЛИ</strong></span>
      </div>
      <div id="wb_Image15">
         <img src="images/pricheska-s-pleteniem-na-dlinny-e-volosy-braided-hairstyle-for-long-hair-youtube-thumb.jpg" id="Image15" alt="">
      </div>
      <div id="wb_Shape4">
         <img src="images/img0003.png" id="Shape4" alt="">
      </div>
      <div id="wb_Shape5">
         <img src="images/img0004.png" id="Shape5" alt="">
      </div>
      <div id="wb_Image21">
         <img src="images/1377722760773.jpg" id="Image21" alt="">
      </div>
      <div id="wb_Image16">
         <img src="images/maxresdefault.jpg" id="Image16" alt="">
      </div>
      <div id="wb_Image27">
         <img src="images/curly-waterfall-braid-2016-450x750.png" id="Image27" alt="">
      </div>
      <div id="wb_Image14">
         <img src="images/1443970323948.jpg" id="Image14" alt="">
      </div>
      <div id="wb_Image28">
         <img src="images/8Dtm3Z_A3H8.jpg" id="Image28" alt="">
      </div>
      <div id="wb_Image29">
         <img src="images/56bf5fd3f14fb.jpg" id="Image29" alt="">
      </div>
      <div id="wb_Image30">
         <img src="images/20151108130637.jpg" id="Image30" alt="">
      </div>
      <div id="wb_Image31">
         <img src="images/getImage%20%2813%29.jpg" id="Image31" alt="">
      </div>
      <div id="wb_Image34">
         <img src="images/timthumb1.jpg" id="Image34" alt="">
      </div>
   </div>
   <div id="Layer1">
      <div id="Layer1_Container">
         <div id="wb_Shape1">
            <img src="images/img0002.png" id="Shape1" alt=""></div>
         <div id="wb_Image49">
            <img src="images/badge4.png" id="Image49" alt=""></div>
         <div id="wb_Text44">
<span id="wb_uid86"><em>скидка до 30 июня</em></span></div>
         <div id="wb_Text21">
<span id="wb_uid87"><strong>-35</strong></span><span id="wb_uid88"><strong>%</strong></span></div>
      </div>
   </div>
<!-- Yandex.Metrika counter -->
<script>
    (function (d, w, c) {
        (w[c] = w[c] || []).push(function() {
            try {
                w.yaCounter34896615 = new Ya.Metrika({
                    id:34896615,
                    clickmap:true,
                    trackLinks:true,
                    accurateTrackBounce:true,
                    webvisor:true,
                    trackHash:true
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
   <noscript><div><img src="https://mc.yandex.ru/watch/34896615" style="position:absolute; left:-9999px;" alt=""/></div></noscript>
<!-- /Yandex.Metrika counter --></body>
</html>