<?php
define('alpha123@#Veuk4OkDik[','ri[twu3Baj-]obCicdotok4');
$ROOTPATH='../';
require('common_head.php');
try{
	/*$res=run_query("SELECT `access` FROM `users` WHERE `userid`='{$_SESSION['userid']}';");
	$res=mysql_fetch_row($res);
	$type=$res[0];
	if(!($type==1 || $type==2))
		throw new Exception('You are not Authorized! Please contact NITTFEST core for user level upgradation.');*/
	if(isset($_POST['comment'])){
	if(trim($_POST['comment'])=='')
		throw new Exception('Empty Comment!');
	$content=htmlspecialchars($_POST['comment'],ENT_QUOTES);
	$time=time();
	$threadid=intval($_POST['threadid']);
	run_query("UPDATE `threads` SET `time`='$time' WHERE `threadid` ='$threadid';");
	if(!mysql_affected_rows())
		throw new Exception('Invalid thread');
	run_query("INSERT INTO `comments` VALUES(NULL,'$threadid','$content','$time','{$_SESSION['userid']}','0','0','0');");
	if(isset($_POST['commentSubmit']))
		header('Location: ../blog.php?discuss='.$_POST['threadid']);
	else
		echo '1';
	} else if(isset($_POST['thread'])){
	
	$thread=htmlspecialchars($_POST['thread'],ENT_QUOTES);
	if(strlen($thread)>500)
		throw new Exception('Too long thread name');
	$content=htmlspecialchars($_POST['threadcontent'],ENT_QUOTES);
	if($_POST['author'])
		$author=addslashes($_POST['author']);
	else{
		$res=mysql_fetch_row(run_query("SELECT `name`,`openid` FROM `users` WHERE `userid`='{$_SESSION['userid']}';"));
		$author=addslashes("<a href='https://www.facebook.com/{$res[1]}' target='blank'>{$res[0]}</a>");
	}
	$time=time();
	$res=run_query("INSERT INTO `threads` VALUES(NULL,'$thread','$content','$time','$time','$author','0','0','0');");
	$res=mysql_insert_id();
	if(isset($_POST['threadSubmit']))
		header('Location: ../blog.php?discuss='.$res);
	else
		echo '1';
	}
} catch(Exception $e){
	echo $e->getMessage();
}
if($c)
	mysql_close($c);
?>