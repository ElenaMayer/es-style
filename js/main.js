/*-----------------------------------------------------------------------------------

  Template Name: Eme eCommerce HTML5 Template.
  Template URI: #
  Description: Eme is a unique website template designed in HTML with a simple & beautiful look. There is an excellent solution for creating clean, wonderful and trending material design corporate, corporate any other purposes websites.
  Author: HasTech
  Author URI: https://themeforest.net/user/hastech/portfolio
  Version: 1.0

-----------------------------------------------------------------------------------*/

/*-------------------------------
[  Table of contents  ]
---------------------------------
  01. jQuery MeanMenu
  02. wow js active
  03. Portfolio  Masonry (width)


/*--------------------------------
[ End table content ]
-----------------------------------*/


(function($) {
    'use strict';


/*-------------------------------------------
  01. jQuery MeanMenu
--------------------------------------------- */
    
$('.mobile-menu nav').meanmenu({
    meanMenuContainer: '.mobile-menu-area',
    meanScreenWidth: "991",
    meanRevealPosition: "right",
});

/*-------------------------------------------
  02. wow js active
--------------------------------------------- */
    new WOW().init();
/*-------------------------------------------
  03. Portfolio  Masonry (width)
--------------------------------------------- */ 
  $('.ml-portfolio-page').imagesLoaded( function() {
      // filter items on button click
      $('#ml-filters').on('click', 'li', function () {
          var filterValue = $(this).attr('data-filter');
          $containerpage.isotope({ filter: filterValue });
      });
      // change is-checked class on buttons
      $('#ml-filters li').on('click', function () {
          $('#ml-filters li').removeClass('is-checked');
          $(this).addClass('is-checked');
          var selector = $(this).attr('data-filter');
          $containerpage.isotope({ filter: selector });
          return false;
      });
      var $containerpage = $('.ml-portfolio-page');
      $containerpage.isotope({
          itemSelector: '.pro-item',
          filter: '*',
          transitionDuration: '0.7s',
          masonry: {
              columnWidth: '.pro-item'
          }
        });
    });



/*-------------------------------------------
  06. Sticky Header
--------------------------------------------- */ 
  var win = $(window);
  var sticky_id = $("#sticky-header-with-topbar");
  win.on('scroll',function() {    
    var scroll = win.scrollTop();
    if (scroll < 245) {
      sticky_id.removeClass("scroll-header");
    }else{
      sticky_id.addClass("scroll-header");
    }
  });

/*--------------------------
  11. ScrollUp
---------------------------- */
$.scrollUp({
    scrollText: '<i class="zmdi zmdi-chevron-up"></i>',
    easingType: 'linear',
    scrollSpeed: 900,
    animation: 'fade'
});




/*-------------------------------------------
  03. Product  Masonry (width)
--------------------------------------------- */ 

$('.htc__product__container').imagesLoaded( function() {
  
    // filter items on button click
    $('.product__menu').on( 'click', 'button', function() {
      var filterValue = $(this).attr('data-filter');
      $grid.isotope({ filter: filterValue });
    }); 
    // init Isotope
    var $grid = $('.product__list').isotope({
      itemSelector: '.single__pro',
      percentPosition: true,
      transitionDuration: '0.7s',
      masonry: {
        // use outer width of grid-sizer for columnWidth
        columnWidth: '.single__pro',
      }
    });

});

$('.product__menu button').on('click', function(event) {
    $(this).siblings('.is-checked').removeClass('is-checked');
    $(this).addClass('is-checked');
    event.preventDefault();
});

/*------------------------------------    
  09. Search Bar
--------------------------------------*/ 
    
  $( '.search__open' ).on( 'click', function () {
    $( 'body' ).toggleClass( 'search__box__show__hide' );
    return false;
  });

  $( '.search__close__btn .search__close__btn_icon' ).on( 'click', function () {
    $( 'body' ).toggleClass( 'search__box__show__hide' );
    return false;
  });

/*------------------------------------    
  11. Shopping Cart Area
--------------------------------------*/

  $('.cart__menu').on('click', function() {
    $('.shopping__cart').addClass('shopping__cart__on');
    $('.body__overlay').addClass('is-visible');

  });

  $('.offsetmenu__close__btn').on('click', function() {
      $('.shopping__cart').removeClass('shopping__cart__on');
      $('.body__overlay').removeClass('is-visible');
  });


/*------------------------------------    
  12. Filter Area
--------------------------------------*/

  $('.filter__menu').on('click', function() {
    $('.filter__wrap').addClass('filter__menu__on');
    $('.body__overlay').addClass('is-visible');

  });

  $('.filter__menu__close__btn').on('click', function() {
      $('.filter__wrap').removeClass('filter__menu__on');
      $('.body__overlay').removeClass('is-visible');
  });



/*------------------------------------    
  10. Toogle Menu
--------------------------------------*/

  $('.toggle__menu').on('click', function() {
    $('.offsetmenu').addClass('offsetmenu__on');
    $('.body__overlay').addClass('is-visible');

  });

  $('.offsetmenu__close__btn').on('click', function() {
      $('.offsetmenu').removeClass('offsetmenu__on');
      $('.body__overlay').removeClass('is-visible');
  });

/*------------------------------------    
  13. User Menu
--------------------------------------*/

  $('.user__menu').on('click', function() {
    $('.user__meta').addClass('user__meta__on');
    $('.body__overlay').addClass('is-visible');

  });

  $('.offsetmenu__close__btn').on('click', function() {
      $('.user__meta').removeClass('user__meta__on');
      $('.body__overlay').removeClass('is-visible');
  });






/*------------------------------------    
Menu 
--------------------------------------*/

  $('.menu__click').on('click', function() {
    $('.off__canvars__wrap').addClass('off__canvars__wrap__on');
    $('.body__overlay').addClass('is-visible');
    $('body').addClass('off__canvars__open');
    $(this).hide();

  });

  $('.menu__close__btn').on('click', function() {
      $('.off__canvars__wrap').removeClass('off__canvars__wrap__on');
      $('.body__overlay').removeClass('is-visible');
      $('body').removeClass('off__canvars__open');
      $('.menu__click').show();
  });


/*------------------------------------    
Menu Dropdown
--------------------------------------*/
function offCanvasMenuDropdown(){
    
  $('.off__canvars__dropdown-menu').hide();
    
  $('.off__canvars__dropdown > a').on('click', function(e){
    e.preventDefault();
      
    $(this).find('i.zmdi').toggleClass('zmdi-chevron-up');
    $(this).siblings('.off__canvars__dropdown-menu').slideToggle();
      return false;
  });
}
offCanvasMenuDropdown();


/*------------------------------------    
  14. Overlay Close
--------------------------------------*/
  $('.body__overlay').on('click', function() {
    $(this).removeClass('is-visible');
    $('.offsetmenu').removeClass('offsetmenu__on');
    $('.shopping__cart').removeClass('shopping__cart__on');
    $('.filter__wrap').removeClass('filter__menu__on');
    $('.user__meta').removeClass('user__meta__on');
    $('.off__canvars__wrap').removeClass('off__canvars__wrap__on');
    $('body').removeClass('off__canvars__open');
    $('.menu__click').show();
  });

/*---------------------------------------------------
  10. Testimonial Image Slider As Nav
---------------------------------------------------*/
  $('.ht__testimonial__activation').slick({
      slidesToShow: 2,
      slidesToScroll: 1,
      swipeToSlide: true,
      dots: false,
      centerMode: true,
      focusOnSelect: true,
      centerPadding: '10px',
      responsive: [
          {
            breakpoint: 600,
            settings: {
              dots: false,
              slidesToShow: 1,
              slidesToScroll: 1,  
              centerPadding: '10px',
              }
          },
          {
            breakpoint: 320,
            settings: {
              autoplay: true,
              dots: false,
              slidesToShow: 1,
              slidesToScroll: 1,
              centerMode: false,
              focusOnSelect: false,
              }
          }
      ]
  });

/*-----------------------------------------------
  16. Brand Area
-------------------------------------------------*/
  $('.brand__list').owlCarousel({
      loop: true,
      margin:0,
      nav:false,
      autoplay: true,
      autoplayTimeout: 10000,
      items:6,
      dots: false,
      lazyLoad: true,
      responsive: {
        0: {
          items: 2,
        },
        767: {
          items: 4,
        },
        991: {
          items: 6,
        }
      }
    });

/*-----------------------------------------------
  17. Instagram Posts
-------------------------------------------------*/
  $('.htc__instagram__posts').owlCarousel({
      loop: true,
      margin:0,
      nav:false,
      autoplay: true,
      autoplayTimeout: 10000,
      items:6,
      dots: false,
      lazyLoad: true,
      responsive: {
        0: {
          items: 2,
        },
        767: {
          items: 4,
        },
        991: {
          items: 6,
        }
      }
    });


/*-----------------------------------------------
  16. Product Area
-------------------------------------------------*/
  $('.activation__style--1').owlCarousel({
      loop: true,
      margin:0,
      nav:true,
      autoplay: false,
      navText: [ '<i class="zmdi zmdi-long-arrow-left"></i>', '<i class="zmdi zmdi-long-arrow-right"></i>' ],
      autoplayTimeout: 10000,
      items:4,
      dots: false,
      lazyLoad: true,
      responsive: {
        0: {
          items: 2,
        },
        767: {
          items: 3,
        },
        991: {
          items: 4,
        },
        320: {
          items: 1,
        }
      }
    });

/*-------------------------------
  19. Price Slider Active
--------------------------------*/
  $("#slider-range").slider({
      range: true,
      min: 10,
      max: 500,
      values: [110, 400],
      slide: function(event, ui) {
          $("#amount").val("$" + ui.values[0] + " - $" + ui.values[1]);
      }
  });
  $("#amount").val("$" + $("#slider-range").slider("values", 0) +
      " - $" + $("#slider-range").slider("values", 1));


/*-----------------------------------------------
  Slider Activations One [ Home 1 ]
-------------------------------------------------*/
if ($('.slider-activation-one').length) {
  $('.slider-activation-one').owlCarousel({
      items: 3,
      loop: true,
      margin: 0,
      autoplay: true,
      autoplayTimeout: 5000,
      autoplayHoverPause: true,
      responsiveClass: true,
      responsive: {
        0: {
          items: 1,
        },
        767: {
          items: 2,
        },
        991: {
          items: 3,
        }
      }
  });
}

/*-----------------------------------------------
   Slider Activations Two [ Home 2 ]
-------------------------------------------------*/
if ($('.slider__activation__wrap--2').length) {
  $('.slider__activation__wrap--2').owlCarousel({
    loop: true,
    margin:0,
    nav:true,
    animateOut: 'fadeOut',
    animateIn: 'fadeIn',
    smartSpeed: 1000,
    autoplay: false,
    navText: [ '<i class="arrow-down-long"></i><span>Prev</span>', '<i class="arrow-down-long"></i><span>Next</span>' ],
    autoplayTimeout: 10000,
    items:1,
    dots: false,
    lazyLoad: true,
    responsive: {
        0: {
          items: 1,
        },
        767: {
          items: 1,
        },
        991: {
          items: 1,
        }
      }
  });
}

/*-----------------------------------------------
   Slider Activations Three [ Home 2 ]
-------------------------------------------------*/

if ($('.slider__activation__wrap--3').length) {
  $('.slider__activation__wrap--3').owlCarousel({
    loop: true,
    margin:0,
    nav:true,
    animateOut: 'fadeOut',
    animateIn: 'fadeIn',
    smartSpeed: 1000,
    autoplay: false,
    navText: [ '<i class="zmdi zmdi-long-arrow-left"></i>', '<i class="zmdi zmdi-long-arrow-right"></i>' ],
    autoplayTimeout: 10000,
    items:1,
    dots: false,
    lazyLoad: true,
    responsive: {
        0: {
          items: 1,
        },
        767: {
          items: 1,
        },
        991: {
          items: 1,
        }
      }
  });
}

/*---------------------------------------------------
  Slider Activations Five [ Home 5 ]
---------------------------------------------------*/
  $('.slider__activation__wrap--5').slick({
      slidesToShow: 3,
      slidesToScroll: 1,
      swipeToSlide: true,
      dots: false,
      centerMode: true,
      focusOnSelect: true,
      centerPadding: '0px',
      responsive: [
          {
            breakpoint: 1024,
            settings: {
              slidesToShow: 1,
              slidesToScroll: 1,
              swipeToSlide: true,
              dots: false,
              centerMode: true,
              focusOnSelect: true,
              centerPadding: '0px',
              }
          },
          {
            breakpoint: 767,
            settings: {
              slidesToShow: 1,
              slidesToScroll: 1,
              swipeToSlide: true,
              dots: false,
              centerMode: true,
              focusOnSelect: true,
              centerPadding: '0px',
              }
          },
          {
            breakpoint: 320,
            settings: {
              slidesToShow: 1,
              slidesToScroll: 1,
              swipeToSlide: true,
              dots: false,
              centerMode: true,
              focusOnSelect: true,
              centerPadding: '0px',
              }
          }
      ]
  });

/*---------------------------------------------------
  Accordion
---------------------------------------------------*/
  function emeAccordion(){
    $('.accordion__title')
      .siblings('.accordion__title').removeClass('active')
      .first().addClass('active');
    $('.accordion__body')
      .siblings('.accordion__body').slideUp()
      .first().slideDown();
    $('.accordion').on('click', '.accordion__title', function(){
      $(this).addClass('active').siblings('.accordion__title').removeClass('active');
      $(this).next('.accordion__body').slideDown().siblings('.accordion__body').slideUp();
    });
  };
  emeAccordion();


/*---------------------------------------------------
  Ship to another
---------------------------------------------------*/
  function shipToAnother(){
    var trigger = $('.ship-to-another-trigger'),
      container = $('.ship-to-another-content');
    trigger.on('click', function(e){
      e.preventDefault();
      container.slideToggle();
    });
  };
  shipToAnother();



/*---------------------------------------------------
  Payment credit card
---------------------------------------------------*/
  function paymentCreditCard(){
    var trigger = $('.paymentinfo-credit-trigger'),
      container = $('.paymentinfo-credit-content');
    trigger.on('click', function(e){
      e.preventDefault();
      container.slideToggle();
    });
  };
  paymentCreditCard();



})(jQuery);




