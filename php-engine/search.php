<!DOCTYPE HTML PUBLIC "-//W3C//DTD HTML 4.01//EN" "http://www.w3.org/TR/html4/strict.dtd">
<?php
include ('settings.php');
include ('config.php');

$result = mysql_query("SELECT * from configurations");
$client_ip = $_SERVER['REMOTE_ADDR'];
$rating_id = mysql_real_escape_string($_GET["id"]);
$date = date("D, d M Y");
$check_rated = mysql_query("SELECT * from ratings where client_ip = '$client_ip' and date = '$date' and video_id = '$rating_id'");
$num_rows = mysql_num_rows($check_rated);
if (isset($_GET["rating"]) && ($_GET["rating"] > 0) && ($num_rows < 1) && ($_GET["rating"] < 6))
{
$rate_status = "Your vote has been succesfully counted!";
$rating_posted = mysql_real_escape_string($_GET["rating"]);
$rating_id = mysql_real_escape_string($_GET["id"]);
mysql_query("UPDATE videos SET rating = rating + '$rating_posted', raters = raters + 1 WHERE id = '$rating_id'"); 
mysql_query("INSERT into ratings (client_ip, rating, date, video_id) VALUES ('$client_ip', '$rating_posted', '$date', '$rating_id')"); 
}
elseif (isset($_GET["rating"]) && ($num_rows > 0))
{
$rate_status = "Sorry, it appears you have already voted today.";
}


while ($row = mysql_fetch_array($result))
{
$homepage_advertisement = $row["home_ad"];
$sc_s = $row["statcounter_security"];
$sc_p = $row["statcounter_project"];
$description = $row["description"];
$keywords = $row["keywords"];
$domain = $row["domain"];
$title = $row["title"];
}
?>
<html>
<head>
    <link rel="stylesheet" href="slider/themes/default/default.css" type="text/css" media="screen" />
    <link rel="stylesheet" href="slider/themes/pascal/pascal.css" type="text/css" media="screen" />
    <link rel="stylesheet" href="slider/themes/orman/orman.css" type="text/css" media="screen" />
    <link rel="stylesheet" href="slider/nivo-slider.css" type="text/css" media="screen" />
    <link rel="stylesheet" href="slider/style.css" type="text/css" media="screen" />
<?php
echo '
<title>' . $domain . " - " . $title . '</title>
<link rel="stylesheet" type="text/css" href="style.css">
<meta name="description" content="' . $description . '" /> 
<meta name="keywords" content="' . $keywords . '" /> ';
?>
<style>
.rating_bit 
{
text-align: center;
margin-top: 10px;
font-size: 12px;
padding: 5px;
color: red;"
}
.slider-wrapper
{
width: 800px;
text-align: center;
margin: auto;
}

.nivim, img.nivim
{
position: absolute;
width: 800px;
}

.search-failed
{
color: red;
margin: 20px;
font-size: 12px;
font-weight: bold;
}

</style>
</head>
<body>
<div id="header_container">
	<div id="logo"><a href="index.php" style="none"><img src="images/logo.png" alt="logo"></a></div>
	<div id="search">
		<form action="search.php" method="get" name="search_form">
			<input type="text" name="search" size="25">
			<input type="submit" value="Search">
		</form>
	</div>	
</div>	
	
	<div id="featured-container" style="clear: both;">
		<div id="featured-image">
		
		
		
		<!--Slider!-->
		
		
        <div class="slider-wrapper theme-default">
            <div id="slider" class="nivoSlider">
			<?php
			$number = "1";
			
			
if ($restrict_status == "On")
{
$result = mysql_query("SELECT * from videos where cattegory = '$restrict_domain' AND featured_status = 'on' ORDER BY id DESC LIMIT 5");
}
else
{
$result = mysql_query("SELECT * from videos where featured_status = 'on' ORDER BY id DESC");
}			
			
			
			while ($row = mysql_fetch_array($result))
			{
			echo '<img src="' . $row["featured_image"] . '" alt="" title="#' . $number . '" class="nivim" width="800px" height="300px" />';
			$number++;
			}
			?>
            </div>
			<?php
			$number = "1";
