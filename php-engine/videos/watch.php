<!DOCTYPE HTML PUBLIC "-//W3C//DTD HTML 4.01//EN" "http://www.w3.org/TR/html4/strict.dtd">
<?php
include ('../settings.php');
include ('../config.php');
$result = mysql_query("SELECT * from configurations");
while ($row = mysql_fetch_array($result))
{
$homepage_advertisement = $row["home_ad"];
$widget_on = $row["cpalead_enabled"];
$sc_s = $row["statcounter_security"];
$sc_p = $row["statcounter_project"];
$widget_code = $row["cpalead_id"];
$domain = $row["domain"];
mysql_real_escape_string($widget_code);
}


$result = mysql_query("SELECT * from videos where id = '$video_id'");
while ($row = mysql_fetch_array($result))
{
$description = $row["video_description"];
$keywords = $row["video_keywords"];
$title = $row["video_name"];
mysql_real_escape_string($widget_code);
}

$video_id = $_GET["id"];
$client_ip = $_SERVER['REMOTE_ADDR'];
$date = date("D, d M Y");
$result = mysql_query("SELECT * from visitor_views where visited_id = '$video_id' AND hostname = '$client_ip' AND date = '$date'");
$count_views = mysql_num_rows($result);
if ($count_views > 0)
{
echo "";
}
else
{
mysql_query("INSERT INTO visitor_views (hostname, visited_id, date) VALUES ('$client_ip', '$video_id', '$date')");
mysql_query("UPDATE videos SET views = views +1 WHERE id = '$video_id'");
}
?>
<html>
<head>
<?php
echo '
<title>' . $domain . " - " . $title . '</title>
<link rel="stylesheet" type="text/css" href="../style.css">
<script src="http://code.jquery.com/jquery-latest.js"></script>
<meta name="description" content="Watch ' . $description . ' free online streaming in HD Quality." /> 
<meta name="keywords" content="' . $keywords . '" /> ';
mysql_real_escape_string($video_id);
$result = mysql_query("SELECT * from videos where id = '$video_id'");
while ($row = mysql_fetch_array($result))
{
$video_name = $row["video_name"];
$video_thumb = $row["video_thumb"];
$video_embed = $row["video_embed"]; 
$video_desc = $row["video_description"];
$video_date = $row["video_date"];
}
?>
<style>
#featured-container_2
{
background-image: url('../images/background.gif');
background-repeat: repeat;
padding-bottom: 10px;
height: auto;
width: 100%;
}

.title_desc_b
{
font-style: none;
font-weight: bold;
padding-top: 15px;
font-size: 12px;
}

.title-desc
{
padding-top: 15px;
font-size: 12px;
}

.title-date
{
font-style: italic;
padding-top: 15px;
font-size: 10px;
}
</style>
<?php
if ($widget_on == "Enabled")
{
echo $widget_code;
}

?>
</head>
<body>
<div id="logo"><a href="../index.php" style="none"><img src="../images/logo.png" alt="logo"></a></div>
<p></p>
	<div id="featured-container_2" style="clear: both;">
		<div id="featured-image">
		<?php echo $video_embed; ?>
		</div>
	</div>
	<div id="main-div">
<div id="video-container">
	<div class="title-bar"><?php echo $video_name; ?></div>
	<div class="title-desc"><span class="title_desc_b">Description: </span><?php echo $video_desc ?></div>
	<div class="title-date"><span class="title_desc_b">Uploaded: </span><?php echo $video_date ?></div>

<p><div id="fb-root"></div><script src="http://connect.facebook.net/en_US/all.js#xfbml=1"></script><fb:comments href="http://<?php echo $_SERVER['HTTP_HOST'] . $_SERVER['REQUEST_URI'];  ?>"  num_posts="5" width="500"></fb:comments></p>
	
</div>	
	<div class="advertisement-area">
	<?php echo $homepage_advertisement; ?>
	</div>
	
	<div id="pagination" style="clear: both;">
	</div>
</div>


<div id="footer">
	<div id="footer-links"><a href="../index.php">Home</a>
	<p id="site-footer">Website by <a href="bonken.co.uk">Bonken</a></p></div>
	<div id="footer-name"><?php echo $domain; ?></div>
</div>

<?php
	include('../watchframe.php');
	?>


<!-- Start of StatCounter Code -->
<script type="text/javascript">
var sc_project=<?php echo $sc_p; ?>; 
var sc_invisible=1; 
var sc_security="<?php echo $sc_s; ?>"; 
</script>
<script type="text/javascript"
src="http://www.statcounter.com/counter/counter.js"></script><noscript><div
class="statcounter"><a title="click tracking"
href="http://statcounter.com/" target="_blank"><img
class="statcounter"
src="http://c.statcounter.com/7162859/0/98993364/1/"
alt="click tracking" ></a></div></noscript>
<!-- End of StatCounter Code -->
</body>
<?php
mysql_close($con);
?>
</html>