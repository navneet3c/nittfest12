<?php
if(defined('alpha123@#Veuk4OkDik['))
	$const=constant('alpha123@#Veuk4OkDik[');
else
	$const='';
if($const!='ri[twu3Baj-]obCicdotok4'){
	header($_SERVER['SERVER_PROTOCOL'].' 403 Forbidden');
	echo '<h1>403 Forbidden<h1><h4>You are not authorized to access the page.</h4>';
	echo '<hr/>'.$_SERVER['SERVER_SIGNATURE'];
	exit(1);
}
function base64_url_decode($input) {
	return base64_decode(strtr($input, '-_', '+/'));
}
if(isset($_GET['id'])){
$signed_request=$_GET['id'];
$secret='c8eb9487bb0e4175224fd00feb890c76';
list($encoded_sig, $payload) = explode('.', $signed_request, 2); 
// decode the data
$sig = base64_url_decode($encoded_sig);
$data = json_decode(base64_url_decode($payload), true);
if (strtoupper($data['algorithm']) !== 'HMAC-SHA256')
	throw new Exception('Unknown algorithm. Expected HMAC-SHA256');
// check sig
$expected_sig = hash_hmac('sha256', $payload, $secret, $raw = true);
if ($sig !== $expected_sig)
	throw new Exception('Bad login attemp. Please retry!');
$id=$data['user_id'];
$res=mysql_fetch_assoc(run_query("SELECT `userid`,`signedrequest` FROM `users` WHERE `openid`='$id'"));
if(!$res){
	run_query("INSERT INTO `users` VALUES(null,'$id','4','','".time()."','$signed_request');");
	echo "Your details have been registered.";
}
if($res['signedrequest']==$signed_request && 
!isset($_SESSION['userid']))
	throw new Exception('Your login attempt has expired. Please login again. Restart your browser if problem continues.');
run_query("UPDATE `users` SET `time`='".time()."',`signedrequest`='$signed_request' WHERE `userid`='$id';");
$_SESSION['userid']=$res['userid'];

} else {
?>
<script>
(function(d){
var js, id = 'facebook-jssdk', ref = d.getElementsByTagName('script')[0];
if (d.getElementById(id)) {return;}
js = d.createElement('script'); js.id = id; js.async = true;
js.src = "//connect.facebook.net/en_US/all.js";
ref.parentNode.insertBefore(js, ref);
}(document));

window.fbAsyncInit = function() {
	FB.init({
	appId : '405090642838620', // App ID
	channelUrl : '//nittfest.in/resources/channel.php', // Channel File
	status : true, // check login status
	cookie : true, // enable cookies to allow the server to access the session
	xfbml : true
	});
	
			document.getElementById('fbLogin').innerHTML='<a href="#" title="Login with Facebook"><img src="blog/fb-logo.png" /></a><br /><br />';
			$('#fbLogin a').click(function(){
		
		FB.login(function(response) {
		if (response.authResponse) {
			document.location="blog.php?id="+response.authResponse.signedRequest;
		}
		});
		});
	
};
</script>
<div id="fbLogin"></div>
<?php
}
?>
