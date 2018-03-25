<?php
include '3curl.php';
define('APPID', 'wxf8518c8b9acc0dcf');
define('SECRET', '9109586d7ec46a5530e60043f9a77f99');
$url = "https://api.weixin.qq.com/cgi-bin/token?grant_type=client_credential";
$data['appid'] = APPID;
$data['secret'] = SECRET;
var_dump($data);
// 删掉assec_token的最后两个参数，直接使用字符串拼接
$url = $url . '&' . http_build_query($data);
// 通过curl调用这个借口
$curl = new MyCurl($url);
$content = $curl->get();
var_dump($content);