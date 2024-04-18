/**
 * Exoplanet Custom JS
 *
 * @package Exoplanet
 *
 * Distributed under the MIT license - http://opensource.org/licenses/MIT
 */
var stickyon = jQuery('#sticky-onoff').text().trim();
var a1 = stickyon.length;
window.onscroll = function () {
  if (a1 == 3) {
    myScrollNav();
  }
}
const viewportWidth = window.innerWidth;
if (viewportWidth < 1199) {


  jQuery(document).ready(function () {
    // Create a <span> element with Font Awesome classes
    var spanElement = jQuery("<span class='fa-solid fa-chevron-down dropDown'></span>");

    // Append the <span> element inside the element with class "menu-item-has-children"
    jQuery(".menu-item-has-children").append(spanElement);

    // Hide all sub-menus initially
    jQuery('.sub-menu').hide();

    // Click event handler for the appended icon
    jQuery('.dropDown').on('click', function () {
      // console.log('Dropdown clicked'); // Debugging - Check if the click event is triggered

      // Toggle visibility of the specific sub-menu related to the clicked icon
      var submenu = jQuery(this).siblings(".sub-menu");
      if (submenu.length > 0) {
        submenu.slideToggle(500);
        jQuery(this).toggleClass('active');

      }
    });
  });


  var owl = jQuery('.trending-slider.owl-carousel');
  owl.owlCarousel({
    margin: 20,
    nav: false,
    dots: false,
    autoplay: false,
    lazyLoad: true,
    loop: false,
    responsive: {
      0: {
        items: 2
      },
      500: {
        items: 2
      },
      600: {
        items: 2
      },
      700: {
        items: 3
      },
      900: {
        items: 3
      },
      1000: {
        items: 4
      },
      1150: {
        items: 5
      },
      1300: {
        items: 5
      },
      1400: {
        items: 5
      }
    },
    autoplayHoverPause: true,
    mouseDrag: true
  });
}
// Function to check if the clicked element is within a specific container
function isClickedInsideElement(clickedElement, containerSelector) {
  return jQuery(clickedElement).closest(containerSelector).length > 0;
}

// Hide .options initially
jQuery('.options').hide();

// Click event on the social trigger
jQuery('.option-trigger').on('click', function (event) {
  // Toggle the visibility of .options relative to the clicked .option-trigger
  jQuery(this).siblings('.options').fadeIn();
  // Stop the click event from propagating to the document
  event.stopPropagation();
});
// Click event on the social trigger
jQuery('.option-trigger.single').on('click', function (event) {
  // Toggle the visibility of .options relative to the clicked .option-trigger
  jQuery(this).child('.options').fadeIn();
  // Stop the click event from propagating to the document
  event.stopPropagation();
});
// Click event on the document
jQuery(document).on('click', function (event) {
  // Check if the clicked element is not within .option-trigger or .options
  if (!isClickedInsideElement(event.target, '.option-trigger') && !isClickedInsideElement(event.target, '.options')) {
    // Hide .options when clicked outside
    jQuery('.options').fadeOut();
  }
});


jQuery(document).ready(function () {

  var elementHeight = jQuery("#header").height();
  var top = elementHeight / 2 + 5;
  var adminBarHeight = jQuery('div#wpadminbar').height();
  var topWithAdmin = (elementHeight + adminBarHeight) - 16;
  // console.log("Element height (excluding padding and borders): " + elementHeight + "px");
  // // jQuery('#masthead').css('height', elementHeight);
  // console.log('LoggedIn====================>', jQuery('body').hasClass('.logged-in'));

  if (jQuery('body').hasClass('logged-in')) {
    jQuery('.toggle-nav.mobile-menu').css('top', topWithAdmin);
  } else {
    jQuery('.toggle-nav.mobile-menu').css('top', top);
  }
  // console.log("topWithAdmin========================>", topWithAdmin);
  // console.log("top========================>", top);
});


jQuery(function ($) {

  jQuery('.search-icon > i').click(function () {
    jQuery(".serach_outer").slideDown(700);
  });

  jQuery('.closepop i').click(function () {
    jQuery(".serach_outer").slideUp(700);
  });
});

