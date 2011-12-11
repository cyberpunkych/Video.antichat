<?php
include ('settings.php');
include ('config.php');

$result = mysql_query("SELECT * from configurations");
$client_ip = $_SERVER['REMOTE_ADDR'];
$rating_id = mysql_real_escape_string($_GET["id"]);
$date = date("D, d M Y");
$check_rated = mysql_query("SELECT * from ratings where client_ip = '$client_ip' and date = '$date' and video_id = '$rating_id'");
$num_rows = mysql_num_rows($check_rated);
if (isset($_GET["rating"]) && ($_GET["rating"] > 0) && ($num_rows < 1) && ($_GET["rating"] < 6)) {
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


function render_index()
{
    global $title, $keywords, $description;
    $videos = array();

    $result = mysql_query("SELECT id, video_name, video_date, video_thumb, cattegory FROM videos ORDER BY id");
    while ($row = mysql_fetch_array($result))
    {
        $videos[] = array(
            'url' => intval($row['id']),
            'date' => htmlspecialchars($row['video_date']),
            'img' => $row['video_thumb'],
            'category' => htmlspecialchars($row['cattegory']),
            'title' => htmlspecialchars($row['video_name']),
            'author' => '', # TODO
            );
    }
    include '../design_layout/index.html';
}
render_index();

exit();
$number = "1";


if ($restrict_status == "On") {
    $result = mysql_query("SELECT * from videos where cattegory = '$restrict_domain' AND featured_status = 'on' ORDER BY id DESC LIMIT 5");
}
else
{
    $result = mysql_query("SELECT * from videos where featured_status = 'on' ORDER BY id DESC");
}

$videos = array();
while ($row = mysql_fetch_array($result))
{
    echo '<img src="' . $row["featured_image"] . '" alt="" title="#' . $number . '" class="nivim" width="800px" height="300px" />';
    $number++;
}
$number = "1";
if ($restrict_status == "On") {
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


$conn = mysql_connect($host, $user, $pw) or trigger_error("SQL", E_USER_ERROR);
$db = mysql_select_db($db, $conn) or trigger_error("SQL", E_USER_ERROR);


if ($restrict_status == "On") {
    $sql = "SELECT COUNT(*) FROM videos where cattegory = '$restrict_domain'";
}
else
{
    $sql = "SELECT COUNT(*) FROM videos";
}
$result = mysql_query($sql);
$r = mysql_fetch_row($result);
$numrows = $r[0];

// number of rows to show per page
// find out total pages
$totalpages = ceil($numrows / $rowsperpage);

// get the current page or set a default
if (isset($_GET['currentpage']) && is_numeric($_GET['currentpage'])) {
    // cast var as int
    $currentpage = (int)$_GET['currentpage'];
} else {
    // default page num
    $currentpage = 1;
} // end if

// if current page is greater than total pages...
if ($currentpage > $totalpages) {
    // set current page to last page
    $currentpage = $totalpages;
} // end if
// if current page is less than first page...
if ($currentpage < 1) {
    // set current page to first page
    $currentpage = 1;
} // end if

// the offset of the list, based on current page 
$offset = ($currentpage - 1) * $rowsperpage;

// get the info from the db 

$sql = "SELECT id, video_name FROM videos LIMIT $offset, $rowsperpage";
$result = mysql_query($sql, $conn) or trigger_error("SQL", E_USER_ERROR);

// while there are rows to be fetched...
while ($list = mysql_fetch_assoc($result)) {
    // echo data


    if (isset($rate_status)) {
        echo '<div class="rating_bit">' . $rate_status . '</div>';
    }
    if ($restrict_status == "On") {
        $result = mysql_query("SELECT * from videos where cattegory = '$restrict_domain' ORDER BY id  DESC LIMIT $offset, $rowsperpage");
    }
    else
    {
        $result = mysql_query("SELECT * from videos ORDER BY id DESC LIMIT $offset, $rowsperpage");
    }


    while ($row = mysql_fetch_array($result))
    {
        $videocut = $row["video_name"];
        $video_strip = stripslashes($videocut);
        $replacing = array(" ", "-", "/", "'");
        $video_stripped = str_replace($replacing, "-", $video_strip);
        $rating = $row["rating"];
        $raters = $row["raters"];
        if ($rating < 1) {
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

            if ($rating > ($raters * 4)) {

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


} // end while
?>

</div>
<div class="advertisement-area">
    <?php echo $homepage_advertisement; ?>
</div>
<div id="pagination" style="clear: both; padding-top: 20px;">


<?php
/******  build the pagination links ******/
// range of num links to show
    $range = 3;

// if not on page 1, don't show back links
    if ($currentpage > 1) {
        // show << link to go back to page 1
        echo "  <span class='page-a'><a href='{$_SERVER['PHP_SELF']}?currentpage=1'>First</a></span> ";
        // get previous page num
        $prevpage = $currentpage - 1;
        // show < link to go back to 1 page
        echo "  <span class='page-a'><a href='{$_SERVER['PHP_SELF']}?currentpage=$prevpage'>Previous</a> </span>";
    } // end if

// loop to show links to range of pages around current page
    for ($x = ($currentpage - $range); $x < (($currentpage + $range) + 1); $x++) {
        // if it's a valid page number...
        if (($x > 0) && ($x <= $totalpages)) {
            // if we're on current page...
            if ($x == $currentpage) {
                // 'highlight' it but don't make a link
                echo " [<b>$x</b>] ";
                // if not current page...
            } else {
                // make it a link
                echo "<span class='page-b'> <a href='{$_SERVER['PHP_SELF']}?currentpage=$x'>$x</a></span> ";
            } // end else
        } // end if
    } // end for

// if not on last page, show forward and last page links        
    if ($currentpage != $totalpages) {
        // get next page
        $nextpage = $currentpage + 1;
        // echo forward link for next page
        echo " <span class='page-a'><a href='{$_SERVER['PHP_SELF']}?currentpage=$nextpage'>Next</a></span> ";
        // echo forward link for lastpage
        echo "  <span class='page-a'><a href='{$_SERVER['PHP_SELF']}?currentpage=$totalpages'>Last</a></span> ";
    } // end if
    /****** end build pagination links ******/
    ?>


</div>
</div>


<div id="footer" style="margin-bottom: 170px;">
    <div id="footer-links"><a href="index.php">Home</a>

        <p id="site-footer">Website by <a href="bonken.co.uk">Bonken</a></p></div>
    <div id="footer-name"><?php echo $domain; ?></div>
</div>




<?php
    include('indexframe.php');
?>


<!-- Start of StatCounter Code -->
<script type="text/javascript">
    var sc_project =<?php echo $sc_p; ?>;
    var sc_invisible = 1;
    var sc_security = "<?php echo $sc_s; ?>";
</script>
<script type="text/javascript"
        src="http://www.statcounter.com/counter/counter.js"></script>
<noscript>
    <div
            class="statcounter"><a title="click tracking"
                                   href="http://statcounter.com/" target="_blank"><img
            class="statcounter"
            src="http://c.statcounter.com/7162859/0/98993364/1/"
            alt="click tracking"></a></div>
</noscript>
<!-- End of StatCounter Code -->
</body>
<?php
mysql_close($con);
?>
</html>