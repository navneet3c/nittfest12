<div id="content" class="english" pollingclass='event' polling='archive'>
<?php
/*if(mktime (17,0,0,3,22,2012)<time())
	throw new 
Exception('<h3>Scoreboard&nbsp;will&nbsp;open&nbsp;after&nbsp;NITTFEST&nbsp;inaugurates!<br 
/>At 22nd March 2012, 5p.m.</h3>');*/
?>
<h2 class="eventname">Scoreboard</h2>
<table id="scorestable">
<thead><tr><th>Department</th><th>Current Rank</th>
<th><a href="scores/scores_desc.php?e=culturals" class="lightbox" title="Details of Cultural Events Scores">Culturals</a></th>
<th><a href="scores/scores_desc.php?e=english_lits" class="lightbox" title="Details of English Literature Events Scores">English Lits</a></th>
<th><a href="scores/scores_desc.php?e=hindi_lits" class="lightbox" title="Details of Hindi Literature Events Scores">Hindi Lits</a></th>
<th><a href="scores/scores_desc.php?e=tamil_lits" class="lightbox" title="Details of Tamil Literature Events Scores">Tamil Lits</a></th>
<th><a href="scores/scores_desc.php?e=arts" class="lightbox" title="Details of Arts Events Scores">Arts</a></th>
<th><a href="scores/scores_desc.php?e=design" class="lightbox" title="Details of Design Events Scores">Design</a></th>
<th>Total Score</th></tr></thead>
<tbody>
<?php
$res=run_query("SELECT `a`.*,(SELECT `culturals`+`english_lits`+`hindi_lits`+`tamil_lits`+`arts`+`design` AS `total` FROM `scores` `b` WHERE `a`.`branch_id`=`b`.`branch_id`) 'total' FROM `scores` `a` ORDER BY `total` DESC,`branch_name` ASC ;");
$i=0;
$score=-1;
while($row=mysql_fetch_assoc($res)){
	if($score!=$row['total'])
		$i++;
	$score=$row['total'];
	echo "<tr>
	<td class='branchnametd'><a href='scores/scores_desc.php?b={$row['branch_id']}' class='lightbox' title='Details for Scores of {$row['branch_name']}'>{$row['branch_name']}</a></td>
	<td>$i</td>
	<td><a href='scores/scores_desc.php?b={$row['branch_id']}&e=culturals' class='lightbox' title='Details for Scores of {$row['branch_name']} in Cultural Events'>".floatval($row['culturals'])."</a></td>
	<td><a href='scores/scores_desc.php?b={$row['branch_id']}&e=english_lits' class='lightbox' title='Details for Scores of {$row['branch_name']} in English Literature Events'>".floatval($row['english_lits'])."</a></td>
	<td><a href='scores/scores_desc.php?b={$row['branch_id']}&e=hindi_lits' class='lightbox' title='Details for Scores of {$row['branch_name']} in Hindi Literature Events'>".floatval($row['hindi_lits'])."</a></td>
	<td><a href='scores/scores_desc.php?b={$row['branch_id']}&e=tamil_lits' class='lightbox' title='Details for Scores of {$row['branch_name']} in Tamil Literature Events'>".floatval($row['tamil_lits'])."</a></td>
	<td><a href='scores/scores_desc.php?b={$row['branch_id']}&e=arts' class='lightbox' title='Details for Scores of {$row['branch_name']} in Arts Events'>".floatval($row['arts'])."</a></td>
	<td><a href='scores/scores_desc.php?b={$row['branch_id']}&e=design' class='lightbox' title='Details for Scores of {$row['branch_name']} in Design Events'>".floatval($row['design'])."</a></td>
	<td class='totalscoretd'>".floatval($row['total'])."</td>
	</tr>";
}
?>
<tbody></table>
<br /><br /><span>Click on individual Events or Departments to know 
their description<br />Click on Points to know Details</span>
