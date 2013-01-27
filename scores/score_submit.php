<?php
define('alpha123@#Veuk4OkDik[','ri[twu3Baj-]obCicdotok4');
$ROOTPATH='../';
require('../blog/common_head.php');
try{
if(isset($_SESSION['userid']))
	$id=$_SESSION['userid'];
else
	throw new Exception('Not Logged In!');
$res=mysql_fetch_row(run_query("SELECT `access` FROM `users` WHERE `userid`='$id';"));
if($res[0]!=1)
	throw new Exception('You are not authorised!');
if(!isset($_POST['scoreSubmit']))
	throw new Exception('Wrong submission mode');
$event=intval($_POST['event']);
$subevent=intval($_POST['subevent']);
if($event<1 || $subevent<1)
	throw new Exception('Invalid event!');
$points=$_POST['points'];
foreach($_POST['winner'] as $data){
	$brid=intval($data['branch']);
	$res=mysql_fetch_row(run_query("SELECT `branch_id`,`subname` FROM `scores`,`subevents` WHERE `branch_id`='$brid' AND `event`='$event' AND `subid`='$subevent';"));
	if(!$res)
		continue;
	run_query("DELETE FROM `score_details` WHERE `branch_id`='$brid' AND `category_id`='$event' AND `event_id`='$subevent';");
	$position=intval($data['position']);
	if($position<1)
		throw new Exception('Select a Valid position!');
	
	$pt=floatval($points[$position]);
	if($pt<0)
		throw new Exception('Enter a Valid score!');
	$desc=htmlspecialchars($data['desc'],ENT_QUOTES);
	$time=time();
	run_query("INSERT INTO `score_details` VALUES (NULL,'$brid','$event','$position','$pt','$subevent','$desc','$time');");
	run_query("INSERT INTO `score_log` VALUES (NULL,'$brid','$event','$subevent','$position','$pt','$time');");
	$res=mysql_fetch_row(run_query("SELECT `name` FROM `events` WHERE `id`='$event';"));
	run_query("UPDATE `scores` SET `{$res[0]}`= ( SELECT SUM(score) FROM `score_details` WHERE `branch_id`='$brid' AND `category_id`='$event') WHERE `branch_id`='$brid';");
}
header('Location: ../admin_scores.php?error=Submitted');
} catch(Exception $e){
	header('Location: ../admin_scores.php?error='.urlencode($e->getMessage()));
}
?>
