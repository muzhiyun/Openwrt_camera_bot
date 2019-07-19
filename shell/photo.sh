my_current_date=`date +%Y_%m_%d`
my_current_time=`date +%H_%M_%S`
echo $my_current_time

echo $my_current_date
wget http://127.0.0.1:8080/?action=snapshot -O /tmp/$my_current_date"_"$my_current_time.jpg
echo “uploading…�
curl -F file=@/tmp/$my_current_date"_"$my_current_time.jpg http://192.168.2.174/bot/post.php
echo 