if ($restrict_status == "On")
{
$result = mysql_query("SELECT * from videos where cattegory = '$restrict_domain' AND featured_status = 'on' ORDER BY id DESC LIMIT 5");
}
else
{
$result = mysql_query("SELECT * from videos where featured_status = 'on' ORDER BY id DESC");
}				
			while ($row = mysql_fetch_array($result))
			{
			echo '
			<div id="' . $number . '" class="nivo-html-caption">
                <span>*NEW: </span><span style="font-weight: bold;">' . $row["video_name"] . '</span><a href="videos/watch.php?id=' . $row["id"] . "&video=" . $video_stripped . '" style="color: red; font-size: 12px; margin-left: 5px;"> CLICK HERE TO WATCH.</a>.
            </div>';
			$number++;
			}
			?>
        </div>

    <script type="text/javascript" src="scripts/jquery-1.6.1.min.js"></script>
    <script type="text/javascript" src="slider/jquery.nivo.slider.pack.js"></script>
    <script type="text/javascript">
    $(window).load(function() {
        $('#slider').nivoSlider();
    });
    </script>
	
		<!--Slider!-->
	
	
	
	
	
	
	
	
	
	
	
		</div>
	</div>
	<div id="main-div">
<div id="video-container">
	<div class="title-bar">Latest Videos</div>



<?php


   
   
   
if (isset($rate_status))
{
echo '<div class="rating_bit">' . $rate_status . '</div>';
}





$search = $_GET["search"];
mysql_real_escape_string($search);

if (($restrict_status == "On") && (isset($_GET["search"])))
{
$result = mysql_query("SELECT * from videos where cattegory = '$restrict_domain' and video_name LIKE '%$search%' ORDER BY id  DESC LIMIT $rowsperpage");
}
elseif (($restrict_status != "On") && (isset($_GET["search"])))
{
$result = mysql_query("SELECT * from videos where video_name LIKE '%$search%' ORDER BY id DESC LIMIT $rowsperpage");
}
else 
{
$result = mysql_query("SELECT * from videos ORDER BY id DESC LIMIT $rowsperpage");
}

$rows = mysql_num_rows($result);

