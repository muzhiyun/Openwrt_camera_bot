<?php
if(isset($_FILES["file"])&&(($_FILES["file"]["type"] == "image/gif")|| ($_FILES["file"]["type"] == "image/jpeg")|| ($_FILES["file"]["type"] == "image/pjpeg"))&& ($_FILES["file"]["size"] < 20000))
{
	$file= $_FILES["file"];
	$key = $file["name"];
}
else
{
	echo try_json_encode("403","Uploaded file is illegal");
	#exit;
}


if(isset($_GET["report"])&&$_GET["report"]!="false")
{
	#if(is_bool($_GET["report"]))
		$report = $_GET["report"];
	#else
	#	{
	#		echo "error";
	#		exit;
	#	}

}
else
{
	$report = boolval("");
}



$file_name = $file["name"];
$tmp_file = $file["tmp_name"];
#echo $key;
#echo $tmp_file;
$error = $file['error'];
    if($error == 0){
        move_uploaded_file($tmp_file, 'coolQ/data/image/'.$file_name);
		#echo unlink("now.jpg");
		#$file = "now.jpg";
		#if (!unlink($file))
		#{
		#  echo ("Error deleting $file");
		#}
		#else
		#{
		#  echo ("Deleted $file");
		#}
		system("rm -f coolQ/data/image/now.jpg");
		copy('coolQ/data/image/'.$file_name,"coolQ/data/image/now.jpg");
		echo try_json_encode("0","success")
    }
	#coolQ/data/image



	
#echo($report);
if ($report) //检测是否需要报告
{
	if(isset($_GET["id"])&&isset($_GET["type"])&&(($_GET["type"]=="group")||($_GET["type"]=="user"))&&(($_GET["id"]>0)&&($_GET["id"]<9999999999)))  //检测变量是否设置
	{
		$id = $_GET["id"];
		$type = $_GET["type"];
		#	echo($time);
		#echo 
		apidata($id,$type);
	}
	else
	{
		echo try_json_encode("403","The variable is illegal or empty");
	}

}


function try_json_encode($retcode_temp,$message_temp){
	$before=array("retcode"=>$retcode_temp,"message"=>$message_temp);
	$after=json_encode($before);
	#echo gettype($before);
	#echo "</br>";
	#echo gettype($after);
	#echo "</br>";
	#echo json_encode($before);
	#echo "</br>";
	#echo ($after);
	#echo "</br>";
	return $after;
}


function curl_file_get_contents($durl){  
    $ch = curl_init();  
    curl_setopt($ch, CURLOPT_URL, $durl);  
	curl_setopt($ch, CURLOPT_TIMEOUT,2); 
    curl_setopt($ch, CURLOPT_RETURNTRANSFER, true) ; // 获取数据返回    
    curl_setopt($ch, CURLOPT_BINARYTRANSFER, true) ; // 在启用 CURLOPT_RETURNTRANSFER 时候将获取数据返回    
    $data = curl_exec($ch);  
    curl_close($ch);  
    return $data;  
	}


 function apidata($id,$type){
 	if($type=="user")
 		$sendto = "private";
 	else
 		$sendto = "group";

 	$time = date('Y-m-d h:i:s', time());
	$durl='http://127.0.0.1:3100/send_'.$sendto.'_msg?'.$type.'_id='.$id.'&message='.urlencode($time).urlencode("\n动态监测报警[CQ:image,cache=0,file=http://192.168.2.174/bot/coolQ/data/image/now.jpg]") ;
	#echo ("$durl");
	$apidata=curl_file_get_contents($durl);
	#echo ("$apidata");
	echo "<pre>";
	print_r ($apidata);
	echo "</pre>";
	#echo "finish";
	}


?>