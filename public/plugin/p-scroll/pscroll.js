(function($) {
    "use strict";
    
    // Функция для проверки существования элемента перед инициализацией PerfectScrollbar
    function initScrollbarIfExists(selector) {
        const element = document.querySelector(selector);
        if (element) {
            return new PerfectScrollbar(selector, {
                useBothWheelAxes: true,
                suppressScrollX: true,
                suppressScrollY: false,
            });
        }
        return null;
    }

    // Инициализация для каждого элемента только если он существует
    const ps1 = initScrollbarIfExists('.header-dropdown-list');
    const ps2 = initScrollbarIfExists('.notifications-menu');
    const ps3 = initScrollbarIfExists('.message-menu-scroll');

    //P-scrolling
})(jQuery);