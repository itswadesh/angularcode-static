<?php
error_reporting(E_ERROR);
require_once('simple_html_dom.php');
require_once('url_to_absolute.php');
$url = $_POST['url'];
$urlForMeta = $_POST['url'];
$url = checkValues($url);
 
function checkValues($value)
{
$value = trim($value);
if (get_magic_quotes_gpc()) 
{
	$value = stripslashes($value);
}
$value = strtr($value, array_flip(get_html_translation_table(HTML_ENTITIES)));
$value = strip_tags($value);
$value = htmlspecialchars($value);
return $value;
}	
function urlMetaOG($url){
	$sites_html = file_get_contents($url);

$html = new DOMDocument();
@$html->loadHTML($sites_html);
$meta_og_img = null;
//Get all meta tags and loop through them.
foreach($html->getElementsByTagName('meta') as $meta) {
    //If the property attribute of the meta tag is og:image
    if($meta->getAttribute('property')=='og:image'){ 
        //Assign the value from content attribute to $meta_og_img
        $meta_og_img = $meta->getAttribute('content');
    }
}
return $meta_og_img;
} 
function fetch_record($path)
{
$file = fopen($path, "r"); 
if (!$file)
{
	exit("Problem occured");
} 
$data = '';
while (!feof($file))
{
	$data .= fgets($file, 1024);
}
return $data;
}
 
$string = fetch_record($url);
/// fecth title
$title_regex = "/<title>(.+)<\/title>/i";
preg_match_all($title_regex, $string, $title, PREG_PATTERN_ORDER);
$url_title = $title[1];
 
/// fecth decription
$tags = get_meta_tags($url);
?>
<div class="images" style="height:100px;">
<?php
$i=1;
$k=1;
$html = file_get_html($url);
$urlMetaOG=urlMetaOG($urlForMeta);
if(isSet($urlMetaOG)){
echo '<img src='.$urlMetaOG.' width="100" id="1" >';
$k=2;
}
foreach($html->find('img') as $element) {
	$i++;if ($i=='50'){break;}
	$absUrl = @url_to_absolute($url, $element->src);
	list($width, $height, $type, $attr) = getimagesize($absUrl);
	if($width >= 50 && $height >= 50 ){
    echo '<img src='.$absUrl. ' width="100" id='.$k.' >';
	$k++;
	}
}
?>

<input type="hidden" name="total_images" id="total_images" value="<?php echo --$k?>" />
</div>
<div class="info">
 
<input type="hidden" class="title" value="<?php  echo @$url_title[0]; ?>"/>
<input type="hidden" class="url" value="<?php  echo substr($url ,0,35); ?>"/>
<input type="hidden" class="desc" value="<?php  echo @$tags['description']; ?>"/>
<input type="hidden" class="tags" value="<?php  echo @$tags['keywords']; ?>"/>
	<label class="label_image">
	<label style="float:left"><img src="images/prev.png" id="previmg" alt="" /><img src="images/next.png" id="nextimg" alt="" /></label>
 	<label class="totalimg">
		Total <?php echo $k?> images
	</label>
	</label>
</div>