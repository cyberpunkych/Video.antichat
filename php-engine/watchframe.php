<style>
.watchframe
{
border-top: 1px solid gray;
background-color: black;
margin-top: 500px;
position: fixed;
bottom: 0px;
width: 100%;
/* for IE */
filter:alpha(opacity=90);
/* CSS3 standard */
opacity:0.9;
}

.boxed-content
{
border-top: 2px solid gray;
text-align: center;
margin: 0px auto;
padding: 10px;
}

img.boxed-bord
{
border: 0.5px solid #EBEBEB;
margin-left: 20px;
height: 80px;
}


</style>

<script>
jQuery(document).ready(function($) {
if(navigator.platform == 'iPad' || navigator.platform == 'iPhone' || navigator.platform == 'iPod')
{
$(".watchframe").css("position", "static");
};
});
</script> 
<?php 
if ($enabled_box == "Yes" || $enabled_box == "on" || $enabled_box == "On" || $enabled_box == "Enabled" || $enabled_box == "YES" || $enabled_box == "yes")
{
?>
<div class="watchframe" style="clear: both;">
		<div id="frame-close">
			  <img src="../images/x.png" class="close-frame" align="right" width="30" height="30">
		</div>
	<div class="boxed-content">
	<?php
$result = mysql_query("SELECT cattegory from videos where id = '$video_id'");
while ($row=mysql_fetch_array($result))
{
$curcat = $row["cattegory"];
$cattegory_result = mysql_query("SELECT * from videos where cattegory = '$curcat' AND id != '$video_id' ORDER BY id DESC LIMIT 8");
while ($rowret=mysql_fetch_array($cattegory_result))
{
$videocut = $rowret["video_name"];
$video_strip = stripslashes($videocut);
$replacing = array(" ", "-", "/", "'");
$video_stripped = str_replace($replacing, "-", $video_strip);
?>
		<a href="../videos/watch.php?id=<?php echo $rowret["id"] . "&video=" . $video_stripped; ?>"><img src="../images/tray-icon.PNG" width="120" height="80" class="boxed-bord" style="background-size: 120px 80px ;background-image: url('<?php echo $rowret["video_thumb"]; ?>');" title="<?php echo $rowret["video_name"]; ?>"></a>
<?php
}
}
}
else
{
echo "";
}
?>	
	<script>
$("img.close-frame").click(function () {
$("div.watchframe").toggle("slow");
});    
</script>
	</div>
</div>