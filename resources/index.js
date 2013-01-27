window.onload=function(){
  	$('#load-div-wrapper').fadeOut(100);
	$('#content-div-wrapper').fadeIn(500);
	$("#sponsorSlideshow").cycle({ timeout: 3000, speed: 300 });
  	$('#sponsors').fadeIn(100);
  	window.setInterval(function(){
		$('#banner').animate({'opacity':0.7},500);
		window.setTimeout(function(){$('#banner').animate({'opacity':1.0},500);},500)
  	}, 2000);
/*  	document.getElementById('audio2').play(); */
	$('#contacts-button').click(function(){  
		document.getElementById('audio1').play();
		$('#contactsLayer').fadeIn('fast'); 
		$('#contacts div').slideToggle('fast');
	});
  	$('#contactsLayer').click(function(){ 
  	$('#contacts div').stop(); $('#contacts div').fadeOut(200,function(){$('#contactsLayer').fadeOut('fast');});
  	
  	});
  (function(d, s, id) {
  var js, fjs = d.getElementsByTagName(s)[0];
  if (d.getElementById(id)) return;
  js = d.createElement(s); js.id = id;
  js.src = "//connect.facebook.net/en_US/all.js#xfbml=1";
  fjs.parentNode.insertBefore(js, fjs);
}(document, 'script', 'facebook-jssdk'));
};
