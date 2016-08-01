<?php if (!defined('THINK_PATH')) exit();?>﻿<!DOCTYPE HTML>
<html>
<head>
<meta charset="utf-8">
<meta name="renderer" content="webkit|ie-comp|ie-stand">
<meta http-equiv="X-UA-Compatible" content="IE=edge">
<meta name="viewport" content="width=device-width,initial-scale=1,minimum-scale=1.0,maximum-scale=1.0,user-scalable=no" />
<meta http-equiv="Cache-Control" content="no-siteapp" />
<!--[if lt IE 9]>
<script type="text/javascript" src="js/html5.js"></script>
<script type="text/javascript" src="js/respond.min.js"></script>
<script type="text/javascript" src="js/PIE_IE678.js"></script>
<![endif]-->
<link type="text/css" rel="stylesheet" href="/Public/admin/css/H-ui.css"/>
<link type="text/css" rel="stylesheet" href="/Public/admin/css/H-ui.admin.css"/>
<link type="text/css" rel="stylesheet" href="/Public/admin/font/font-awesome.min.css"/>
<!--[if IE 7]>
<link href="font/font-awesome-ie7.min.css" rel="stylesheet" type="text/css" />
<![endif]-->
<title>百度外卖</title>
</head>
<body>
<div class="pd-20" style="padding-top:20px;">
  <p class="f-20 text-success">欢迎使用百度外卖后台系统 <span class="f-14"></span></p>
  <p>登录次数：<?php echo ($admin["log_count"]); ?> </p>
  <p>上次登录IP：<?php echo ($admin["last_ip"]); ?>  上次登录时间：<?php echo (date("Y-m-d H:i:s",$admin["log_time"])); ?></p>
  <table class="table table-border table-bordered table-bg mt-20">
    <thead>
      <tr>
        <th colspan="2" scope="col">后台信息</th>
      </tr>
    </thead>
    <tbody>

      <tr>
        <td>当前用户</td>
        <td><?php echo ($admin["account"]); ?></td>
      </tr>
    </tbody>
  </table>
</div>
<footer>
    本后台系统由<a href="http://www.17sucai.com/" target="_blank" title="">文本云、徐海森、曾艺</a>提供前端技术支持</p>
</footer>
<script type="text/javascript" src="/Public/admin/js/jquery.min.js"></script>

</body>
</html>

<!--代码整理：js代码 www.jsdaima.com-->