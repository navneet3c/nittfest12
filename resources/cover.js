function _escape(a){a=a.replace(/ /g,"+");a=a.replace(/%/g,"%25");a=a.replace(/\?/,"%3F");a=a.replace(/&amp;/,"%26");return a}function showClock(b){var c='bed src="http://www.worldtimeserver.com/clocks/'+b.wtsclock+"?",d,a;for(d in b){if("wtsclock"==d||"width"==d||"height"==d||"wmode"==d||"type"==d){continue}c+=(d+"="+_escape(b[d])+"&")}c+='" ';c+=' width="'+b.width+'"';c+=' height="'+b.height+'"';a=(navigator.userAgent.indexOf("Opera")!=-1)?true:false;if(a!=true){c+=' wmode="'+b.wmode+'"'}c+=' type="application/x-shockwave-flash" allowscriptaccess="always" />';document.write("<em"+c)}function clocker(){objIN=new Object;objIN.wtsclock="wtsclock001.swf";objIN.color="140603";objIN.wtsid="IN"; objIN.width=120;objIN.height=120;objIN.wmode="transparent";showClock(objIN)};

function tabLink(){
	$('.tabLink').click(function(){//tab switching
		var ths=$(this);
		$('.tabLink').removeClass('activeLink');
		ths.addClass('activeLink');
		$('.tabContent').css('display','none');
		$('#content'+ths.attr('tnumber')).fadeIn('fast');
	});
}
var ajax,ev,ajaxsub;	
$(window).ready(function(){
var ele=$('#icons a');
for(var i=ele.length-1;i>=0;--i){
	ele[i].onmouseover=function(){
		var lef=$(this).position().left;
		$('#iconBack').stop(true);
		$('#iconBack').animate({'left':lef+5+'px'},'fast',function(){
			$('#iconBack').animate({'left':lef+'px'} ,'fast');
		});
		$(this).animate({'opacity':'1'},'fast');
	};
	ele[i].onmouseout=function(){
		$('#iconBack').stop(true);
		$('#iconBack').animate({'left':'60px'},'slow',function(){
			$('#iconBack').animate({'left':'65px'} ,'fast');
		});
			$(this).animate({'opacity':'0.7'},'slow');
	};
}
if(window.XMLHttpRequest){
	ajaxsub=new XMLHttpRequest();
	ajax=new XMLHttpRequest();
}
else{
	ajaxsub=new ActiveXObject('Microsoft.XMLHTTP');
	ajax=new ActiveXObject('Microsoft.XMLHTTP');
}
function eventajax(){
	$('.ajaxLink').click(function(event){
		event.preventDefault();
		ev=this.getAttribute('alt');
		ajax.eventName=ev;
		ajax.running=1;
		if(this.childNodes[0].attributes)
			ajax.eventTitle=this.childNodes[0].getAttribute('title');
		else
			ajax.eventTitle=this.getAttribute('title');
		location.hash="event="+ev;
		document.title="NITTFEST '12 :: "+ajax.eventTitle+" [Loading...]";
		ajax.open("POST","cover.php?ajax&event="+ev,true);
		ajax.send();
	});
}
function subeventAjax(){
	$('.ajaxSubevent').click(function(event){
			event.preventDefault();
			ev=this.getAttribute('alt');
			ajaxsub.running=1;
			location.hash="subevent="+ev;
			document.title="NITTFEST '12 :: "+ajax.eventTitle+" [Loading...]";
			ajaxsub.open("POST","cover.php?ajax&subevent="+ev,true);
			ajaxsub.send();
	});
}
eventajax();
ajaxsub.onreadystatechange=function(){
	ajaxsub.running=0;
	if(ajaxsub.readyState==4 && ajaxsub.status==200){
		$('#sandbox').fadeOut('fast',function(){
			document.getElementById('sandbox').innerHTML=ajaxsub.responseText;
			document.title="NITTFEST '12 :: "+ajax.eventTitle;
			tabLink();
			$('#tabContent div:first').css('display','block');
			$('#tabList a:first').addClass('activeLink');
			eventajax();
			$('#sandbox').fadeIn('fast');
		});
	}
};
ajax.onreadystatechange=function(){
	if(ajax.readyState==4 && ajax.status==200){
		ajax.running=0;
		$('#sandbox').fadeOut('fast',function(){
			document.title="NITTFEST '12 :: "+ajax.eventTitle;
			document.getElementById('sandbox').innerHTML=ajax.responseText;
			if(ajax.eventName=='scores')
				$('.lightbox').colorbox({
			initialWidth: "200",
			initialHeight: "100"
			});
			tabLink();
			$('#tabContent div:first').css('display','block');
			$('#tabList a:first').addClass('activeLink');
			subeventAjax();
			$('#sandbox').fadeIn('fast');
		});
	}
};
});
window.onload=function(){
$('#tabContent div:first').css('display','block');
$('#tabList a:first').addClass('activeLink');
$('#load-div-wrapper').fadeOut(100);
$('#content-div-wrapper').fadeIn(500);


(function(d, s, id) {
var js, fjs = d.getElementsByTagName(s)[0];
if (d.getElementById(id)) return;
js = d.createElement(s); js.id = id;
js.src = "//connect.facebook.net/en_US/all.js#xfbml=1";
fjs.parentNode.insertBefore(js, fjs);
}(document, 'script', 'facebook-jssdk'));

window.setInterval(function(){
	$('#logo').animate({'opacity':0.7},500);
		window.setTimeout(function(){$('#logo').animate({'opacity':1.0},500);},500)
}, 2000);
$("#sponsorSlideshow").nivoSlider({
	effect: 'fade',
	animSpeed: 100,
	pauseTime: 3000,
	startSlide: 0,
	directionNav: false,
	controlNav: false,
	keyboardNav: false,
	pauseOnHover: true,
});
$("#updates").nivoSlider({
	effect: 'fade',
	animSpeed: 100,
	pauseTime: 3000,
	startSlide: 0,
	directionNav: false,
	controlNav: false,
	keyboardNav: false,
	pauseOnHover: true,
});
$('#sponsors').fadeIn(100);
};
