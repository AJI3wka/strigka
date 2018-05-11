<!doctype html>
<html lang="ru">
<head>
   <meta charset="UTF-8">
   <meta http-equiv="X-UA-Compatible" content="IE=edge">
   <meta name="viewport" content="width=device-width, initial-scale=1">
    <script>
        var ajaxurl = '<?php echo admin_url('admin-ajax.php'); ?>';
        var is_user_logged_in = <?php echo intval(is_user_logged_in()); ?>;
    </script>
   <?php wp_head(); ?>
  <link rel="icon" href="/favicon.ico" type="image/x-icon">
  <link rel="shortcut icon" href="/favicon.ico" type="image/x-icon">
   <link rel="stylesheet" href="/css/libs.min.css">
   <link rel="stylesheet" href="/css/main.css">
   <link rel="stylesheet" type="text/css" href="<?php echo get_stylesheet_uri(); ?>" />

</head>
<body <?php body_class(); ?>>
   <!--<div class="pixel-perfect"></div>-->
   <div class="overflow-block">
      <div class="header-block">
         <div class="container">
            <div class="clearfix row">
               <div class="col-sm-6 col-xs-4 logo-container"><a href="/" class="logo"><img src="/img/logo.png" alt="logo"></a></div>
               <div class="col-sm-6 col-xs-8 phone-header">
                  <div class="header-phone__value">
                     <p>Звоните нам по номеру</p>
                     <a href="tel:+73422250078">+7 (342) 225-00-78</a>
                  </div>
                  <a href="#popUp" class="phone-button call-popUp"><i></i></a>
               </div>
            </div>
         </div>
      </div>