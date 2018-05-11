ymaps.ready(init);
ymaps.ready(init1);

function init () {
    var myMap = new ymaps.Map("map", {
            center: [54.720012, 56.004772],
            zoom: 13
        }),

    // Создаем геообъект с типом геометрии "Точка".
    myGeoObject = new ymaps.GeoObject();
    myMap.geoObjects
        .add(myGeoObject)
        .add(new ymaps.Placemark([54.720012, 56.004772], {
            balloonContent: 'ул. Менделеева, д.171/1'
        }, {
             iconLayout: 'default#image',
            iconImageHref: 'img1/mark.png',
            iconImageSize: [20, 32],
            iconImageOffset: [0, 0]
        }));
}

function init1 () {
    var myMap = new ymaps.Map("map1", {
            center: [54.720012, 56.004772],
            zoom: 13
        }),

    // Создаем геообъект с типом геометрии "Точка".
    myGeoObject = new ymaps.GeoObject();
    myMap.geoObjects
        .add(myGeoObject)
        .add(new ymaps.Placemark([54.720012, 56.004772], {
            balloonContent: 'ул. Вокзальная, д.65'
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

$( "a.prmbtn" ).click(function( event ) {
  event.preventDefault();
  $( ".prm" ).css( "display","block" );
  $( ".chaik" ).css( "display","none" );
  
  $( "a.chkbtn" ).css( "border-bottom","1px dotted white" );
  $( ".chose a.chkbtn" ).css( "border-bottom","1px dotted #56483a" );
  $( "a.prmbtn" ).css( "border-bottom","1px dotted transparent" );
});
$( "a.chkbtn" ).click(function( event ) {
  event.preventDefault();
  $( ".chaik" ).css( "display","block" );
  $( ".prm" ).css( "display","none" );
  
  $( "a.prmbtn" ).css( "border-bottom","1px dotted white" );
  $( ".chose a.prmbtn" ).css( "border-bottom","1px dotted #56483a" );
  $( "a.chkbtn" ).css( "border-bottom","1px dotted transparent" );
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