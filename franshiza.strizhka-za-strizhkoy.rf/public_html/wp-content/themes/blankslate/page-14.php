<?php get_header(); ?>


     <div class="first-block">
         <div class="container">
            <div class="description">

               <div class="title">
                   <?php if ( have_posts() ) : while ( have_posts() ) : the_post(); ?>
                       <h1><?php the_title(); ?></h1>
                   <?php endwhile; endif; ?>
               </div>
               <div class="subtitle">
                   <?php if ( have_posts() ) : while ( have_posts() ) : the_post(); ?>
                       <?php the_content(); ?>
                   <?php endwhile; endif; ?>
               </div>

                <ul class="advantages-list">
                    <li><span>Ежедневная чистая прибыль</span></li>
                    <li><span>Крупная сеть, состоящая из 11 салонов</span></li>
                    <li><span>Стабильная прибыль от 90 000 Р/месяц</span></li>
                    <li><span>Персональная система поддержки</span></li>
                </ul>

               <div class="for_a"><a href="#popUp" class="button comm call-popUp">Получить коммерческое предложение</a></div>
            </div>

         </div>
      </div>

      <div class="all-whiteBlock">
         <div class="noCompetitor-block">
            <div class="container">
               <div class="white-container">

                   <div class="noCompetitor-container row">
                        <?php include "inc/symbols_city.php";?>
                   </div>
               </div>
            </div>
         </div>

         <div class="contacts-block" id="contacts-block">
            <div id="map"></div>
            <div class="contacts-container">
               <h2 class="top-title">Контакты</h2>
               <ul class="contacts-list">
                  <li>
                     <a href="tel:+73422250078" class="title">+7 (342) 225-00-78</a>
                     <p>Контактный телефон</p>
                  </li>
                  <li>
                     <div class="title">Пермь, бульвар Гагарина, 66а</div>
                     <p>Адрес</p>
                  </li>
                  <li>
                     <a href="mailto:strizhka-franch@ya.ru" class="title">strizhka-franch@ya.ru</a>
                     <p>Электронная почта</p>
                  </li>
               </ul>
            </div>
         </div>
      </div>

<?php get_footer(); ?>