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
<title>订单管理</title>
<style>
	.f-14 span{
		cursor: pointer;
	}
</style>
</head>
<body>
<nav class="Hui-breadcrumb"><i class="icon-home"></i> 首页 <span class="c-gray en">&gt;</span> 用户中心 <span class="c-gray en">&gt;</span> 用户管理 <a class="btn btn-success radius r mr-20" style="line-height:1.6em;margin-top:3px" href="javascript:location.replace(location.href);" title="刷新" ><i class="icon-refresh"></i></a></nav>
<div class="pd-20">
<form action="/index.php/Admin/Orders/orderList" method='post'>
  <div class="text-c">
	<select name="status" id="" class="select">
	<option value="-1" <?php if($status == -1): ?>selected<?php endif; ?>>全部</option>
  <option value="0" <?php if($status == 0): ?>selected<?php endif; ?>>已下单</option>
  <option value="1" <?php if($status == 1): ?>selected<?php endif; ?>>已支付</option>
  <option value="2" <?php if($status == 2): ?>selected<?php endif; ?>>已接单</option>
  <option value="3" <?php if($status == 3): ?>selected<?php endif; ?>>已拒单</option>
  <option value="4" <?php if($status == 4): ?>selected<?php endif; ?>>派送中</option>
  <option value="5" <?php if($status == 5): ?>selected<?php endif; ?>>已签收</option>
  <option value="6" <?php if($status == 6): ?>selected<?php endif; ?>>已完成</option>
  <option value="7" <?php if($status == 7): ?>selected<?php endif; ?>>已取消</option>
  <option value="8" <?php if($status == 8): ?>selected<?php endif; ?>>货到付款</option>
	</select>
    <input type="text" class="input-text" style="width:250px" placeholder="输入订单号" id="<?php echo ($vol["id"]); ?>" name="word" value="<?php echo ($word); ?>"><button type="submit" class="btn btn-success" id="" name=""><i class="icon-search"></i> 搜订单</button>
  </div>
  </form>
  <div class="cl pd-5 bg-1 bk-gray mt-20">
    <span class="l">订单列表</span>
    <span class="r">共有数据：<strong><?php echo ($count); ?></strong> 条</span>
  </div>
  <table class="table table-border table-bordered table-hover table-bg table-sort">
    <thead>
      <tr class="text-c">
        <th style="25px;"><input type="checkbox" name="" value=""></th>
        <th>序列</th>
        <th width="30px" style="25px;padding: 0px;">订单号</th>
        <th width="30px" style="width:52px;">购买人</th>
        <th width="60px" style="width:340px">配送地址</th>
        <th width="50px">联系人电话</th>
        <th width="50px">总价</th>
        <th width="50px" style="width: 50px;">下单时间</th>
        <th width="130px" style="width:57px;">支付方式</th>
        <th width="70px">状态</th>
        <th width="70px" style="width:100px;">所属店铺</th>
		<th width="100px" style="width: 170px;padding: 0px;">操作</th>
      </tr>
    </thead>
    <tbody>
<?php if(is_array($data)): $i = 0; $__LIST__ = $data;if( count($__LIST__)==0 ) : echo "" ;else: foreach($__LIST__ as $key=>$vol): $mod = ($i % 2 );++$i;?><tr class="text-c">
        <td><input type="checkbox" value="<?php echo ($vol["id"]); ?>" name=""></td>
        <td><?php echo ($vol["id"]); ?></td>
        <td><?php echo ($vol["order_sn"]); ?></td>      
        <td><u style="cursor:pointer" class="text-primary" onclick="user_show('10001','360','','张三','user-show.html')"></u><?php echo ($vol["name"]); ?></td>
        <td><?php echo ($vol["address"]); ?></td>
        <td><?php echo ($vol["phone"]); ?></td>
        <td><?php echo ($vol["count_price"]); ?></td>
        <td class="text-l"><?php echo (date('Y-m-d H:i:s',$vol["create_time"])); ?></td>
        <td><?php if($vol["pay_way"] == 1 ): ?>在线支付<?php else: ?>货到付款<?php endif; ?></td>
        <td class="user-status"><?php if($vol["status"] == 1 ): ?>已支付<?php else: ?>未支付<?php endif; ?></td>
        <td class="f-14 user-manage"><?php echo ($vol["shop_id"]); ?></td>
        <td class="f-14 user-manage"> <a title="编辑" href="javascript:;" onClick="user_edit('<?php echo ($vol["id"]); ?>','700','','编辑','/index.php/Admin/Orders/orderDetail')"  style="text-decoration:none">编辑 | </a> 
			<a href="">详情</a>
        </td>
      </tr><?php endforeach; endif; else: echo "" ;endif; ?>
    </tbody> 
  </table>
  <div id="pageNav" class="pageNav">
  <?php echo ($show); ?>
  </div>
	
</div>
<script type="text/javascript" src="/Public/admin/js/jquery.min.js"></script>
<script type="text/javascript" src="/Public/admin/js/pagenav.cn.js"></script>
<script type="text/javascript" src="/Public/admin/js/H-ui.js"></script>
<script type="text/javascript" src="/Public/admin/plugin/My97DatePicker/WdatePicker.js"></script>
<script type="text/javascript" src="/Public/admin/js/jquery.dataTables.min.js"></script>
<script type="text/javascript" src="/Public/admin/js/H-ui.admin.js"></script>
<script type="text/javascript" src="/Public/admin/layer/layer.min.js"></script>
<script type="text/javascript">

$('.table-sort').dataTable({
	"lengthMenu":false,//显示数量选择 
	"bFilter": false,//过滤功能
	"bPaginate": false,//翻页信息
	"bInfo": false,//数量信息
	"aaSorting": [[ 3, "desc" ]],//默认第几个排序
	"bStateSave": true,//状态保存
	"aoColumnDefs": [
	  //{"bVisible": false, "aTargets": [ 3 ]} //控制列的隐藏显示
	  {"orderable":false,"aTargets":[0,8,9]}// 制定列不参与排序
	]
});

</script>

</body>
</html>