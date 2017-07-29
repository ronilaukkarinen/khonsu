<?php 
	require_once("FoursquareAPI.class.php");
	
	// This file is intended to be used as your redirect_uri for the client on Foursquare
	
	// Set your client key and secret
	$client_key = "U4XDRE2DOB1TVLPF2M1HS3KWYQJXEDICCAEV1NCOJ3O5DQ40";
	$client_secret = "3CLTCH4HNBFLIK4G40LH13QIFIEVT2GZFL41PZ324DM4KRUZ";
	$redirect_uri = "http://bliss:5757/content/themes/newera/inc/foursquare-tokenrequest.php";
	
	// Load the Foursquare API library
	$foursquare = new FoursquareAPI($client_key,$client_secret);
	
	// If the link has been clicked, and we have a supplied code, use it to request a token
	if(array_key_exists("code",$_GET)){
		$token = $foursquare->GetToken($_GET['code'],$redirect_uri);
	}
	
?>
<!doctype html>
<html>
<head>
	<title>PHP-Foursquare :: Token Request</title>
</head>
<body>
<h1>Token Request</h1>
<p>
	<?php 
	// If we have not received a token, display the link for Foursquare webauth
	if(!isset($token)){ 
		echo "<a href='".$foursquare->AuthenticationLink($redirect_uri)."'>Connect to this app via Foursquare</a>";
	// Otherwise display the token
	}else{
		echo "Your auth token: $token";
	}
	
	?>
	
</p>
<hr />
<?php 
	
?>
</body>
</html>
