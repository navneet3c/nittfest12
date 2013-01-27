<?php
function run_query($str){
	$ress=@mysql_query($str);
	if(!$ress)
		throw new Exception('MySQL Error: '.mysql_error());
	return $ress;
}
if(isset($_GET['event']))
	$event=filter_var($_GET['event'],FILTER_SANITIZE_STRING);
if(isset($_GET['subevent']))	
	$subevent=filter_var($_GET['subevent'],FILTER_SANITIZE_STRING);
define('alpha123@#Veuk4OkDik[','ri[twu3Baj-]obCicdotok4');
require_once('resources/mySQL.php');
$content='<!-- -->';
$c=@mysql_connect($SQLserver.':'.$SQLport,$SQLuser,$SQLpassword);
if(!$c)
	die( 'Database connection failed! Please Try Again Later');
if(!mysql_select_db($SQLdatabase,$c))
	die('Database selection failed! Please Try Again Later.');
if(!isset($_GET['ajax']))
	require('resources/header.php');
echo <<<SCRIPT
<script type='text/javascript'>$(window).load(function(){
if(location.search==''){
if(!location.hash)
	location.hash="event=home";
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
	} else
		$('.ajaxLink[alt=home]').click();
}
tabLink();
});
window.onhashchange=function(){
	if(ajax.running || ajaxsub.running)
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
};
</script>
SCRIPT;
try{
	$ip=filter_var($_SERVER['REMOTE_ADDR'],FILTER_SANITIZE_STRING);
	$res=mysql_fetch_row(run_query("SELECT `id` FROM `views` WHERE `ip`='$ip';"));
	if(!$res)
		$res=run_query("INSERT INTO `views` VALUES(NULL, '$ip');");
	if(isset($event)){
		if($event=='archive')
			require('archive/archive.php');
		else if($event=='scores')
			require('scores/scores.php');
		else {
		$res=run_query("SELECT * FROM `events` WHERE `name`='$event';");
		$row=mysql_fetch_row($res);
		if(!$row)	throw new Exception('inValid');
		if($event=='tamil_lits')
		$cls='tamil';
		else if($event=='hindi_lits')
		$cls='hindi';
		else
		$cls='english';
		$content.= "<div id='content' pollingclass='event' polling='$event' class='$cls'>";
		$content.= '
		<h2 class="eventname">'.str_replace(' ','&nbsp;',htmlspecialchars_decode($row[2])).'</h2><div name="contentArea">'.htmlspecialchars_decode($row[3]).'<!--  --></div>
		';
		$res=run_query("SELECT `subname`,`subtitle` FROM `subevents` WHERE `event`='{$row[0]}';");
		$row=mysql_fetch_row($res);
		if($row){
			$content.= '<span id="subeventname" class="english">Events</span><ul>';
			do{
			$content.= "<li><a class='ajaxSubevent' href='cover.php?subevent={$row[0]}' alt='{$row[0]}'>".htmlspecialchars_decode($row[1])."</a></li>";
			}while($row=mysql_fetch_row($res));
			$content.= '</ul>';
		}
		}
		
	} else if(isset($subevent)){
		$res=run_query("SELECT `subtitle`,`subdescription`,`title`,`name` FROM `events`,`subevents` WHERE `subname`='$subevent' AND `event`=`id`;");
		$row=mysql_fetch_row($res);
		if($row[3]=='tamil_lits'){
			$cls='tamil';
			$title='Tamil Lits';
		}
		else if($row[3]=='hindi_lits'){
			$cls='hindi';
			$title='Hindi Lits';
		}
		else{
			$cls='english';
			$title=htmlspecialchars_decode($row[2]);
		}
		$content.= "<div id='content' pollingclass='subevent' polling='$subevent' class='$cls'>";
		if(!$row)	throw new Exception('inValid');
		$content.= '
		<table cellspacing="0" cellpadding="0" id="navigation"><tr><td><a id="parentEvent" class="subevent ajaxLink" href="cover.php?event='.$row[3].'" alt=\''.$row[3]."' title='$title' >".str_replace(' ','&nbsp;',htmlspecialchars_decode($row[2])).'</a></td><td><span class="english">&nbsp;&nbsp;>&nbsp;</span></td><td><span class="eventname">'.str_replace(' ','&nbsp;',htmlspecialchars_decode($row[0])).'</span></td></tr></table><div name="contentArea">'.htmlspecialchars_decode($row[1]).'</div>';
	}
} catch(Exception $e){
	$message=$e->getMessage();
	if($message=='inValid')
		showDefault();
	else $content.= 'Error! '.$message;
}
function showDefault(){
	$res=run_query("SELECT `title`,`description` FROM `events` WHERE `name`='home';");
	$row=mysql_fetch_row($res);
	global $content;
	$content.= "<div id='content' pollingclass='event' polling='home' class='english'>";
	if(!$row)	$content.= 'Try again Later';
	$content.= '
		<h2 
class="eventname">'.htmlspecialchars_decode($row[0]).'</h2><div 
name="contentArea">'.htmlspecialchars_decode($row[1]).'
</div>';
}
$content.='<!-- -->';
echo $content;
if(!isset($_GET['ajax']))
	require('resources/footer.php');
?>
