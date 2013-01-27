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
if(isset($_SESSION['userid']))
	$id=$_SESSION['userid'];
else
	$id='';
$type=0;
if($id){
$res=mysql_fetch_assoc(run_query("SELECT `access`,`name` FROM `users` WHERE `userid`='$id'"));
$type=$res['access'];
//no name: get name first
if($res['name']=='' && $type<=3){ $script=1; ?>
<form id="nameForm" action="blog/addname.php" method="post" ><table>
<tr><td>Enter your Display Name:</td><td> <textarea class="WYSIWYG" id="nameText" name="userName" onclick="this.select()" ></textarea></td><td>&nbsp;</td><td><input type="submit" name="addNameSubmit" value="Update" /></td></tr>
</table></form>
<script type="text/javascript" src="blog/whizzywig2011.js" ></script>
<?php
}
if($type==1)
	echo '<a href="admin_blog.php">Blog Admin Page</a><br /><a href="admin_scores.php">Scores Admin Page</a>';
echo '<div id="logouttext"><a href="blog/logout.php">Logout</a></div>';
}//end if id
if(isset($_GET['page']))
	$page=intval($_GET['page']);
else
	$page=1;

if($type==1 || $type==3)
	$remove=1;
echo '<div id="comments">';
try{
	if(isset($_GET['discuss'])){
	$threadid=intval($_GET['discuss']);
	$res=run_query("SELECT `thread`,`thread_content`,`user`,`created`,`likes`,`unlikes`,`neutral` FROM `threads` WHERE `threadid`='$threadid';");
	$res=mysql_fetch_assoc($res);
	if(!$res){
		$res=mysql_fetch_assoc(run_query("SELECT `threadid`,`thread`,`thread_content`,`user`,`created`,`likes`,`unlikes`,`neutral` FROM `threads` ORDER BY `time` DESC LIMIT 0,1;"));
		$threadid=$res['threadid'];
	}
	$interest=mysql_fetch_row(run_query("SELECT `activity` FROM `interest` WHERE `storyid`='{$threadid}' AND `type`='1' AND `userid`='$id';"));
	$interest=$interest[0];
	if(isset($interest[0])){
		$interest=$interest[0];
		$interest=$interest==1?'You like this':($interest==2?'You dislike this':'You are neutral about this');
	} else $interest='';
	$tname=htmlspecialchars_decode($res['thread'],ENT_QUOTES);
	$tcont=htmlspecialchars_decode($res['thread_content'],ENT_QUOTES);
	$author=stripslashes($res['user']);
	$time=date('F j, Y, g:i a',$res['created']);
	echo '
<h2 class="threadname">'.str_replace(' ','&nbsp;',htmlspecialchars_decode($tname)).'</h2><span id="returnBlog"><a class="ajaxThreadName" href="blog.php?x">Back to Blogs</a></span>
<div id="threadContent">'.htmlspecialchars_decode($tcont).'</div>';
if(!$id)
	echo "
<div class='actions'><span><div class='neutral' title='Neutral'>{$res['neutral']}</div></span>
<span><div class='unlikes' title='Dislikes'>{$res['unlikes']}</div></span>
<span><div class='likes' title='Likes'>{$res['likes']}</div></span>
	";
else {echo '
<div class="actions">';
	if(isset($remove))
		echo '<span><a href="blog/remove_story.php?story='.$threadid.'&thread" title="Remove"><div class="remove">Remove</div></a></span>';
echo "<span><a class='ajaxActivityComment' href='blog/interest.php?story={$threadid}&action=3&thread' title='Neutral'><div class='neutral'>{$res['neutral']}</div></a></span>
<span><a class='ajaxActivityComment' href='blog/interest.php?story={$threadid}&action=2&thread' title='Dislikes'><div class='unlikes'>{$res['unlikes']}</div></a></span>
<span><a class='ajaxActivityComment' href='blog/interest.php?story={$threadid}&action=1&thread' title='Likes'><div class='likes'>{$res['likes']}</div></a></span>
<div class='activityStatus'>$interest</div>

";
	}
	echo "<div class='threadDesc'>Created by <strong>$author</strong>, at {$time}.</div></div><ul id='commentList'>
	";
	$res=mysql_fetch_row(run_query("SELECT COUNT(*) FROM `comments` WHERE `threadid`='$threadid';"));
	$maxpage=intval($res[0]/10)+($res[0]%10?1:0);
	if($page>$maxpage)
		$page=$maxpage;
	if($page<1)
		$page=1;
	$tp=$page+1;
	$next=$page<$maxpage?"<a class='ajaxThreadName' href='blog.php?discuss={$threadid}&page=$tp'><div id='nextPage'>Next Page</div></a>":'';
	$tp=$page-1;
	$prev=$tp>0?"<a class='ajaxThreadName' href='blog.php?discuss={$threadid}&page=$tp'><div id='prevPage'>Previous Page</div></a>":'';
	$page=($page-1)*10;
	
	$r=run_query("SELECT `comments`.*,`users`.`name`,`users`.`userid`,( SELECT `activity` FROM `interest` WHERE `interest`.`storyid`=`comments`.`storyid` AND `type`='2' AND `userid`='$id')  AS `activity` FROM `comments`,`users` WHERE `threadid`='{$threadid}' AND `comments`.`userid`=`users`.`userid` ORDER BY `comments`.`time` DESC LIMIT {$page},10 ;");
	$a=0;
	while($res=mysql_fetch_assoc($r)){
		$a++;
		$content=htmlspecialchars_decode($res['content'],ENT_QUOTES);
		$time=date('F j, Y, g:i a',$res['time']);
		$rem=isset($remove)?'<span><a href="blog/remove_story.php?story='.$res['storyid'].'" title="Remove"><div class="remove">Remove</div></a></span>':'';
		if($interest=$res['activity'])
			$interest=$interest==1?'You like this':($interest==2?'You dislike this':'You are neutral about this');
		else $interest='';
		echo "<li><input type='hidden' name='storyid' value='{$res['storyid']}' />
<div class='commentContent'>
$content</div><div class='actions'>
";
if(!$id)
	echo "

<span><div class='neutral' title='Neutral'>{$res['neutral']}</div></span>
<span><div class='unlikes' title='Dislikes'>{$res['unlikes']}</div></span>
<span><div class='likes' title='Likes'>{$res['likes']}</div></span>
<div class='commentDesc'><a href='https://www.facebook.com/{$res['userid']}' target='blank' title='Posted at $time'>{$res['name']}</a></div></div>
</li>
	";
else echo "
$rem
<span><a class='ajaxActivityComment' href='blog/interest.php?story={$res['storyid']}&action=3' title='Neutral'><div class='neutral'>{$res['neutral']}</div></a></span>
<span><a class='ajaxActivityComment' href='blog/interest.php?story={$res['storyid']}&action=2' title='Dislikes'><div class='unlikes'>{$res['unlikes']}</div></a></span>
<span><a class='ajaxActivityComment' href='blog/interest.php?story={$res['storyid']}&action=1' title='Likes'><div class='likes'>{$res['likes']}</div></a></span>
<div class='activityStatus'>$interest</div>
<div class='commentDesc'><a href='https://www.facebook.com/{$res['userid']}' target='blank' title='Posted at $time'>{$res['name']}</a></div>
</div></li>
";

	}
	if($a==0)
		echo '<li><div class="threadName">No Comments</div></li>';
	echo "
</ul>{$prev}{$next}";
	} else {
	$res=mysql_fetch_row(run_query("SELECT COUNT(*) FROM `threads`;"));
	$maxpage=intval($res[0]/10)+($res[0]%10?1:0);
	if($page>$maxpage)
		$page=$maxpage;
	if($page<1)
		$page=1;
	$tp=$page+1;
	$next=$page<$maxpage?"<a class='ajaxThreadName' href='blog.php?page=$tp'><div id='nextPage'>Next</div></a>":'';
	$tp=$page-1;
	$prev=$tp>0?"<a class='ajaxThreadName' href='blog.php?page=$tp'><div id='prevPage'>Prev</div></a>":'';
	$page=($page-1)*10;
	$r=run_query("SELECT `threadid`,`thread`,`created`,`user`,`likes`,`unlikes`,`neutral`,( SELECT `activity` FROM `interest` WHERE `storyid`=`threadid` AND `type`='1' AND `userid`='$id')  AS `activity` FROM `threads` ORDER BY `threads`.`time` DESC LIMIT {$page},10;");
	echo '<ul id="threadList">
';
	while($res=mysql_fetch_assoc($r)){
		$thread=htmlspecialchars_decode($res['thread'],ENT_QUOTES);
		$time=date('F j, Y, g:i a',$res['created']);
		$rem=isset($remove)?'<span><a href="blog/remove_story.php?story='.$res['threadid'].'&thread" title="Remove"><div class="remove">Remove</div></a></span>':'';
		if($interest=$res['activity'])
			$interest=$interest==1?'You like this':($interest==2?'You dislike this':'You are neutral about this');
		else $interest='';
		$author=stripslashes($res['user']);
		echo "
<li>
<div class='threadName'><a class='ajaxThreadName' href='blog.php?discuss={$res['threadid']}'>$thread</a></div>";
if(!$id)
	echo "
<div class='actions'><span><div class='neutral' title='Neutral'>{$res['neutral']}</div></span>
<span><div class='unlikes' title='Dislikes'>{$res['unlikes']}</div></span>
<span><div class='likes' title='Likes'>{$res['likes']}</div></span>
<div title='At {$time}' class='threadDesc'>By $author</div>
</div></li>
	";
else echo "
<div class='actions'>$rem
<span><a class='ajaxActivityComment' href='blog/interest.php?story={$res['threadid']}&action=3&thread' title='Neutral'><div class='neutral'>{$res['neutral']}</div></a></span>
<span><a class='ajaxActivityComment' href='blog/interest.php?story={$res['threadid']}&action=2&thread' title='Dislikes'><div class='unlikes'>{$res['unlikes']}</div></a></span>
<span><a class='ajaxActivityComment' href='blog/interest.php?story={$res['threadid']}&action=1&thread' title='Likes'><div class='likes'>{$res['likes']}</div></a></span>
<div class='activityStatus'>$interest</div>
<div title='At {$time}' class='threadDesc'>By $author</div></div>
</li>
";
	}
	echo "
</ul>{$prev}{$next}";
	}
} catch(Exception $e){
	echo 'An Error Occured: '.$e->getMessage();
}
echo '</div>';
if($id){
if(isset($threadid)){ ?>
<form class="newComment" action="blog/register_comment.php" method="post" onsubmit="return registerComment()">
<table><tr><td>Comment</td>
<td><input type="hidden" name="threadid" value="<?php echo $threadid; ?>" /></td>
<td><textarea class="WYSIWYG" id="commentarea" name="comment" style="width:500px;"></textarea></td><td><input type="submit" value="Post" name="commentSubmit" /></td></tr></table>
</form>
<?php } else if($type==1 || $type==2){ ?>
<form class="newThread" action="blog/register_comment.php" method="post" onsubmit="return registerThread()">
<table><tr><td colspan="2"><span class="newThread">Post new Blog</span></td></tr>
<tr><td>Title</td><td><input size="80" id="threadnameinput" type="text" name="thread" /></td></tr>
<tr><td>Author<br />(Leave Blank for Own Name)</td><td><input size="80" id="threadauthor" type="text" name="author" /></td></tr>
<tr><td>Content</td><td><textarea class="WYSIWYG" id="threadarea" name="threadcontent" ></textarea></td><td><input type="submit" name="threadSubmit" value="Post" /></td></tr></table>
</form>
<?php }
if(!isset($script))
	echo '<script type="text/javascript" src="blog/whizzywig2011.js" ></script>
	';
}
?>