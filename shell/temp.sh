/bin/stty -F /dev/ttyUSB0 raw speed 115200
var=$(head -n 1 /dev/ttyUSB0)
echo $var
temp=${var:7:2}
echo $temp
humi=${var:23:2}
echo $humi
curl -s -X POST "http://192.168.2.174/bot/temp.php" -d "password=bot&temp=$temp&humi=$humi&flag=1"
#curl -s -X POST "http://192.168.2.174/openwrt_camera/temp/temp.php" -d "password=bot&temp=$temp&humi=$humi&flag=1"

