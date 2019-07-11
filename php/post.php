<?php
$file= $_FILES["file"];
$key = $file["name"];
if ($key=='')
{
	echo "操作非法，没有选择文件";
	exit;
}
$file_name = $file["name"];
$tmp_file = $file["tmp_name"];
echo $key;
echo $tmp_file;
$error = $file['error'];
    if($error == 0){
        move_uploaded_file($tmp_file, 'img/'.$file_name);
    }


?>