var menu_width = "";

var menu_width = "";
/* Mobile responsive Menu*/
jQuery(function ($) {
  jQuery('#open_nav').click(function () {
    jQuery('ul#menu-primary-menu').toggleClass("open-nav");
    jQuery('#open_nav').toggleClass('active');
  })

});

jQuery(document).ready(function () {
  jQuery('.archive .product a.added').removeClass("loading");
})

function vw_podcast_pro_filters(event, ui) {
  var data_obj = {};

  data_obj['values'] = jQuery('#product-price-slider').slider("values");
  data_obj['search_value'] = jQuery('[name="products_search"]').val();

  jQuery('.shop-page-filters [type="checkbox"]:checked').each(function (index, element) {
    if (!Array.isArray(data_obj[jQuery(element).attr('name')])) {
      data_obj[jQuery(element).attr('name')] = new Array();
    }
    data_obj[jQuery(element).attr('name')].push(jQuery(element).val())
  });

  jQuery.post(vw_podcast_pro_customscripts_obj.ajaxurl, {
    'action': 'get_shop_page_filter',
    'data': data_obj
  },
    function (response) {
      jQuery('.products.columns-3').html(response.html)
    });

}

function vw_podcast_pro_filters_listings(event, ui) {
  var data_obj = {};

  data_obj['values'] = jQuery('#listing-price-slider').slider("values");

  jQuery.post(vw_podcast_pro_customscripts_obj.ajaxurl, {
    'action': 'get_listing_page_filter',
    'data': data_obj
  },
    function (response) {
      jQuery('.auto-listings-row .auto-listing-box').remove();
      jQuery('.auto-listings-row').append(response.html);
    });
}


jQuery(function () {
  //----- OPEN
  jQuery('[data-popup-open]').on('click', function (e) {
    var targeted_popup_class = jQuery(this).attr('data-popup-open');
    jQuery('[data-popup="' + targeted_popup_class + '"]').fadeIn(350);

    e.preventDefault();
  });

  //----- CLOSE
  jQuery('[data-popup-close]').on('click', function (e) {
    var targeted_popup_class = jQuery(this).attr('data-popup-close');
    jQuery('[data-popup="' + targeted_popup_class + '"]').fadeOut(350);

    e.preventDefault();
  });
});


jQuery(document).ready(function ($) {

  var sync1 = $(".main-gallery");
  var sync2 = $(".main-gallery-list");
  var slidesPerPage = 6; //globaly define number of elements per page

  sync1.owlCarousel({
    items: 1,
    slideSpeed: 200,
    nav: true,
    dots: false,
    responsiveRefreshRate: 200,
    navText: ['<i class="fa fa-angle-left"></i>', '<i class="fa fa-angle-right"></i>']
  }).on('changed.owl.carousel', syncPosition);

  sync2.on('initialized.owl.carousel', function () {
    sync2.find(".owl-item").eq(0).addClass("current");
  }).owlCarousel({
    items: slidesPerPage,
    dots: false,
    nav: false,
    smartSpeed: 200,
    slideSpeed: 500,
    slideBy: 4,
    autoplay: true,
    // loop:true
    responsiveRefreshRate: 100
  }).on('changed.owl.carousel', syncPosition2);

  sync2.on('click', '.owl-item', function () {
    sync1.trigger('to.owl.carousel', [$(this).index(), 200, true]);
  });

  function syncPosition(el) {
    var current = el.item.index;

    sync2.find(".owl-item").removeClass("current").eq(current).addClass("current");
    var onscreen = sync2.find('.owl-item.active').length - 1;
    var start = sync2.find('.owl-item.active').first().index();
    var end = sync2.find('.owl-item.active').last().index();

    if (current > end) {
      sync2.data('owl.carousel').to(current, 100, true);
    }
    if (current < start) {
      sync2.data('owl.carousel').to(current - onscreen, 100, true);
    }
  }

  function syncPosition2(el) {
    if (sync2.data('owl.carousel').options.loop) {
      var number = el.item.index;
      var clonedNumber = el.item.count - el.item.index;

      if (clonedNumber <= number) {
        number = clonedNumber;
      }
      number--;
      var sync2visible = sync2.find('.owl-item').eq(number).visible(true);
      sync2.data('owl.carousel').to(sync2visible, 100, true);
    } else {
      sync1.data('owl.carousel').to(el.item.index, 100, true);
    }
  }


  //custom variation home page image and price change start

  jQuery('.product_variant_color').on('click', function () {

    jQuery('.product_variant_text').hide();
    jQuery(this).closest('.variant-parent-container').find('.product_variant_text').show();
    jQuery('.product_variant_color').removeClass('checked');
    jQuery(this).addClass('checked');

    var variationId = jQuery(this).attr('variation-id');

    jQuery.ajax({
      url: vw_podcast_pro_customscripts_obj.ajaxurl,
      type: 'POST',
      data: {
        action: 'get_variation_data',
        variation_id: variationId
      },
      success: function (response) {

        // Update price
        jQuery('.product-price').html(response.price_html);

        // Update images
        var imageGallery = jQuery('.product-gallery');
        imageGallery.html(response.image_html);

      }
    });

  });

  if (jQuery('.product_variant_color').length) {
    jQuery('.product_variant_color').eq(0).addClass('checked').click();
    jQuery('.variant-parent-container .product_variant_text').eq(0).show();
  }

  //custom variation home page image and price change end
});


