/*! rollemaa 21-01-2020 17:51 - Digitoimisto Dude Oy (moro@dude.fi) */
/(trident|msie)/i.test(navigator.userAgent)&&document.getElementById&&window.addEventListener&&window.addEventListener("hashchange",function(){var e,t=location.hash.substring(1);/^[A-z0-9_-]+$/.test(t)&&(e=document.getElementById(t))&&(/^(?:a|select|input|button|textarea)$/i.test(e.tagName)||(e.tabIndex=-1),e.focus())},!1);var MoveTo=function(){var e={tolerance:0,duration:800,easing:"easeOutQuart",container:window,callback:function(){}};function t(e,t,n,o){return e/=o,-n*(--e*e*e*e-1)+t}function n(e,t){var n={};return Object.keys(e).forEach(function(t){n[t]=e[t]}),Object.keys(t).forEach(function(e){n[e]=t[e]}),n}function o(e){return e instanceof HTMLElement?e.scrollTop:e.pageYOffset}function i(){var o=arguments.length>0&&void 0!==arguments[0]?arguments[0]:{},i=arguments.length>1&&void 0!==arguments[1]?arguments[1]:{};this.options=n(e,o),this.easeFunctions=n({easeOutQuart:t},i)}return i.prototype.registerTrigger=function(e,t){var o=this;if(e){var i=e.getAttribute("href")||e.getAttribute("data-target"),a=i&&"#"!==i?document.getElementById(i.substring(1)):document.body,r=n(this.options,function(e,t){var n={};return Object.keys(t).forEach(function(t){var o=e.getAttribute("data-mt-"+t.replace(/([A-Z])/g,function(e){return"-"+e.toLowerCase()}));o&&(n[t]=isNaN(o)?o:parseInt(o,10))}),n}(e,this.options));"function"==typeof t&&(r.callback=t);var s=function(e){e.preventDefault(),o.move(a,r)};return e.addEventListener("click",s,!1),function(){return e.removeEventListener("click",s,!1)}}},i.prototype.move=function(e){var t=this,i=arguments.length>1&&void 0!==arguments[1]?arguments[1]:{};if(0===e||e){i=n(this.options,i);var a="number"==typeof e?e:e.getBoundingClientRect().top,r=o(i.container),s=null,c=void 0;a-=i.tolerance;window.requestAnimationFrame(function n(d){var u=o(t.options.container);s||(s=d-1);var l=d-s;if(c&&(a>0&&c>u||a<0&&c<u))return i.callback(e);c=u;var f=t.easeFunctions[i.easing](l,r,a,i.duration);i.container.scroll(0,f),l<i.duration?window.requestAnimationFrame(n):(i.container.scroll(0,a+r),i.callback(e))})}},i.prototype.addEaseFunction=function(e,t){this.easeFunctions[e]=t},i}();"undefined"!=typeof module?module.exports=MoveTo:window.MoveTo=MoveTo,function(e,t){"object"==typeof exports&&"object"==typeof module?module.exports=t():"function"==typeof define&&define.amd?define("whatInput",[],t):"object"==typeof exports?exports.whatInput=t():e.whatInput=t()}(this,function(){return function(e){var t={};function n(o){if(t[o])return t[o].exports;var i=t[o]={exports:{},id:o,loaded:!1};return e[o].call(i.exports,i,i.exports,n),i.loaded=!0,i.exports}return n.m=e,n.c=t,n.p="",n(0)}([function(e,t){"use strict";e.exports=function(){if("undefined"==typeof document||"undefined"==typeof window)return{ask:function(){return"initial"},element:function(){return null},ignoreKeys:function(){},specificKeys:function(){},registerOnChange:function(){},unRegisterOnChange:function(){}};var e=document.documentElement,t=null,n="initial",o=n,i=Date.now();try{window.sessionStorage.getItem("what-input")&&(n=window.sessionStorage.getItem("what-input")),window.sessionStorage.getItem("what-intent")&&(o=window.sessionStorage.getItem("what-intent"))}catch(e){}var a=["button","input","select","textarea"],r=[],s=[16,17,18,91,93],c=[],d={keydown:"keyboard",keyup:"keyboard",mousedown:"mouse",mousemove:"mouse",MSPointerDown:"pointer",MSPointerMove:"pointer",pointerdown:"pointer",pointermove:"pointer",touchstart:"touch",touchend:"touch"},u=!1,l={x:null,y:null},f={2:"touch",3:"touch",4:"mouse"},h=!1;try{var m=Object.defineProperty({},"passive",{get:function(){h=!0}});window.addEventListener("test",null,m)}catch(e){}var w=function(){var e=!!h&&{passive:!0};window.PointerEvent?(window.addEventListener("pointerdown",p),window.addEventListener("pointermove",g)):window.MSPointerEvent?(window.addEventListener("MSPointerDown",p),window.addEventListener("MSPointerMove",g)):(window.addEventListener("mousedown",p),window.addEventListener("mousemove",g),"ontouchstart"in window&&(window.addEventListener("touchstart",p,e),window.addEventListener("touchend",p))),window.addEventListener(x(),g,e),window.addEventListener("keydown",p),window.addEventListener("keyup",p),window.addEventListener("focusin",y),window.addEventListener("focusout",k)},p=function(e){var t=e.which,i=d[e.type];"pointer"===i&&(i=b(e));var r=!c.length&&-1===s.indexOf(t),u=c.length&&-1!==c.indexOf(t),l="keyboard"===i&&t&&(r||u)||"mouse"===i||"touch"===i;if(E(i)&&(l=!1),l&&n!==i){n=i;try{window.sessionStorage.setItem("what-input",n)}catch(e){}v("input")}if(l&&o!==i){var f=document.activeElement;if(f&&f.nodeName&&-1===a.indexOf(f.nodeName.toLowerCase())||"button"===f.nodeName.toLowerCase()&&!M(f,"form")){o=i;try{window.sessionStorage.setItem("what-intent",o)}catch(e){}v("intent")}}},v=function(t){e.setAttribute("data-what"+t,"input"===t?n:o),L(t)},g=function(e){var t=d[e.type];if("pointer"===t&&(t=b(e)),T(e),!u&&!E(t)&&o!==t){o=t;try{window.sessionStorage.setItem("what-intent",o)}catch(e){}v("intent")}},y=function(n){n.target.nodeName?(t=n.target.nodeName.toLowerCase(),e.setAttribute("data-whatelement",t),n.target.classList&&n.target.classList.length&&e.setAttribute("data-whatclasses",n.target.classList.toString().replace(" ",","))):k()},k=function(){t=null,e.removeAttribute("data-whatelement"),e.removeAttribute("data-whatclasses")},b=function(e){return"number"==typeof e.pointerType?f[e.pointerType]:"pen"===e.pointerType?"touch":e.pointerType},E=function(e){var t=Date.now(),o="mouse"===e&&"touch"===n&&t-i<200;return i=t,o},x=function(){return"onwheel"in document.createElement("div")?"wheel":void 0!==document.onmousewheel?"mousewheel":"DOMMouseScroll"},L=function(e){for(var t=0,i=r.length;t<i;t++)r[t].type===e&&r[t].fn.call(void 0,"input"===e?n:o)},T=function(e){l.x!==e.screenX||l.y!==e.screenY?(u=!1,l.x=e.screenX,l.y=e.screenY):u=!0},M=function(e,t){var n=window.Element.prototype;if(n.matches||(n.matches=n.msMatchesSelector||n.webkitMatchesSelector),n.closest)return e.closest(t);do{if(e.matches(t))return e;e=e.parentElement||e.parentNode}while(null!==e&&1===e.nodeType);return null};return"addEventListener"in window&&Array.prototype.indexOf&&(d[x()]="mouse",w(),v("input"),v("intent")),{ask:function(e){return"intent"===e?o:n},element:function(){return t},ignoreKeys:function(e){s=e},specificKeys:function(e){c=e},registerOnChange:function(e,t){r.push({fn:e,type:t||"input"})},unRegisterOnChange:function(e){var t=function(e){for(var t=0,n=r.length;t<n;t++)if(r[t].fn===e)return t}(e);(t||0===t)&&r.splice(t,1)}}}()}])}),function(e){e(window).load(function(){window.innerWidth>600&&e(".equal, .artist-image, .trakt-image").css({height:e(".col-min").outerHeight()+"px"}),e("#dynamic-lastfm").load(dynamicFooter.lastfm),setInterval(function(){e("#dynamic-lastfm").load(dynamicFooter.lastfm)},3e4)}),e(window).scroll(function(){e(window).scrollTop()>=200?(e(".scroll-indicator").addClass("fadeout"),setTimeout(function(){e(".scroll-indicator").hide()},500)):(e(".scroll-indicator").removeClass("fadeout"),setTimeout(function(){e(".scroll-indicator").show()},500))}),e(function(){e(".block-network .column-huurteinen").rss("https://www.huurteinen.fi/feed/",{limit:1,ssl:!0,layoutTemplate:'<div class="column">{entries}</div>',entryTemplate:'<h4><a href="{url}">{title}</a></h4><div class="meta"><div class="meta-avatar" style="background-image: url(\'https://www.rollemaa.fi/content/themes/khonsu/images/avatar-huurteinen.png\');"></div><div class="meta-title-stuff"><h5><a href="https://www.huurteinen.fi">Huurteinen</a></h5><h6><time datetime="{date}">{date}</time></h6></div></div>',dateFormat:"D.M.Y",effect:"show"}),e(".block-network .column-leffat").rss("https://www.rollemaa.fi/leffat-rss.php",{limit:1,ssl:!0,layoutTemplate:'<div class="column">{entries}</div>',entryTemplate:'<h4><a href="{url}">Elokuva-arvio: {title}</a></h4><div class="meta"><div class="meta-avatar" style="background-image: url(\'https://www.rollemaa.fi/content/themes/khonsu/images/avatar-leffat.png\');"></div><div class="meta-title-stuff"><h5><a href="https://www.rollemaa.fi/leffat">Rollen leffablogi</a></h5><h6><time datetime="{date}">{date}</time></h6></div></div>',dateFormat:"D.M.Y",effect:"show"}),e(".block-network .column-geekylifestyle").rss("https://geekylifestyle.com/feed/",{limit:1,ssl:!0,layoutTemplate:'<div class="column">{entries}</div>',entryTemplate:'<h4><a href="{url}">{title}</a></h4><div class="meta"><div class="meta-avatar" style="background-image: url(\'https://www.rollemaa.fi/content/themes/khonsu/images/avatar-geekylifestyle.jpg\');"></div><div class="meta-title-stuff"><h5><a href="https://geekylifestyle.com">Geeky Lifestyle</a></h5><h6><time datetime="{date}">{date}</time></h6></div></div>',dateFormat:"D.M.Y",effect:"show"}),e(".block-network .column-dude").rss("https://www.dude.fi/feed",{limit:1,ssl:!0,layoutTemplate:'<div class="column">{entries}</div>',entryTemplate:'<h4><a href="{url}">{title}</a></h4><div class="meta"><div class="meta-avatar" style="background-image: url(\'https://www.rollemaa.fi/content/themes/khonsu/images/avatar-dude.png\');"></div><div class="meta-title-stuff"><h5><a href="https://www.dude.fi/blogi">Digitoimisto Dude</a></h5><h6><time datetime="{date}">{date}</time></h6></div></div>',dateFormat:"D.M.Y",effect:"show"}),e(".entry-content, .entry-content p, .entry-content iframe, .post").fitVids(),e(".dynamic-content").load("/content/themes/khonsu/template-parts/block-random-dynamic.php"),e(".load-more-random").on("click",function(t){t.preventDefault(),e(".dynamic-content").load("/content/themes/khonsu/template-parts/block-random-dynamic.php")}),"dismiss"===Cookies.get("ad_cookie_status")&&e(".advertisement").remove();var t=navigator.userAgent;t.match(/iPad/i)||t.match(/iPhone/);function n(){var t=e(this),n=e(window).height();function o(){t.css("height",n+"px")}e(window).resize(function(){Math.abs(n-e(window).height())>100&&(n=e(window).height(),o())}),o()}e(".single-post .entry-content").find("img").each(function(){var t=e(this),n=t.width();n<580&&n>100&&t.addClass("too-small")}),e(".hero-single").each(n),e(window).on("resize",function(){window.innerWidth>600&&e(".equal, .artist-image, .trakt-image").css({height:e(".col-min").outerHeight()+"px"}),window.innerWidth<770&&e(".block-latest .entry, block-random .entry").each(function(){var t=e(this).find(".entry-details").outerHeight();e(this).find(".entry-featured-image").outerHeight(t)}),e(".hero-single").each(n)}),e('a[href^="#"]').on("click",function(t){t.preventDefault();var n=this.hash,o=e(n);e("html, body").stop().animate({scrollTop:o.offset().top},500,"swing",function(){window.location.hash=n})}),e("textarea#comment").keyup(function(){e(".hidden-by-default").addClass("show")}),e(".load-dynamic-footer").click(function(t){t.preventDefault(),e(this).hide(),e("#loading").show(),e.ajax({url:dynamicFooter.url,type:"POST",data:{action:"load_posts"},success:function(t){e(".loader-stuff").fadeOut(),e("#dynamic-footer").append(t),e("#loading").fadeOut(),e("html, body").animate({scrollTop:e("#colophon").offset().top},1e3),setTimeout(function(){window.innerWidth>600&&e(".equal, .artist-image, .trakt-image").css({height:e(".col-min").outerHeight()+"px"})},500),setTimeout(function(){window.innerWidth>600&&e(".equal, .artist-image, .trakt-image").css({height:e(".col-min").outerHeight()+"px"})},1500)}})}),e("a.fancy").fancybox({openEffect:"none",closeEffect:"none",padding:"0",closeBtn:!1,closeClick:!0,openEffect:"elastic",closeEffect:"elastic",openSpeed:"slow",closeSpeed:"slow",openMethod:"zoomIn",closeMethod:"zoomOut",autoSize:!0,autoCenter:!0,helpers:{title:{type:"outside"}}})})}(jQuery);
//# sourceMappingURL=all.js.map
