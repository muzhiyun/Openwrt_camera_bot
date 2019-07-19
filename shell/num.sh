#wifi5=$(iwinfo rax0 assoclist |wc -l)                                                                      
client=$(iwinfo wlan0-1 assoclist |wc -l)                                                                       
#num=`expr $wifi2 + $wifi5`                                                                                
#client=`expr $wifi`                                                                                                             
#ip=$(ifconfig eth1 |grep "inet addr:"|awk '{print $2}'|cut -c 6-)                                          
old=$(cat /usr/count_client)                                                                               
echo $old                                                                                                  
echo $client                                                                                               
#echo $ip                                                                                                   
if [ "$old" != "$client" ] ;then                                                                           
{                                                                                                          
        echo $client > /usr/count_client                                                                   
     #   curl -s -X POST "http://192.168.2.174/bot/temp.php" -d "password=bot&yiban=$client&ip=$ip"   
        echo " "                                                                                           
}                                                                                                          
else                                                                                                       
        echo "Same value,not updated"                                                                      
fi                                                                                   