jQuery('document').ready(function () {

  jQuery(".search-toggle .search-icon").click(function (e) {
    jQuery(".search-container").show();
    e.stopPropagation();
  });

  jQuery(".search-container").click(function (e) {
    e.stopPropagation();
  });

  jQuery(document).click(function () {
    jQuery(".search-container").hide();
  });



  jQuery('.cat_toggle i').click(function () {
    jQuery('#cart_animate').toggle('slow');
  });

  jQuery(document).ready(function () {
    jQuery('.myVideoBtn').click(function () {
      var url = jQuery(this).data('url');
      // console.log(url);
      // console.log(jQuery('#videoEmbed'));
      jQuery('#videoEmbed').attr('src', url);
      jQuery("#myVideoNewModal").show();
    });
    jQuery('.close-one').click(function () {
      jQuery("#myVideoNewModal").hide()
    });

    jQuery('.counter1-up').each(function () {
      jQuery(this).prop('Counter', 0).animate({
        Counter: jQuery(this).text()
      }, {
        duration: 4000,
        easing: 'swing',
        step: function (now) {
          jQuery(this).text(Math.ceil(now));
        }
      });
    });



  });


  jQuery('a[data-slide]').click(function (e) {
    e.preventDefault();
    var slideno = jQuery(this).data('slide');
    jQuery('.slider-for').slick('slickGoTo', slideno - 1);
  });

  var owl = jQuery('#slider .owl-carousel');
  if (owl.length > 0) {

    owl.owlCarousel({
      margin: 25,
      nav: false,
      autoplay: false,
      lazyLoad: true,
      autoHeight: false,
      autoplayTimeout: 2000,
      center: true,
      dots: false,
      loop: true,
      // loop: true,
      navText: ['<i class="fas fa-angle-left" aria-hidden="true"></i>', '<i class="fas fa-angle-right" aria-hidden="true"></i>'],
      responsive: {
        0: {
          items: 1,
          stagePadding: 0
        },
        768: {
          items: 1,
          stagePadding: 0
        },
        1024: {
          items: 1,
        },
        1920: {
          items: 1,
        },

      },
      autoplayHoverPause: true,
      mouseDrag: true
    });
  }

  var owl = jQuery('#services-us .owl-carousel');
  if (owl.length > 0) {

    owl.owlCarousel({
      margin: 25,
      nav: false,
      autoplay: true,
      lazyLoad: true,
      autoplayTimeout: 3000,
      center: false,
      dots: true,
      loop: true,
      responsive: {
        0: {
          items: 1,
        },
        768: {
          dotsEach: 2,
          items: 2,
        },
        1024: {
          dotsEach: 2,
          items: 2,
        },
        1200: {
          dotsEach: 3,
          items: 3,
        },
        1400: {
          dotsEach: 3,
          items: 3,
        },
        1920: {
          dotsEach: 3,
          items: 3,
        },

      },
      autoplayHoverPause: true,
      mouseDrag: true
    });
  }


  var owl = jQuery('#blog-news .owl-carousel');
  owl.owlCarousel({
    margin: 25,
    nav: false,
    dots: false,
    autoplay: true,
    // lazyLoad: true,
    autoplayTimeout: 4000,
    navText: ['<i class="fa fa-chevron-left" aria-hidden="true"></i>', '<i class="fa fa-chevron-right" aria-hidden="true"></i>'],
    loop: true,
    responsive: {
      0: {
        items: 1
      },
      500: {
        items: 1
      },
      600: {
        items: 1
      },
      700: {
        items: 2
      },
      900: {
        items: 2
      },
      1000: {
        items: 2
      },
      1200: {
        items: 3
      },
      1300: {
        items: 3
      }
    },
    autoplayHoverPause: true,
    mouseDrag: true
  });
  // var owl = jQuery('.related-posts .owl-carousel');
  // owl.owlCarousel({
  //     margin: 25,
  //     nav: false,
  //     dots: false,
  //     autoplay: true,
  //     lazyLoad: true,
  //     autoplayTimeout: 4000,
  //     navText: ['<i class="fa fa-chevron-left" aria-hidden="true"></i>', '<i class="fa fa-chevron-right" aria-hidden="true"></i>'],
  //     loop: true,
  //     center: false,
  //     responsive: {
  //         0: {
  //             items: 1
  //         },
  //         500: {
  //             items: 1
  //         },
  //         600: {
  //             items: 1
  //         },
  //         700: {
  //             items: 1
  //         },
  //         900: {
  //             items: 2
  //         },
  //         1000: {
  //             items: 2
  //         },
  //         1200: {
  //             items: 3 // Changed from 2 to 3
  //         },
  //         1300: {
  //             items: 3 // Changed from 2 to 3
  //         }
  //     },
  //     autoplayHoverPause: true,
  //     mouseDrag: true
  // });

  jQuery(document).ready(function () {
    jQuery(document).ready(function () {
      jQuery('.slick-slider').slick({
        slidesToShow: 3,
        slidesToScroll: 1,
        autoplay: false,
        autoplaySpeed: 2000,
        dots: false,
        nav: false,
        responsive: [
          {
            breakpoint: 1025,
            settings: {
              slidesToShow: 2,
              slidesToScroll: 2,
              infinite: true,
              dots: true
            }
          },
          {
            breakpoint: 600,
            settings: {
              slidesToShow: 2,
              slidesToScroll: 2
            }
          },
          {
            breakpoint: 480,
            settings: {
              slidesToShow: 1,
              slidesToScroll: 1
            }
          }
        ]
        // Add more settings as needed
      });
    });
  });
  var owl = jQuery('section.clientandPratners .owl-carousel');
  owl.owlCarousel({
    margin: 25,
    dots: false,
    nav: false,
    autoplay: true,
    autoplayTimeout: 2000,
    navText: ['<i class="fa fa-chevron-left" aria-hidden="true"></i>', '<i class="fa fa-chevron-right" aria-hidden="true"></i>'],
    loop: true,
    responsive: {
      0: {
        items: 1
      },
      500: {
        items: 2
      },
      600: {
        items: 2
      },
      700: {
        items: 3
      },
      900: {
        items: 3
      },
      1000: {
        items: 4
      },
      1200: {
        items: 4
      },
      1300: {
        items: 4
      }
    },
    autoplayHoverPause: true,
    mouseDrag: true
  });





  // jQuery('.ternding-slider').slick(
  //   {
  //     slidesToShow: 6,
  //     slidesToScroll: 1,
  //     autoplay: false,
  //     arrows: false,
  //     dots: false,
  //     infinite: false
  //   }
  // );

  jQuery('a.accordion-toggle').click(function () {
    jQuery("i", this).toggleClass("fas fa-plus fas fa-times");
  });
  var interval = null;
  function show_loading_box() {
    jQuery(".eco-box").css("display", "none");
    clearInterval(interval);
  }
  jQuery('document').ready(function () {

    interval = setInterval(show_loading_box, 1000);
  });
  //  offer section
});

