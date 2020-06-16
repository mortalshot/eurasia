document.addEventListener("DOMContentLoaded", function () {
    //header sticky
    var navOffset = $('.header-bottom').offset().top;
    $(window).scroll(function () {
        var scrolled = $(this).scrollTop();
        if (scrolled > navOffset) {
            //шапка прилипла
            $('.header').addClass('nav-fixed');
        } else if (scrolled < navOffset) {
            //шапка отлипла
            $('.header').removeClass('nav-fixed');
        }
    });

    //burger
    $('.header__burger').click(function (event) {
        $('.header__burger, .main-menu').toggleClass('active')
        $('body').toggleClass('lock')
    })

    // home slider
    $('.home-slider').slick({
        adaptiveHeight: true,
        responsive: [
            {
                breakpoint: 767,
                settings: {
                    dots: true,
                    arrows: false,
                }
            },
        ],
    });

    // ibg
    function ibg() {
        $.each($('.ibg'), function (index, val) {
            if ($(this).find('img').length > 0) {
                $(this).css('background-image', 'url("' + $(this).find('img').attr('src') + '")');
            }
        });
    }
    ibg();
});