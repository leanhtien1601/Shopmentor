var GUI = (function () {
    var win = $(window);
    var html = $('html,body');

    var animant = function () {
        wow = new WOW({

        });
        wow.init();
    }

    // var header_top = function () {

    //     var header = document.querySelectorAll('.haki_t');
    //     var header = header[0];

    //     //Truy xuất div menu
    //     var trangthai = "duoi100";
    //     window.addEventListener("scroll", function () {
    //         var x = pageYOffset;
    //         if (x > 50) {
    //             if (trangthai == "duoi100") {
    //                 trangthai = "tren100";
    //                 header.classList.add('menu_back');
    //             }
    //         }
    //         else {
    //             if (trangthai == "tren100") {
    //                 header.classList.remove('menu_back');
    //                 trangthai = "duoi100";
    //             }
    //         }

    //     })

    // }
    var slide = function () {
        var swiper = new Swiper('.slide_banner', {
            pagination: {
                el: '.swiper-pagination',
            },
        });
    }
    var slide_blog = function () {
        var swiper = new Swiper('.blog_slide', {
            slidesPerView: 3,
            spaceBetween: 30,
            pagination: {
                el: '.swiper-pagination',
                clickable: true,
            },
        });
    }
    var list_image = function () {
        var galleryThumbs = new Swiper('.gallery-thumbs', {
            spaceBetween: 10,
            slidesPerView: 4,
            freeMode: true,
            watchSlidesVisibility: true,
            watchSlidesProgress: true,
        });
        var galleryTop = new Swiper('.gallery-top', {
            spaceBetween: 10,
            navigation: {
                nextEl: '.swiper-button-next',
                prevEl: '.swiper-button-prev',
            },
            thumbs: {
                swiper: galleryThumbs
            }
        });
    }
   
    return {
        _: function () {
            animant();
            slide();
            slide_blog();
            list_image();
          
        }
    };
})();

$(document).ready(function ($) {
    GUI._();
});
