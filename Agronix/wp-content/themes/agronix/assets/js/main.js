/***************************************************
==================== JS INDEX ======================
****************************************************
01. PreLoader Js
02. Mobile Menu Js
03. Sidebar Js
04. Cart Toggle Js
05. Search Js
06. Sticky Header Js
07. Data Background Js
08. Testimonial Slider Js
09. Slider Js (Home 3)
10. Brand Js
11. Tesimonial Js
12. Course Slider Js
13. Masonary Js
14. Wow Js
15. Data width Js
16. Cart Quantity Js
17. Show Login Toggle Js
18. Show Coupon Toggle Js
19. Create An Account Toggle Js
20. Shipping Box Toggle Js
21. Counter Js
22. Parallax Js
23. InHover Active Js

****************************************************/

(function ($) {
"use strict";

	var windowOn = $(window);
	////////////////////////////////////////////////////
    // 01. PreLoader Js
	windowOn.on('load',function() {
		$("#loading").fadeOut(500);
	});

	////////////////////////////////////////////////////
    // 02. Mobile Menu Js
	$('#mobile-menu').meanmenu({
		meanMenuContainer: '.mobile-menu',
		meanScreenWidth: "991",
		meanExpand: ['<i class="fal fa-plus"></i>'],
	});


	////////////////////////////////////////////////////
    // 03. Sidebar Js
	$(".sidebar-toggle-btn").on("click", function () {
		$(".sidebar__area").addClass("sidebar-opened");
		$(".body-overlay").addClass("opened");
	});
	$(".sidebar__close-btn").on("click", function () {
		$(".sidebar__area").removeClass("sidebar-opened");
		$(".body-overlay").removeClass("opened");
	});

	////////////////////////////////////////////////////
    // 04. Cart Toggle Js
	$(".cart-toggle-btn").on("click", function () {
		$(".cartmini__wrapper").addClass("opened");
		$(".body-overlay").addClass("opened");
	});
	$(".cartmini__close-btn").on("click", function () {
		$(".cartmini__wrapper").removeClass("opened");
		$(".body-overlay").removeClass("opened");
	});
	$(".body-overlay").on("click", function () {
		$(".cartmini__wrapper").removeClass("opened");
		$(".sidebar__area").removeClass("sidebar-opened");
		$(".header__search-3").removeClass("search-opened");
		$(".body-overlay").removeClass("opened");
	});


	////////////////////////////////////////////////////
    // 05. Search Js
	$(".search-toggle").on("click", function () {
		$(".search__area").addClass("opened");
	});
	$(".search-close-btn").on("click", function () {
		$(".search__area").removeClass("opened");
	});


	////////////////////////////////////////////////////
    // 06. Sticky Header Js
	windowOn.on('scroll', function () {
		var scroll = $(window).scrollTop();
		if (scroll < 100) {
			$("#header-sticky-1").removeClass("sticky-header");
		} else {
			$("#header-sticky-1").addClass("sticky-header");
		}
	});


	////////////////////////////////////////////////////
    // 07. Data Background Js

	$("[data-background").each(function () {
		$(this).css(
			"background-image",
			"url( " + $(this).attr("data-background") + "  )"
		);
	});

	$("[data-bg-color]").each(function () {
		$(this).css("background-color", $(this).attr("data-bg-color"));
	});

	$("[data-color]").each(function () {
		$(this).css("color", $(this).attr("data-color"));
	});

	$("[data-top-space]").each(function () {
		$(this).css("padding-top", $(this).attr("data-top-space"));
	});


    // menu-last class
    $('.main-menu nav > ul > li').slice(-4).addClass('menu-last');


  	////////////////////////////////////////////////////
    // 07. Nice Select Js
 	$(".news-sidebar select, .blog__details-wrapper select, .blog__wrapper select, .footer-widget select,.tp-contact-form select, .agronix-shop-product-topbar select").niceSelect();

	////////////////////////////////////////////////////
    // 08. slider__active Slider Js

	if (jQuery(".slider__active").length > 0) {
		let sliderActive1 = ".slider__active";
		let sliderInit1 = new Swiper(sliderActive1, {
		  // Optional parameters
		  slidesPerView: 1,
		  slidesPerColumn: 1,
		  paginationClickable: true,
		  loop: true,
		  effect: 'fade',
	
		  autoplay: {
			delay: 5000,
		  },
	
		  // If we need pagination
		  pagination: {
			el: ".swiper-paginations",
			// dynamicBullets: true,
			clickable: true,
		  },
	
		  // Navigation arrows
		  navigation: {
			nextEl: ".swiper-button-next",
			prevEl: ".swiper-button-prev",
		  },
	
		  a11y: false,
		});
	
		function animated_swiper(selector, init) {
		  let animated = function animated() {
			$(selector + " [data-animation]").each(function () {
			  let anim = $(this).data("animation");
			  let delay = $(this).data("delay");
			  let duration = $(this).data("duration");
	
			  $(this)
				.removeClass("anim" + anim)
				.addClass(anim + " animated")
				.css({
				  webkitAnimationDelay: delay,
				  animationDelay: delay,
				  webkitAnimationDuration: duration,
				  animationDuration: duration,
				})
				.one(
				  "webkitAnimationEnd mozAnimationEnd MSAnimationEnd oanimationend animationend",
				  function () {
					$(this).removeClass(anim + " animated");
				  }
				);
			});
		  };
		  animated();
		  // Make animated when slide change
		  init.on("slideChange", function () {
			$(sliderActive1 + " [data-animation]").removeClass("animated");
		  });
		  init.on("slideChange", animated);
		}
	
		animated_swiper(sliderActive1, sliderInit1);
	  }

	if (jQuery(".slider__active-2").length > 0) {
		let sliderActive1 = ".slider__active-2";
		let sliderInit1 = new Swiper(sliderActive1, {
		  // Optional parameters
		  slidesPerView: 1,
		  slidesPerColumn: 1,
		  paginationClickable: true,
		  loop: true,
		  effect: 'fade',
	
		  autoplay: {
			delay: 5000,
		  },
	
		  // If we need pagination
		  pagination: {
			el: ".swiper-paginations",
			// dynamicBullets: true,
			clickable: true,
		  },
	
		  // Navigation arrows
		  navigation: {
			nextEl: ".swiper-button-next",
			prevEl: ".swiper-button-prev",
		  },
	
		  a11y: false,
		});
	
		function animated_swiper(selector, init) {
		  let animated = function animated() {
			$(selector + " [data-animation]").each(function () {
			  let anim = $(this).data("animation");
			  let delay = $(this).data("delay");
			  let duration = $(this).data("duration");
	
			  $(this)
				.removeClass("anim" + anim)
				.addClass(anim + " animated")
				.css({
				  webkitAnimationDelay: delay,
				  animationDelay: delay,
				  webkitAnimationDuration: duration,
				  animationDuration: duration,
				})
				.one(
				  "webkitAnimationEnd mozAnimationEnd MSAnimationEnd oanimationend animationend",
				  function () {
					$(this).removeClass(anim + " animated");
				  }
				);
			});
		  };
		  animated();
		  // Make animated when slide change
		  init.on("slideChange", function () {
			$(sliderActive1 + " [data-animation]").removeClass("animated");
		  });
		  init.on("slideChange", animated);
		}
	
		animated_swiper(sliderActive1, sliderInit1);
	  }

	var themeSlider = new Swiper('.classname', {
		slidesPerView: 1,
        spaceBetween: 30,
		loop: true,
        pagination: {
          el: ".swiper-pagination",
          clickable: true,
        },
		breakpoints: {  
			'1200': {
				slidesPerView: 3,
			},
			'992': {
				slidesPerView: 2,
			},
			'768': {
				slidesPerView: 1,
			},
			'576': {
				slidesPerView: 1,
			},
			'0': {
				slidesPerView: 1,
			},
		},
	});


	// init Isotope Masonary Js
	$('.grid').imagesLoaded( function() {
		
		var $grid = $(".grid").isotope({
			// options
		});
		// filter items on button click
		$(".filter-button-group").on("click", "button", function () {
			var filterValue = $(this).attr("data-filter");
			$grid.isotope({ filter: filterValue });
		});

		//for menu active class
		$(".project-menu button").on("click", function (event) {
			$(this).siblings(".active").removeClass("active");
			$(this).addClass("active");
			event.preventDefault();
		});
	});


	/* magnificPopup img view */
	$('.image-popups').magnificPopup({
		type: 'image',
		gallery: {
			enabled: true
		}
	  });

	/* magnificPopup video view */
	$(".popup-video").magnificPopup({
		type: "iframe",
	});

	////////////////////////////////////////////////////
    // 14. Wow Js
	new WOW().init();

	////////////////////////////////////////////////////
    // 15. Data width Js
	$("[data-width]").each(function () {
		$(this).css("width", $(this).attr("data-width"));
	});
	

	 // cart-plus-minus
    $(".cart-plus-minus2").append('<div class="qtybutton minus">-</div><div class="qtybutton plus">+</div>');

    $(".cart-plus-minus2").on("click", ".qtybutton.plus, .qtybutton.minus", function () {
        // Get current quantity values
        var qty = $(this).closest(".cart-plus-minus2").find(".qty");
        console.log( qty.val() );
        var val = parseFloat(qty.val());
        var max = parseFloat(qty.attr("max"));
        var min = parseFloat(qty.attr("min"));
        var step = parseFloat(qty.attr("step"));

        // Change the value if plus or minus
        if ($(this).is(".plus")) {
            if (max && max <= val) {
                qty.val(max);
            }
            else {
                qty.val(val + step).trigger("change");
            }
        }
        else {
            if (min && min >= val) {
                qty.val(min);
            }
            else if (val > 0) {
                qty.val(val - step).trigger("change");
            }
        }
    });


	////////////////////////////////////////////////////
	// 17. Show Login Toggle Js
	$('#showlogin').on('click', function () {
		$('#checkout-login').slideToggle(900);
	});

	////////////////////////////////////////////////////
	// 18. Show Coupon Toggle Js
	$('#showcoupon').on('click', function () {
		$('#checkout_coupon').slideToggle(900);
	});

	////////////////////////////////////////////////////
	// 19. Create An Account Toggle Js
	$('#cbox').on('click', function () {
		$('#cbox_info').slideToggle(900);
	});

	////////////////////////////////////////////////////
	// 20. Shipping Box Toggle Js
	$('#ship-box').on('click', function () {
		$('#ship-box-info').slideToggle(1000);
	});

	////////////////////////////////////////////////////
	// 21. Counter Js
	$('.counter').counterUp({
		delay: 10,
		time: 1000
	});
	
	////////////////////////////////////////////////////
	// 22. Parallax Js
	if ($('.scene').length > 0 ) {
		$('.scene').parallax({
			scalarX: 10.0,
			scalarY: 15.0,
		}); 
	};

	////////////////////////////////////////////////////
    // 23. InHover Active Js
	$('.hover__active').on('mouseenter', function () {
		$(this).addClass('active').parent().siblings().find('.hover__active').removeClass('active');
	});


	////////////////////////////////////////////////////
    // 09. Supporter Slider Js

	$('.tp-supporter__slider-active').owlCarousel({
		rtl:true,

		loop:true,

		// margin:30,

		autoplay:false,

		autoplayTimeout:3000,

		smartSpeed:500,

		items:6,

		navText:['<button><i class="fa fa-angle-left"></i>PREV</button>','<button>NEXT<i class="fa fa-angle-right"></i></button>'],

		nav:false,

		dots:false,

		responsive:{

			0:{

				items:2

			},

			767:{

				items:3

			},

			992:{

				items:4

			},

			1200:{

				items:5

			},

			1600:{

				items:6

			}

		}

	});

	 // 09. Supporter Slider Js
	$('.tp-supporter__slider-2').owlCarousel({
		rtl:true,

		loop:true,

		margin:20,

		autoplay:false,

		autoplayTimeout:3000,

		smartSpeed:500,

		items:6,

		navText:['<button><i class="fa fa-angle-left"></i>PREV</button>','<button>NEXT<i class="fa fa-angle-right"></i></button>'],

		nav:false,

		dots:false,

		responsive:{

			0:{

				items:1

			},
			570:{

				items:2

			},

			767:{

				items:3

			},

			992:{

				items:4

			},

			1200:{

				items:4

			},

			1600:{

				items:5

			}

		}

	});


	////////////////////////////////////////////////////
    // 09. Project Slider Js
	$('.tp-project__slider-active').owlCarousel({

		loop:true,

		margin:30,

		autoplay:false,

		autoplayTimeout:3000,

		smartSpeed:500,

		items:3,

		navText:['<button><i class="fa fa-angle-left"></i>PREV</button>','<button>NEXT<i class="fa fa-angle-right"></i></button>'],

		nav:false,

		dots:true,

		responsive:{

			0:{

				items:1

			},
			570:{

				items:1

			},

			767:{

				items:2

			},

			992:{

				items:3

			},

			1200:{

				items:3

			},

			1310:{

				items:3

			},

			1600:{

				items:3

			}

		}

	}); 

	////////////////////////////////////////////////////
    // 09. Blog Slider Js
	$('.blog-slider_active').owlCarousel({

		loop:true,

		margin:30,

		autoplay:false,

		autoplayTimeout:3000,

		smartSpeed:500,

		items:3,

		navText:['<button><i class="fal fa-long-arrow-left"></i></button>','<button><i class="fal fa-long-arrow-right"></i></button>'],

		nav:true,

		dots:false,

		responsive:{

			0:{

				items:1

			},

			767:{

				items:2

			},

			992:{

				items:2

			},

			1200:{

				items:2

			},

			1310:{

				items:2

			},

			1600:{

				items:2

			}

		}

	});


	////////////////////////////////////////////////////
    // 09. testimonial  Slider-2 Js
	$('.testimonial-slider-2-active').owlCarousel({

		loop:true,

		margin:30,

		autoplay:false,

		autoplayTimeout:3000,

		smartSpeed:500,

		items:3,

		navText:['<button><i class="fal fa-long-arrow-left"></i></button>','<button><i class="fal fa-long-arrow-right"></i></button>'],

		nav:true,

		dots:true,

		responsive:{

			0:{

				items:1

			},

			767:{

				items:1

			},

			992:{

				items:1

			},

			1200:{

				items:1

			},

			1310:{

				items:1

			},

			1600:{

				items:1

			}

		}

	});


	////////////////////////////////////////////////////
    // 09. Blog Slider Js
	$('.product-slider-active').owlCarousel({

		loop:true,

		margin:30,

		autoplay:false,

		autoplayTimeout:3000,

		smartSpeed:500,

		items:3,

		navText:['<button><i class="fal fa-chevron-left"></i></button>','<button><i class="fal fa-chevron-right"></i></button>'],

		nav:true,

		dots:false,

		responsive:{

			0:{

				items:1

			},
			575:{

				items:2

			},

			767:{

				items:2

			},

			992:{

				items:3

			},

			1200:{

				items:3

			},

			1310:{

				items:3

			},

			1600:{

				items:4

			}

		}

	});

	// 09. Blog Slider Js
	$('.news-thumb-slider-active').owlCarousel({

		loop:true,

		margin:30,

		autoplay:false,

		autoplayTimeout:3000,

		smartSpeed:500,

		items:3,

		navText:['<button><i class="fal fa-chevron-left"></i></button>','<button><i class="fal fa-chevron-right"></i></button>'],

		nav:true,

		dots:false,

		responsive:{

			0:{

				items:1

			},
			575:{

				items:1

			},

			767:{

				items:1

			},

			992:{

				items:1

			},

			1200:{

				items:1

			},

			1310:{

				items:1

			},

			1600:{

				items:1

			}

		}

	});
	


	var swiper = new Swiper(".testimonial__slider-nav", {
		loop:true,
        spaceBetween: 0,
        slidesPerView: 3,
		autoplay:true,
		autoplayTimeout:3000,
        watchSlidesProgress: true,
		centeredSlides: true,
		breakpoints: {  
			'1200': {
				slidesPerView: 3,
			},
			'992': {
				slidesPerView: 3,
			},
			'768': {
				slidesPerView: 2,
				centeredSlides: false,
			},
			'576': {
				slidesPerView: 1,
			},
			'0': {
				slidesPerView: 1,
			},
		},
      });
      var swiper2 = new Swiper(".testimoinial__slider-text", {
		loop:true,
		autoplay:true,
		autoplayTimeout:3000,
        spaceBetween: 0,
        navigation: {
          nextEl: ".swiper-button-next",
          prevEl: ".swiper-button-prev",
        },
        thumbs: {
          swiper: swiper,
        },
      });
    



	// imgae-select
	const activeImage = document.querySelector(".product-image .active");
	const productImages = document.querySelectorAll(".product-thumb img");
	function changeImage(e) {
		activeImage.src = e.target.src;
	}
	productImages.forEach((image) => image.addEventListener("click", changeImage));

	// Jquery Appear raidal
	if (typeof ($.fn.knob) != 'undefined') {
		$('.knob').each(function () {
		var $this = $(this),
		knobVal = $this.attr('data-rel');

		$this.knob({
		'draw': function () {
			$(this.i).val(this.cv + '%')
		}
		});

		$this.appear(function () {
		$({
			value: 0
		}).animate({
			value: knobVal
		}, {
			duration: 2000,
			easing: 'swing',
			step: function () {
			$this.val(Math.ceil(this.value)).trigger('change');
			}
		});
		}, {
		accX: 0,
		accY: -150
		});
	});
	}

	// Jquery Appear
	//----------------------------------------------------------------------------------------
	if ($('.progress-bar').length) {
		$('.progress-bar').appear(function () {
			var el = $(this);
			var percent = el.data('width');
			$(el).css('width', percent + '%');
		}, {
			accY: 0
		});
	}

		////////////////////////////////////////////////////
	// 21. Cart Plus Minus Js
	$(".cart-plus-minus").append('<div class="dec qtybutton">-</div><div class="inc qtybutton">+</div>');
	$(".qtybutton").on("click", function () {
		var $button = $(this);
		var oldValue = $button.parent().find("input").val();
		if ($button.text() == "+") {
			var newVal = parseFloat(oldValue) + 1;
		} else {
			// Don't allow decrementing below zero
			if (oldValue > 0) {
				var newVal = parseFloat(oldValue) - 1;
			} else {
				newVal = 0;
			}
		}
		$button.parent().find("input").val(newVal);
	});




	$('.woocommerce form .form-row select').parent('span.woocommerce-input-wrapper').addClass('select-before');

})(jQuery);