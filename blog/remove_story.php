<?php
define('alpha123@#Veuk4OkDik[','ri[twu3Baj-]obCicdotok4');
$ROOTPATH='../';
require('common_head.php');
try{
	$sid=intval($_GET['story']);
	$res=mysql_fetch_row(run_query("SELECT `access` FROM `users` WHERE `userid`='{$_SESSION['userid']}';"));
	$type=$res[0];
	if(!($type==1 || $type==3))//1,3-remove
		throw new Exception('You are not Authorized! Please contact NITTFEST core for user level upgradation.');
	if(isset($_GET['thread'])){
		run_query("DELETE FROM `threads` WHERE `threadid`='$sid';");
		run_query("DELETE FROM `comments` WHERE `threadid`='$sid';");
	} else
		run_query("DELETE FROM `comments` WHERE `storyid`='$sid';");
	run_query("DELETE FROM `interest` WHERE `storyid`='$sid';");
	if(isset($_GET['ajax']))
		echo '1';
	else{
		$location=isset($_GET['thread'])?'../blog.php':'../blog.php?discuss='.$sid;
		header('Location: '.$location);
	}
} catch(Exception $e){
	if(isset($_GET['ajax']))
		echo '0';
	else
		echo $e->getMessage();
}
if($c)
	mysql_close($c);
?>