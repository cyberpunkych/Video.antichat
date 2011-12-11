<?php
session_start();
?>

<!DOCTYPE HTML PUBLIC "-//W3C//DTD HTML 4.01//EN" "http://www.w3.org/TR/html4/strict.dtd">
<?php
include ('settings.php');
include ('config.php');
if(isset($_SESSION['userName']))
{
  ?>
<html>
<head>
<title>Administration Section</title>
<style>
body
{
font-family: Arial, sans-serif;
text-align: center;
margin: 0px auto;
}

#container
{
margin: 0px auto;
width: 900px;
}

#title-bar
{
border-bottom: 1px solid black;
font-weight: bold;
margin-top: 100px;
text-align: left;
color: #0099FF;
padding: 5px;
width: 800px;
}

#left
{
width: 250px;
float: left;
}

.cattegory-title
{
border-bottom: 1px solid gray;
padding-bottom: 4px;
font-weight: bold;
text-align: left;
margin-top: 20px;
font-size: 14px;
width: 150px;
color: red;
}

.sub-cat-title
{
text-align: left;
font-size: 12px;
width: 100px;
}

a
{
text-decoration: none;
color: blue;
border: 0px;
}

img
{  border-style: none;
}

.video-p
{
color: blue;
}

#footer
{
border-top: 1px solid gray;
text-align: center;
width: 900px;
margin: 30px auto;
margin-top: 300px;
}

#footer-links, #footer-name
{
margin-bottom: 30px;
font-size: 12px;
padding: 20px;
color: blue;
}

#footer-links
{
text-align: left;
float: left;
}

#footer-name
{
text-align: right;
float: right;
}

#site-footer
{
font-style: italic;
font-size: 10px;
color: gray;
}

#pagination
{
text-align: center;
width: 900px;
text-align: center;
}

#right
{
padding-bottom: 20px;
width: 560px;
height: auto;
float: left;
}

#right-title
{
border-bottom: 1px solid gray;
font-weight: bold;
padding-bottom: 4px;
text-align: right;
margin-top: 20px;
font-size: 14px;
color: red;
}

.video_title
{
font-weight: bold;
text-align: left;
font-size: 14px;
padding: 10px;
}

.vid-tit
{
width: 200px;
}

.video-thumb-box
{
margin: 10px;
float: left;
}

.video-title-text
{
	margin: 10px auto;
	
}

.video-text-cont
{
border-left: 1px solid gray;
padding-left: 20px;
text-align: left;
height: 125px;
float: left;
}

.video-title-text
{
padding-top: 20px;
font-size: 12px;
color: blue;
}

.video_description_text
{
font-size: 10px;
color: gray;
}

.video_options
{
text-align: center;
padding-top: 10px;
}

.delete-edit-video
{
font-size: 12px;
}

.end
{
border-top: 1px solid gray;
}

.video_changed_text
{
font-weight: bold;
font-color: red;
padding: 50px;
}
</style>
</head>
<body>
	<div id="container">
	<div id="title-bar">Administration Section</div>
	<div id="left">
		<div class="cattegory-title">Video Options</div>
		<div class="sub-cat-title"><p>- <span class="video-p"><a href="admin.php?select=edit_videos">Edit Videos</a></span></p></div>
		<div class="sub-cat-title"><p>- <span class="video-p"><a href="admin.php?select=new_video">New Video</a></span></p></div>	
		
		<div class="cattegory-title">General Options</div>
		<div class="sub-cat-title"><p>- <span class="video-p"><a href="admin.php?select=settings">Edit Settings</a></span></p></div>
		<div class="sub-cat-title"><p>- <span class="video-p"><a href="admin.php?select=new_cattegory">New Cattegory</a></span></p></div>		
		<div class="sub-cat-title"><p>- <span class="video-p"><a href="admin.php?select=delete_cattegory">Delete Cattegory</a></span></p></div>			
	</div>
	<div id="right">
	<?php
	$result = mysql_query("SELECT * from videos order by id DESC");	
	$setting = $_GET["select"];
	if ($setting == "edit_videos")
	{


	echo '
		<div id="right-title">Edit Videos.</div>
	';

while($row = mysql_fetch_array($result))
  {
  $titlelength = strlen($row["video_name"]);
  $video_id = $row["id"];
  $descriptionlength = strlen($row["video_description"]);
  if ($titlelength > 40)
  {
  $title_string = substr($row["video_name"], 0, 40) . "..";
  }
  else
  {
  $title_string = $row["video_name"];
  }
  
  if ($descriptionlength > 40)
  {
  $desc_string = substr($row["video_description"], 0, 40) . "..";
  }
  else
  {
  $desc_string = $row["video_description"];
  }
  echo '
	<div class="video-edit-container">
		<div class="video-thumb-box">
			<img src="' . $row["video_thumb"] . '" width="150" height="100">
		</div>
		<div class="video-text-cont">
			<div class="video-title-text">' . $title_string . '</div>
			<div class="video_description_text">' . $desc_string . '.</div>
			<div class="video_description_text">Views: ' . $row["views"] . '.</div>
		<div class="video_options">
			<div class="delete-edit-video">
				<a href="admin.php?select=delete_video&id=' . $video_id . '">Delete</a> | 
				<a href="admin.php?select=edit_video&id=' . $video_id . '">Edit</a> 
			</div>
		</div>
			</div>	
			</div>
		<div class="end" style="clear: both;"></div>
		
		
		
		
			';
	  }
	}

	elseif ($setting == "new_video")
	{
	echo 
	'
	<div id="right-title">New Video.</div>
	<form action="admin.php?select=video_added" method="post">
		<div class="video_title"><div class="vid-tit">Video Title:</div> <input type="text" name="video_title" /><br /></div>
		<div class="video_title"><div class="vid-tit">Video Description:</div> <input type="text" name="video_description"  /><br /></div>
		<div class="video_title"><div class="vid-tit">Video Keywords:</div> <input type="text" name="video_keyword"  /><br /> </div>
		<div class="video_title"><div class="vid-tit">Video Thumb:</div> <input type="text" name="video_thumb"  /><br /> </div>
		<div class="video_title"><div class="vid-tit">Embed Code:</div> <input type="text" name="embed_code"  /><br /> </div>	
		<div class="video_title"><div class="vid-tit">Enable Featured?</div> <input type="checkbox" name="featured_enabled" /><br /> </div>	
		<div class="video_title"><div class="vid-tit">Featured Image:</div> <input type="text" name="featured_image"  /> <br /> </div>	
		<div class="video_title"><div class="vid-tit">Featured Image:</div>		
		<select name="cattegory_select">
			<option value="All" selected="selected">General ' . $row["cattegory"] . '</option>';		
			
			$check_this = mysql_query("SELECT * from cattegories");
			while ($checking = mysql_fetch_array($check_this))
			{
			echo '<option value="' . $checking["cattegory"] . '">' . $checking["cattegory"] . '</option>';
			}
			
			
		echo '</select> <br /> </div>	
		<input type="submit" value="Submit" />
	</form>	
	';
	}
	
	
	
	
	
	
	
	elseif ($setting == "video_edited")
	{
	$pid = $_GET["id"];
	$vpt = $_POST["video_title"];
	$video_description = $_POST["video_description"];
	$video_keyword = $_POST["video_keyword"];
	$video_thumb = $_POST["video_thumb"];	
	$embed_code = $_POST["embed_code"];	
	$featured_image = $_POST["featured_image"];
	$featstat = $_POST["featured_enabled"];
	$catselect = $_POST["cattegory_select"];	$catselect = $_POST["cattegory_select"];
	mysql_query("UPDATE videos SET video_name = '$vpt', video_description = '$video_description', video_keywords = '$video_keyword', video_thumb = '$video_thumb', video_embed = '$embed_code', featured_status = '$featstat', featured_image = '$featured_image', cattegory = '$catselect' WHERE id = '$pid'");
	echo 
	'
	<div id="right-title">Succesfully Edited.</div>
	<div class="video_changed_text">Your video has been succesfully updated!.</div>
	';
	}
	
	
	
	elseif ($setting == "new_cattegory")
	{
echo '
	<div id="right-title">Manage Cattegories.</div>


	<form action="admin.php?select=cattegory_added" method="post">
		<div class="video_title">New Cattegory: <input type="text" name="cattegory" /><br /></div>	
		<input type="submit" value="Submit" />
	</form>	';
	}	
	
	
	elseif ($setting == "cattegory_added")
	{
	$new_cattegory = $_POST["cattegory"];
	mysql_query("INSERT INTO cattegories (cattegory) VALUES ('$new_cattegory')");
echo '
	<div id="right-title">Cattegory Added.</div>
	<div class="video_changed_text">Your cattegory has been succesfully added!.</div>	
	
	';
	}	
	
	
	elseif ($setting == "delete_cattegory")
	{
echo '
	<div id="right-title">Delete Cattegories.</div>
		<div class="video_title"><div class="vid-tit">Cattegory:</div>	
	<form action="admin.php?select=cattegory_deleted" method="post">
		<select name="cattegory_select">
			<option value="All" selected="selected">Please select a cattegory ' . $row["cattegory"] . '</option>		
			<option value="All">General</option>';		
			
			$check_this = mysql_query("SELECT * from cattegories");
			while ($checking = mysql_fetch_array($check_this))
			{
			echo '<option value="' . $checking["cattegory"] . '">' . $checking["cattegory"] . '</option>';
			}
			
			
		echo '</select>
		<input type="submit" value="Delete" />
	</form>	</div>';
	}	


	elseif ($setting == "cattegory_deleted")
	{
	$posted_cat = $_POST["cattegory_select"];
	mysql_query("DELETE FROM cattegories WHERE cattegory  = '$posted_cat'");
echo '
		<div id="right-title">Cattegory Deleted.</div>
			<div class="video_changed_text">Your cattegory has been succesfully deleted.</div>';	
	}	
	
	
	elseif ($setting == "video_added")
	{
	$date = date("D, d M Y H:i:s O");
	$video_title = $_POST["video_title"];
	$video_description = $_POST["video_description"];
	$video_keyword = $_POST["video_keyword"];
	$video_thumb = $_POST["video_thumb"];	
	$embed_code = $_POST["embed_code"];	
	$featured_status = $_POST["featured_enabled"];	
	$featured_image = $_POST["featured_image"];		
	$catselect = $_POST["cattegory_select"];	
	
	mysql_query("INSERT INTO videos (video_name, video_description, video_keywords, video_thumb, video_embed, video_date, featured_status, featured_image, cattegory) VALUES ('$video_title', '$video_description', '$video_keyword', '$video_thumb', '$embed_code', '$date', '$featured_status', '$featured_image', '$catselect')");
	echo '
	<div id="right-title">Video added succesfully.</div>
	<div class="video_changed_text">Your video has been added succesfully to the website.</div>
	';
	}
	elseif ($setting == "settings")
	{
	$result = mysql_query("SELECT * from configurations");
	while ($row=mysql_fetch_array($result))
{
	$escaped = htmlentities($row["cpalead_id"]);
	$escaped_a = htmlentities($row["home_ad"]);	
	echo 
	
	'
		<div id="right-title">Edit Settings.</div>
	<form action="admin.php?select=settings_change" method="post">
		<div class="video_title"><div class="vid-tit">Domain Name:</div> <input type="text" name="domain" value="' . $row["domain"] . '" /><br /></div>	
		<div class="video_title"><div class="vid-tit">Description:</div> <input type="text" name="description" value="' . $row["description"] . '" /><br /></div>
		<div class="video_title"><div class="vid-tit">Keywords:</div> <input type="text" name="keywords" value="' . $row["keywords"] . '" /><br /></div>
		<div class="video_title"><div class="vid-tit">Home Title:</div> <input type="text" name="title" value="' . $row["title"] . '" /><br /></div>
		<div class="video_title"><div class="vid-tit">Homepage Advertisement:</div> <input type="text" name="home_ad" value="' . $escaped_a . '" /><br /></div>
		<div class="video_title-mini" style="font-size: 10px; font-style: italic;"><div class="vid-tit">The homepage advertisement is the small area located on the right-side of the index page. Suggested max width of 200px. An example would be an adsense ad. </div><br /></div>			
		<div class="video_title"><div class="vid-tit">Widget Enabled:</div> 
		<select name="cpalead_enabled">
			<option value="' . $row["cpalead_enabled"] . '" selected="selected">Currently ' . $row["cpalead_enabled"] . '</option>		
			<option value="Disabled">Disable</option>
			<option value="Enabled">Enable</option>
		</select>
		
		<br /></div>
		<div class="video_title"><div class="vid-tit">Widget Code:</div> <input type="text" name="cpalead_id" value="' . $escaped . '" /><br /></div>
		<div class="video_title-mini" style="font-size: 10px; font-style: italic;"><div class="vid-tit">An example of a widget being used would be <a href="http://www.cpalead.com/get-started.php?ref=118588">CPALead</a> (ref link). Using a widget can make your website highly lucrative and bring in more money. </div><br /></div>
		<div class="video_title"><div class="vid-tit">Statcounter Project Code:</div> <input type="text" name="sc_p" value="' . $row["statcounter_project"] . '" /><br /></div>		
		<div class="video_title"><div class="vid-tit">Statcounter Security Code:</div> <input type="text" name="sc_s" value="' . $row["statcounter_security"] . '" /><br /></div>		
		<input type="submit" value="Submit" />
	</form>	';
	}
	}
	elseif ($setting == "settings_change")
	{
	$domain = $_POST["domain"];
	$description = $_POST["description"];
	$keywords = $_POST["keywords"];
	$title = $_POST["title"];
	$home_ad = $_POST["home_ad"];
	$sc_p = $_POST["sc_p"];
	$sc_s = $_POST["sc_s"];	
	$cpalead_enabled = $_POST["cpalead_enabled"];
	$cpalead_code = $_POST["cpalead_id"];	
	mysql_query("UPDATE configurations SET domain = '$domain', description = '$description', keywords = '$keywords', title = '$title',  home_ad = '$home_ad', cpalead_enabled = '$cpalead_enabled', cpalead_id = '$cpalead_code', statcounter_project = '$sc_p', statcounter_security = '$sc_s' ");
	echo 
	'
	<div id="right-title">Succesfully Edited.</div>
	<div class="video_changed_text">Your global settings have been updated.</div>
	';
	}
	elseif ($setting == "delete_video")
	{
	$posted_id = $_GET["id"];
	mysql_query("DELETE FROM videos WHERE id = '$posted_id'");
	echo '
	<div id="right-title">Deleted Video.</div>
	<div class="video_changed_text">Video Succesfully Deleted.</div>';
	}	
	elseif ($setting == "edit_video")
	{	
	$posted_id = $_GET["id"];
	$result = mysql_query("SELECT * from videos where id = $posted_id");
	while ($row=mysql_fetch_array($result))
	{
	$featstat = $row["featured_status"];
	if ($featstat == "on")
	{
	$checked = 'checked = "checked" ';
	}
	else
	{
	$checked = "";
	}
	$escaped_v = htmlentities($row["video_embed"]);
	echo 
	'
		<div id="right-title">Edit Video.</div>
	<form action="admin.php?select=video_edited&id=' . $_GET['id'] . '" method="post">
		<div class="video_title"><div class="vid-tit">Video Title:</div> <input type="text" name="video_title" value="' . $row["video_name"] . '" /><br /></div>
		<div class="video_title"><div class="vid-tit">Video Description:</div> <input type="text" name="video_description"  value="' . $row["video_description"] . '"/><br /></div>
		<div class="video_title"><div class="vid-tit">Video Keywords:</div> <input type="text" name="video_keyword"  value="' . $row["video_keywords"] . '"/><br /> </div>
		<div class="video_title"><div class="vid-tit">Video Thumb:</div> <input type="text" name="video_thumb"  value="' . $row["video_thumb"] . '"><br /> </div>
		<div class="video_title"><div class="vid-tit">Embed Code:</div> <input type="text" name="embed_code"  value="' . $escaped_v . '"/><br /> </div>	
		<div class="video_title"><div class="vid-tit">Enable Featured?</div> <input type="checkbox" name="featured_enabled" ' . $checked . '><br /> </div>	
		<div class="video_title"><div class="vid-tit">Featured Image:</div> <input type="text" name="featured_image" value="' . $row["featured_image"] . '" /> <br /> </div>
		<div class="video_title"><div class="vid-tit">Cattegory:</div>
		<select name="cattegory_select">
			<option value="' . $row["cattegory"] . '" selected="selected">Currently ' . $row["cattegory"] . '</option>		
			<option value="All">All</option>';		
			
			$check_this = mysql_query("SELECT * from cattegories");
			while ($checking = mysql_fetch_array($check_this))
			{
			echo '<option value="' . $checking["cattegory"] . '">' . $checking["cattegory"] . '</option>';
			}
			
			
		echo '</select>
		<br /> </div>			
		<input type="submit" value="Submit" />
	</form>	';
	
	
	}
	}
	else
	{
	echo '
	<div id="right-title">Please select an option on the side.</div>
	<div class="video_changed_text">Please select an option at the side bar.</div>
	';
	}
	?>
	
	
	</div>
	</div>
	
	<div id="footer" style="clear: both;">
	<div id="footer-links"><a href="index.php">Home</a> - <a href="logged_out.php">Logout</a>
	<p id="site-footer">Website by <a href="bonken.co.uk">Bonken</a></p></div>
	<div id="footer-name"><?php echo $domain; ?></div>
</div>
</body>
</html>
<?php
}
else
{
  echo 'Sorry, it seems your session has ended. Please login again <a href="admin_login.php">here</a>.';
}
?>
