<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<html xmlns="http://www.w3.org/1999/xhtml">
<head>
<meta http-equiv="Content-Type" content="text/html; charset=utf-8" />

<title>FMQAI Search Results</title>

<!--CSS style-->
<!--reset for safety-->
<link href="./css/reset.css" rel="stylesheet" type="text/css" media="all" />
<!--our styles-->
<link href="./css/css.css" rel="stylesheet" type="text/css" media="screen" />
<!--Form Validation style-->
<link href="./css/SpryValidationTextField.css" rel="stylesheet" type="text/css" />
<!--AutoSuggest-->
<link href="./css/autosuggest.css" rel="stylesheet" type="text/css" media="screen" />

<!--//-->
<!--scripts-->
<!--Form validation-->
<script src="ajax/SpryValidationTextField.js" type="text/javascript"></script>
<!--Autouggest-->
<script language="JavaScript" type="text/javascript" src="ajax/xpath.js"></script>
<script language="JavaScript" type="text/javascript" src="ajax/SpryData.js"></script>
<script language="JavaScript" type="text/javascript" src="ajax/SimpleAutoSuggest.js"></script>
<script language="JavaScript" type="text/javascript" src="ajax/SpryWordSuggest.js"></script>
    
</head>

<body>

<div id="mainBody">

<a href="index.php" target="_self"><img src="gui/fmqaiLogo.png" width="274" height="156" alt="FMQAI Logo" longdesc="The FMQAI Logo" /></a>

<br /><br />

<div>
<a href="http://www.cms.hhs.gov/ESRDGeneralInformation/" target="_blank"  class="menulink">ESRD</a>&nbsp;&nbsp;&nbsp;|
&nbsp;&nbsp;&nbsp;<a href="http://www.cms.hhs.gov/" target="_blank"  class="menulink">CMS</a>&nbsp;&nbsp;&nbsp;|
&nbsp;&nbsp;&nbsp;<a href="http://fmqai.com/" target="_blank" class="menulink">FMQAI</a>&nbsp;&nbsp;&nbsp;|
&nbsp;&nbsp;&nbsp;<a href="index_508.php" target="_self" class="menulink">Text Only (508)</a>&nbsp;&nbsp;&nbsp;|
&nbsp;&nbsp;&nbsp;<a href="http://ssd.servehttp.com/resumev4/" target="_blank" class="menulink">David Eddy</a>
</div>
<br />

<div id="suggestedwordSample">
<form method="GET" action="results.php">
	<span id="sprytextfield1">
		<input name="q" type="text" value="" tabindex="q" id="q"  dir="ltr" lang="en" size="64" maxlength="128" />
		<input type="submit" value="Submit" tabindex="s" alt="Start Search" />
        	<div id="suggestedwordMenu" spry:region="dsSuggestedWords" style="display: none;position:relative;left:112px;">
				<table width="100%">
		        	<tr spry:repeat="dsSuggestedWords" spry:hover="hover" spry:suggestion="{word}" >
						<td><div>{word}</div></td>
					</tr>
				</table>
			</div>
        
    	<br />
		<span class="textfieldRequiredMsg">*A value is required to start a search.</span>
        
	</span>
</form>
</div>


<!--start footer-->
<?PHP include_once('footermenu.inc'); ?>
<!--end foter-->


</div>

<script type="text/javascript">
<!--
//Validation
var sprytextfield1 = new Spry.Widget.ValidationTextField("sprytextfield1");
//AutoSuggest
var asw = new Spry.Widget.SimpleAutoSuggest("q", "suggestedwordMenu", function(acWidget, str) { MyQueryFunc(acWidget, str, 1, dsSuggestedWords, "word"); });
//-->
</script>
</body>
</html>