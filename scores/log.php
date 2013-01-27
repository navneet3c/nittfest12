<?php
define('alpha123@#Veuk4OkDik[','ri[twu3Baj-]obCicdotok4');
function run_query($str){
	$ress=@mysql_query($str);
	if(!$ress)
		throw new Exception('MySQL Error: '.mysql_error());
	return $ress;
}
session_set_cookie_params(0,'/');
session_start();
if(!isset($ROOTPATH))
	$ROOTPATH='../';
require_once($ROOTPATH.'resources/mySQL.php');
$c=@mysql_connect($SQLserver.':'.$SQLport,$SQLuser,$SQLpassword);
if(!$c)
	die( 'Database connection failed! Please Try Again Later');
if(!mysql_select_db($SQLdatabase,$c))
	die('Database selection failed! Please Try Again Later.');
	
try{
	if(!isset($_SESSION['userid']))
		throw new Exception("<!DOCTYPE HTML PUBLIC \"-//IETF//DTD HTML 2.0//EN\">
<html><head>
<title>404 Not Found</title>
</head><body>
<h1>Not Found</h1>
<p>The requested URL {$_SERVER['PHP_SELF']} was not found on this server.</p>
<hr>
<address>{$_SERVER['SERVER_SIGNATURE']}</address>
</body></html>");
$_SESSION['userid']=floatval($_SESSION['userid']);
	$res=mysql_fetch_row(run_query("SELECT `access` FROM `users` WHERE `userid`='{$_SESSION['userid']}';"));
if($res[0]!=1)
	throw new Exception("<!DOCTYPE HTML PUBLIC \"-//IETF//DTD HTML 2.0//EN\">
<html><head>
<title>404 Not Found</title>
</head><body>
<h1>Not Found</h1>
<p>The requested URL {$_SERVER['PHP_SELF']} was not found on this server.</p>
<hr>
<address>{$_SERVER['SERVER_SIGNATURE']}</address>
</body></html>");


} catch(Exception $e){
	$error=$e->getMessage();
}
?>
<!DOCTYPE HTML PUBLIC "-//W3C//DTD HTML 4.01 Transitional//EN" "http://www.w3.org/TR/html4/loose.dtd">
<html>
<head>
<title>NITTFEST Scores Log</title>
<script type="text/javascript" src="../resources/jquery.min.js" ></script>
<script type="text/javascript" src="../blog/blog.js" ></script>
<script type="text/javascript" src="../blog/jquery.dataTables.min.js" ></script>
<link rel="stylesheet" type="text/css" href="../blog/demo_table.css" />
<style type="text/css">
body{
	margin: 0px;
	padding: 0px;
	background: #100908;
	color: #c7c7c7;
	font-family: Verdana,Helvetica, Arial, sans-serif;
	font-size: 1em;
}
#header h3{
	padding: 10px;
	margin: 0px;
}
#body{
	margin: 0px;
	padding: 10px 10px;
	display: block;
	min-height: 600px;display: block;
}
table{
	border: 1px solid #fff;
	background-color: rgba(30,30,30,0.3);
}
table th,table td{
	border: 1px solid #747474;
	padding: 5px 25px;
	text-align: center;
	vertical-align: middle;
}
table th{
	color: #fff;
	border: 2px ridge #aaa;
background-color: rgba(0,0,0,0.5);
}
.rankTable{
	margin: 0px auto;
}
#footer{
	text-align: center;
	font-size: 12px;
	font-family: Georgia, serif;
	padding: 10px 0px; padding-top: 0px;
	display: block;
	width: 100%;
	color: #777;
	float: left;	
	background-color:rgba(0,0,0,0.6);
}
.clear{
	width: 100%;
	display: block;
	position: relative;
	margin: 0px; padding: 0px;
	float: left;
}
</style>
</head>
<body>
<div id="wrapper">
	<div id="header">
		<h3 class="rankTable">NITTFEST Scores Log</h3>
	</div>
	<div id="body">
		<div id="tables">
			<table class="rankTable" id="rankTable"><thead><tr><th>#</th><th>ID</th><th>Department</th><th>Section</th><th>Event</th><th>Position</th><th>Points</th><th>Time</th></tr></thead><tbody>
<?php

try{
$result=run_query("SELECT `score_log`.*,`subname`,`branch_name`,`name` FROM `score_log`,`subevents`,`scores`,`events` WHERE `subevent`=`subid` AND `score_log`.`event`=`id` AND `branch`=`branch_id` ORDER BY `time` DESC,`serial` DESC;");
mysql_close($c);
$i=mysql_num_rows($result);
while($row=mysql_fetch_assoc($result)){
	$time=date('F j, Y, g:i a',$row['time']);
	echo "<tr><td>$i</td><td>{$row['serial']}</td><td>{$row['branch_name']}</td><td>{$row['name']}</td><td>{$row['subname']}</td><td>{$row['position']}</td><td>{$row['points']}</td><td>{$time}</td></tr>";
	--$i;
}
} catch(Exception $e){
	$error=$e->getMessage();
}
?></tbody></table>
		</div>
<script type="text/javascript">$(document).ready(function() { $("#rankTable").dataTable(); });</script>
		<?php
if(isset($error))
	echo "<div class='errorDiv'>$error</div>";
?>
		<div class="clear"></div>
	</div>
	<div id="footer">
	&copy; NITTFEST Team.
	</div>
</div>
</body>
</html>