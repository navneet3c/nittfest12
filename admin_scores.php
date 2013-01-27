<?php
define('alpha123@#Veuk4OkDik[','ri[twu3Baj-]obCicdotok4');
require('blog/common_head.php');
?>
<!DOCTYPE HTML PUBLIC "-//W3C//DTD HTML 4.01 Transitional//EN" "http://www.w3.org/TR/html4/loose.dtd">
<html>
<head>
<title>NITTFEST '12</title>
<link rel="shortcut icon" type="image/x-icon" href="resources/favicon.ico"></link>
<link rel="stylesheet" type="text/css" href="resources/cover.css" />
<script type="application/x-javascript" src="resources/jquery.min.js"></script>
<script type="application/x-javascript" src="scores/jquery.colorbox-min.js"></script>
<script type="application/x-javascript" src="resources/jquery.nivo.slider.pack.js"></script>
<!--<script type="application/x-javascript" src="http://ajax.googleapis.com/ajax/libs/jquery/1.7.1/jquery.min.js"></script>-->
<script type="application/x-javascript" src="resources/cover.js"></script>
</head>
<body>
<div id="front">
<div id="load-div-wrapper"><div id="load-div">
<img src="resources/loading.gif" alt="Loading..." title="Loading..." /><br />Loading...</div></div>
<div id="content-div-wrapper">
	<div id="header">
		<div id="sponsors"><div id="sponsorSlideshow">
		<a href="http://www.aircel.com"	title="Aircel" target="blank"><img src="sponsors/aircel.jpg" alt="Aircel" /></a>
		<a href="http://www.princetonreview.com" title="Princeton Review"  target="blank"><img src="sponsors/princeton.jpg" alt="Princeton Review"/></a>
		<a href="http://www.iob.in" title="Indian Overseas Bank" target="blank"><img src="sponsors/iob.jpg" alt="Indian Overseas Bank" /></a>
		<img src="sponsors/stella.gif" alt="Stella Maris Institute of Banking"  />
		<a href="http://www.basicslife.in/" title="Basics life"><img src="sponsors/basics.jpg" alt="Basics" /></a>
		<a href="http://esparsha.com" title="Esparsha" target="blank"><img src="sponsors/esparsha.jpg" alt="Esparsha"/></a>
		<a href="http://www.bisleri.com" title="Bisleri" target="blank"><img src="sponsors/bisleri.jpg" alt="Bisleri"/></a>
		<img src="sponsors/belmont.jpg" alt="Belmont Consultancies"  />
		<a href="http://www.systech.co.in" title="SysTech" target="blank"><img src="sponsors/systech.jpg" alt="SysTech"/></a>
		<a href="http://www.indiamart.com/saradhas-textiles" title="Saradhas Textile" target="blank"><img src="sponsors/saradhas.jpg" alt="Saradhas Textile"/></a>
		<a href="http://expressbuzz.com" title="The New Indian express" target="blank"><img src="sponsors/ie.jpg" alt="The New Indian express"/></a>
		</div></div>
		
		<div id="logo"><a href="index.php"><img src="resources/bg_glow.png" alt="NITTFEST 12" title="NITTFEST 12" /></a></div>
		<div id="icons"><div id="iconBack"></div>
			<a class="ajaxLink" href="cover.php" alt="home"><img src="resources/home.png" title="Home"/></a>
			<a class="ajaxLink" href="cover.php?event=scores" alt="scores"><img src="resources/scores.png" title="Scorecard" /></a>
			<a class="ajaxLink" href="cover.php?event=rulebook" alt="rulebook"><img src="resources/rulebook.png" title="Rulebook"/></a>
			<a class="ajaxLink" href="cover.php?event=culturals" alt="culturals"><img src="resources/culturals.png" title="Culturals" /></a>
                        <a class="ajaxLink" href="cover.php?event=english_lits"  alt="english_lits"><img src="resources/english.png" title="English Lits" /></a>
			<a class="ajaxLink" href="cover.php?event=hindi_lits" alt="hindi_lits"><img src="resources/hindi.png" title="Hindi Lits" /></a>
			<a class="ajaxLink" href="cover.php?event=tamil_lits" alt="tamil_lits"><img src="resources/tamil.png" title="Tamil Lits" /></a>
			<a class="ajaxLink" href="cover.php?event=arts" alt="arts"><img src="resources/arts.png" title="Arts" /></a>
			<a class="ajaxLink" href="cover.php?event=design" alt="design"><img src="resources/design.png" title="Design" /></a>
			<a href="blog.php" alt="Blog"><img src="resources/blog.png" title="Blog" /></a>
			<!-- <a href="cover.php?event=archive" alt="archive"><img src="resources/archive.png" title="Archive" ) /></a> -->
			<a class="ajaxLink" href="cover.php?event=contacts" alt="contacts"><img src="resources/contacts.png" title="Contacts" /></a>
			<a class="ajaxLink" href="cover.php?event=partners" alt="partners"><img src="resources/partners.png" title="Partners" /></a>
		</div>
	</div>
	<div id="content-wrapper"><div id="sandbox">

