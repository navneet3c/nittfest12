$(window).ready(function(){

function threadName(){
	$('.ajaxThreadName').click(function(event){
		event.preventDefault();
		ev=this.getAttribute('href');
		ajaxthread.running=1;
		location.hash=ev;
		document.title="NITTFEST '12 [Loading...]";
		ajaxthread.open("GET",ev+"&ajax",true);
		ajaxthread.send();
	});
}
function activity(){
$('.ajaxActivityComment').click(function(event){
	event.preventDefault();
	ev=this.getAttribute('href');
	ajax.open("GET",ev+"&ajax",true);
	ajax.focusElement=this.parentNode.parentNode;
	$(ajax.focusElement).find('.activityStatus').html('Processing...');
	ajax.send();
});
}
	
var ajax,ajaxthread;	
if(window.XMLHttpRequest){
	ajax=new XMLHttpRequest();
	ajaxthread=new XMLHttpRequest();
}
else{
	ajax=new ActiveXObject('Microsoft.XMLHTTP');
	ajaxthread=new XMLHttpRequest();
}
activity();
threadName();
ajax.onreadystatechange=function(){
	if(ajax.readyState==4 && ajax.status==200){
		var obj=JSON.parse(ajax.responseText),el=$(ajax.focusElement);
		el.find('.likes').html(obj.likes);
		el.find('.unlikes').html(obj.unlikes);
		el.find('.neutral').html(obj.neutral);
		el.find('.activityStatus').html(obj.actStatus+obj.errorMessage);
	} 
};
ajaxthread.onreadystatechange=function(){
	if(ajaxthread.readyState==4 && ajaxthread.status==200){
		ajaxthread.running=0;
		$('#sandbox').fadeOut('fast',function(){
			document.getElementById('sandbox').innerHTML=ajaxthread.responseText;
			document.title="NITTFEST '12";
			threadName();
			activity();
			$('#sandbox').fadeIn('fast');
		});
	} 
};
});/*
window.onhashchange=function(){
	if(ajaxthread.running)
		return;
	if(location.hash=="#"+$('#content').attr('pollingclass')+"="+$('#content').attr('polling'))
		return;
	var arr=location.hash.split('#')[1].split('=');
	if(arr[0]=="event"){
		var p=$('.ajaxLink[alt='+arr[1]+']');
		if(p.length>0)
			p.click();//always present
		else
			$('.ajaxLink[alt=home]').click();
	}
	else if(arr[0]=="subevent"){
		ajaxsub.running=1;
		location.hash="subevent="+arr[1];
		document.title="NITTFEST '12 :: "+ajax.eventTitle+" [Loading...]";
		ajaxsub.open("POST","cover.php?ajax&subevent="+arr[1],true);
		ajaxsub.send();
	}
};*/