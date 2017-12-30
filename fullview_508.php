<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<html xmlns="http://www.w3.org/1999/xhtml">
<head>
<meta http-equiv="Content-Type" content="text/html; charset=utf-8" />

<title>FMQAI Search Results</title>

</head>

<body>
<!--Start SEHL-->
<?php
include ("sehl-1.8.3.php");
ob_start("sehl");
?>
<!--End SEHL-->

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
		&nbsp;<a href="https://davidjeddy.com" target="_blank" class="footermenu">David Eddy</a>
  </div>    
    
</div>

<hr />

<!--We dont need to know the word since we have searched for it and its highlighted on this page-->
<!--<P id="searchterm"><?PHP echo "Search term: " . $_GET['q'];?></P>-->
</div>

<!--end header area-->

<!--Prev/Next found item bttns-->
<!--we need to get the topoffSet amount and then scrool to that amount
document.getElementById('h10').scrollTop = document.getElementById('h10').offsetTop;
-->
<div class="docutilwrapper">
	<div class="docnav">
		<input name="prev" type="button" value="Find Prev" disabled="disabled" />&nbsp;&nbsp;&nbsp;<input name="prev" type="button" value="Find Prev" disabled="disabled" />
	</div>
	<div class="docutil">
		<input name="next" type="button" value="Download" onclick="window.open('<?PHP echo $_GET['q_dlfile'] ?>')" /> 
	</div>
</div>
&nbsp;
<!--start full article area-->

<div class="fullarticlecontent" id="fullarticlecontent">

<?php

// Get the search variable from URL

$var = $_GET['q_docID'];
//trim whitespace from the stored variable
  $trimmedvar = trim($var);

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
mysqli_connect("db","root","root");

//select which database we're using
mysqli_select_db("fmqaitest") or die("Error connecting to database, sorry :(.");

// Build SQL Query
// EDIT HERE and specify your table and field names for the SQL query
$query = "select * from tbl_docs where ID = $trimmedvar"; 

 $numresults=mysqli_query($query);
 $numrows=mysqli_num_rows($numresults);

// get results
$result = mysqli_query($query) or die("Couldn't execute query");

// now you can display the results returned
	while ($row= mysqli_fetch_array($result)) {
		$docid = $row["ID"];
		//$title = $row["Title"];
		//$title = substr($title, 0,64);
		//$body = $row["Body"];
		//picks out a chunck for a the preview
		//$body = substr($body, 128,8320);
		//innterHTMl does not like line breaks, time to sreplace
		//had to use ascii code to remove line breaks and carrage returns
		//$body = str_replace (chr(10), " ", $body); 
		//$body = str_replace (chr(13), " ", $body); 
		
		//$author = $row["Author"];
		//$date = $row["Date"];
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
		
$handle = fopen($display, "r");
$filecontents= fread($handle, filesize($display));

echo "$filecontents" ;
	}
?>

</div>
<!--Prev/Next found item bttns-->

<!--end full article area-->


<!--start footer-->
<?PHP include_once('footermenu.inc'); ?>
<!--end foter-->

</body>
</html>