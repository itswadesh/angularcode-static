<?php
session_start();
$_SESSION['chatuser'] = '12';
$_SESSION['chatuser_name'] = 'VimlaJonko'; //; Must be already set

?>

<!DOCTYPE HTML PUBLIC "-//W3C//DTD HTML 4.01//EN" "http://www.w3.org/TR/html4/loose.dtd" >

<html>
<head>
<title>Live Demo | Simulating gmail, facebook type simple chat application using css, jQuery and PHP free @ 2lessons.com with space and special character support</title>
<style>
body {
	background-color: #eeeeee;
	padding:0;
	margin:0 auto;
	font-family:"Lucida Grande",Verdana,Arial,"Bitstream Vera Sans",sans-serif;
	font-size:11px;
}
</style>

<link type="text/css" rel="stylesheet" media="all" href="css/chat.css" />
<link type="text/css" rel="stylesheet" media="all" href="css/screen.css" />

<!--[if lte IE 7]>
<link type="text/css" rel="stylesheet" media="all" href="css/screen_ie.css" />
<![endif]-->

</head>
<body>
<div id="main_container" align="center">
<div style="background-color:#f2f2f2">
<a href="http://2lessons.com"><img src="http://2lessons.com/2lessons.com.png"/></a>
</div>

<H1>Live Demo | Free gmail, facebook type chat application using CSS, jQuery and PHP @ <a href="http://2lessons.com">2lessons.com</a></H1>
-> Supports both space and special characters <-
<h2><a style='color:green' href="javascript:void(0)" onclick="javascript:chatWith('2','Brijesh')">Chat with Brijesh</a></h2>
<h2><a style='color:green' href="javascript:void(0)" onclick="javascript:chatWith('13','itswadesh')">Chat with itswadesh</a></h2>
<!-- YOUR BODY HERE -->
  <p>&nbsp;</p>
  <p>&nbsp;</p>
  <p>&nbsp;</p>
  <p>&nbsp;</p>
  <p>&nbsp;</p>
    <p>&nbsp;</p>
  <p>&nbsp;</p>
  <p>&nbsp;</p>

<h2>Current User Session</h2> <?=$_SESSION['chatuser_name']?> (ID = <?=$_SESSION['chatuser']?> )
 <p>&nbsp;</p>
  <p>&nbsp;</p>
  <p>&nbsp;</p>
  <p>&nbsp;</p>
  <p>&nbsp;</p>
  <h2> <a href="http://itswadesh.wordpress.com/2011/05/07/gmail-facebook-style-jquery-chat/">Back to tutorial</a></h2>
</div>

<script type="text/javascript" src="js/jquery.min.js"></script>
<script type="text/javascript" src="js/chat.js"></script>

</body>
</html>