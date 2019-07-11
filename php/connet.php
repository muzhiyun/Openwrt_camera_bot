<?php

$servername="localhost";
$username="admin";
$passwd="2019";
$dbname="control";

$conn=new mysqli($servername,$username,$passwd,$dbname);

if ($conn->connect_error) {
    die("连接失败: " . $conn->connect_error);
} 

?>