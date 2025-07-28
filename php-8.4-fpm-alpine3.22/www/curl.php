<?php
//1.初始化，创建一个新cURL资源
$ch = curl_init();
//2.设置URL和相应的选项
curl_setopt($ch, CURLOPT_URL, "http://192.168.3.110/curl_post.php");
//3.抓取URL并把它传递给浏览器
$str_hour = floor(time()/3600);
$str_hour = $str_hour."";
$id = "test.catphp.com-fc110fb5-".$str_hour."-4911484";
$arr =  array("catcontextheader: test.catphp.com;10.1.2.7;;;".$id.";".$id.";".$id."");
var_dump($arr);
curl_setopt($ch, CURLOPT_HTTPHEADER, $arr);
$arr =  array("filed: name");
var_dump($arr);
curl_setopt($ch, CURLOPT_HTTPHEADER, $arr);

curl_exec($ch);
//4.关闭cURL资源，并且释放系统资源
$code = curl_getinfo($ch,CURLINFO_HTTP_CODE);
echo "\n";
echo $code;
echo "\n";
curl_close($ch);
echo CURLOPT_HTTPHEADER;
?> 
