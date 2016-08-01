<?php if (!defined('THINK_PATH')) exit();?><!DOCTYPE HTML>
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
<title>商铺管理</title>
</head>
<body>
<nav class="Hui-breadcrumb"><i class="icon-home"></i> 首页 <span class="c-gray en">&gt;</span> 常用操作 <span class="c-gray en">&gt;</span> 商铺管理 <a class="btn btn-success radius r mr-20" style="line-height:1.6em;margin-top:3px" href="javascript:location.replace(location.href);" title="刷新" ><i class="icon-refresh"></i></a></nav>
<div class="pd-20">
   <div class="cl pd-5 bg-1 bk-gray mt-20">
    <span class="r">&nbsp;&nbsp;共有：<strong style="color:blue"><?php echo ($countNum); ?></strong> 个商铺</span>
  </div>
  <table class="table table-border table-bordered table-hover table-bg table-sort">
    <thead>
      <tr class="text-c">
        <th width="90">商铺名称</th>
        <th width="90">公司名称</th>
        <th width="90">商户类型</th>
        <th width="90">联系人</th>
        <th width="120">联系电话</th>
        <th width="220">商铺地址</th>
        <th width="120">创建时间</th>
        <th width="100">状态</th>
        <th width="80">操作</th>
      </tr>
    </thead>

    <tbody>
      <?php if(is_array($data)): $i = 0; $__LIST__ = $data;if( count($__LIST__)==0 ) : echo "" ;else: foreach($__LIST__ as $key=>$vo): $mod = ($i % 2 );++$i;?><tr class="text-c">       
        <td><?php echo ($vo["title"]); ?></td>
        <td><?php echo ($vo["compay_name"]); ?></td>
        <td>
          <?php if($vo["shop_type"] == '1'): ?>企业商户<?php endif; ?>
          <?php if($vo["shop_type"] == '0'): ?>个体商户<?php endif; ?>
        </td>
        <td><?php echo ($vo["account"]); ?></td>
        <td><?php echo ($vo["mobile"]); ?></td>
        <td><?php echo ($vo["address"]); ?></td>
        <td><?php echo (date("Y-m-d",$vo["create_time"])); ?></td>
        <td class="user-status">
          <?php if($vo["state"] == '1'): ?><span class="label label-success">营业</span><?php else: ?><span class="label label-danger">停业</span><?php endif; ?>
         
          <a title="状态修改" href="javascript:;" onClick="user_edit('<?php echo ($vo["id"]); ?>','280','160','状态修改','/index.php/Admin/Shops/shopsEdit/id/<?php echo ($vo["id"]); ?>')" class="ml-5" style="text-decoration:none"> <i class="icon-edit"></i>
          </a>
        </td>
        <td>
          <a title="查看详情" href="/index.php/Admin/Shops/shopsDetail/id/<?php echo ($vo["id"]); ?>" class="ml-5" style="text-decoration:none"> <span class="label label-info">查看详情</span>
          </a>
        </td>
        
      </tr><?php endforeach; endif; else: echo "" ;endif; ?>
    </tbody>
  </table>
  <div style="width:100%;margin-top:10px;text-align:center;"></div>
</div>
<script type="text/javascript" src="/Public/admin/js/jquery.min.js"></script>
<script type="text/javascript" src="/Public/admin/layer/layer.min.js"></script>
<script type="text/javascript" src="/Public/admin/js/pagenav.cn.js"></script>
<script type="text/javascript" src="/Public/admin/js/H-ui.js"></script>
<script type="text/javascript" src="/Public/admin/plugin/My97DatePicker/WdatePicker.js"></script>
<script type="text/javascript" src="/Public/admin/js/jquery.dataTables.min.js"></script>
<script type="text/javascript" src="/Public/admin/js/H-ui.admin.js"></script>
<script type="text/javascript">

</script>

</body>
</html>