// Определяем переменную map
var map;
// Функция initMap которая отрисует карту на странице
function initMap() {
    // В переменной map создаем объект карты GoogleMaps и вешаем эту переменную на <div id="map"></div>
    map = new google.maps.Map(document.getElementById('map'), {
        // При создании объекта карты необходимо указать его свойства
        // center - определяем точку на которой карта будет центрироваться
        center: {lat: 57.99756923, lng: 56.2846005},
        // zoom - определяет масштаб. 0 - видно всю платнеу. 18 - видно дома и улицы города.
        zoom: 16,
        //Стили карты
        styles: [{"featureType": "water","elementType": "geometry","stylers": [{"color": "#e9e9e9"},{"lightness": 17}]},{"featureType": "landscape","elementType": "geometry","stylers": [{"color": "#f5f5f5"},{"lightness": 20}]},{"featureType": "road.highway","elementType": "geometry.fill","stylers": [{"color": "#ffffff"},{"lightness": 17}]},{"featureType": "road.highway","elementType": "geometry.stroke","stylers": [{"color": "#ffffff"},{"lightness": 29},{"weight": 0.2}]},{"featureType": "road.arterial","elementType": "geometry","stylers": [{"color": "#ffffff"},{"lightness": 18}]},{"featureType": "road.local","elementType": "geometry","stylers": [{"color": "#ffffff"},{"lightness": 16}]},{"featureType": "poi","elementType": "geometry","stylers": [{"color": "#f5f5f5"},{"lightness": 21}]},{"featureType": "poi.park","elementType": "geometry","stylers": [{"color": "#dedede"},{"lightness": 21}]},{"elementType": "labels.text.stroke","stylers": [{"visibility": "on"},{"color": "#ffffff"},{"lightness": 16}]},{"elementType": "labels.text.fill","stylers": [{"saturation": 36},{"color": "#333333"},{"lightness": 40}]},{"elementType": "labels.icon","stylers": [{"visibility": "off"}]},{"featureType": "transit","elementType": "geometry","stylers": [{"color": "#f2f2f2"},{"lightness": 19}]},{"featureType": "administrative","elementType": "geometry.fill","stylers": [{"color": "#fefefe"},{"lightness": 20}]},{"featureType": "administrative","elementType": "geometry.stroke","stylers": [{"color": "#fefefe"},{"lightness": 17},{"weight": 1.2}]}],
        scrollwheel: false
    });
    var marker = new google.maps.Marker({
        // Определяем позицию маркера
        position: {lat: 57.99756923, lng: 56.2846005},
        // Указываем на какой карте он должен появится. (На странице ведь может быть больше одной карты)
        map: map,
        // Пишем название маркера - появится если навести на него курсор и немного подождать
        title: 'Стрижка за стрижкой',
        // Укажем свою иконку для маркера
        icon: '/img/location2.png'
    });
}

/*Якорь меню*/
// Cache selectors
var lastId,
    topMenu = $(".main-menu__block ul"),
    topMenuHeight = topMenu.outerHeight(),
// All list items
    menuItems = topMenu.find("a"),
// Anchors corresponding to menu items
    scrollItems = menuItems.map(function(){
        var item = $($(this).attr("href"));
        if (item.length) { return item; }
    });

// Bind click handler to menu items
// so we can get a fancy scroll animation
menuItems.click(function(e){
    var href = $(this).attr("href"),
        offsetTop = href === "#" ? 0 : $(href).offset().top - 40;
    $('html, body').stop().animate({
        scrollTop: offsetTop
    }, 1200);
    e.preventDefault();
});

// Bind to scroll
$(window).scroll(function(){
    // Get container scroll position
    var fromTop = $(this).scrollTop()+topMenuHeight;

    // Get id of current scroll item
    var cur = scrollItems.map(function(){
        if ($(this).offset().top < fromTop)
            return this;
    });
    // Get the id of the current element
    cur = cur[cur.length-1];
    var id = cur && cur.length ? cur[0].id : "";

    if (lastId !== id) {
        lastId = id;
        // Set/remove active class
        menuItems
            .parent().removeClass("active")
            .end().filter("[href='#"+id+"']").parent().addClass("active");
    }
});

