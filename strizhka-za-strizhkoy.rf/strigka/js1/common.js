ymaps.ready(init1);
ymaps.ready(init2);
ymaps.ready(init3);
ymaps.ready(init4);

function init1 () {
    var myMap = new ymaps.Map("map1", {
            center: [58.010259, 56.234195],
            zoom: 13
        }),

    // Создаем геообъект с типом геометрии "Точка".
    myGeoObject = new ymaps.GeoObject();
    myMap.geoObjects
        .add(myGeoObject)
        .add(new ymaps.Placemark([58.015604, 56.279902], {
            balloonContent: 'ул. Крупской, д.40'
        }, {
             iconLayout: 'default#image',
            iconImageHref: 'img1/mark.png',
            iconImageSize: [20, 32],
            iconImageOffset: [0, 0]
        }))
        .add(new ymaps.Placemark([57.977624, 56.207464], {
            balloonContent: 'ул. Декабристов, д.13'
        }, {
             iconLayout: 'default#image',
            iconImageHref: 'img1/mark.png',
            iconImageSize: [20, 32],
            iconImageOffset: [0, 0]
        }))
        .add(new ymaps.Placemark([58.019589, 56.292101], {
            balloonContent: 'ул. КИМ, д.83'
        }, {
             iconLayout: 'default#image',
            iconImageHref: 'img1/mark.png',
            iconImageSize: [20, 32],
            iconImageOffset: [0, 0]
        }))
        .add(new ymaps.Placemark([58.007408, 56.230629], {
            balloonContent: 'ул. Eкатеринская, д.134'
        }, {
             iconLayout: 'default#image',
            iconImageHref: 'img1/mark.png',
            iconImageSize: [20, 32],
            iconImageOffset: [0, 0]
        }))
        .add(new ymaps.Placemark([58.005219, 56.271691], {
            balloonContent: 'ул. Революции, д.8'
        }, {
            iconLayout: 'default#image',
            iconImageHref: 'img1/mark.png',
            iconImageSize: [20, 32],
            iconImageOffset: [0, 0]
        }))
        .add(new ymaps.Placemark([57.998776, 56.154129], {
            balloonContent: 'пр. Парковый, д.15/6б'
        }, {
            iconLayout: 'default#image',
            iconImageHref: 'img1/mark.png',
            iconImageSize: [20, 32],
            iconImageOffset: [0, 0]
        }))
        .add(new ymaps.Placemark([57.998275, 56.24431], {
            balloonContent: 'ул. Глеба Успенского, 8'
        }, {
            iconLayout: 'default#image',
            iconImageHref: 'img1/mark.png',
            iconImageSize: [20, 32],
            iconImageOffset: [0, 0]
        }))
        .add(new ymaps.Placemark([58.004284, 56.305175], {
            balloonContent: 'ул. Уинская, д.8'
        }, {
            iconLayout: 'default#image',
            iconImageHref: 'img1/mark.png',
            iconImageSize: [20, 32],
            iconImageOffset: [0, 0]
        }));
}

