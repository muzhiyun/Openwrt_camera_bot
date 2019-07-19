<?php


#$data=$_GET["yiban"];
$password=$_GET["password"];

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

function try_json_encode($temp_temp,$humi_temp,$num_temp,$time_temp){
	$before=array("temp"=>$temp_temp,"humi"=>$humi_temp,"devices"=>$num_temp,"time"=>$time_temp);
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


require "connet.php";					//数据库部分
	$last="SELECT time,temp,humi,num,flag,makes FROM bot where makes = "."'".$password."'";
	#echo $last;
	$result = $conn->query($last);
	$row = $result->fetch_assoc();
	#echo $row["num"]."台设备正在易班无线上网";
	#echo "</br>";
	#echo "最后更新时间：</br>".$row["time"];
	#echo "</br>";
	#echo "路由器当前IP：</br>".$row["ip"];
	echo try_json_encode($row["temp"],$row["humi"],$row["num"],$row["time"]);
	#echo ($result);
	#$conn->query($sql);
	$conn->close();

?>