/* Counter */
jQuery(document).ready(function () {

  // ------------ Scroll Top ---------------

  jQuery(window).scroll(function () {
    if (jQuery(this).scrollTop() >= 50) {        // If page is scrolled more than 50px
      jQuery('#return-to-top').fadeIn(200);    // Fade in the arrow
    } else {
      jQuery('#return-to-top').fadeOut(200);   // Else fade out the arrow
    }
  });
  jQuery('#return-to-top').click(function () {      // When arrow is clicked
    jQuery('body,html').animate({
      scrollTop: 0                       // Scroll to top of body
    }, 1000);
  });



});

jQuery(function ($) {
  $(window).scroll(function () {
    var scrollTop = $(window).scrollTop();
    if (scrollTop > 100) {
      $('.right_menu').addClass('scrolled');
    } else {
      $('.right_menu').removeClass('scrolled');
    }
    $('.main-header').css('background-position', 'center ' + (scrollTop / 2) + 'px');
  });

});

//At the document ready event
jQuery(function () {
  new WOW().init();
});

//also at the window load event
jQuery(window).on('load', function () {

  new WOW().init();
});


jQuery('body').on('added_to_cart', function (e, fragments, cart_hash, button) {
  var product = '';
  var img = '';
  var title = '';
  var url = '';

  if (vw_podcast_pro_customscripts_obj.is_home == "1") {
    var product = jQuery(button).closest('.product-content');
    var img = product.find('img').attr('src');
    var title = product.find('.product_head').text();
    var url = product.find('.woocommerce-loop-product__link').attr('href');
  } else {
    var product = jQuery(button).closest('.product');
    var img = product.find('img').attr('src');
    var title = product.find('.woocommerce-loop-product__title').text();
    var url = product.find('.product_head').attr('href');
  }
  if (product != '') {
    jQuery.notify({
      icon: img,
      title: title,
      message: "Product has been added to your cart.",
      url: url
    }, {
      type: 'minimalist',
      delay: "3000",
      icon_type: 'image',
      template: '<div data-notify="container" class="col-xs-11 col-sm-3 alert alert-{0}" role="alert">' +
        '<img data-notify="icon" class="img-circle pull-left">' +
        '<span class="prod-title" data-notify="title">{1}</span>' +
        '<div class="prod-messg" data-notify="message">{2}</div>' +
        '</div>'
    });
  }

});

