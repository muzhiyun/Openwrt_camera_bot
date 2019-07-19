my_current_date=`date +%Y_%m_%d`
my_current_time=`date +%H_%M_%S`
echo $my_current_time

echo $my_current_date
wget http://127.0.0.1:8080/?action=snapshot -O /tmp/$my_current_date"_"$my_current_time.jpg
echo “uploading…
curl -F file=@/tmp/$my_current_date"_"$my_current_time.jpg http://192.168.2.174/bot/post.php
echo 


#wifi5=$(iwinfo rax0 assoclist |wc -l)
client=$(iwinfo wlan0-1 assoclist |wc -l)
#num=`expr $wifi2 + $wifi5`
#client=`expr $wifi`                                                        
#ip=$(ifconfig eth1 |grep "inet addr:"|awk '{print $2}'|cut -c 6-)
old=$(cat /usr/count_client)
echo $old                                                                   
echo $client                                                                   


/bin/stty -F /dev/ttyUSB0 raw speed 115200
var=$(head -n 1 /dev/ttyUSB0)
echo $var
temp=${var:7:2}
echo $temp
humi=${var:23:2}
echo $humi
curl -s -X POST "http://192.168.2.174/bot/temp.php" -d "password=bot&temp=$temp&humi=$humi&flag=1&num=$client"
#curl -s -X POST "http://192.168.2.174/openwrt_camera/temp/temp.php" -d "password=bot&temp=$temp&humi=$humi&flag=1"
