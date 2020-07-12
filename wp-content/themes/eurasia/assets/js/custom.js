document.addEventListener("DOMContentLoaded", function () {
    // !header sticky
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

    // !mini-cart
    $('.header-cart-wrapper').hover(function () {
        $('.mini-cart').addClass('mini-cart--open');
    }, function () {
        $('.header-cart-wrapper').data('timer', setTimeout(function () {
            $('.mini-cart').removeClass('mini-cart--open');
        }, 200));
    })

    // !burger
    $('.header__burger').click(function (event) {
        $('.header__burger, .main-menu').toggleClass('active')
        $('body').toggleClass('lock')
    })

    // !home slider
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

    // !best-selling-products slider
    $('.best-selling-products .products, .recent-products .products').slick({
        slidesToShow: 4,
        waitForAnimate: false,
        responsive: [
            {
                breakpoint: 1200,
                settings: {
                    slidesToShow: 3
                }
            },
            {
                breakpoint: 880,
                settings: {
                    slidesToShow: 2
                }
            },
            {
                breakpoint: 650,
                settings: {
                    arrows: false,
                    slidesToShow: 2
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
            }
        ]
    });

    // !ibg
    function ibg() {
        $.each($('.ibg'), function (index, val) {
            if ($(this).find('img').length > 0) {
                $(this).css('background-image', 'url("' + $(this).find('img').attr('src') + '")');
            }
        });
    }
    ibg();

    // !Динамический адаптив
    (function () {
        let originalPositions = [];
        let daElements = document.querySelectorAll('[data-da]');
        let daElementsArray = [];
        let daMatchMedia = [];
        //Заполняем массивы
        if (daElements.length > 0) {
            let number = 0;
            for (let index = 0; index < daElements.length; index++) {
                const daElement = daElements[index];
                const daMove = daElement.getAttribute('data-da');
                if (daMove != '') {
                    const daArray = daMove.split(',');
                    const daPlace = daArray[1] ? daArray[1].trim() : 'last';
                    const daBreakpoint = daArray[2] ? daArray[2].trim() : '767';
                    const daType = daArray[3] === 'min' ? daArray[3].trim() : 'max';
                    const daDestination = document.querySelector('.' + daArray[0].trim())
                    if (daArray.length > 0 && daDestination) {
                        daElement.setAttribute('data-da-index', number);
                        //Заполняем массив первоначальных позиций
                        originalPositions[number] = {
                            "parent": daElement.parentNode,
                            "index": indexInParent(daElement)
                        };
                        //Заполняем массив элементов 
                        daElementsArray[number] = {
                            "element": daElement,
                            "destination": document.querySelector('.' + daArray[0].trim()),
                            "place": daPlace,
                            "breakpoint": daBreakpoint,
                            "type": daType
                        }
                        number++;
                    }
                }
            }
            dynamicAdaptSort(daElementsArray);

            //Создаем события в точке брейкпоинта
            for (let index = 0; index < daElementsArray.length; index++) {
                const el = daElementsArray[index];
                const daBreakpoint = el.breakpoint;
                const daType = el.type;

                daMatchMedia.push(window.matchMedia("(" + daType + "-width: " + daBreakpoint + "px)"));
                daMatchMedia[index].addListener(dynamicAdapt);
            }
        }
        //Основная функция
        function dynamicAdapt(e) {
            for (let index = 0; index < daElementsArray.length; index++) {
                const el = daElementsArray[index];
                const daElement = el.element;
                const daDestination = el.destination;
                const daPlace = el.place;
                const daBreakpoint = el.breakpoint;
                const daClassname = "_dynamic_adapt_" + daBreakpoint;

                if (daMatchMedia[index].matches) {
                    //Перебрасываем элементы
                    if (!daElement.classList.contains(daClassname)) {
                        let actualIndex = indexOfElements(daDestination)[daPlace];
                        if (daPlace === 'first') {
                            actualIndex = indexOfElements(daDestination)[0];
                        } else if (daPlace === 'last') {
                            actualIndex = indexOfElements(daDestination)[indexOfElements(daDestination).length];
                        }
                        daDestination.insertBefore(daElement, daDestination.children[actualIndex]);
                        daElement.classList.add(daClassname);
                    }
                } else {
                    //Возвращаем на место
                    if (daElement.classList.contains(daClassname)) {
                        dynamicAdaptBack(daElement);
                        daElement.classList.remove(daClassname);
                    }
                }
            }
            customAdapt();
        }

        //Вызов основной функции
        dynamicAdapt();

        //Функция возврата на место
        function dynamicAdaptBack(el) {
            const daIndex = el.getAttribute('data-da-index');
            const originalPlace = originalPositions[daIndex];
            const parentPlace = originalPlace['parent'];
            const indexPlace = originalPlace['index'];
            const actualIndex = indexOfElements(parentPlace, true)[indexPlace];
            parentPlace.insertBefore(el, parentPlace.children[actualIndex]);
        }
        //Функция получения индекса внутри родителя
        function indexInParent(el) {
            var children = Array.prototype.slice.call(el.parentNode.children);
            return children.indexOf(el);
        }
        //Функция получения массива индексов элементов внутри родителя 
        function indexOfElements(parent, back) {
            const children = parent.children;
            const childrenArray = [];
            for (let i = 0; i < children.length; i++) {
                const childrenElement = children[i];
                if (back) {
                    childrenArray.push(i);
                } else {
                    //Исключая перенесенный элемент
                    if (childrenElement.getAttribute('data-da') == null) {
                        childrenArray.push(i);
                    }
                }
            }
            return childrenArray;
        }
        //Сортировка объекта
        function dynamicAdaptSort(arr) {
            arr.sort(function (a, b) {
                if (a.breakpoint > b.breakpoint) { return -1 } else { return 1 }
            });
            arr.sort(function (a, b) {
                if (a.place > b.place) { return 1 } else { return -1 }
            });
        }
        //Дополнительные сценарии адаптации
        function customAdapt() {
            //const viewport_width = Math.max(document.documentElement.clientWidth, window.innerWidth || 0);
        }
    }());

    // !Выделение звездочек
    const ratingItemList = document.querySelectorAll('.comment-rating__item');
    const ratingItemsArray = Array.prototype.slice.call(ratingItemList);
    ratingItemsArray.forEach(item =>
        item.addEventListener('click', () => {
            item.parentNode.dataset.totalValue = item.dataset.itemValue
        })
    );

    // !Маска на ввод номера телефона
    $("#billing_phone").mask("+7(999) 999-9999");


    $('.custom_add_to_cart').click(function (e) {
        e.preventDefault();
        var id = $(this).next().next().next().attr('value');
        var data = {
            product_id: id,
            quantity: 1
        };
        $(this).parent().addClass('loading');
        $.post(wc_add_to_cart_params.wc_ajax_url.toString().replace('%%endpoint%%', 'add_to_cart'), data, function (response) {

            if (!response) {
                return;
            }
            if (response.error) {
                alert("Custom Massage ");
                $('.custom_add_to_cart').parent().removeClass('loading');
                return;
            }
            if (response) {

                var url = woocommerce_params.wc_ajax_url;
                url = url.replace("%%endpoint%%", "get_refreshed_fragments");
                $.post(url, function (data, status) {
                    $(".woocommerce.widget_shopping_cart").html(data.fragments["div.widget_shopping_cart_content"]);
                    if (data.fragments) {
                        jQuery.each(data.fragments, function (key, value) {

                            jQuery(key).replaceWith(value);
                        });
                    }
                    jQuery("body").trigger("wc_fragments_refreshed");
                });
                $('.custom_add_to_cart').parent().removeClass('loading');

            }
        });
    });
});