jQuery(document).ready(function () {
  // Delete that line if you don't want the first Div to be displayed by default
  jQuery(".answer:first").css("display", "block");
  jQuery(".accordion-click:first").addClass('active');
  // 
  jQuery(".accordion-click").click(function () {
    jQuery(this).toggleClass('active');
    jQuery(this).next().slideToggle(500);
    jQuery(".answer").not(jQuery(this).next()).slideUp(500);
    jQuery(".accordion-click").not(jQuery(this)).removeClass('active');
  });

});
function customMediaUploader(button) {
  var customUploader = wp.media({
    title: 'Upload Image',
    button: {
      text: 'Select Image'
    },
    multiple: false
  });

  customUploader.on('select', function () {
    var attachment = customUploader.state().get('selection').first().toJSON();
    var mediaIdField = jQuery(button).closest('p').find('.custom_media_id');
    var mediaPreview = jQuery(button).closest('p').find('.custom_media_preview');

    mediaIdField.val(attachment.id);
    mediaPreview.html('<img src="' + attachment.url + '" alt="Image" style="max-width:100%;height:auto;" />');
  });

  customUploader.open();
}
setTimeout(function () {
  jQuery('.ccb-drop-down.calc_dropDown_field_id_2').on('click', function () {
    // console.log('click ===============> working')
    jQuery('.calc-subtotal.calc-list').toggleClass('show')
    // console.log('working==========================>');
  })
  // Check if the div is present
  if (jQuery(".ewd-otp-order-results").length == 0) {
    // The div with class "ewd-otp-order-results" is present
    // You can change the CSS of an <a> element here
    jQuery(".ewd-otp-tracking-results").css({
      "border": "none",            // Change the color to red (for example)
      "backdrop-filter": "none"  // Add underline (for example)
    });
    // console.log('status================> I ran')
  }


  // Iterate through the array and get the height of each element
  var tallestHeight = 0;
  for (var i = 0; i < elements.length; i++) {
    var height = jQuery(elements[i]).height();
    // Check if the current element is taller than the previous tallest one
    if (height > tallestHeight) {
      tallestHeight = height;
      tallestElement = elements[i];
    }
    var tallest = parseInt(tallestElement);
    jQuery('.slider-main').css('height', tallestHeight + 75 + 'px');
  }
  // console.log('tallestElement is', tallestHeight);
}, 3000);
// heighest element in slider 
var elements = document.querySelectorAll('.testimonial-content');





