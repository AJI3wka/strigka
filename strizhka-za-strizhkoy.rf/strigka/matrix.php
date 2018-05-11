<?php
   function ValidateEmail($email)
   {
      $pattern = '/^([0-9a-z]([-.\w]*[0-9a-z])*@(([0-9a-z])+([-\w]*[0-9a-z])*\.)+[a-z]{2,6})$/i';
      return preg_match($pattern, $email);
   }
   if ($_SERVER['REQUEST_METHOD'] == 'POST')
   {
      $mailto = 'your@mail.ru';
      $mailfrom = isset($_POST['email']) ? $_POST['email'] : $mailto;
      $subject = 'заявка с сайта матрикс';
      $message = 'Values submitted from web site form:';
      $success_url = './form-ok.php';
      $error_url = '';
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
<meta charset="Windows-1251">
<title>Акция МАТРИКС</title>
<meta name="generator" content="WYSIWYG Web Builder 9 - http://www.wysiwygwebbuilder.com">
<link href="css/matrix.css" rel="stylesheet" type="text/css">
<script type="text/javascript" src="js/jquery-1.7.2.min.js"></script>
<script type="text/javascript" src="fancybox/jquery.easing-1.3.pack.js"></script>
<link rel="stylesheet" href="fancybox/jquery.fancybox-1.3.0.css" type="text/css">
<script type="text/javascript" src="fancybox/jquery.fancybox-1.3.0.pack.js"></script>
<script type="text/javascript" src="fancybox/jquery.mousewheel-3.0.2.pack.js"></script>
<script type="text/javascript" src="js/wwb9.min.js"></script>
<script type="text/javascript">
$(document).ready(function()
{
   $('#InlineFrame4').click(function()
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
   $("a[data-rel='PhotoGallery1']").attr('rel', 'PhotoGallery1');
   $("a[rel^='PhotoGallery1']").fancybox({});
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
      <div id="wb_Shape1">
         <img src="images/img0013.png" id="Shape1" alt="">
      </div>
      <div id="wb_Image1">
         <img src="images/header.jpg" id="Image1" alt="">
      </div>
      <div id="wb_Image2">
         <img src="images/strizhka11.png" id="Image2" alt="">
      </div>
      <div id="wb_InlineFrame4">
         <a id="InlineFrame4" title="Заказать обратный звонок" href="./callback.php?iframe"><img src="images/callback3.png" id="wb_uid0" alt="Заказать обратный звонок"></a>
      </div>
      <div id="wb_Text1">
         <span id="wb_uid1"> </span><span id="wb_uid2"><strong>260-3-260</strong></span>
      </div>
      <div id="wb_Image3">
         <img src="149577_536a3d29da3d4536a3d29da40b.jpeg" id="Image3" alt="">
      </div>
      <div id="wb_header1">
<span id="wb_uid3"><strong>Только 7 дней </strong></span><span id="wb_uid4"><strong>окрашивание </strong></span><span id="wb_uid5"><strong>MATRIX</strong></span><span id="wb_uid6"><strong> по цене </strong></span><span id="wb_uid7"><strong>ЭСТЕЛЬ</strong></span><span id="wb_uid8"><strong> </strong></span>
      </div>
      <div id="wb_Text2">
<span id="wb_uid9"><strong>ПОЧУВСТВУЙ КАЧЕСТВО ЗА ДОСТУПНЫЕ ДЕНЬГИ</strong></span>
      </div>
      <div id="wb_Image8">
         <img src="images/formbg.png" id="Image8" alt="">
      </div>
      <div id="wb_Image9">
         <img src="images/formbgna.png" id="Image9" alt="">
      </div>
      <div id="wb_Form1">
         <form name="Form1" method="post" action="<?php echo basename(__FILE__); ?>" enctype="multipart/form-data" accept-charset="UTF-8" target="_top" id="Form1">
            <div id="wb_Text7">
<span id="wb_uid10"><strong>оставить заявку</strong></span></div>
            <input type="submit" id="Button1" onmouseover="SetImage('Image9','images/formbga.png');SetImage('Image11','images/formbga.png');SetImage('Image12','images/formbga.png');SetImage('Image10','images/buta.png');return false;" onmouseout="SetImage('Image9','images/formbgna.png');SetImage('Image11','images/formbgna.png');SetImage('Image12','images/formbgna.png');SetImage('Image10','images/but.png');return false;" name="" value="Оставить заявку">
            <input type="text" id="Editbox2" onmouseover="SetImage('Image11','images/formbga.png');return false;" onmouseout="SetImage('Image11','images/formbgna.png');return false;" name="Editbox2" value="" title="&#1074;&#1072;&#1096; e- mail:" placeholder="&#1074;&#1072;&#1096; e-mail">
            <input type="text" id="Editbox3" onmouseover="SetImage('Image12','images/formbga.png');return false;" onmouseout="SetImage('Image12','images/formbgna.png');return false;" name="Editbox3" value="" placeholder="&#1074;&#1072;&#1096; &#1090;&#1077;&#1083;&#1077;&#1092;&#1086;&#1085;">
            <div id="wb_Image10">
               <img src="images/but.png" id="Image10" alt=""></div>
            <div id="wb_Image11">
               <img src="images/formbgna.png" id="Image11" alt=""></div>
            <div id="wb_Image12">
               <img src="images/formbgna.png" id="Image12" alt=""></div>
            <div id="wb_Text26">
<span id="wb_uid11">ваш телефон:</span></div>
         </form>
      </div>
      <div id="wb_Text8">
<span id="wb_uid12"><strong>запишитесь на окрашивание</strong></span>
      </div>
      <div id="wb_Text9">
<span id="wb_uid13"><em>просто оставьте ваше имя,<br>телефон и e-mail в форме ниже</em></span>
      </div>
      <div id="wb_Image13">
         <img src="images/shadow.png" id="Image13" alt="">
      </div>
      <div id="wb_Image14">
         <img src="images/img0014.png" id="Image14" alt="">
      </div>
      <div id="wb_Image15">
         <img src="images/line2.png" id="Image15" alt="">
      </div>
      <div id="wb_Shape2">
         <img src="images/img0015.png" id="Shape2" alt="">
      </div>
      <div id="wb_Text12">
<span id="wb_uid14"><strong>Почувствуйте разницу от использования качественного продукта</strong></span>
      </div>
      <div id="wb_BulletedList1">
         <div>
            <div class="bullet" id="wb_uid15"><img src="images/bullet.png" id="wb_uid16" alt=""></div>
            <div class="item" id="wb_uid17"><div id="wb_uid18"><span id="wb_uid19">Matrix - это &quot;американский Loreal&quot;</span></div>
            </div>
         </div>
         <div id="wb_uid20">
            <div class="bullet" id="wb_uid21"><img src="images/bullet.png" id="wb_uid22" alt=""></div>
            <div class="item" id="wb_uid23"><div id="wb_uid24"><span id="wb_uid25">Волосы заметно более гладкие и шелковистые </span></div>
            </div>
         </div>
         <div id="wb_uid26">
            <div class="bullet" id="wb_uid27"><img src="images/bullet.png" id="wb_uid28" alt=""></div>
            <div class="item" id="wb_uid29"><div id="wb_uid30"><span id="wb_uid31">Стойкость и насыщенность цветов</span></div>
            </div>
         </div>
         <div id="wb_uid32">
            <div class="bullet" id="wb_uid33"><img src="images/bullet.png" id="wb_uid34" alt=""></div>
            <div class="item" id="wb_uid35"><span id="wb_uid36">Они поистине способны преобразить любую женщину и помочь ей сделать шажок на пути к своей мечте<br></span></div>
         </div>
      </div>
      <div id="wb_Image26">
         <img src="images/img0016.png" id="Image26" alt="">
      </div>
      <div id="wb_Image27">
         <img src="images/line2.png" id="Image27" alt="">
      </div>
      <div id="wb_PhotoGallery1">
         <table id="PhotoGallery1">
            <tr>
               <td class="figure" id="wb_uid37">
                  <a href="images/lori-0001343232-smallwww.jpg" data-rel="PhotoGallery1" title="lori-0001343232-smallwww"><img alt="lori-0001343232-smallwww" title="lori-0001343232-smallwww" src="images/tn_lori-0001343232-smallwww.png" id="wb_uid38"></a>
               </td>
               <td class="figure" id="wb_uid39">
                  <a href="images/melirovanie-3.jpg" data-rel="PhotoGallery1" title="melirovanie-3"><img alt="melirovanie-3" title="melirovanie-3" src="images/tn_melirovanie-3.png" id="wb_uid40"></a>
               </td>
               <td class="figure" id="wb_uid41">
                  <a href="images/volos-5.jpg" data-rel="PhotoGallery1" title="volos-5"><img alt="volos-5" title="volos-5" src="images/tn_volos-5.png" id="wb_uid42"></a>
               </td>
               <td class="figure" id="wb_uid43">
                  <a href="images/163_image.jpg" data-rel="PhotoGallery1" title="163_image"><img alt="163_image" title="163_image" src="images/tn_163_image.png" id="wb_uid44"></a>
               </td>
            </tr>
            <tr>
               <td class="figure" id="wb_uid45">
                  <a href="images/story-2012-kraski-dlja-volos-bjez-vrjeda-dlja-zdorovja.jpg" data-rel="PhotoGallery1" title="story-2012-kraski-dlja-volos-bjez-vrjeda-dlja-zdorovja"><img alt="story-2012-kraski-dlja-volos-bjez-vrjeda-dlja-zdorovja" title="story-2012-kraski-dlja-volos-bjez-vrjeda-dlja-zdorovja" src="images/tn_story-2012-kraski-dlja-volos-bjez-vrjeda-dlja-zdorovja.png" id="wb_uid46"></a>
               </td>
               <td class="figure" id="wb_uid47">
                  <a href="images/23971-2.jpg" data-rel="PhotoGallery1" title="23971-2"><img alt="23971-2" title="23971-2" src="images/tn_23971-2.png" id="wb_uid48"></a>
               </td>
               <td class="figure" id="wb_uid49">
                  <a href="images/so3ABBFOVR-preview.jpg" data-rel="PhotoGallery1" title="so3ABBFOVR-preview"><img alt="so3ABBFOVR-preview" title="so3ABBFOVR-preview" src="images/tn_so3ABBFOVR-preview.png" id="wb_uid50"></a>
               </td>
               <td class="figure" id="wb_uid51">
                  <a href="images/322.jpg" data-rel="PhotoGallery1" title="322"><img alt="322" title="322" src="images/tn_322.png" id="wb_uid52"></a>
               </td>
            </tr>
         </table>
      </div>
      <div id="wb_Text14">
<span id="wb_uid53"><strong>&nbsp; </strong></span><span id="wb_uid54"><strong>MATRIX</strong></span><span id="wb_uid55"><strong>&nbsp; </strong></span><span id="wb_uid56">Выбор Очевиден</span>
      </div>
      <div id="wb_Image29">
         <img src="images/line2.png" id="Image29" alt="">
      </div>
      <div id="wb_Text15">
<span id="wb_uid57">Отзывы тех, кто использует<br></span><span id="wb_uid58">MATRIX</span>
      </div>
      <div id="wb_Shape3">
         <img src="images/img0017.png" id="Shape3" alt="">
      </div>
      <div id="wb_Text17">
<span id="wb_uid59"><strong>***Марина***<br></strong></span>
      </div>
      <div id="wb_Image30">
         <img src="images/img0018.png" id="Image30" alt="">
      </div>
      <div id="wb_Text16">
<span id="wb_uid60">Я уже много лет матриксом крашусь. Я крашусь я бешенно-жестоко, выбеливаюсь капиатально. НО, волосы мягкие, не ломаются, не выпадают, приятные на ощупь. Кожа головы в отличном состоянии даже сразу после покраски. Нравится, что всегда получается нужный цвет, без промахов.</span>
      </div>
      <div id="wb_Shape4">
         <img src="images/img0019.png" id="Shape4" alt="">
      </div>
      <div id="wb_Image31">
         <img src="images/img0020.png" id="Image31" alt="">
      </div>
      <div id="wb_Text18">
<span id="wb_uid61">Краской Matrix пользуюсь уже очень давно. Изначально, мой парикмахер предложила мне попробовать, я долго сомневалась, краска то ведь не дешевая, но в конце-концов попробовала. Результат предвосхитил все мои ожидания!!!</span>
      </div>
      <div id="wb_Text19">
<span id="wb_uid62"><strong>Кристина</strong></span>
      </div>
      <div id="wb_Shape5">
         <img src="images/img0021.png" id="Shape5" alt="">
      </div>
      <div id="wb_Image32">
         <img src="images/img0022.png" id="Image32" alt="">
      </div>
      <div id="wb_Text20">
<span id="wb_uid63">Мое первое знакомство с этой краской состоялось больше года назад. С тех пор я в нее влюблена. Грамотный мастер смешала несколько тонов красок Matrix в определенных пропорциях - результат меня вполне устраивает. Крашусь в блонд, при этом, натуральный цвет волос - темно-русый. Цыплячей желтизны нет!</span>
      </div>
      <div id="wb_Text21">
<span id="wb_uid64"><strong>Татьяна Карташова</strong></span>
      </div>
      <div id="wb_Shape6">
         <img src="images/img0023.png" id="Shape6" alt="">
      </div>
      <div id="wb_Text22">
<span id="wb_uid65">Не пропустите оличную возможность,<strong> </strong></span><span id="wb_uid66"><strong>оставьте заявку сейчас!</strong></span>
      </div>
      <div id="wb_Image33">
         <img src="images/img0024.png" id="Image33" alt="">
      </div>
      <div id="wb_InlineFrame8">
         <a id="InlineFrame8" title="Оставить заявку" href="./zakaz.php?iframe"><img src="images/btnz.png" id="wb_uid67" alt="Оставить заявку"></a>
      </div>
      <div id="wb_Text23">
         <span id="wb_uid68"><strong>260-3-260</strong></span>
      </div>
      <div id="wb_Text39">
         <span id="wb_uid69">szs1@bk.ru<br>г. Пермь, ул. Крупской, 40</span>
      </div>
      <div id="wb_Text24">
<span id="wb_uid70">ваше имя:</span>
      </div>
      <div id="wb_Text25">
<span id="wb_uid71">ваш e-mail:</span>
      </div>
      <div id="wb_Image4">
         <img src="images/icon-phone.png" id="Image4" alt="">
      </div>
      <div id="wb_Text27">
         <span id="wb_uid72">сеть парикмахерских</span>
      </div>
      <div id="wb_Text10">
         <span id="wb_uid73">работаем</span><span id="wb_uid74"><br><strong>5</strong></span><span id="wb_uid75"><strong><br></strong>лет</span>
      </div>
      <div id="wb_Text11">
         <span id="wb_uid76">на данное время<br></span><span id="wb_uid77"><strong>7</strong></span><span id="wb_uid78"><br>салонов-парикмахерских</span>
      </div>
      <div id="wb_Image16">
         <img src="images/icon-phone.png" id="Image16" alt="">
      </div>
      <div id="wb_Form2">
         <form name="Form1" method="post" action="<?php echo basename(__FILE__); ?>" enctype="multipart/form-data" accept-charset="UTF-8" target="_top" id="Form2">
            <div id="wb_Text28">
<span id="wb_uid79"><strong>оставить заявку</strong></span></div>
            <input type="submit" id="Button2" onmouseover="SetImage('Image9','images/formbga.png');SetImage('Image11','images/formbga.png');SetImage('Image12','images/formbga.png');SetImage('Image10','images/buta.png');return false;" onmouseout="SetImage('Image9','images/formbgna.png');SetImage('Image11','images/formbgna.png');SetImage('Image12','images/formbgna.png');SetImage('Image10','images/but.png');return false;" name="" value="Оставить заявку">
            <input type="text" id="Editbox1" onmouseover="SetImage('Image9','images/formbga.png');return false;" onmouseout="SetImage('Image9','images/formbgna.png');return false;" name="Editbox1" value="" placeholder="&#1074;&#1072;&#1096;&#1077; &#1080;&#1084;&#1103;">
            <input type="text" id="Editbox4" onmouseover="SetImage('Image11','images/formbga.png');return false;" onmouseout="SetImage('Image11','images/formbgna.png');return false;" name="Editbox2" value="" placeholder="&#1074;&#1072;&#1096; e-mail">
            <input type="text" id="Editbox5" onmouseover="SetImage('Image12','images/formbga.png');return false;" onmouseout="SetImage('Image12','images/formbgna.png');return false;" name="Editbox3" value="" placeholder="&#1074;&#1072;&#1096; &#1090;&#1077;&#1083;&#1077;&#1092;&#1086;&#1085;">
         </form>
      </div>
   </div>
</body>
</html>