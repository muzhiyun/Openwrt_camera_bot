<?php
$dir="img/";
$file=scandir($dir);
foreach ($file as $key) {
	# code...
	if ($key!=NULL&&$key!="."&&$key!="..")
	{
    	echo "<img width=\"80\" height=\"80\" src=\"";
    	echo "img/".$key;
    	//echo "http://192.168.1.1/tmp.jpg";
    	echo "\">";
		echo $key."</br>";
	}
}
//echo $file[3];
#var_dump($file);
?>
