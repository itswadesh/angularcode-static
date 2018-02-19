<?php
include_once '../includes/db.php';
$sql_res=mysql_query("select * from users limit 50");

?>
<HTML><HEAD><TITLE>Facebook type instant search</TITLE>
<META http-equiv=Content-Type content="text/html; charset=windows-1252">
<SCRIPT src="jquery.js"></SCRIPT>

<SCRIPT src="instant-search.js"></SCRIPT>

<STYLE>BODY {
	FONT-WEIGHT: 300; FONT-SIZE: 16px; MARGIN: 0px 10%; COLOR: #333; FONT-STYLE: normal; FONT-FAMILY: 'Helvetica Neue', Helvetica, Arial, sans-serif
}
.name SPAN {
	BACKGROUND: #fbffc6
}
UL {
	PADDING-RIGHT: 0px; PADDING-LEFT: 0px; PADDING-BOTTOM: 0px; MARGIN: 0px; PADDING-TOP: 0px
}
UL LI {
	BORDER-RIGHT: #ddd 1px solid; PADDING-RIGHT: 5px; BORDER-TOP: #ddd 1px solid; PADDING-LEFT: 5px; FONT-SIZE: 20px; BACKGROUND: #eee; FLOAT: left; PADDING-BOTTOM: 5px; MARGIN: 3px; BORDER-LEFT: #ddd 1px solid; WIDTH: 150px; LINE-HEIGHT: 70px; PADDING-TOP: 5px; BORDER-BOTTOM: #ddd 1px solid; LIST-STYLE-TYPE: none; HEIGHT: 70px; TEXT-ALIGN: center
}
#container {
	BORDER-RIGHT: #b9b9b9 1px solid; BORDER-TOP: #b9b9b9 1px solid; MARGIN-TOP: 20px; BORDER-LEFT: #b9b9b9 1px solid; WIDTH: 100%; BORDER-BOTTOM: #b9b9b9 1px solid; HEIGHT: 440px; webkit-box-shadow: 0 0 15px #aaa; moz-box-shadow: 0 0 15px #aaa; box-shadow: 0 0 15px #aaa
}
#container .content {
	OVERFLOW: auto; HEIGHT: 440px
}
#main {
	MARGIN: 0px auto; WIDTH: 100%;
}
INPUT {
	BORDER-RIGHT: #ddd 1px solid; BORDER-TOP: #ddd 1px solid; FONT-SIZE: 20px; BORDER-LEFT: #ddd 1px solid; BORDER-BOTTOM: #ddd 1px solid
}
A {
	COLOR: #31499c; TEXT-DECORATION: none
}
H1 {
	FONT-WEIGHT: normal; TEXT-ALIGN: center
}
</STYLE>
</HEAD>
<BODY>
<DIV id=main>
<H1>Facebook type instant search engine - super speed 
</H1>
Filter friends list : <INPUT id=filter> 
<DIV id=container>
<DIV class=content>
<UL>
<?php 
while($row=mysql_fetch_array($sql_res))
{
$username=$row['username'];
$email=$row['email'];
$img=$row['profile_image'];
?>
  <LI>
  <DIV class=text>
  <DIV class=name><?=$username?></DIV></DIV></LI>
<?php
}

?>  
  </UL></DIV></DIV></DIV></BODY></HTML>
