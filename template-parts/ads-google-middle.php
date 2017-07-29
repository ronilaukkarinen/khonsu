<?php
/**
 * Ads for the middle section of the page
 *
 * @package khonsu
 */

if ( $count == 2 || is_page() || is_single() ) : ?>

<div class="keskimainos-desktop keskimainos">
	<script async src="//pagead2.googlesyndication.com/pagead/js/adsbygoogle.js"></script>
	<!-- Jättibanneri keskellä (728x90) -->
	<ins class="adsbygoogle"
	style="display:inline-block;width:728px;height:90px"
	data-ad-client="ca-pub-8523880252818258"
	data-ad-slot="1607949247"></ins>
	<script>
		(adsbygoogle = window.adsbygoogle || []).push({});
	</script>
</div>

<div class="keskimainos-mobile keskimainos">
	<script async src="//pagead2.googlesyndication.com/pagead/js/adsbygoogle.js"></script>
	<!-- Mobiilibanneri -->
	<ins class="adsbygoogle"
	style="display:inline-block;width:320px;height:100px"
	data-ad-client="ca-pub-8523880252818258"
	data-ad-slot="7514882041"></ins>
	<script>
		(adsbygoogle = window.adsbygoogle || []).push({});
	</script>
</div>

<div class="keskimainos-ipad keskimainos">
	<script async src="//pagead2.googlesyndication.com/pagead/js/adsbygoogle.js"></script>
	<!-- Keskikokoinen mainos (iPad) -->
	<ins class="adsbygoogle"
	style="display:inline-block;width:468px;height:60px"
	data-ad-client="ca-pub-8523880252818258"
	data-ad-slot="5898548047"></ins>
	<script>
		(adsbygoogle = window.adsbygoogle || []).push({});
	</script>
</div>

<?php endif; ?>