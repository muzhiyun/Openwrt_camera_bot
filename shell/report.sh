my_current_date=`date +%Y_%m_%d`
my_current_time=`date +%H_%M_%S`
echo $my_current_time

echo $my_current_date
wget http://127.0.0.1:8080/?action=snapshot -O /tmp/$my_current_date"_"$my_current_time.jpg

echo uploading…
curl -F file=@/tmp/$my_current_date"_"$my_current_time.jpg http://192.168.2.174/bot/post.php?report=true\&type=user\&id=2652382350
echo
#curl http://192.168.2.174:3100/send_private_msg?user_id=2652382350\&message=%e5%8a%a8%e6%80%81%e7%9b%91%e6%b5%8b%e6%8a%a5%e8%ad%a6%5bCQ%3aimage%2ccache%3d0%2cfile%3dhttp%3a%2f%2f192.168.2.174%2fbot%2fimg%2fnow.jpg%5d
