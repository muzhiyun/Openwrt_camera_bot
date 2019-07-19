### Openwrt_camera_bot

2019校级电赛项目，基于Openwrt搭载UVC摄像头及串口传感器  配合PHP+MySQL与docker版酷Q机器人实现类似智能安防报警的效果


### 已实现功能 使用SHT20串口输出温湿度模块

- 被动查询

向机器人发送指定关键词，机器人回复相应数据(传感器数值、连接设备数、照片等，更新频率由shell脚本执行频率决定)
    
![demo.jpg](https://github.com/muzhiyun/Openwrt_camera_bot/blob/master/demo.jpg)

<img src="https://github.com/muzhiyun/Openwrt_camera_bot/raw/master/demo.jpg" width="356" height="399" alt="demo.jpg"/>

<img src="https://github.com/muzhiyun/Openwrt_camera_bot/raw/master/demo.jpg" alt="demo.jpg" style="max-width:40%;">

- 主动报警

在shell脚本中可设定当获取到的传感器值超出指定阈值时，通过curl调用酷Q的HTTPApi接口主动发送报警信息

![demo2.jpg](https://github.com/muzhiyun/Openwrt_camera_bot/blob/master/demo2.jpg)

### 预开发功能
		
- 搭配使用motion动态监测 检测到镜头前有运动物体自动执行脚本 实现视频监控   

- 制定统一接口规范，兼容更多传感器，兼容I2C、SPI等更多协议，降低耦合性，增强可扩展度。

- 使用C代替shell脚本，并编译为ipk包 制作对应luci界面 


#### 文件说明

- CoolQ

	*基于酷Q的C++SDK编写的插件源码，新手第一次写C++，写的很菜*

- PHP           
*后端接口文件 部署时应放在web服务器的bot文件夹中 并修改connet.php中的mysql相关信息*
    - temp.php	温湿度更新接口

    - echo.php	温湿度查询接口

    - post.php	图片上传接口

    - index.php	图片预览页面

    - connet.php 数据库连接配置文件 请将数据库名称 账号 密码填写

- Shell         
*Shell脚本文件 部署时应放在至路由器的一个可写且重启不丢失的目录下 并设置对应crontab定时任务*

	- temp.sh		获取串口温湿度上传脚本

	- photo.sh		照片上传不报告脚本

	- report.sh		照片上传报警脚本

	- num.sh		设备数获取测试脚本

	- all.sh		照片、温度、设备数综合上传

#### 接口说明


#### 图片预览后台 
[http://192.168.2.174/bot/index.php](http://192.168.2.174/bot/index.php "http://192.168.2.174/bot/index.php")

- 请求方式：http直接访问  

- 参数：无

---

#### 图片文件上传接口
[http://192.168.2.174/bot/post.php](http://192.168.2.174/bot/post.php "http://192.168.2.174/bot/post.php")  

- 说明	
	- 上传的图片文件名为jpg格式  以时间格式“**年\_月\_日\_时\_分\_秒**”命名。形如"**2019\_01\_01\_12\_00.jpg"** 	
	- 此接口上传的图片将存储于**coolQ/data/image/**下，并复制一份命名为**now.jpg**，以供机器人主动报告或被动查看  
	

- 参数	

		参数名 	  类型				范围					含义
		-----------------------------------------------------------------------------------------------------
		 report		布尔				 false/true			默认为false 代表不报告 适用于被定时上传的照片 true适用于触发报警
		
		 type 		字符串				group/user			report为true时必须带 发送群消息/私聊消息	
		
		 id			长整形				0/9999999999		report为true时必须带 发送目标的群号/QQ号
	

- 返回	


		状态码			含义			说明		
		-----------------------------------------------------
		0	 		上传成功	
		
		403	 		缺少参数
		
		503			参数无效 		请确定参数数据类型以及值是否有效


- 返回示例：2019\_01\_01\_12\_00.jpg
	
- 请求示例：
	- 定时上传 `curl -F file=@/tmp/2019_01_01_12_00.jpg http://192.168.2.174/bot/post.php`
	- 主动报告 `curl -F file=@/tmp/2019_01_01_12_00.jpg http://192.168.2.174/bot/post.php?report=true\&type=user\&id=2652382350`

 

---
#### 上传温度湿度设备数接口 
[http://192.168.2.174/bot/temp.php](http://192.168.2.174/bot/temp.php "http://192.168.2.174/bot/temp.php")

- 请求方式 POST

- 参数 	

		参数名		类型				范围					含义
		---------------------------------------------------------------------------------------------
		temp 		float								当前温度	
		humi		double								当前湿度
		num		int				0-255				设备数	
		password	字符串				  bot				  验证字段 必须带	
		flag		int				0-255				留作备用 暂时值恒为1
		
- 请求示例：    `curl -s -X POST "http://192.168.2.174/bot/temp.php" -d "password=bot&temp=99&humi=99&flag=1&num=99"`


- 返回	

		状态码			说明
		---------------------------
		200 				更新成功
		403				缺少参数
		500				参数错误

---
#### 查询接口

[http://192.168.2.174/bot/echo.php?password=bot](http://192.168.2.174/bot/echo.php?password=bot "http://192.168.2.174/bot/echo.php?password=bot")

- 请求方式 GET

- 参数	

`
	 password   验证字段      必须带   
`

- 请求示例：`curl  http://192.168.2.174/bot/echo.php?password=bot`


- **json**格式返回示例：

		{
			"temp":"26",
			"humi":"73",
			"devices":"1",
			"time":"2019-05-28 22:21:00"
		}
		


---

### 硬件依赖

Openwrt路由器 

- mjpg-streamer驱动UVC协议的USB摄像头

- Openwrt自编译固件中增加CH340 PL2303等USB转换模块的驱动
		
- shell脚本从mjpg-streamer视频流截图保存为图片 curl以POST提交温度、设备数、上传图片  + crontab计划任务定期执行  

云服务器  

- php+mysql 接受提交 更新记录 格式化输出数据提供查询 

- docker wine运行酷Q C++开发酷Q插件 浏览器VNC管理 群组消息关键字触发后 向127.0.0.1:80端口发起一个GET请求 json解析拿到设备数等相关信息




### crontab命令 

`
*/1 * * * * * bash /mnt/sda1/shell/all.sh
`

### 引用

使用参考了以下项目的部分代码，在此表示感谢

[Wine酷Q-使用 Wine 在 Docker 容器中运行 酷Q Air / Pro ](https://hub.docker.com/r/coolq/wine-coolq/)

[CoolQ C++ SDK-酷Q C++ SDK](https://github.com/richardchien/coolq-cpp-sdk)

[coolq-http-api-酷Q httpApi插件](https://github.com/richardchien/coolq-http-api)

[tinyjson-一个轻量化Header only型json解析](https://github.com/button-chen/tinyjson)

[mjpg-streamer-允许通过文件或者是HTTP方式访问linux UVC兼容摄像头](https://github.com/jacksonliam/mjpg-streamer)

[lede-Lean's OpenWrt source](https://github.com/coolsnowwolf/lede)

---
最后更改于：2019/6/5 21:40:05 
		