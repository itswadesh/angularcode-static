<?php
$profimg="photos/donald-duck.jpg";
?>
<script type="text/javascript" src="js/jquery-1.8.0.min.js"></script>
<script type="text/javascript" src="js/jquery.form.js"></script>
<script> 
$(function() { 
$('#UploadForm').on('change', function(e) {
e.preventDefault();
//show uploading message
$("#picture_preview").html('<div style="padding:10px"><img src="photos/round-loader.gif" alt="Please Wait"/> </div>');
$(this).ajaxSubmit({
	target: '#picture_preview',
	success:  afterSuccess //call function after success
});
});
}); 

function afterSuccess()  { 
$('#UploadForm').resetForm();  // reset form
$('#img_prof').attr('src',$('#picture_preview img').attr("src"));
} 
</script>

<style>

.preview
{
width:200px;
border:solid 1px #dedede;
padding:10px;
}
#preview
{
color:#cc0000;
font-size:12px
}
	
#header ul li.first {
	margin-left: 0;
	border-left: none;
	list-style: none;
	display: inline;
	}*/
	.main_menu li
	{
	 padding:15px;
	}
	
</style>
<div style="background-color:#f2f2f2;">
<a style="float:left;" href="http://www.2lessons.info"><img src="http://4.bp.blogspot.com/-5RL_78SJKQ8/UFn0JHtE55I/AAAAAAAAAOc/0KzdpV5TAJc/s1600/2lessons-logo.png"/></a>
<a style="float:right;margin:0 50px;" href="http://www.2lessons.info/2012/09/asynchronous-photo-upload-and-resize.html"><h2>Tutorial Link - How to resize images using php</h2></a>
<div style="clear:both;">.</div>
</div>
<div style="width:650px; margin:0 auto;">
<div style="float:left;padding:30px;" align="center">
<div id="picture_preview">
<img src="<?=$profimg?>" width="200px" height="250px" style="border:1px solid #e2e2e2" alt="<?=$profimg?>" onerror="this.onerror=null; this.src='photos/donald-duck.jpg';"/>
<br/><br/>
</div>
</div>

<div style="float:left;width:50%;padding-top: 8%;" align="center">
Select an image file on your computer (2MB max)
</br></br>
<iframe name="upload_iframe" id="upload_iframe" style="display:none;"></iframe>
<form action="processupload.php" method="post" enctype="multipart/form-data" id="UploadForm">
<input name="ImageFile" type="file" id="input_file"/>
</form>
<div id="output"></div>
<br/>
</div>
</div>