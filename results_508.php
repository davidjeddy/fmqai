<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<html xmlns="http://www.w3.org/1999/xhtml">
<head>
<meta http-equiv="Content-Type" content="text/html; charset=utf-8" />

<title>FMQAI Search Results</title>

</head>

<body>
<!--start header area-->
<div id="ResultsHeader">
<div class"logo"><a href="index.php" target="_self"><img src="gui/fmqaiLogo_sm.png" width="137" height="78" alt="FMQAI Logo" longdesc="FMQAI Logo" border="0" /></a></div>
  
	<div id="searchbox">
	<div id="suggestedwordSample">
   	  <form method="GET" action="results_508.php">
<span id="sprytextfield1">
			<input name="q" type="text" value="" tabindex="q" id="q"  dir="ltr" lang="en" size="32" maxlength="128" />
            &nbsp;&nbsp;&nbsp;<input type="submit" value="Submit" tabindex="s" alt="Start Search" /><br />
	  </form>
	</div>
	</div>
    
  <div id="topmenu">
		<a href="http://www.cms.hhs.gov/ESRDGeneralInformation/" target="_blank" class="footermenu">ESRD</a>&nbsp;|
		&nbsp;<a href="http://www.cms.hhs.gov/" target="_blank" class="footermenu">CMS</a>&nbsp;|
		&nbsp;<a href="http://fmqai.com/" target="_blank" class="footermenu">FMQAI</a>&nbsp;|
		&nbsp;<a href="index.php" target="_self" class="footermenu">Graphics</a>&nbsp;|
		&nbsp;<a href="http://ssd.servehttp.com/resumev4/" target="_blank" class="footermenu">David Eddy</a>
  </div>    
    
</div>

<hr />

<p id="searchterm"><?PHP echo "Search term: " . $_GET['q'];?></p>

</div>
<!--end header area-->

<!--start results-->
<div id="searchresultlist">
<?php

// Get the search variable from URL

//  $var = @$_GET['q_txtbx'] ;
$var = $_GET['q'];
//trim whitespace from the stored variable
  $trimmedvar = trim($var);
  $trimmedvar = str_replace("\""," ",$trimmedvar);

// rows to return
$limit=10; 

// check for an empty string and display a message.
// incase somehow a blank search go past the form validation
if ($trimmedvar == "")
  {
  echo "<p>Please enter a search...</p>";
  exit;
  }

// check for a search parameter was recieved from the querystring
if (!isset($var))
  {
  echo "<p>Error during search processing.</p>";
  exit;
  }

//(host, username, password)
$linkId = mysqli_connect("db","root","root");

//select which database we're using
mysqli_select_db($linkId,"fmqai") or die("Error connecting to database, sorry :(.");

// Build SQL Query
// EDIT HERE and specify your table and field names for the SQL query
$query = "select * from tbl_docs where Body like \"%$trimmedvar%\"  order by Date"; 

 $numresults=mysqli_query($linkId, $query);
 $numrows=0;
 if ($numresults) {
     $numrows = mysqli_num_rows($numresults);
 }

// If we have no results, offer a google search as an alternative

if ($numrows == 0)
  {
  echo "<br />Sorry, could not find any matches.<br />";

// google
 echo "You could try on <a href=\"http://www.google.com/search?q=". $trimmedvar . "\" target=\"_blank\" title=\"Look up " . $trimmedvar . " on Google\">google</a>.<br />";
  }

// next determine if s has been passed to script, if not use 0
  if (empty($s)) {
  $s=0;
  }

// get results
$query .= " limit $s,$limit";
$result = mysqli_query($linkId, $query) or die("Couldn't execute query");

// begin to show results set
$count = 1 + $s ;

// now you can display the results returned
	while ($row= mysqli_fetch_array($result)) {
		$docid = $row["ID"];
		$title = $row["Title"];
		$title = substr($title, 0,64);
		$body = $row["Body"];
		//picks out a chunck for a the preview
		$body = substr($body, 128,8320);
		//innterHTMl does not like line breaks, time to sreplace
		//had to use ascii code to remove line breaks and carrage returns
		$body = str_replace (chr(10), " ", $body); 
		$body = str_replace (chr(13), " ", $body); 
		
		$author = $row["Author"];
		$date = $row["Date"];
		//dont need the display formated field on this page, we will on the fullarticle page though.
		$display = $row["Display"];
		$dlfile = $row["dlfile"];
		//get format of D/L file
		$format = $dlfile;
		//remove all but the last 4 chracter from the string
		$start = strlen($format)-4;
		$end = strlen($format);
		//sutract the last 4 character
		//set it to the format
		$format = substr($format,$start,$end);
		

echo "
<p id=\"resultitemtitle\">$count )&nbsp;&nbsp;&nbsp;<a href=\"fullview_508.php?q=$trimmedvar&q_docID=$docid&q_dlfile=$dlfile\" target=\"_self\" class=\"menulink\">$title</a></p>
<p id=\"resultiteminfo\">
&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;Author:&nbsp;$author
&nbsp;&nbsp;&nbsp;|&nbsp;&nbsp;&nbsp;Date:&nbsp;$date<br />
&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;<a href=\"$display\" target=\"_new\" class=\"resultlink\">View (new window)</a>
&nbsp;&nbsp;&nbsp;|&nbsp;&nbsp;&nbsp;<a href=\"$dlfile\" target=\"_new\" class=\"resultlink\">Download ($format)</a><br />



</p><br /><br />" ;

		$count++ ;
	}


  

?>

</div>
<!--end results-->

<!--start footer-->
<?PHP include_once('footermenu.inc'); ?>
<!--end foter-->


</body>
</html>