jQuery(document).ready(function () {
  jQuery("#clientSlider").owlCarousel({
    loop: true, // Enable loop
    margin: 10, // Space between each item
    autoplay: true, // Auto-play the slider
    autoplayTimeout: 2000, // Auto-play interval in milliseconds
    dots: false,
    responsive: {
      0: {
        items: 2 // Number of items to show at different screen sizes
      },
      600: {
        items: 4
      },
      1000: {
        items: 6
      }
    }
  });
});



jQuery('.counter-number').each(function () {
  var $this = jQuery(this);
  var text = $this.text();
  var numbers = text.split('+');
  var total = 0;

  // Iterate through the numbers and sum them
  for (var i = 0; i < numbers.length; i++) {
    var num = parseInt(numbers[i], 10);
    if (!isNaN(num)) {
      total += num;
    }
  }

  $this.prop('Counter', 0).animate({
    Counter: total,
  }, {
    duration: 5000,
    easing: 'swing',
    step: function (now) {
      $this.text(Math.ceil(now) + '+');
    }
  });
});









// Define the click event for your button
jQuery('.scroll-btn').click(function (e) {
  e.preventDefault(); // Prevent the default behavior of the link

  // Get the target div's offset from the top
  var targetOffset = jQuery('#pricing_sec').offset().top;

  // Animate the scroll to the target div
  jQuery('html, body').animate({
    scrollTop: targetOffset
  }, 500); // Adjust the duration as needed
});


jQuery(document).ready(function () {
  jQuery('.social-links-wrap').on('click', function (event) {
    jQuery(this).find('.get_in_touch').animate({
      opacity: '0',
      width: '0%',
    }, '100');
    jQuery(this).find('.social-media-links').animate({
      width: '100%'
    }, '500');
    jQuery(this).find('.social-media-links').removeClass('active');
    jQuery(this).addClass('active');
    // Perform actions when clicked inside the specific element
    event.stopPropagation(); // Prevent the click event from bubbling up to the document
  });

  jQuery(document).on('click', function (event) {
    if (!jQuery(event.target).closest('.social-links-wrap').length) {
      jQuery(this).find('.get_in_touch').delay(700).animate({
        opacity: '1',
        width: '100%'
      }, '1000');
      jQuery(this).find('.social-media-links').animate({
        width: '0%'
      }, '0');
      jQuery(this).find('.social-media-links').addClass('active');
      jQuery('.social-links-wrap').removeClass('active');
      // Perform actions when clicked outside the specific element
    }
  });
});





//for update track history