<div  class="english" pollingclass="event" polling="archive" id="content"><!-- -->
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
$res=run_query("SELECT `branch_id`,`branch_name` FROM `scores`;");
$brsel="<OPTION></OPTION>";
while($row=mysql_fetch_assoc($res))
	$brsel.="<OPTION value='{$row['branch_id']}'>{$row['branch_name']}</OPTION>";
?>
<script type="text/javascript" src="blog/jquery.dataTables.min.js" ></script>
<script type="text/javascript">
var len=0;
$(window).ready(function(){
if(window.XMLHttpRequest)
	subajax=new XMLHttpRequest();
else
	subajax=new ActiveXObject('Microsoft.XMLHTTP');
$('#eventselect').click(function(){
	var ev=document.forms[0].event.options[document.forms[0].event.options.selectedIndex].value;
	subajax.open("POST","scores/get_subevent.php?ajax&event="+ev,true);
	subajax.send();
});
subajax.onreadystatechange=function(){
	if(subajax.readyState==4 && subajax.status==200){
		document.getElementById('subeventselect').innerHTML=subajax.responseText;
	}
};
$('#addWinner').click(function(){
	$('#scoresubmittable').append("<tr><td>Branch Name</td><td><SELECT size='1' name='winner["+len+"][branch]'><?php echo $brsel; ?></SELECT></td><td>Rank</td><td><SELECT size='1' name='winner["+len+"][position]'><option></option><option>1</option><option>2</option><option>3</option><option>4</option><option>5</option><option>6</option></select></td><td>Description</td><td><textarea name='winner["+len+"][desc]' ></textarea></td></tr>");
	len++;
});
for(var i=3;i>0;--i)
	$('#addWinner').click();
});
</script>
<link rel="stylesheet" type="text/css" href="blog/demo_table.css" />
<div id="logouttext"><a href="blog/logout.php">Logout</a></div>
<?php
if(isset($_GET['error']))
	echo '<div id="scoreadminerrordiv">'.htmlspecialchars(urldecode($_GET['error']),ENT_QUOTES).'</div>';
?>
<div id="scoresubmit"><form action="scores/score_submit.php" method="post"><table id="scoresubmittable">
<tr><td>Event</td><td><SELECT size="1" name="event" id="eventselect"><option></option>
<?php
$res=run_query("SELECT `event`,`name` FROM `subevents`,`events` WHERE `event`=`id` GROUP BY `event`;");
while($row=mysql_fetch_assoc($res)){
	echo "<OPTION value='{$row['event']}'>{$row['name']}</OPTION>";
}
?>
</SELECT></td><td>Sub event</td><td colspan="2"><SELECT size="1" id="subeventselect" name="subevent">
</select></td><td><input type="submit" value="Update" name="scoreSubmit" /></td></tr>
<tr><td>First Position Points</td><td><input type="text" size="5" name="points[1]" /></td>
<td>Second Position Points</td><td><input type="text" size="5" name="points[2]" /></td>
<td>Third Position Points</td><td><input type="text" size="5" name="points[3]" /></td>
</tr>
<tr><td>Fourth Position Points</td><td><input type="text" size="5" name="points[4]" /></td>
<td>Fifth Position Points</td><td><input type="text" size="5" name="points[5]" /></td>
<td>Sixth Position Points</td><td><input type="text" size="5" name="points[6]" /></td>
</tr>
<tr><td><input type="button" value="Add Position" id="addWinner" /></td></tr>
</table></form></div>
<table>
<form action="resources/update_submit.php" method="post">
<tr><td colspan="2">Update</td></tr>
<tr><td>Enter Update</td><td><textarea cols="80" rows="3" name="updateContent"></textarea></td></tr>
<tr><td><input type="submit" name="updateSubmit" value="Update" /></td></tr>
</form>
</table>
<?php
} catch(Exception $e){
	echo $e->getMessage();
}
echo '<!-- -->';
if(!isset($_GET['ajax']))
	require('resources/footer.php');
if($c)
	mysql_close($c);
?>