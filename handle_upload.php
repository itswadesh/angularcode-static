<?php
$target_path  = "swadesh/";
//$target_path = $target_path . $_FILES['uploadedfile']['name'];
//$f = "swadesh/" . $_FILES['uploadedfile']['name'];
$f = split("_", $_FILES['uploadedfile']['name']);
    mkdir($target_path . $f[0], 0777, true);
//}
if(move_uploaded_file($_FILES['uploadedfile']['tmp_name'], $target_path . $f[0] . "/" . $f[1])) 
{
    echo "The file ".  basename( $_FILES['uploadedfile']['name']).
 " has been uploaded";
} 
else
{
    echo "There was an error uploading the file, please try again!";
}
?>;