document.addEventListener('DOMContentLoaded', function () {
  const intervalTime = 5000; // Check every 5 seconds

  const intervalId = setInterval(updateHistoryIfPlaying, intervalTime);

  function updateHistoryIfPlaying() {
    // console.log('Checking if a song is playing...');
    const isPlaying = checkIfSongIsPlaying();
    // console.log('Is a song playing?', isPlaying);

    if (isPlaying) {
      const trackId = getCurrentlyPlayingTrackId();
      const songName = getCurrentlyPlayingSongName();
      const lastLoggedTrackId = sessionStorage.getItem('lastLoggedTrackId');

      console.log(`Current track ID: ${trackId}, Last logged track ID: ${lastLoggedTrackId}`);

      if (trackId !== lastLoggedTrackId) {
        // console.log('A song is playing. Updating history...');
        const userId = getCurrentUserId();
        // console.log('Current user ID:', userId);

        updateTrackHistory(userId, trackId, songName);

        // Update sessionStorage with the current trackId
        sessionStorage.setItem('lastLoggedTrackId', trackId);
      } else {
        //console.log('This song has already been logged. Skipping history update.');
      }
    } else {
      //console.log('No song is playing. Skipping history update.');
    }
  }

  // Function to check if a song is playing
  function checkIfSongIsPlaying() {
    // Check if the player controls have a class indicating that the song is playing
    const isPlaying = document.getElementById('vwwvpl-sticky-player').classList.contains('playing');
    return isPlaying;
  }

  // Function to retrieve the track ID of the currently playing song
  function getCurrentlyPlayingTrackId() {
    // Get the track ID associated with the currently playing song
    const trackIdElement = document.querySelector('#vwwvpl-sticky-player .vwwvpl-artist[data-id]');
    // console.log('track id object=====>',trackIdElement);

    return trackIdElement ? trackIdElement.getAttribute('data-id') : null;
  }

  // Function to retrieve the song name of the currently playing song
  function getCurrentlyPlayingSongName() {
    // Get the song title element
    const songTitleElement = document.querySelector('.vwwvpl-title');
    return songTitleElement ? songTitleElement.innerText.trim() : null;
  }

  // Function to retrieve the current user ID
  function getCurrentUserId() {

    // For now, let's return null as a placeholder
    // return null;
  }

  // Function to update track history
  function updateTrackHistory(userId, trackId, songName) {
    // console.log('Updating track history...');
    // Construct the FormData object with the necessary data
    const data = new FormData();
    data.append('action', 'update_track_history');
    data.append('security', ajax_object.update_track_history_nonce);
    data.append('track_id', trackId);
    data.append('song_name', songName);

    // Send a POST request to update the track history
    fetch(ajax_object.ajax_url, {
      method: 'POST',
      body: data,
      credentials: 'same-origin'
    })
      .then(response => {
        if (response.ok) {
          return response.json();
        } else {
          throw new Error('Network response was not ok.');
        }
      })
      .then(data => {
        console.log('Response data:', data);
      })
      .catch(error => {
        console.error('Error:', error);
      });
  }
});

jQuery('.mobile-open').on('click', function () {
  jQuery(this).toggleClass('Show');
  jQuery(this).parents('.main-sidebar').toggleClass("open");
})
jQuery(document).ready(function ($) {
  // Create a span element and append the <i> element inside it
  var iconSpan = jQuery('<span class="toggle-submenu"></span>').append('<i class="fa fa-plus" aria-hidden="true"></i>');

  // Append the span element inside aside#nav_menu-2
  jQuery('aside#nav_menu-2').append(iconSpan);
});


jQuery(document).ready(function ($) {

  // Toggle the visibility of the #menu-library when .toggle-submenu is clicked
  jQuery('span.toggle-submenu').on('click', function () {
    // Find the closest menu-library-container and then find the ul#menu-library within it
    jQuery(this).closest('.widget_nav_menu').find('.menu-library-container ul#menu-library').slideToggle();
  });

  // profile page 
  jQuery('table').css('display', 'none');
  jQuery('div#slider-id').on('click', function () {
    jQuery('table').slideToggle();
  })



});
// Faq toggle 
jQuery(document).ready(function ($) {
  jQuery('.answer').css('display', 'none');
  // jQuery code to toggle answer visibility
  jQuery('.question span').on('click', function () {
    jQuery(this).parent('.question').toggleClass('active');
    jQuery(this).parent().next('.answer').slideToggle();
  });


  $(document).ready(function () {
    function initSlickSlider() {
      $('.archive-row').slick({
        arrows: false, // Disable navigation arrows
        dots: false, // Disable dots
        lazyLoad: false,
        responsive: [
          {
            breakpoint: 575,
            settings: {
              slidesToShow: 1,
              slidesToScroll: 1,
              autoplay: true,
              autoplaySpeed: 2000, // Adjust as needed
              infinite: true,
              draggable: true
            }
          }
        ]
      });
    }

    function destroySlickSlider() {
      if ($('.archive-row').hasClass('slick-initialized')) {
        $('.archive-row').slick('unslick');
      }
    }

    // Initialize or destroy slick slider based on screen width
    function checkScreenWidth() {
      if ($(window).width() < 575) {
        initSlickSlider();
      } else {
        destroySlickSlider();
      }
    }

    // Check screen width on window resize
    $(window).resize(function () {
      checkScreenWidth();
    });

    // Initial check on document ready
    checkScreenWidth();
  });

});

