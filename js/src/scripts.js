/**
 * khonsu theme JavaScript.
 */

// jQuery start
( function( $ ) {

  // Window load
  $( window ).load(function() {

    // Equal height blocks
    if (window.innerWidth > 600) {
      $('.equal, .artist-image, .trakt-image').css( { 'height': ($('.col-min').outerHeight() + 'px' ) });
    }
  });


  // Window scroll
  $(window).scroll(function() {

    // Hide scroll indicator after certain amount
    if( '.scroll-indicator' != undefined) {
      var scroll = $(window).scrollTop();
      if (scroll >= 200) {
        $('.scroll-indicator').addClass('fadeout');
      } else {
        $('.scroll-indicator').removeClass('fadeout');
      }
    }
  });  

  // Document ready
  $(function() {

    // Hide ads if dismissed
    var ad_cookie_status = Cookies.get( 'ad_cookie_status' );
    if( ad_cookie_status === 'dismiss' ) {
      $('.advertisement').remove();
    }

    // Make ads dismissable on iOS/iPhone SE
    var ua = navigator.userAgent,
    event = (ua.match(/iPad/i) || ua.match(/iPhone/)) ? 'touchstart' : 'click';

    $('body').on(event, '.advertisement .close', function(e) {
      $('.advertisement').addClass('fadeout');

      Cookies.set( 'ad_cookie_status', 'dismiss', { expires: 3650 } );

      $('.advertisement').addClass('fadeout');

      setTimeout( function(){
        $('.advertisement').remove();
      }, 1000 );
    });

    $('.advertisement a.close').on('click', function(e) {
      e.preventDefault();

      Cookies.set( 'ad_cookie_status', 'dismiss', { expires: 3650 } );

      $('.advertisement').addClass('fadeout');

      setTimeout( function(){
        $('.advertisement').remove();
      }, 1000 );
    });

    // Add class to all images under certain width
    $('.single-post .entry-content').find('img').each(function () {
     var $this = $(this), width = $this.width();
     if (width < 580) {
      $this.addClass('too-small');
    }
    });

    // Prevent 100vh slides from "jumping" when browsing on mobile and address bar goes hidden
    function greedyJumbotron() {
        var HEIGHT_CHANGE_TOLERANCE = 100; // Approximately URL bar height in Chrome on tablet

        var jumbotron = $(this);
        var viewportHeight = $(window).height();

        $(window).resize(function () {
          if (Math.abs(viewportHeight - $(window).height()) > HEIGHT_CHANGE_TOLERANCE) {
            viewportHeight = $(window).height();
            update();
          }
        });

        function update() {
          jumbotron.css('height', viewportHeight + 'px');
        }

        update();
      }

      $('.hero-single').each(greedyJumbotron);

      // Window resize
      $(window).on('resize', function() {

         // Equal height blocks
         if (window.innerWidth > 600) {
          $('.equal, .artist-image, .trakt-image').css( { 'height': ($('.col-min').outerHeight() + 'px' ) });
        }

        $('.hero-single').each(greedyJumbotron);
      });

    // Smooth scroll to ID on any anchor link
    $('a[href^="#"]').on('click',function (e) {
      e.preventDefault();

      var target = this.hash;
      var $target = $(target);

      $('html, body').stop().animate({
        'scrollTop': $target.offset().top
      }, 500, 'swing', function () {
        window.location.hash = target;
      });
    });    

    // Show other fields only when starting typing comment
    $('textarea#comment').keyup(function(){
      $('.hidden-by-default').addClass('show');
    });

    // Dynamic footer loading thingy
    $('.load-dynamic-footer').click(function(event) {
      event.preventDefault();
      $(this).hide();
      $('#loading').show();

      $.ajax({
        url: dynamicFooter.url,
        type: 'POST',
        data: {
          action: 'load_posts'
        },
        success: function( data ) {
          $('.loader-stuff').fadeOut();
          $('#dynamic-footer').append( data );
          $('#loading').fadeOut();

          $('html, body').animate({
            scrollTop: $("#colophon").offset().top
          }, 1000);

          setTimeout(function() {
              // Equal height blocks
              if (window.innerWidth > 600) {
                $('.equal, .artist-image, .trakt-image').css( { 'height': ($('.col-min').outerHeight() + 'px' ) });
              }
            }, 500);

          setTimeout(function() {
              // Equal height blocks, again, to make sure
              if (window.innerWidth > 600) {
                $('.equal, .artist-image, .trakt-image').css( { 'height': ($('.col-min').outerHeight() + 'px' ) });
              }
            }, 1500);
        }
      });
    });

    // Fancybox
    $('a.fancy').fancybox({
      openEffect  : 'none',
      closeEffect : 'none',
      padding     : '0',
      closeBtn    : false,
      closeClick  : true,
      openEffect  : 'elastic',
      closeEffect : 'elastic',
      openSpeed   : 'slow',
      closeSpeed  : 'slow',
      openMethod  : 'zoomIn',
      closeMethod : 'zoomOut',
      autoSize  : true,
      autoCenter  : true,
      helpers : {
        title: {
          type: 'outside'
        }
      }
    });

  });

} )( jQuery );
