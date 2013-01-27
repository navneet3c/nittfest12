<?php
define('alpha123@#Veuk4OkDik[','ri[twu3Baj-]obCicdotok4');
require('blog/common_head.php');
if(!isset($_GET['ajax']))
	require('resources/header.php');
echo '<div  class="english blogContent" id="content"><!-- -->';
?>
<script type="text/javascript" src="blog/blog.js" ></script>
<script type="text/javascript" src="blog/jquery.dataTables.min.js" ></script>
<link rel="stylesheet" type="text/css" href="blog/demo_table.css" />
<?php
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
echo '<div id="logouttext"><a href="blog/logout.php">Logout</a></div>';
echo '<div id="activateUsers">
<table id="userTable"><thead><tr><th>FB id</th><th>Name</th><th>Access</th></tr></thead><tbody>';
$res=run_query("SELECT `userid`,`openid`,`access`,`name` FROM `users` ORDER BY `access` ASC, `name` ASC;");
while($row=mysql_fetch_assoc($res)){
	$name=stripslashes($row['name']);
	$selector=array(1=>'',2=>'',3=>'',4=>'');
	$selector[$row['access']]=' SELECTED ';
	$access="<option value=1{$selector[1]}>All</option><option value=2{$selector[2]}>Post</option><option value=3{$selector[3]}>Remove</option><option value=4{$selector[4]}>Read</option>";
echo "
<tr><td><a href='https://www.facebook.com/profile.php?id={$row['openid']}'>{$row['openid']}</a></td>
<td>$name</td>
<td><form action='blog/changePerm.php' method='post' >
<select name='access' size='1'>$access</select>
<input type='hidden' value='{$row['openid']}' name='openid' />
<input type='hidden' value='{$row['userid']}' name='userid' />
<input type='submit' value='Change' name='accessSubmit' /></form></td></tr>
";
}
echo '</tbody></table></div>';
echo '<script type="text/javascript">$(document).ready(function() { $("#userTable").dataTable(); });</script>';
} catch(Exception $e){
	echo $e->getMessage();
}
echo '<!-- -->';
if(!isset($_GET['ajax']))
	require('resources/footer.php');
if($c)
	mysql_close($c);
?>