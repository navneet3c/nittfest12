<?php
define('alpha123@#Veuk4OkDik[','ri[twu3Baj-]obCicdotok4');
$ROOTPATH='../';
require('common_head.php');
try{
$id=$_SESSION['userid'];

$res=mysql_fetch_row(run_query("SELECT `access` FROM `users` WHERE `userid`='{$_SESSION['userid']}';"));
if($res[0]!=1)
	throw new Exception('You are not authorized!');
$access=intval($_POST['access']);
$openid=htmlspecialchars($_POST['openid'],ENT_QUOTES);
$userid=htmlspecialchars($_POST['userid'],ENT_QUOTES);
$res=run_query("UPDATE `users` SET `access`='$access' WHERE `openid`='$openid' AND `userid`='$userid';");
if(!$res)
	throw new Exception('Request is not conistent! Please retry.');
header('Location: ../admin_blog.php');
} catch(Exception $e){
	$err=$e->getMessage();
	echo $err;
}
?>