function calc() {
    $(".calculate-block form").bind('click keyup', function() {
        var get_val_1 = parseInt($( ".col-vo input[name='col_vo']").val());
        var get_val_2 = $( "#slider-range-min").slider("value" );
        var get_val_3 = parseInt($( ".col-vo__clients input[name='col-vo__clients']" ).val());
        var get_val_4 = parseInt($( ".period input[name='period']" ).val());
        var final_price = get_val_3 * 30 * get_val_2 * get_val_1 * get_val_4 * 0.25;
        var newPrice = final_price.toLocaleString('ru');

        if (!isNaN(get_val_4)) {
            // var one = get_val_4;
            // if(one == 1){
            //     $('.calculate-application__container .period').html(one + " месяц");
            // } else if(one == 2 || one == 3 || one == 4){
            //     $('.calculate-application__container .period').html(one + " месяца");
            // } else if(one == 5 || one == 6 || one == 7 || one == 8 || one == 9 || one == 10){
            //     $('.calculate-application__container .period').html(one + " месяцев");
            // }
            var wordForm = function(num,word){  
                cases = [2, 0, 1, 1, 1, 2];  
                return word[ (num%100>4 && num%100<20)? 2 : cases[(num%10<5)?num%10:5] ];  
            }
            var count = get_val_4;
            var result = count+wordForm(count, [' месяц', ' месяца', ' месяцев']);
            $('.calculate-application__container .period').html(result);
        }else{
            $('.calculate-application__container .period').html("0");
        }
        if (!isNaN(final_price)) {
            $('.income-form p span, .calculate-application__container .calc-price').html(newPrice);
        }else{
            $('.income-form p span, .calculate-application__container .calc-price').html("0");
        }
        $('.calculate-application__container form input[name="form_hid"]').attr("value", "Кол салонов: " + get_val_1 + " Средний чек: " + get_val_2 + " Клиентов в день: " + get_val_3 + " Период: " + get_val_4 + " Прибыль: " + newPrice);
    });
    setTimeout(function() {
        var get_val_1 = parseInt($(".col-vo input[name='col_vo']").val());
        var get_val_2 = $("#slider-range-min").slider("value");
        var get_val_3 = parseInt($(".col-vo__clients input[name='col-vo__clients']").val());
        var get_val_4 = parseInt($(".period input[name='period']").val());
        var final_price = get_val_3 * 30 * get_val_2 * get_val_1 * get_val_4 * 0.25;
        var newPrice = final_price.toLocaleString('ru');

        if (!isNaN(get_val_4)) {
            // var one = get_val_4;
            // if(one == 1){
            //     $('.calculate-application__container .period').html(one + " месяц");
            // } else if(one == 2 || one == 3 || one == 4){
            //     $('.calculate-application__container .period').html(one + " месяца");
            // } else if(one == 5 || one == 6 || one == 7 || one == 8 || one == 9 || one == 10){
            //     $('.calculate-application__container .period').html(one + " месяцев");
            // }

            var wordForm = function(num,word){  
                cases = [2, 0, 1, 1, 1, 2];  
                return word[ (num%100>4 && num%100<20)? 2 : cases[(num%10<5)?num%10:5] ];  
            }
            var count = get_val_4;
            var result = count+wordForm(count, [' месяц', ' месяца', ' месяцев']);
            $('.calculate-application__container .period').html(result);
        }else{
            $('.calculate-application__container .period').html("0");
        }
        if (!isNaN(final_price)) {
            $('.income-form p span, .calculate-application__container .calc-price').html(newPrice);
        } else {
            $('.income-form p span, .calculate-application__container .calc-price').html("0");
        }

        $('.calculate-application__container form input[name="form_hid"]').attr("value", "Кол салонов: " + get_val_1 + " Средний чек: " + get_val_2 + " Клиентов в день: " + get_val_3 + " Период: " + get_val_4 + " Прибыль: " + newPrice);
    },100);
}

jQuery(document).ready(function(){
    calc();
});


function menu_fix2(){
    var height = $(".main-menu__block").height();
    var s_head = $(".all-whiteBlock").offset().top - 50;
    $(window).scroll(function(){
        var top = $(this).scrollTop();
        var elem = $('.main-menu__block');
        if (top >= s_head) {
            elem.addClass("active");
        }else{
            elem.removeClass("active");
        }
    });
    $(".menuAbsolute").css("padding-top", height)
}

$(window).resize(function () {
    menu_fix2();
    if($(window).width() < 991){
        $(".main-menu__block ul li a").click(function(){
            $(".main-menu__block ul").fadeOut(600);
            $(".toggle_mnu").toggleClass("active")
        });
    }
});

