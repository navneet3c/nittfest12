<?php
if(defined('alpha123@#Veuk4OkDik['))
	$const=constant('alpha123@#Veuk4OkDik[');
else
	$const='';
if($const!='ri[twu3Baj-]obCicdotok4'){
	header($_SERVER['SERVER_PROTOCOL'].' 403 Forbidden');
	echo '<h1>403 Forbidden<h1><h4>You are not authorized to access the page.</h4>';
	echo '<hr/>'.$_SERVER['SERVER_SIGNATURE'];
	exit(1);
}
function run_query($str){
	$ress=@mysql_query($str);
	if(!$ress)
		throw new Exception('MySQL Error: '.mysql_error());
	return $ress;
}
session_set_cookie_params(0,'/');
session_start();
if(!isset($ROOTPATH))
	$ROOTPATH='';
require_once($ROOTPATH.'resources/mySQL.php');
$c=@mysql_connect($SQLserver.':'.$SQLport,$SQLuser,$SQLpassword);
if(!$c)
	die( 'Database connection failed! Please Try Again Later');
if(!mysql_select_db($SQLdatabase,$c))
	die('Database selection failed! Please Try Again Later.');
if(isset($_SESSION['userid']))
	$_SESSION['userid']=floatval($_SESSION['userid']);
?>