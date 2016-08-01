<?php
header("Content-Type:text/html;charset=utf8");
// 检测PHP环境
if(version_compare(PHP_VERSION,'5.3.0','<'))  die('require PHP > 5.3.0 !');

// 开启调试模式 建议开发阶段开启 部署阶段注释或者设为false
define('APP_DEBUG',true);

define('WORKING_PATH',str_replace('\\','/',__dir__));//定义当前工作目录的常量
define('UPLOAD_PATH','/Public/Upload/shops/');//定义上传文件的根目录的常量

require './ThinkPHP/ThinkPHP.php';