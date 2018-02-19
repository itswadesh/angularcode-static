<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<html xmlns="http://www.w3.org/1999/xhtml" xmlns:fb="http://ogp.me/ns/fb#" xml:lang="en" lang="en"><head><meta http-equiv="Content-Type" content="text/html; charset=UTF-8">
<title>Facebook type extract url data using PHP and jQuery</title>
<script type='text/javascript' src='js/jquery-1.8.0.min.js'></script>
<script>
$(function(){
var loading_image='<img src="images/round-loader.gif" />';
function url_extract()
	{
			if(!isValidURL($('#url').val()))
			{
				$('#err_url').html('Please enter a valid url. url must start with http://');
				return false;
			}
			else
			{
			$('#err_url').html('');
			$('.load').html(loading_image).show();
			var ajaxRequest = $.ajax({
			   type: "POST",
			   url: "url_fetch.php",
			   data: "url="+$('#url').val(),
			   cache: false,
			   success: function(response)
				{
					$('#span_image').html($(response).fadeIn('slow'));
					$('.images img').hide();
					$('.load').hide();
					$('img#1').fadeIn();
					$('#cur_image').val(1);
					$('#list_item_title').html($('#span_image .title').val());
					$('#list_item_url').html($('#url').val());
					$('#list_item_description').html($('#span_image .desc').val());
					//$('#list_item_tags').html($('#span_image .tags').val());
				}  });
			}
	}

$('#url').live("keyup", function(){
	url_extract();
});
// next image
$('#nextimg').live("click", function(){
	totalImages = $('#total_images').val();
	var firstimage = $('#cur_image').val();
	$('#cur_image').val(1);
	$('img#'+firstimage).hide();
	if(firstimage < totalImages)
	{
		firstimage = parseInt(firstimage)+parseInt(1);
		$('.totalimg').html(firstimage+' of '+totalImages);
		$('#cur_image').val(firstimage);
		$('img#'+firstimage).show();
	}
	else if(firstimage = totalImages){
		$('#cur_image').val(0);
	}
});	
// prev image
$('#previmg').live("click", function(){
	totalImages = $('#total_images').val();
	var firstimage = $('#cur_image').val();
 
	$('img#'+firstimage).hide();
	if(firstimage>0)
	{
		firstimage = parseInt(firstimage)-parseInt(1);
		$('.totalimg').html(firstimage+' of '+totalImages);
		$('#cur_image').val(firstimage);
		$('img#'+firstimage).show();
	}
 
});	

});	
function isValidURL(url){
var RegExp = /(ftp|http|https):\/\/(\w+:{0,1}\w*@)?(\S+)(:[0-9]+)?(\/|\/([\w#!:.?+=&%@!\-\/]))?/;

if(RegExp.test(url)){
	return true;
}else{
	return false;
}
}
</script>
  <?php error_reporting(E_ERROR); ?>
<style>

#previmg{cursor:pointer;}
#nextimg{cursor:pointer;}

.totalimg{ font-size:10px; color:#333333;float:left; margin:5px;}

.textInput {
height: 48px;
line-height: 1.28;
background-color: transparent;
border: 2px solid #d83b97;
-webkit-box-sizing: border-box;
outline: 0;
width: 550px;
}
.container{
	width:550px; height:250px;
	margin:0 auto;
	border:1px solid #eeeeee;
	padding:10px;
}
.items{
float:right;
width:400px;
padding:0 10px;
}
.title{
	font-weight:bold;
}
.keywords{
	margin-top:5px;
}
.url{
	font-size: 11px;
	font-weight: normal;
	color: #666;
}
</style>
<div style="background-color:#f2f2f2;">
<a style="float:left;" href="http://www.2lessons.info"><img src="http://4.bp.blogspot.com/-5RL_78SJKQ8/UFn0JHtE55I/AAAAAAAAAOc/0KzdpV5TAJc/s1600/2lessons-logo.png"/></a>
<a style="float:right;margin:20px 50px 0 0;" href="http://www.2lessons.info/2012/09/facebook-type-extract-url-data-using.html"><h2>Tutorial Link for facebook type extract url data using PHP and jQuery</h2></a>
<div style="clear:both;">.</div>
</div>
<div class="container">
<input type="hidden" id="cur_image" value="0">
<label>Enter the webpage url (Ex: http://www.2lessons.info)</label>
<div class="input">
	<textarea class="textInput" id="url" name="url" ></textarea>
	<p class="form_tip" style="color:#D73B96;" id="err_url">.</p>
	<div id="loader">
  </div>
</div>
<div class="load" style="display:none">&nbsp;</div>
<span class="items">
<div id="list_item_title" class="title"></div>
<div id="list_item_url" class="url"></div>
<div id="list_item_description"></div>
<div id="list_item_tags" class="keywords"></div>
</span>
<span id="span_image" >&nbsp;</span>
</div>


