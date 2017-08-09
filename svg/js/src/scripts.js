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

    // Stacked mobile blocks
    if (window.innerWidth < 770) {

      $('.block-latest .entry, block-random .entry').each(function() {
        var contentheight =  $(this).find('.entry-details').outerHeight()
        $(this).find('.entry-featured-image').outerHeight(contentheight);
      })
    }

  });


  // Window scroll
  $(window).scroll(function() {

    // Hide scroll indicator after certain amount
    if( '.scroll-indicator' != undefined) {
      var scroll = $(window).scrollTop();
      if (scroll >= 200) {
        $('.scroll-indicator').addClass('fadeout');

        setTimeout( function(){
          $('.scroll-indicator').hide();
        }, 500 );

      } else {
        $('.scroll-indicator').removeClass('fadeout');

        setTimeout( function(){
          $('.scroll-indicator').show();
        }, 500 );
      }
    }
  });  

  // Document ready
  $(function() {

    // RSS feeds on front page
    $('.block-network .column-twitter').rss('https://twitrss.me/twitter_user_to_rss/?user=rolle', { limit: 2, ssl: true, layoutTemplate: '<div class="column column-twitter">{entries}</div>',
      entryTemplate: '<h4><a href="{url}">{title}</a></h4><div class="meta"><div class="meta-avatar" style="background-image: url(\'https://www.rollemaa.fi/content/themes/khonsu/images/avatar-twitter.jpg\');"></div><div class="meta-title-stuff"><h5><a href="https://twitter.com/rolle">@rolle Twitterissä</a></h5><h6><time datetime="{date}">{date}</time></h6></div></div>', dateFormat: 'D.M.Y', effect: 'show'
    });
    $('.block-network .column-huurteinen').rss('https://www.huurteinen.fi/feed/', { limit: 1, ssl: true, layoutTemplate: '<div class="column">{entries}</div>',
      entryTemplate: '<h4><a href="{url}">{title}</a></h4><div class="meta"><div class="meta-avatar" style="background-image: url(\'https://www.rollemaa.fi/content/themes/khonsu/images/avatar-huurteinen.png\');"></div><div class="meta-title-stuff"><h5><a href="https://www.huurteinen.fi">Huurteinen</a></h5><h6><time datetime="{date}">{date}</time></h6></div></div>', dateFormat: 'D.M.Y', effect: 'show'
    });
    $('.block-network .column-leffat').rss('https://www.rollemaa.fi/leffat-rss.php', { limit: 1, ssl: true, layoutTemplate: '<div class="column">{entries}</div>',
      entryTemplate: '<h4><a href="{url}">Elokuva-arvio: {title}</a></h4><div class="meta"><div class="meta-avatar" style="background-image: url(\'https://www.rollemaa.fi/content/themes/khonsu/images/avatar-leffat.png\');"></div><div class="meta-title-stuff"><h5><a href="https://www.rollemaa.fi/leffat">Rollen leffablogi</a></h5><h6><time datetime="{date}">{date}</time></h6></div></div>', dateFormat: 'D.M.Y', effect: 'show'
    });
    $('.block-network .column-geekylifestyle').rss('https://geekylifestyle.com/feed/', { limit: 1, ssl: true, layoutTemplate: '<div class="column">{entries}</div>',
      entryTemplate: '<h4><a href="{url}">{title}</a></h4><div class="meta"><div class="meta-avatar" style="background-image: url(\'https://www.rollemaa.fi/content/themes/khonsu/images/avatar-geekylifestyle.jpg\');"></div><div class="meta-title-stuff"><h5><a href="https://geekylifestyle.com">Geeky Lifestyle</a></h5><h6><time datetime="{date}">{date}</time></h6></div></div>', dateFormat: 'D.M.Y', effect: 'show'
    });
    $('.block-network .column-medium').rss('https://medium.com/feed/@rolle/', { limit: 1, ssl: true, layoutTemplate: '<div class="column">{entries}</div>',
      entryTemplate: '<h4><a href="{url}">{title}</a></h4><div class="meta"><div class="meta-avatar" style="background-image: url(\'https://www.rollemaa.fi/content/themes/khonsu/images/avatar-medium.png\');"></div><div class="meta-title-stuff"><h5><a href="https://medium.com/@rolle">Stories by Roni Laukkarinen on Medium</a></h5><h6><time datetime="{date}">{date}</time></h6></div></div>', dateFormat: 'D.M.Y', effect: 'show'
    });
    $('.block-network .column-dude').rss('https://www.dude.fi/feed', { limit: 1, ssl: true, layoutTemplate: '<div class="column">{entries}</div>',
      entryTemplate: '<h4><a href="{url}">{title}</a></h4><div class="meta"><div class="meta-avatar" style="background-image: url(\'https://www.rollemaa.fi/content/themes/khonsu/images/avatar-dude.png\');"></div><div class="meta-title-stuff"><h5><a href="https://www.dude.fi/blogi">Digitoimisto Dude</a></h5><h6><time datetime="{date}">{date}</time></h6></div></div>', dateFormat: 'D.M.Y', effect: 'show'
    });

    // Fitvids
    $('.entry-content, .entry-content p, .entry-content iframe, .post').fitVids();

    // Load random posts dynamically
    $('.dynamic-content').load('/content/themes/khonsu/template-parts/block-random-dynamic.php');
    $('.load-more-random').on('click', function(e) {
      e.preventDefault();
      $('.dynamic-content').load('/content/themes/khonsu/template-parts/block-random-dynamic.php');
    });

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
     if ( width < 580 && width > 100 ) {
        $this.addClass('too-small');
      }
    });

    // Max height for hero, fix iOS scaling issues
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

        // Stacked mobile blocks
        if (window.innerWidth < 770) {

          $('.block-latest .entry, block-random .entry').each(function() {
            var contentheight =  $(this).find('.entry-details').outerHeight()
            $(this).find('.entry-featured-image').outerHeight(contentheight);
          })
        }

        // Max height for hero, fix iOS scaling issues
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
