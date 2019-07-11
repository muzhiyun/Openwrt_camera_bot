### 2019校级电赛项目

基于Openwrt搭载UVC摄像头及串口传感器  配合PHP+MySQL与docker版酷Q机器人实现类似智能安防报警的效果

主动查询
    
![demo.jpg](https://github.com/muzhiyun/Openwrt_camera_bot/blob/master/demo.jpg)


#### 文件说明

- PHP           
*后端接口文件 部署时应放在web服务器的bot文件夹中 并修改connet.php中的mysql相关信息*
    - temp.php	温湿度更新接口

    - echo.php	温湿度查询接口

    - post.php	图片上传接口

    - index.php	图片预览页面

    -connet.php 数据库连接配置文件 请将数据库名称 账号 密码填写

- Shell         
*Shell脚本文件 部署时应放在至路由器的一个可写且重启不丢失的目录下 并设置对应crontab定时任务*

    - uart.sh   获取串口温湿度传感器的值并上传

    - shell.sh	获取照片并上传


#### 接口说明

	上传温度湿度接口 
	http://192.168.2.174/bot/temp.php

	请求方式 POST

	参数 	temp 			当前温度
			humi			当前湿度
			password		验证字段 必须带	
			flag			留作备用 暂时值恒为1
			
	返回	无
	
	返回示例：10	

	请求示例：curl -s -X POST "http://192.168.2.174/bot/temp.php" -d "password=bot&temp=$temp&humi=$humi&flag=1"

	==================================================================================================================================================
	查询接口

	http://192.168.2.174/bot/echo.php?password=bot

	请求方式 GET

	参数	password		验证字段 必须带 

	返回示例
	{
		"temp":"26",
		"humi":"73",
		"time":"2019-05-28 22:21:00"
	}
		

	请求示例：curl  http://192.168.2.174/bot/echo.php?password=bot


			
			