function init2 () {
    var myMap = new ymaps.Map("map2", {
            center: [56.768678, 54.12642],
            zoom: 13
        }),

    // Создаем геообъект с типом геометрии "Точка".
    myGeoObject = new ymaps.GeoObject();
    myMap.geoObjects
        .add(myGeoObject)
        .add(new ymaps.Placemark([56.766627, 54.15509], {
            balloonContent: 'ул. Вокзальная, д.65'
        }, {
             iconLayout: 'default#image',
            iconImageHref: 'img1/mark.png',
            iconImageSize: [20, 32],
            iconImageOffset: [0, 0]
        }))
        .add(new ymaps.Placemark([57.977624, 56.207464], {
            balloonContent: 'ул. Декабристов, д.13'
        }, {
             iconLayout: 'default#image',
            iconImageHref: 'img1/mark.png',
            iconImageSize: [20, 32],
            iconImageOffset: [0, 0]
        }))
        .add(new ymaps.Placemark([56.761462, 54.097786], {
            balloonContent: 'ул. Советская, д.22'
        }, {
             iconLayout: 'default#image',
            iconImageHref: 'img1/mark.png',
            iconImageSize: [20, 32],
            iconImageOffset: [0, 0]
        }))
        .add(new ymaps.Placemark([56.778781, 54.148532], {
            balloonContent: 'ул. Карла Маркса, 20'
        }, {
             iconLayout: 'default#image',
            iconImageHref: 'img1/mark.png',
            iconImageSize: [20, 32],
            iconImageOffset: [0, 0]
        }))
        .add(new ymaps.Placemark([56.774401, 54.139827], {
            balloonContent: 'ул. Вокзальная, д.23'
        }, {
            iconLayout: 'default#image',
            iconImageHref: 'img1/mark.png',
            iconImageSize: [20, 32],
            iconImageOffset: [0, 0]
        }));
}
function init3 () {
    var myMap = new ymaps.Map("map3", {
            center: [59.8563589, 30.2228124],
            zoom: 13
        }),

    // Создаем геообъект с типом геометрии "Точка".
    myGeoObject = new ymaps.GeoObject();
    myMap.geoObjects
        .add(myGeoObject)
        .add(new ymaps.Placemark([59.8563589, 30.2228124], {
            balloonContent: 'пр. Маршала Жукова д.35 корпус 3'
        }, {
             iconLayout: 'default#image',
            iconImageHref: 'img1/mark.png',
            iconImageSize: [20, 32],
            iconImageOffset: [0, 0]
        }))
        
}
function init4 () {
    var myMap = new ymaps.Map("map4", {
            center: [51.70669, 39.1650391],
            zoom: 13
        }),

    // Создаем геообъект с типом геометрии "Точка".
    myGeoObject = new ymaps.GeoObject();
    myMap.geoObjects
        .add(myGeoObject)
        .add(new ymaps.Placemark([51.70669, 39.1650391], {
            balloonContent: 'ул. Генерала Лизюкова,д.38'
        }, {
             iconLayout: 'default#image',
            iconImageHref: 'img1/mark.png',
            iconImageSize: [20, 32],
            iconImageOffset: [0, 0]
        }))
       
}

// $( "a.prmbtn" ).click(function( event ) {
//   event.preventDefault();
//   $( ".prm" ).css( "display","block" );
//   $( ".chaik" ).css( "display","none" );
  
//   $( "a.chkbtn" ).css( "border-bottom","1px dotted white" );
//   $( ".chose a.chkbtn" ).css( "border-bottom","1px dotted #56483a" );
//   $( "a.prmbtn" ).css( "border-bottom","1px dotted transparent" );
// });
// $( "a.chkbtn:eq(0)" ).click(function( event ) {
//   event.preventDefault();
//   $( ".chaik" ).css( "display","block" );
//   $( ".prm" ).css( "display","none" );
  
//   $( "a.prmbtn" ).css( "border-bottom","1px dotted white" );
//   $( ".chose a.prmbtn" ).css( "border-bottom","1px dotted #56483a" );
//   $( "a.chkbtn" ).css( "border-bottom","1px dotted transparent" );
// });
// 	$( "a.chkbtn:eq(1)" ).click(function( event ) {
//   event.preventDefault();
//   $( ".chaik" ).css( "display","block" );
//   $( ".prm" ).css( "display","none" );
  
