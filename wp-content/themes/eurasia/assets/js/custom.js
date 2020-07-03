document.addEventListener("DOMContentLoaded", function () {
    //header sticky
    var navOffset = $('.header-bottom').offset().top;
    // alert (navOffset);
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
                    arrows: false,
                    dots: true,
                }
            },
        ]
    });
    $('.home-slider').slick('setPosition');

    // best-selling-products slider
    $('.best-selling-products .products, .recent-products .products').slick({
        slidesToShow: 4,
        responsive: [
            {
                breakpoint: 1200,
                settings: {
                    slidesToShow: 3,
                }
            },
            {
                breakpoint: 880,
                settings: {
                    slidesToShow: 2,
                }
            },
            {
                breakpoint: 650,
                settings: {
                    arrows: false,
                    slidesToShow: 2,
                }
            },
            {
                breakpoint: 550,
                settings: {
                    arrows: false,
                    slidesToShow: 1,
                    variableWidth: true,
                    centerMode: true,
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