if ($rows < 1)
{
echo "<div class='search-failed'>Sorry, it appears your search has returned no results or you haven't entered a search. Please try again.</div>";
}
else
{

while ($row = mysql_fetch_array($result))
{
$videocut = $row["video_name"];
$video_strip = stripslashes($videocut);
$replacing = array(" ", "-", "/", "'");
$video_stripped = str_replace($replacing, "-", $video_strip);
$rating = $row["rating"];
$raters = $row["raters"];
if ($rating < 1)
{
echo '	<div class="video-box">
		<div class="video-box-rating">
		<a href="index.php?rating=1&id=' . $row["id"] . '"><img src="images/no-rating.jpg" width="20" height="20" class="rating" alt="rating"></a>
		<a href="index.php?rating=2&id=' . $row["id"] . '"><img src="images/no-rating.jpg" width="20" height="20" class="rating" alt="rating"></a>
		<a href="index.php?rating=3&id=' . $row["id"] . '"><img src="images/no-rating.jpg" width="20" height="20" class="rating" alt="rating"></a>
		<a href="index.php?rating=4&id=' . $row["id"] . '"><img src="images/no-rating.jpg" width="20" height="20" class="rating" alt="rating"></a>		
		<a href="index.php?rating=5&id=' . $row["id"] . '"><img src="images/no-rating.jpg" width="20" height="20" class="rating" alt="rating"></a>	
		</div>
		<div class="video-thumb"><a href="videos/watch.php?id=' . $row["id"] . "&video=" . $video_stripped . '"><img src="' . $row["video_thumb"] . '" width="192" height="132"></a></div>
		<div class="video-title" style="padding-top: 5px;"><a href="videos/watch.php?id=' . $row["id"] . "&video=" . $video_stripped . '" style="none">' . $row["video_name"] . '</a></div>
		<div class="video-date">' . $row["video_date"] . '</div>
	</div>';
}


else
{

echo '	<div class="video-box">
		<div class="video-box-rating">
	
';

	if ($rating > ($raters * 4)) 
{

echo '<a href="index.php?rating=1&id=' . $row["id"] . '"><img src="images/rating-full.PNG" width="20" height="20" class="rating" alt="rating"></a>';
echo '<a href="index.php?rating=2&id=' . $row["id"] . '"><img src="images/rating-full.PNG" width="20" height="20" class="rating" alt="rating"></a>';
echo '<a href="index.php?rating=3&id=' . $row["id"] . '"><img src="images/rating-full.PNG" width="20" height="20" class="rating" alt="rating"></a>';
echo '<a href="index.php?rating=4&id=' . $row["id"] . '"><img src="images/rating-full.PNG" width="20" height="20" class="rating" alt="rating"></a>';
echo '<a href="index.php?rating=5&id=' . $row["id"] . '"><img src="images/rating-full.PNG" width="20" height="20" class="rating" alt="rating"></a>';
}
    elseif ($rating > ($raters * 3))
{
echo '<a href="index.php?rating=1&id=' . $row["id"] . '"><img src="images/rating-full.PNG" width="20" height="20" class="rating" alt="rating"></a>';
echo '<a href="index.php?rating=2&id=' . $row["id"] . '"><img src="images/rating-full.PNG" width="20" height="20" class="rating" alt="rating"></a>';
echo '<a href="index.php?rating=3&id=' . $row["id"] . '"><img src="images/rating-full.PNG" width="20" height="20" class="rating" alt="rating"></a>';
echo '<a href="index.php?rating=4&id=' . $row["id"] . '"><img src="images/rating-full.PNG" width="20" height="20" class="rating" alt="rating"></a>';
			echo '
		<a href="index.php?rating=5&id=' . $row["id"] . '"><img src="images/no-rating.jpg" width="20" height="20" class="rating" alt="rating"></a>	';				
}
    elseif ($rating > ($raters * 2))
{
echo '<a href="index.php?rating=1&id=' . $row["id"] . '"><img src="images/rating-full.PNG" width="20" height="20" class="rating" alt="rating"></a>';
echo '<a href="index.php?rating=2&id=' . $row["id"] . '"><img src="images/rating-full.PNG" width="20" height="20" class="rating" alt="rating"></a>';
echo '<a href="index.php?rating=3&id=' . $row["id"] . '"><img src="images/rating-full.PNG" width="20" height="20" class="rating" alt="rating"></a>';

			echo '		<a href="index.php?rating=4&id=' . $row["id"] . '"><img src="images/no-rating.jpg" width="20" height="20" class="rating" alt="rating"></a>		
		<a href="index.php?rating=5&id=' . $row["id"] . '"><img src="images/no-rating.jpg" width="20" height="20" class="rating" alt="rating"></a>	';					
}
    elseif ($rating > ($raters * 1))
{
echo '<a href="index.php?rating=1&id=' . $row["id"] . '"><img src="images/rating-full.PNG" width="20" height="20" class="rating" alt="rating"></a>';	
echo '<a href="index.php?rating=2&id=' . $row["id"] . '"><img src="images/rating-full.PNG" width="20" height="20" class="rating" alt="rating"></a>';
			echo '
		<a href="index.php?rating=3&id=' . $row["id"] . '"><img src="images/no-rating.jpg" width="20" height="20" class="rating" alt="rating"></a>
		<a href="index.php?rating=4&id=' . $row["id"] . '"><img src="images/no-rating.jpg" width="20" height="20" class="rating" alt="rating"></a>		
		<a href="index.php?rating=5&id=' . $row["id"] . '"><img src="images/no-rating.jpg" width="20" height="20" class="rating" alt="rating"></a>	';			
}
    elseif ($rating && $raters > 0)
{
echo '<a href="index.php?rating=1&id=' . $row["id"] . '"><img src="images/rating-full.PNG" width="20" height="20" class="rating" alt="rating"></a>';
			echo '		<a href="index.php?rating=2"><img src="images/no-rating.jpg" width="20" height="20" class="rating" alt="rating"></a>
		<a href="index.php?rating=3&id=' . $row["id"] . '"><img src="images/no-rating.jpg" width="20" height="20" class="rating" alt="rating"></a>
		<a href="index.php?rating=4&id=' . $row["id"] . '"><img src="images/no-rating.jpg" width="20" height="20" class="rating" alt="rating"></a>		
		<a href="index.php?rating=5&id=' . $row["id"] . '"><img src="images/no-rating.jpg" width="20" height="20" class="rating" alt="rating"></a>	';
}			
	echo '	</div>
		<div class="video-thumb"><a href="videos/watch.php?id=' . $row["id"] . "&video=" . $video_stripped . '"><img src="' . $row["video_thumb"] . '" width="192" height="132"></a></div>
		<div class="video-title"><a href="videos/watch.php?id=' . $row["id"] . "&video=" . $video_stripped . '" style="none">' . $row["video_name"] . '</a></div>
		<div class="video-date">' . $row["video_date"] . '</div>
	</div>';


}
}
   
   }
   
   
?>
	
</div>	
	<div class="advertisement-area">
	<?php echo $homepage_advertisement; ?>
	</div>


<div style="clear:both;"></div>
<div id="footer">
	<div id="footer-links"><a href="index.php">Home</a>
	<p id="site-footer">Website by <a href="bonken.co.uk">Bonken</a></p></div>
	<div id="footer-name"><?php echo $domain; ?></div>
</div>




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