//   $( "a.prmbtn" ).css( "border-bottom","1px dotted white" );
//   $( ".chose a.prmbtn" ).css( "border-bottom","1px dotted #56483a" );
//   $( "a.chkbtn" ).css( "border-bottom","1px dotted transparent" );
// });
// 
$('.choose_btn').click(function(e) {
   
   e.preventDefault();

   var id = $(this).attr('data-id');

   //визуальное выдиление кнопок старт
   $('.choose_btn').css("border-bottom","1px dotted transparent");

   $('.choose_btn').each(function(){
        if ($(this).attr('data-id') != id) {
            if($(this).hasClass('bot_btn')){
                $(this).css( "border-bottom","1px dotted white" );
            }else{
                $(this).css( "border-bottom","1px dotted #56483a" );
            }
        }
   });
   //визуальное выдиление кнопок конец


   //перекючение телефона старт
   $('.choose_numb').css( "display","none" );
   $('.choose_numb[data-id="'+id+'"]').css( "display","block" );
   //перекючение телефона конец

   //перекючение прайса старт
   $('.choose_price').css( "display","none" );
   $('.choose_price[data-id="'+id+'"]').css( "display","block" );

    $('.choose_prices').css( "display","none" );
   $('.choose_prices[data-id="'+id+'"]').css( "display","block" );
   //перекючение прайса конец
   //
   //
   $('.choose_presents').css( "display","none" );
   $('.choose_presents[data-id="'+id+'"]').css( "display","block" );

   $('.choose_presents').css( "display","none" );
   $('.choose_presents[data-id="'+id+'"]').css( "display","block" );

   $('.choose_works').css( "display","none" );
   $('.choose_works[data-id="'+id+'"]').css( "display","block" );

   $('.choose_manik').css( "display","none" );
   $('.choose_manik[data-id="'+id+'"]').css( "display","block" );

    $('.choose_tonirovka_man').css( "display","none" );
   $('.choose_tonirovka_man[data-id="'+id+'"]').css( "display","inline-block" );

    $('.choose_tonirovka_woman').css( "display","none" );
   $('.choose_tonirovka_woman[data-id="'+id+'"]').css( "display","inline-block" );

   $('.choose_yslygi').css( "display","none" );
   $('.choose_yslygi[data-id="'+id+'"]').css( "display","inline-block" );

    $('.choose_yslygi2').css( "display","none" );
   $('.choose_yslygi2[data-id="'+id+'"]').css( "display","inline-block" );

   $('.choose_yslygi3').css( "display","none" );
   $('.choose_yslygi3[data-id="'+id+'"]').css( "display","inline-block" );

   $('.choose_ykladka1').css( "display","none" );
   $('.choose_ykladka1[data-id="'+id+'"]').css( "display","inline-block" );

    $('.choose_ykladka2').css( "display","none" );
   $('.choose_ykladka2[data-id="'+id+'"]').css( "display","inline-block" );

    $('.choose_ykladka3').css( "display","none" );
   $('.choose_ykladka3[data-id="'+id+'"]').css( "display","inline-block" );

    $('.choose_ykladka4').css( "display","none" );
   $('.choose_ykladka4[data-id="'+id+'"]').css( "display","inline-block" );

    $('.choose_zal').css( "display","none" );
   $('.choose_zal[data-id="'+id+'"]').css( "display","block" );

   $('.choose_adress').css( "display","none" );
   $('.choose_adress[data-id="'+id+'"]').css( "display","block" );


   $('.choose_solar').css( "display","none" );
   $('.choose_solar[data-id="'+id+'"]').css( "display","block" );

    $('.chosse_otz').css( "display","none" );
   $('.chosse_otz[data-id="'+id+'"]').css( "display","block" );


    $('.choose_map').css( "display","none" );
   $('.choose_map[data-id="'+id+'"]').css( "display","block" );

    $('.choose_fotnumb').css( "display","none" );
   $('.choose_fotnumb[data-id="'+id+'"]').css( "display","block" );




});

    $(document).ready(
    function(){
        $("a.scrollto").click(function(){
            var elementClick=$(this).attr("href")
            var destination=$(elementClick).offset().top;
            jQuery("html:not(:animated),body:not(:animated)").animate({scrollTop:destination},1000);
            return false;
        });
        $(function(){
            if($('.headline').length>0){
                $('.headline').css('z-index',300);
                var menu=$('.headline').offset().top;
                $(window).scroll(
                    function(){
                        if($(this).scrollTop()>menu){
                            if($('.headline').css('position')!='fixed'){
                                $('.headline').css({'position':'fixed','top':'0px'});
                            }}
                            else{
                                if($('.headline').css('position')!='static'){$('.headline').css({'position':'static'});}}});}});});