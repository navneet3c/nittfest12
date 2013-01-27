<?php
define('alpha123@#Veuk4OkDik[','ri[twu3Baj-]obCicdotok4');
$ROOTPATH='../';
require('common_head.php');
try{
	$sid=intval($_GET['story']);
	$action=intval($_GET['action']);
	if(isset($_GET['thread']))//thread1, comment2
		$type=1;
	else {
		$type=2;
		$res=mysql_fetch_row(run_query("SELECT `threadid` FROM `comments` WHERE `storyid`='$sid' ;"));
		$threadid=$res[0];
	}
	$table=$type==1?'threads':'comments';
	$column=$type==1?'threadid':'storyid';
	if(!($sid && $action>=1 && $action<=3))
		throw new Exception('Illegal Usage');
	$res=run_query("SELECT `activity` FROM `interest` WHERE `storyid`='$sid' AND `type`='$type' AND `userid`='{$_SESSION['userid']}';");
	$res=mysql_fetch_row($res);
	if($res && $res[0]!=$action){
		run_query("UPDATE `interest` SET `activity`='$action' WHERE `storyid`='$sid' AND `type`='$type' AND `userid`='{$_SESSION['userid']}';");
		$r=run_query("SELECT `activity`,COUNT(*) FROM `interest` WHERE `storyid`='$sid' AND `type`='$type' GROUP BY `activity`;",$c);
		$likes=0;
		$unlikes=0;
		$neutral=0;
		while($res=mysql_fetch_row($r))
			switch($res[0]){
			case '1':	$likes=$res[1]; break;
			case '2':	$unlikes=$res[1]; break;
			case '3':	$neutral=$res[1];
			}
		run_query("UPDATE `{$table}` SET `likes`='$likes',`unlikes`='$unlikes',`neutral`='$neutral' WHERE `$column`='$sid';");
	} else{
		if($res)
			run_query("DELETE FROM `interest` WHERE `storyid`='$sid' AND `activity`='$action' AND `type`='$type' AND `userid`='{$_SESSION['userid']}';",$c);
		else
			run_query("INSERT INTO `interest` VALUES('$sid','$action','$type','{$_SESSION['userid']}');");
		$field=$action==1?'likes':($action==2?'unlikes':'neutral');
		run_query("UPDATE `$table` SET `$field`=(SELECT COUNT(*) FROM `interest` WHERE `storyid`='$sid' AND `activity`='$action' AND `type`='$type') WHERE `{$column}`='$sid';");
	}
	if(isset($_GET['ajax'])){
		$res=mysql_fetch_assoc(run_query("SELECT `likes`,`unlikes`,`neutral`,( SELECT `activity` FROM `interest` WHERE `interest`.`storyid`=`{$table}`.`{$column}` AND `type`='$type' AND `userid`='{$_SESSION['userid']}')  AS `activity` FROM `{$table}` WHERE `{$column}`='$sid';"));
		if($interest=$res['activity'])
			$interest=$interest==1?'You like this':($interest==2?'You dislike this':'You are neutral about this');
		else $interest='';
		echo json_encode(array('likes'=>$res['likes'],'unlikes'=>$res['unlikes'],'neutral'=>$res['neutral'],'actStatus'=>$interest,'errorMessage'=>''));
	} else{
		if($type==1)
			$location='../blog.php?discuss='.$sid;
		else
			$location='../blog.php?discuss='.$threadid;
		header('Location: '.$location);
	}
} catch(Exception $e){
	if(isset($_GET['ajax']))
		echo json_encode(array('likes'=>'','unlikes'=>'','neutral'=>'','actStatus'=>'','errorMessage'=>$e->getMessage()));
	else
		echo $e->getMessage();
}
if($c)
	mysql_close($c);
?>