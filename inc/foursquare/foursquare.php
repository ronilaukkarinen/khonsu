<?php
require('FoursquareAPI.class.php');
$foursquare = new FoursquareAPI("U4XDRE2DOB1TVLPF2M1HS3KWYQJXEDICCAEV1NCOJ3O5DQ40", "3CLTCH4HNBFLIK4G40LH13QIFIEVT2GZFL41PZ324DM4KRUZ");

$auth_token = "BOUMIKQE5IRJXLJEPZGUCRTHID5CE5Z2PYSO11UDEOZQ4QPP";
$foursquare->SetAccessToken($auth_token);

$endpoint = "users/self";

$source = $foursquare->GetPrivate($endpoint);
$json = json_decode($source, true);

$lat = $json["response"]["user"]["checkins"]["items"]["0"]["venue"]["location"]["lat"];
$lng = $json["response"]["user"]["checkins"]["items"]["0"]["venue"]["location"]["lng"];
$name = $json["response"]["user"]["checkins"]["items"]["0"]["venue"]["name"];
$city = $json["response"]["user"]["checkins"]["items"]["0"]["venue"]["location"]["city"];
$country = $json["response"]["user"]["checkins"]["items"]["0"]["venue"]["location"]["country"];
$category = $json["response"]["user"]["checkins"]["items"]["0"]["venue"]["categories"][0]["shortName"];
$url = 'http://foursquare.com/v/'.$json["response"]["user"]["checkins"]["items"]["0"]["venue"]["id"];

$mapurl = "https://maps.google.com/maps/api/staticmap?sensor=true&amp;center=".$lat.",".$lng."&amp;maptype=roadmap&amp;size=600x400&amp;style=saturation:-50&amp;style=feature:landscape|visibility:simplified&amp;style=feature:road.highway|visibility:simplified&amp;sensor=false&amp;zoom=13&amp;markers=color:green|".$lat.",".$lng."|";

?>

<div class="place equal" style="background-image:url(<?php echo $mapurl; ?>);">

<div class="fold">
	<div class="stuff-info">
		<h3><a href="<?php echo $url; ?>" title="<?php echo $name; ?> Foursquaressa"><?php echo $name; ?></a></h3>
		<h4><?php echo $category; ?>, <?php echo $city; ?></h4>
	</div>
</div>

</div>

<?php
// Testing:

// echo '<pre>';
// print_r($json["response"]["user"]["checkins"]["items"]["0"]["venue"]);
// echo '</pre>';

//echo $json['countryId'];

// Kartta: 
//working: https://maps.google.com/maps/api/staticmap?sensor=false&amp;center=46311&amp;zoom=14&amp;size=600x400