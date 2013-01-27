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
		<div id="clockWrapper"><table border="0" cellspacing="0" cellpadding="0"><tr><td align="center"><script type="text/javascript">clocker();</script></td></tr></table></div>
		<div id="sponsors"><div id="sponsorSlideshow">
		<a href="http://www.aircel.com"	title="Aircel" 
target="blank"><img src="sponsors/aircel.jpg" alt="Aircel" /></a>
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
		<div class="fb-like" data-href="http://www.facebook.com/Nittfest/251983018209921" data-send="false" data-width="160" data-show-faces="false" data-colorscheme="dark" data-font="trebuchet ms"></div>
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
	<div id="content-wrapper">
	<div id="updates" class='english'>
<?php
$res=run_query("SELECT `content` FROM `updates` ORDER BY `time` LIMIT 0,10;");
while($row=mysql_fetch_assoc($res))
	echo "
	<a><img src='resources/filler.png' style='display: none' />{$row['content']}</a>";
?>
	</div>
	<div id="sandbox">