// Function to get session storage item
function getSessionStorageItem(key) {
  return sessionStorage.getItem(key);
}

// Function to set session storage item
function setSessionStorageItem(key, value) {
  sessionStorage.setItem(key, value);
}

// jQuery code to attach click event listener to body
jQuery(document).ready(function () {

  // Get the subscribe div
  var subscribeDiv = document.querySelector('.fa-bell');

  // Get the modal element
  var modal1 = new bootstrap.Modal(document.getElementById('myModal1'));

  // Add click event listener to the subscribe div
  jQuery(subscribeDiv).on('click', function () {
    // Show the modal when the subscribe div is clicked
    console.log('clicked')
    modal1.show();
  });
});

function addExcerpt(config) {
  config.forEach(function (item) {
    // Get all elements with the specified class
    var elements = document.querySelectorAll('.' + item.className);
    let i = 1;
    // Loop through each element and add an excerpt
    elements.forEach(function (element) {
      // Check if the element has a paragraph or anchor tag
      var textElement = element.querySelector('p') || element.querySelector('a');

      // Check if a text element exists
      if (textElement) {
        // Get the text content of the element and remove leading spaces
        var content = textElement.textContent.trim();
        // Set the excerpt based on the length specified in the config
        var excerpt = content.length >= item.excerptLength ? content.slice(0, item.excerptLength) + '...' : content;

        // Create a new element for the excerpt
        var excerptElement = document.createElement(textElement.tagName === 'A' ? 'a' : 'p'); // Create the appropriate element based on the tag name
        if (textElement.tagName === 'A') {
          excerptElement.href = textElement.href; // Preserve the link
        }
        excerptElement.textContent = excerpt;

        // Remove the old element
        element.removeChild(textElement);

        // Append the excerpt element to the element
        element.appendChild(excerptElement);
        i++;
      } else {
        console.error("No paragraph or anchor element found inside ." + item.className);
      }
    });
  });
}

// Define an array of objects containing class names and excerpt lengths
var config = [
  { className: 'song-description', excerptLength: 30 },
  { className: 'song-title', excerptLength: 17 }
];

// Call the function to add excerpts
addExcerpt(config);





document.addEventListener('DOMContentLoaded', function () {
  // Function to toggle options menu
  function toggleOptionsMenu() {
    var optionsMenu = document.querySelector('.options.single');
    if (optionsMenu.style.display === 'none') {
      optionsMenu.style.display = 'block';
    } else {
      optionsMenu.style.display = 'none';
    }
  }

  // Show/hide options menu on click of trigger
  var trigger = document.querySelector('.option-trigger.single');
  trigger.addEventListener('click', function (event) {
    toggleOptionsMenu();
    event.stopPropagation(); // Prevent event propagation to document click handler
  });

  // Hide options menu when clicked away
  document.addEventListener('click', function (event) {
    var optionsMenu = document.querySelector('.options.single');
    if (event.target !== trigger && !trigger.contains(event.target) && event.target !== optionsMenu && !optionsMenu.contains(event.target)) {
      optionsMenu.style.display = 'none';
    }
  });
});


var navbar = document.getElementById("header");
var sticky = navbar.offsetTop;
function myScrollNav() {
  if (window.pageYOffset > sticky) {
    //alert(window.pageYOffset);
    navbar.classList.add("sticky");
    navbar.classList.add("stickynavbar");
  } else {
    navbar.classList.remove("sticky");
    navbar.classList.remove("stickynavbar");
  }
}

