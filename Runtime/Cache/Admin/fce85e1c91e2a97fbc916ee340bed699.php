<?php if (!defined('THINK_PATH')) exit();?>﻿<!DOCTYPE HTML>
<html style="overflow-y:hidden;">
<head>
<meta charset="utf-8">
<meta name="renderer" content="webkit|ie-comp|ie-stand">
<meta http-equiv="X-UA-Compatible" content="IE=edge">
<meta name="viewport" content="width=device-width,initial-scale=1,minimum-scale=1.0,maximum-scale=1.0,user-scalable=no" />
<meta http-equiv="Cache-Control" content="no-siteapp" />
<LINK rel="Bookmark" href="/favicon.ico" >
<LINK rel="Shortcut Icon" href="/favicon.ico" />
<!--[if lt IE 9]>
<script type="text/javascript" src="js/html5.js"></script>
<script type="text/javascript" src="js/respond.min.js"></script>
<script type="text/javascript" src="js/PIE_IE678.js"></script>
<![endif]-->
<link href="/Public/admin/css/H-ui.css" rel="stylesheet" type="text/css" />
<link href="/Public/admin/css/H-ui.admin.css" rel="stylesheet" type="text/css" />
<link type="text/css" rel="stylesheet" href="/Public/admin/font/font-awesome.min.css"/>
<!--[if IE 7]>
<link href="font/font-awesome-ie7.min.css" rel="stylesheet" type="text/css" />
<![endif]-->
<!--[if IE 6]>
<script type="text/javascript" src="js/DD_belatedPNG_0.0.8a-min.js" ></script>
<script>DD_belatedPNG.fix('*');</script>
<![endif]-->
<title>百度后台管理</title>
<meta name="keywords" content="企业后台管理系统,企业后台模板,cms后台管理系统,cms网站管理系统,cms后台模板,cms管理系统模板" />
<meta name="description" content="实用的cms企业后台管理模板html下载。" />
</head>
<body style="overflow:hidden">
<header class="Hui-header cl"> <a class="Hui-logo l" title="百度外卖后台" href="/">百度外卖后台</a> <a class="Hui-logo-m l" href="/" title="H-ui.admin">H-ui</a> <span class="Hui-subtitle l"></span> <span class="Hui-userbox"><span class="c-white"><?php echo ($_SESSION['admin']['title']); ?>：<?php echo ($_SESSION['admin']['account']); ?></span> <a class="btn btn-danger radius ml-10" href="#" title="退出" onclick="logout(this,<?php echo ($_SESSION['admin']['id']); ?>)"><i class="icon-off"></i> 退出</a></span> <a aria-hidden="false" class="Hui-nav-toggle" id="nav-toggle" href="#"></a> </header>
<div class="cl Hui-main"> 
  <aside class="Hui-aside" style="">
    <input runat="server" id="divScrollValue" type="hidden" value="" />  
    <div class="menu_dropdown bk_2">

      <!--  <?php if($_SESSION['admin']['groupid'] != 1): ?><dl id="menu-user">
        <dt> <i class="icon-user"></i>
          常用操作 <b></b>
        </dt>
        <dd>
          <ul>
            <li>
              <a _href="<?php echo U('Users/userList');?>" href="javascript:;">会员管理</a>
            </li>
            <li>
              <a _href="<?php echo U('Cats/catList');?>" href="javascript:void(0)">分类管理</a>
            </li>
            <li>
              <a _href="<?php echo U('Orders/orderList');?>" href="javascript:void(0)">订单管理</a>
            </li>
            <li>
              <a _href="<?php echo U('Shops/shopList');?>" href="javascript:void(0)">商铺管理</a>
            </li>
            <li>
              <a _href="<?php echo U('Goods/goodList');?>" href="javascript:void(0)">商品管理</a>
            </li>
          </ul>
        </dd>
      </dl><?php endif; ?>
    -->
    <?php if(is_array($data)): $i = 0; $__LIST__ = $data;if( count($__LIST__)==0 ) : echo "" ;else: foreach($__LIST__ as $key=>$vo): $mod = ($i % 2 );++$i;?><dl id="menu-user">
        <dt> <i class="icon-user"></i>
          <?php echo ($vo["title"]); ?> <b></b>
        </dt>
        <dd>
          <ul>
            <?php if(is_array($vo['sub'])): $i = 0; $__LIST__ = $vo['sub'];if( count($__LIST__)==0 ) : echo "" ;else: foreach($__LIST__ as $key=>$sub): $mod = ($i % 2 );++$i;?><li>
                <a _href="/index.php/Admin/<?php echo ($sub["name"]); ?>" href="javascript:;"><?php echo ($sub["title"]); ?></a>
              </li><?php endforeach; endif; else: echo "" ;endif; ?>
          </ul>
        </dd>
      </dl><?php endforeach; endif; else: echo "" ;endif; ?>

    <!-- <?php if($_SESSION['admin']['groupid'] == 2): ?><dl id="menu-admin">
      <dt>
        <i class="icon-key"></i>
        管理员管理
        <b></b>
      </dt>
      <dd>
        <ul>
          <li>
            <a _href="<?php echo U('Admin/roleList');?>" href="javascript:void(0)">角色管理</a>
          </li>
          <li>
            <a _href="<?php echo U('Admin/permissionList');?>" href="javascript:void(0)">权限管理</a>
          </li>
          <li>
            <a _href="<?php echo U('Admin/adminList');?>" href="javascript:void(0)">管理员列表</a>
          </li>
        </ul>
      </dd>
    </dl><?php endif; ?>

  <?php if($_SESSION['admin']['groupid'] != 1): ?><dl id="menu-system">
      <dt>
        <i class="icon-cogs"></i>
        系统管理
        <b></b>
      </dt>
      <dd>
        <ul>
          <li>
            <a _href="<?php echo U('index/system-base');?>" href="javascript:void(0)">基本设置</a>
          </li>

        </ul>
      </dd>
    </dl><?php endif; ?>
  -->
  
  <dl id="menu-system">
    <dt>
      <i class="icon-cogs"></i>
      商家服务
      <b></b>
    </dt>
    <dd>
      <ul>
        
          <li>
            <a _href="<?php echo U('Shop/shopCreate');?>" href="javascript:void(0)">创建店铺</a>
          </li>
     
         
          <li>
            <a _href="<?php echo U('Shops/shopList');?>" href="javascript:void(0)">商铺管理</a>
          </li>
          <li>
            <a _href="<?php echo U('Shop/catList');?>" href="javascript:void(0)">分类管理</a>
          </li>
          <li>
            <a _href="<?php echo U('Shop/goodList');?>" href="javascript:void(0)">商品管理</a>
          </li>
          <li>
            <a _href="<?php echo U('Orders/orderList');?>" href="javascript:void(0)">订单管理</a>
          </li>
          <li>
            <a _href="<?php echo U('Shop/Announcement');?>" href="javascript:void(0)">公告管理</a>
          </li>
  
     

      </ul>
    </dd>
  </dl>


  </div>
  </aside>
  <div class="dislpayArrow">
  <a class="pngfix" href="javascript:void(0);"></a>
  </div>
  <section class="Hui-article">
  <div id="Hui-tabNav" class="Hui-tabNav">
  <div class="Hui-tabNav-wp">
  <ul id="min_title_list" class="acrossTab cl">
    <li class="active">
      <span title="我的桌面" data-href="<?php echo U('Index/welcome');?>">我的桌面</span> <em></em>
    </li>
  </ul>
  </div>
  <div class="Hui-tabNav-more btn-group">
  <a id="js-tabNav-prev" class="btn radius btn-default btn-small" href="javascript:;">
    <i class="icon-step-backward"></i>
  </a>
  <a id="js-tabNav-next" class="btn radius btn-default btn-small" href="javascript:;">
    <i class="icon-step-forward"></i>
  </a>
  </div>
  </div>
  <div id="iframe_box" class="Hui-articlebox">
  <div class="show_iframe">
  <div style="display:none" class="loading"></div>
  <iframe scrolling="yes" frameborder="0" src="<?php echo U('index/welcome');?>"></iframe>
  </div>
  </div>
  </section>
  </div>
<script type="text/javascript" src="/Public/admin/js/jquery.min.js"></script>
<script type="text/javascript" src="/Public/admin/js/Validform_v5.3.2_min.js"></script> 
<script type="text/javascript" src="/Public/admin/layer/layer.min.js"></script>
<script type="text/javascript" src="/Public/admin/js/H-ui.js"></script>
<script type="text/javascript" src="/Public/admin/js/H-ui.admin.js"></script>

</body>
</html>

<!--代码整理：js代码 www.jsdaima.com-->