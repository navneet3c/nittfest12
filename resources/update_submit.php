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
if(!isset($_POST['updateSubmit']))
	throw new Exception('Wrong submission mode');
$desc=htmlspecialchars($_POST['updateContent'],ENT_QUOTES);
if(strlen($desc)>1500 || !$desc)
	throw new Exception('Invalid Update. Size is not correct.');
$time=time();
run_query("INSERT INTO `updates` VALUES (NULL,'$desc','$time');");
header('Location: ../admin_scores.php?error=Updated');
} catch(Exception $e){
	header('Location: ../admin_scores.php?error='.urlencode($e->getMessage()));
}
?>
