<?php
define('alpha123@#Veuk4OkDik[','ri[twu3Baj-]obCicdotok4');
$ROOTPATH='../';
require('common_head.php');
try{
$id=$_SESSION['userid'];
$res=mysql_fetch_assoc(run_query("SELECT `name` FROM `users` WHERE `userid`='$id';"));
if(!$res)
	throw new Exception('The user could not be Determined!');
$name=filter_var($_POST['userName'],FILTER_SANITIZE_STRING);
run_query("UPDATE `users` SET `name`='$name' WHERE `userid`='$id';");
header('Location: ../blog.php');
} catch(Exception $e){
	$err=$e->getMessage();
	echo $err;
}
?>
