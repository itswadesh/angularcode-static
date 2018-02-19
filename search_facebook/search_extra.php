
	<ul id="display"> 
<?php
error_reporting(1);
define('DB_SERVER', 'mysql3.000webhost.com');
define('DB_USERNAME', 'a5214129_fb');
define('DB_PASSWORD', 'facebook0');
define('DB_DATABASE', 'a5214129_fb');
$connection = mysql_connect(DB_SERVER, DB_USERNAME, DB_PASSWORD) or die(mysql_error());
$database = mysql_select_db(DB_DATABASE) or die(mysql_error());
$txt="";$sql_res="";
$txt=$_POST["txt"];
$sql_res=mysql_query("SELECT distinct u.uid,u.username,u.email,u.profile_image FROM users u where username!='' and u.username like '%$txt%' order by u.username limit 7");

while($row=mysql_fetch_array($sql_res))
{
$username_search=$row['username'];
$email_search=$row['email'];
$img_search=$row['profile_image'];
$uid_search=$row['uid'];
?>
<a href="profile.php?id=<?php echo $uid_search; ?>">

        <li style="display: block;">
          
<div class="name">
<div class="display_box" align="left">

<div style="float:left">
<img src="photos/<?php echo $img_search; ?>" style="width:50px; float:left; margin-right:6px"/>
</div>

<div style="float:left" class="nm">
<b><?php echo $username_search; ?></b>
<div class="small"></div>
</div>
</div>
</div>
          
        </li> 
        
      

</a>

<?php
}




?>
</ul> 
