<?php
$dir="coolQ/data/image/";
$file=scandir($dir);
foreach ($file as $key) {
	# code...
	#echo "</br>---------";
	#echo $key;
	#echo "---------";
	/*
	if ($key!=NULL)
	{
		echo 1;
	}
	if ($key!=".")
	{
		echo 2;
	}
	if ($key!="..")
	{
		echo 3;
	}
	*/
	if(preg_match('/.jpg$/',$key))
	{
		if ($key!=NULL&&$key!="."&&$key!=".."&&$key!="now.jpg")
		{
			//echo "ceshi";
			echo "<img width=\"160\" height=\"160\" src=\"coolQ\\data\\image\\";
			#echo "";
			echo $key;
			//echo "http://192.168.1.1/tmp.jpg";
			echo "\">";
			#echo $key."</br>";
		}
	}
}
	
#var_dump($file);
?>
