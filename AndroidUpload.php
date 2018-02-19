<?php

$target_path  = "AndroidRec/";

$f = split("_", $_FILES['uploadedfile']['name']);
	mkdir($target_path . $f[0], 0777, true);
    mkdir($target_path . $f[0] . "/" . $f[1], 0777, true);
//echo "a_b_c";
//}
//echo "UFile".$_FILES['uploadedfile']['name'];
if(move_uploaded_file($_FILES['uploadedfile']['tmp_name'], $target_path . $f[0] . "/" . $f[1] . "/" . $f[2])) 

{

    echo "The file ".  basename( $_FILES['uploadedfile']['name']). " has been uploaded";

} 

else

{

    echo "There was an error uploading the file, please try again!";

}

?>;

