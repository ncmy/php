<?php if (!defined('THINK_PATH')) exit();?><!DOCTYPE HTML>
<html>
<head>
<meta http-equiv="Content-Type" content="text/html; charset=utf-8" />
<title>主要内容区main</title>

<link rel="shortcut icon" href="images/main/favicon.ico" />
<script type="text/javascript" src="/Public/admin/js/jquery.min.js"></script>


<link href="/Public/admin/css/css.css" type="text/css" rel="stylesheet" />
<link href="/Public/admin/css/main.css" type="text/css" rel="stylesheet" />

<style>
body{overflow-x:hidden; background:#f2f0f5; padding:15px 0px 10px 5px;}
#searchmain{ font-size:12px;}
#search{ font-size:12px; background:#548fc9; margin:10px 10px 0 0; display:inline; width:100%; color:#FFF}
#search form span{height:40px; line-height:40px; padding:0 0px 0 10px; float:left;}
#search form input.text-word{height:24px; line-height:24px; width:180px; margin:8px 0 6px 0; padding:0 0px 0 10px; float:left; border:1px solid #FFF;}
#search form input.text-but{height:24px; line-height:24px; width:55px; background:url(images/main/list_input.jpg) no-repeat left top; border:none; cursor:pointer; font-family:"Microsoft YaHei","Tahoma","Arial",'宋体'; color:#666; float:left; margin:8px 0 0 6px; display:inline;}
#search a.add{ background:url(images/main/add.jpg) no-repeat 0px 6px; padding:0 10px 0 26px; height:40px; line-height:40px; font-size:14px; font-weight:bold; color:#FFF}
#search a:hover.add{ text-decoration:underline; color:#d2e9ff;}
#main-tab{ border:1px solid #eaeaea; background:#FFF; font-size:12px;}
#main-tab th{ font-size:12px; background:url(images/main/list_bg.jpg) repeat-x; height:32px; line-height:32px;}
#main-tab td{ font-size:12px; line-height:40px;}
#main-tab td a{ font-size:12px; color:#548fc9;}
#main-tab td a:hover{color:#565656; text-decoration:underline;}
.bordertop{ border-top:1px solid #ebebeb}
.borderright{ border-right:1px solid #ebebeb}
.borderbottom{ border-bottom:1px solid #ebebeb}
.borderleft{ border-left:1px solid #ebebeb}
.gray{ color:#dbdbdb;}
td.fenye{ padding:10px 0 0 0; text-align:right;}
.bggray{ background:#f9f9f9; font-size:14px; font-weight:bold; padding:10px 10px 10px 0; width:120px;}
.main-for{ padding:10px;}
.main-for input.text-word{ width:350px; height:36px; line-height:36px; border:#ebebeb 1px solid; background:#FFF; font-family:"Microsoft YaHei","Tahoma","Arial",'宋体'; padding:0 10px;}
.main-for select{ width:370px; height:36px; line-height:36px; border:#ebebeb 1px solid; background:#FFF; font-family:"Microsoft YaHei","Tahoma","Arial",'宋体'; color:#666;}
.main-for input.text-but{ width:100px; height:40px; line-height:30px; border: 1px solid #cdcdcd; background:#e6e6e6; font-family:"Microsoft YaHei","Tahoma","Arial",'宋体'; color:#969696; float:left; margin:0 10px 0 0; display:inline; cursor:pointer; font-size:14px; font-weight:bold;}
#addinfo a{ font-size:14px; font-weight:bold; background:url(images/main/addinfoblack.jpg) no-repeat 0 1px; padding:0px 0 0px 20px; line-height:45px;}
#addinfo a:hover{ background:url(images/main/addinfoblue.jpg) no-repeat 0 1px;}
</style>
</head>
<body>

<!--main_top-->
<table width="99%" border="0" cellspacing="0" cellpadding="0" id="searchmain">
  <tr>
    <td width="99%" align="left" valign="top">您的位置:订单管理&nbsp;&nbsp;>&nbsp;&nbsp;订单详情</td>
  </tr>
  <tr>
    <td align="left" valign="top" id="addinfo">
    <a href="" target="mainFrame" onFocus="this.blur()" class="add">订单管理</a><span style="color:red; margin-left:20px;"></span>
    </td>
  </tr>
  
    <td align="left" valign="top">
    <form action=""  enctype="multipart/form-data" method="post">
	<input type="hidden" name="id" value=""/>
	<!--传输ID到修改页面-->
	
    <table width="100%" border="0" cellspacing="0" cellpadding="0" id="main-tab">	
      <tr onMouseOut="this.style.backgroundColor='#ffffff'" onMouseOver="this.style.backgroundColor='#edf5ff'">
         <td align="left" valign="middle" class="borderright borderbottom main-for">
		<span>订单号：<?php echo strtoupper($order['order_sn']);?></span><span style="margin-left:200px;">状态：</span><?php if($order["status"] == 0): ?><span class="label label-success">已下单 </span>
        	<?php elseif($order["status"] == 1): ?>
				已支付
        	<?php elseif($order["status"] == 2): ?>
				已接单
			<?php elseif($order["status"] == 3): ?>
				已拒单
			<?php elseif($order["status"] == 4): ?>
				派送中
			<?php elseif($order["status"] == 5): ?>
				已签收
			<?php elseif($order["status"] == 6): ?>
			<span class="label label-error">已完成 </span>
			<?php elseif($order["status"] == 7): ?>
			<span class="label label-danger">已取消 </span>
			<?php elseif($order["status"] == 8): ?>
			货到付款	
			<?php else: ?>
			无效订单<?php endif; ?>
		<span id="pwdTip"></span>
        </td>
      </tr>

	  <tr onMouseOut="this.style.backgroundColor='#ffffff'" onMouseOver="this.style.backgroundColor='#edf5ff'">  
        <td align="left" valign="middle" class="borderright borderbottom main-for">	
		<span id="pwdTip">下单时间：</span ><span  style="margin-left:100px;"><?php echo (date("Y-m-d H:i:s",$order["create_time"])); ?></span>
        </td>
      </tr>
	  
	  
	  <tr onMouseOut="this.style.backgroundColor='#ffffff'" onMouseOver="this.style.backgroundColor='#edf5ff'">    
        <td align="left" valign="middle" class="borderright borderbottom main-for">	
		<p style="padding:0px;margin:0px;height:20px;">收货人信息：</p>
		<p style="padding:0px;margin:0px;height:20px;">姓名：<span  style="margin-left:100px;"><?php echo ($order["user"]["name"]); ?></span></p>
		<p style="padding:0px;margin:0px;height:20px;">手机：<span  style="margin-left:100px;"><?php echo ($order["user"]["phone"]); ?></span></p>
		<p style="padding:0px;margin:0px;height:20px;">地址：<span  style="margin-left:100px;"><?php echo ($order["user"]["address"]); ?></span></p>
		<p style="padding:0px;margin:0px;height:20px;">邮编：<span  style="margin-left:100px;"><?php echo ($order["user"]["code"]); ?></span></p>
        </td>
      </tr>
	  
	    <tr onMouseOut="this.style.backgroundColor='#ffffff'" >    
        <td align="left" valign="middle" class="borderright borderbottom main-for">	
		<p style="padding:0px;margin:0px;height:20px;">商品名细：</p>
		
    <table width="100%" border="0" cellspacing="0" cellpadding="0" id="main-tab">
      <tr>
		
		<th align="center" valign="middle" class="borderright" style="width:10%;">序号</th>
        <th align="center" valign="middle" class="borderright" style="width:30%;">商品</th>

		<th align="center" valign="middle" class="borderright" style="width:20%;">单价</th>
		<th align="center" valign="middle" class="borderright" style="width:20%;">数量</th>

        <th align="center" valign="middle" class="borderright" style="width:20%;">总价</th>

      </tr>

<?php if(is_array($order['detail'])): $i = 0; $__LIST__ = $order['detail'];if( count($__LIST__)==0 ) : echo "" ;else: foreach($__LIST__ as $key=>$vo): $mod = ($i % 2 );++$i;?><tr onMouseOut="this.style.backgroundColor='#ffffff'" onMouseOver="this.style.backgroundColor='#edf5ff'" class="father">
        <td align="center" valign="middle" class="borderright borderbottom">
	<?php echo ($i); ?>
		
		</td>
		<td align="center" valign="middle" class="borderright borderbottom">

				<?php if(empty($vo['good_pic'])): ?><img src="/Public/home/index/images/detail/sample.png" width="60px" height="60px"  style="float:left;margin-left:5px;"/>
				<?php else: ?>
				<img src="/Public/upload/goods/<?php echo ($vo["good_pic"]); ?>" width="60px" height="60px"  style="float:left;margin-left:5px;"/><?php endif; ?>
			<?php echo ($vo["good_name"]); ?>
		
	
		
		</td>
		  <td align="center" valign="middle" class="borderright borderbottom">
		<?php echo ($vo["price"]); ?>
		
		</td>
	  <td align="center" valign="middle" class="borderright borderbottom">
		<?php echo ($vo["nums"]); ?>
		
		</td>
		
		</td>
	  <td align="center" valign="middle" class="borderright borderbottom">
		<?php echo ($vo['nums']*$vo['price']); ?>
		
		</td>
		</tr><?php endforeach; endif; else: echo "" ;endif; ?>
		</table>
        </td>
      </tr>

	  
	  <tr onMouseOut="this.style.backgroundColor='#ffffff'" onMouseOver="this.style.backgroundColor='#edf5ff'">  
        <td align="left" valign="middle" class="borderright borderbottom main-for">	
		<span id="pwdTip">总金额：</span ><span  style="margin-left:100px;color:red;"><?php echo ($order["count_price"]); ?></span>
        </td>
      </tr>

	  
	   <tr onMouseOut="this.style.backgroundColor='#ffffff'" onMouseOver=
      <tr onMouseOut="this.style.backgroundColor='#ffffff'" onMouseOver="this.style.backgroundColor='#edf5ff'">       
      <td align="right" valign="middle" class="borderright borderbottom bggray">
        <input name="" type="reset" value="返回" class="text-but" onclick="location='/index.php/Admin/Order/orderList'">
		&nbsp;</td>
        </tr>
    </table>
    </form>
    
    </tr>
</table>


</body>
</html>