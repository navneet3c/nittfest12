<?php
//dept cat
//b c
function run_query($str){
	$ress=@mysql_query($str);
	if(!$ress)
		throw new Exception('MySQL Error: '.mysql_error());
	return $ress;
}
define('alpha123@#Veuk4OkDik[','ri[twu3Baj-]obCicdotok4');
require_once('../resources/mySQL.php');
$c=@mysql_connect($SQLserver.':'.$SQLport,$SQLuser,$SQLpassword);
if(!$c)
	die( 'Database connection failed! Please Try Again Later');
if(!mysql_select_db($SQLdatabase,$c))
	die('Database selection failed! Please Try Again Later.');
?>
<html>
<body>
<div id="content" class="english">
<?php
try{
	if(isset($_GET['b'])){
		$branch=intval($_GET['b']);
		$res=mysql_fetch_row(run_query("SELECT `branch_name` FROM `scores` WHERE `branch_id`='$branch';"));
		if(!$res)
			throw new Exception('Select branch is not participationg in NITTFEST!');
		else	$bname=$res[0];
	} else $branch='';
	if(isset($_GET['e'])){
		$event=filter_var($_GET['e'],FILTER_SANITIZE_STRING);
		$res=mysql_fetch_row(run_query("SELECT `id`,`title` FROM `events` WHERE `name`='$event';"));
		if(!$res)
			throw new Exception('Select Event is not Recognized!');
		else	{ $event=$res[0]; $ename=$res[1]; }
	} else $event='';
	if(!$branch && !$event)
		throw new Exception('Illegal Query');
	$con='';
	if($event)
		$con="`category_id`='$event'";
	if($branch)
		$con.=($con?' AND ':'')."`score_details`.`branch_id`='$branch'";
	$res=run_query("SELECT `score_details`.*,`subtitle`,`branch_name`,`title`,`name` FROM `score_details`,`subevents`,`scores`,`events` WHERE {$con} AND `event_id`=`subid` AND `category_id`=`id` AND `score_details`.`branch_id`=`scores`.`branch_id` ORDER BY `rank` ASC,`time` DESC;");
	if($event)
	if($_GET['e']=='hindi_lits')
		$ename="Hindi Lits";
	else if($_GET['e']=='tamil_lits')
		$ename="Tamil Lits";
	$bname1='';
	$ename1='';
	if($branch)
		echo "<div class='popupbranch'>$bname</div>";
	else $bname1='<th>Department</th>';
	if($event)
		echo "<div class='popupevent'>$ename</div>";
	else $ename1='<th>Section</th>';
	echo "<table width='780' class='popuptable'><tr>{$bname1}{$ename1}<th>Event</th><th>Position</th><th>Points</th><th>Comments</th></tr>";
	$bname1='';
	$ename1='';
	while($row=mysql_fetch_assoc($res)){
		if(!$branch)
			$bname1="<td>{$row['branch_name']}</td>";
		if(!$event)
			if($row['name']=='tamil_lits')	$ename1="<td>Tamil Lits</td>";
			else if($row['name']=='hindi_lits')	$ename1="<td>Hindi Lits</td>";
			else	$ename1="<td>{$row['title']}</td>";
		if($row['name']=='tamil_lits')	$cls='tamil';
		else if($row['name']=='hindi_lits')	$cls='hindi';
		else	$cls='english';
		$desc=htmlspecialchars_decode($row['description'],ENT_QUOTES).'<br /><span class="popuptime">At '.date('g:i a, F j',$row['time']).'</span>';
		$subevent=htmlspecialchars_decode($row['subtitle'],ENT_QUOTES);
		echo "<tr>{$bname1}{$ename1}<td><span class='{$cls}'>{$subevent}</span></td><td>{$row['rank']}</td><td>{$row['score']}</td><td class='popupcomment'>$desc</td></tr>";
	}
	echo '</table>';
} catch(Exception $e){
	$err=$e->getMessage();
	echo $err;
}
if($c)
	mysql_close();
?>
</div>
</body>
</html>