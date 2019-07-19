<?php
$temp=$_POST["temp"];
$humi=$_POST["humi"];
$flag=$_POST["flag"];
$num=$_POST["num"];
$password=$_POST["password"];

if ($password!="bot")
{
	echo "<head>";
	echo "<title>此生无悔入华夏 来生愿在种花家</title>";
	//echo "<style>body {margin-left: 0px;margin-top: 0px;margin-right: 0px;margin-bottom: 0px;overflow: hidden;}</style>";
	echo "<meta id=\"viewport\" name=\"viewport\" content=\"width=device-width,minimum-scale=1.0,maximum-scale=1.0,user-scalable=no\">
    <style>
        html,body,iframe{width: 100%;height: 100%;padding: 0;margin: 0}
        #wrap{width: 100%;height: 100%;}
        iframe{border: none;}
    </style>";

	echo "</head>";
	echo "<body>";

	echo "<iframe src=\"https://news.163.com/\" width='100%' height='100%' frameborder='0' name=\"_blank\" id=\"_blank\"></iframe>";
	
	echo "</body>";
	exit();
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
	
 function apidata($data){
	$durl='http://www.hashmap.tk:3100/send_group_msg?group_id=418501652&message='.urlencode("易班有".$data."人正在无线上网") ;
	#		http://www.hashmap.tk:3100/send_group_msg?group_id=418501652&message=
	#echo ("$durl");
	$apidata=curl_file_get_contents($durl);
	#echo ("$apidata");
	#echo "<pre>";
	#print_r ($apidata);
	#echo "</pre>";
	#echo "finish";
	}


#if ($data=="ssrpy")
#print $data;
require "connet.php";					//数据库部分
	$del="delete from `bot`  WHERE `makes`="."'".$password."'";
	#iecho ($del);
	$conn->query($del);
	$sql="INSERT INTO bot (time,temp,humi,num,flag,makes) VALUES (now(),'$temp','$humi','$num','$flag','$password')";
	$conn->query($sql);
	#echo $sql;	
	$conn->close();
#apidata($data);
?>