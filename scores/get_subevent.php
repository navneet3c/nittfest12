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

	$event=intval($_GET['event']);
	$res=run_query("SELECT `subname`, `subid` FROM `subevents` WHERE `event`='$event';");
	$thing='<option value=""> -- </option>';
	while($row=mysql_fetch_assoc($res)){
		$thing.="<OPTION value='{$row['subid']}'>{$row['subname']}</OPTION>";
	}
	if(isset($_GET['ajax']))
		echo $thing;
	else 
		header('Location: ../admin_scores.php');
} catch(Exception $e){
	$err=$e->getMessage();
	echo $err;
}
?>