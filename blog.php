<?php
define('alpha123@#Veuk4OkDik[','ri[twu3Baj-]obCicdotok4');
require('blog/common_head.php');
if(!isset($_GET['ajax']))
	require('resources/header.php');
echo '<div  class="english blogContent" id="content"><!-- -->';
?>
<script type="text/javascript" src="blog/blog.js" ></script>
<?php
try{
if(!isset($_SESSION['userid']))
	require('blog/login.php');
require('blog/blogmain.php');

} catch(Exception $e){
	echo $e->getMessage();
}
echo '<!-- -->';
if(!isset($_GET['ajax']))
	require('resources/footer.php');
if($c)
	mysql_close($c);
?>