$(document).ready(function () {
    menu_fix2();
    calc();

    $(".col-block .caret .top").click(function () {
        $(this).parent().parent().find("input").val(parseInt($(this).parent().parent().find("input").val())+1);
    });

    $(".col-block .caret .bottom").click(function () {
        $(this).parent().parent().find("input").val(parseInt($(this).parent().parent().find("input").val())-1);
    });

    $('input[name="phone"]').mask('+7 999 999-99-99');

    // $(".for_form").each(function(){
    //     var self = this;
    //     $(this).validate({
    //         submitHandler: function(form) {
    //             var thisForm =$(form);
    //             $.ajax({
    //                 type: "POST",
    //                 url: "mail.php",
    //                 data: thisForm.serialize()
    //             }).done(function() {
    //                 $(self).find(":not(input[type=submit])").val("");
    //                 $(".error-captcha").removeClass("active");
    //                 $.magnificPopup.open({
    //                     items: {
    //                         src: '#thanks'
    //                     },
    //                     type: 'inline'
    //                 });
    //                 setTimeout(function() {
    //                     $.magnificPopup.close();
    //                 }, 3000);
    //             });
    //             return false;
    //         }
    //     });
    // });

    $(".for_form").submit(function(){ // перехватываем все при событии отправки
                var form = $(this); // запишем форму, чтобы потом не было проблем с this
                var error = false; // предварительно ошибок нет
                form.find('input[name="phone"]').each( function(){ // пробежим по каждому полю в форме
                    $(this).attr("style","");
                    if ($(this).val() == '') { // если находим пустое 
                        $(this).css({"border":"1px solid red"}); // говорим заполняй!
                        error = true; // ошибка
                    }
                });
                form.find('input[name="email"]').each( function(){ // пробежим по каждому полю в форме
                    $(this).attr("style","");
                    if ($(this).val() == '') { // если находим пустое 
                        $(this).css({"border":"1px solid red"}); // говорим заполняй!
                        error = true; // ошибка
                    }
                });




                
                if (!error) { // если ошибки нет
                    // var data = form.serialize(); // подготавливаем данные
                    // data.action = 'send_mess';
                    // // alert(222);
                    var data = {action: 'send_mess'};
                    var arr = form.serializeArray();
                    arr.forEach(function(el){
                        data[el.name] = el.value;
                    });
                    console.log(data);
                    $.post( ajaxurl, data, function(res) {
                        $.magnificPopup.open({
                                            items: {
                                                src: '#thanks'
                                            },
                                            type: 'inline'
                                        });
                    });

                    // $.ajax({ // инициализируем ajax запрос
                    //     type: 'POST', // отправляем в POST формате, можно GET
                    //     url: ajaxurl, // путь до обработчика, у нас он лежит в той же папке
                    //     dataType: 'json', // ответ ждем в json формате
                    //     data: data,
                    //    beforeSend: function(data) { // событие до отправки
                    //         form.find('input[type="submit"]').attr('disabled', 'disabled'); // например, отключим кнопку, чтобы не жали по 100 раз
                    //       },
                    //    success: function(data){ // событие после удачного обращения к серверу и получения ответа
                    //         if (data['error']) { // если обработчик вернул ошибку
                    //             //alert(data['error']); // покажем её текст
                    //             $.magnificPopup.open({
                    //                 items: {
                    //                     src: '#thanks'
                    //                 },
                    //                 type: 'inline'
                    //             });
                    //             yaCounter45099798.reachGoal('ORDER');
                    //             //ga('send', 'pageview', '/virtual/zakaz');
                    //             setTimeout(function() {
                    //                 $.magnificPopup.close();
                    //             }, 3000);
                    //         } else { // если все прошло ок
                    //             form.find('label input').each( function(){ // пробежим по каждому полю в форме
                    //                 $(this).val("");
                    //             });
                    //             $.magnificPopup.open({
                    //                 items: {
                    //                     src: '#thanks'
                    //                 },
                    //                 type: 'inline'
                    //             });
                    //             yaCounter45099798.reachGoal('ORDER');
                    //             //ga('send', 'pageview', '/virtual/zakaz');
                    //             setTimeout(function() {
                    //                 $.magnificPopup.close();
                    //             }, 3000);
                    //
                    //         }
                    //      },
                    //    error: function (xhr, ajaxOptions, thrownError) { // в случае неудачного завершения запроса к серверу
                    //         //alert(xhr.status);
                    //         //alert(thrownError);
                    //         $.magnificPopup.open({
                    //             items: {
                    //                 src: '#thanks'
                    //             },
                    //             type: 'inline'
                    //         });
                    //         // yaCounter45099798.reachGoal('ORDER');
                    //         //     ga('send', 'pageview', '/virtual/zakaz');
                    //         setTimeout(function() {
                    //             $.magnificPopup.close();
                    //         }, 3000);
                    //            },
                    //    complete: function(data) { // событие после любого исхода
                    //         form.find('input[type="submit"]').prop('disabled', false); // в любом случае включим кнопку обратно
                    //         }
                    //
                    //
                    //      });
                }
                return false; // вырубаем стандартную отправку формы
            }); 

    $('ul.history-nav').on('click', 'li:not(.active)', function() {
        $(this)
            .addClass('active').siblings().removeClass('active')
            .closest('div.history-tabs').find('div.tabs_content').removeClass('active').eq($(this).index()).addClass('active');
    });

    $(".question-items .answer-block").hide();

    $(".question-items .question-block").on("click", function(){
        if($(this).hasClass('active')){
            $(this).removeClass("active");
            $(this).siblings('.answer-block').slideUp(300);
        }else{
            $(".question-items .question-block").removeClass("active");
            $(this).addClass("active");
            $('.question-items .answer-block').slideUp(300);
            $(this).siblings('.answer-block').slideDown(300);
        }
    });

    $(".toggle_mnu").click(function() {
        $(".toggle_mnu, body, .main-menu__block ul").toggleClass("active");
    });

    $('.photos-item').magnificPopup({
        delegate: 'a', // the selector for gallery item
        type: 'image',
        gallery: {
            enabled:true
        }
    });


    $(".video-item").click(function () {
       $("#video-block iframe").attr("src", $(this).parent().find(".video-link").text());
    }).magnificPopup({
        type: 'inline'
    });
    $(".video-item2").click(function () {
       $("#video-block iframe").attr("src", $(this).parent().find(".video-link").text());
    }).magnificPopup({
        type: 'inline'
    });

    $(".photosGallery-slider").slick({
        slidesToScroll: 1,
        slidesToShow: 1,
        arrows: false,
        dots: false
    });
    $('.photosGallery-nav .next').click(function(){
        $(".photosGallery-slider").slick('slickNext');
    });
    $('.photosGallery-nav .prev').click(function(){
        $(".photosGallery-slider").slick('slickPrev');
    });

    $(".call-popUp").click(function () {
        if($(this).hasClass("phone-button")){
            $("#popUp .title").html("Обратный звонок");
            $("#popUp input[name='form_hid']").attr("value", "Обратный звонок");
            $("#popUp input[type='submit']").attr("value", "Заказать");
        }
        if($(this).hasClass("comm")){
            $("#popUp .title").html("Получить коммерческое предложение");
            $("#popUp input[name='form_hid']").attr("value", "Получить коммерческое предложение");
            $("#popUp input[type='submit']").attr("value", "Получить");
        }
        if($(this).hasClass("more")){
            $("#popUp .title").html("Фраешиза" + $(this).parent().parent().parent().find(".franchiseVariant-moreInf").text());
            $("#popUp input[name='form_hid']").attr("value", "Фраешиза" + $(this).parent().parent().parent().find(".franchiseVariant-moreInf").text());
            $("#popUp input[type='submit']").attr("value", "Получить");
        }
    }).magnificPopup({
        type: "inline"
    });

    $(".monthly-averages__nav .worse").click(function () {
        $(this).addClass("active");
        $(".monthly-averages__value-container.worse").addClass("active");
        $(".monthly-averages__value-container.better").removeClass("active");
        $(".monthly-averages__nav .better").removeClass("active");
    });
    $(".monthly-averages__nav .better").click(function () {
        $(this).addClass("active");
        $(".monthly-averages__value-container.better").addClass("active");
        $(".monthly-averages__value-container.worse").removeClass("active");
        $(".monthly-averages__nav .worse").removeClass("active");
    });

    $(".select-block").each(function () {
        $(this).find(".caret").click(function () {
            $(this).parent().parent().find("ul").slideToggle(300);
            $(this).parent().parent().find("ul").find("li").click(function () {
                $(this).parent().parent().find("input").attr("value", $(this).text());
                $(this).parent().slideUp(300);
            })
        });
    });

    $( function() {
        $( "#slider-range-min" ).slider({
            range: "min",
            value: 253,
            min: 180,
            max: 400,
            slide: function( event, ui ) {
                $( "#amount" ).val(ui.value );
                calc();
            }
        });
        $( "#amount" ).val($( "#slider-range-min" ).slider( "value" ) );
    } );

    // ga(function(tracker) {
    //
    //   var clientId = tracker.get('clientId');
    //   $( "input[name=idgoo]").val(clientId);
    //
    // });

});