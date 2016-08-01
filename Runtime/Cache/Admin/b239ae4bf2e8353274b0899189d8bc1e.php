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
<link type="text/css" rel="stylesheet" href="/Public/common/plugin/uploadify/uploadify.css"/>
<link type="text/css" rel="stylesheet" href="/Public/admin/font/font-awesome.min.css"/>
<style>
  #province select{width:100px}
</style>
<!--[if IE 7]>
<link href="font/font-awesome-ie7.min.css" rel="stylesheet" type="text/css" />
<![endif]-->
<title>创建店铺</title>
</head>
<body>
<div class="pd-20">
  <div class="Huiform">
    <form action="/index.php/Admin/Shop/shopCreate" method="post" enctype="multipart/form-data">
      <table class="table table-bg">
        <tbody>
          <tr>
            <th width="100" class="text-r"><span class="c-red">*</span> 商铺名：</th>
            <td><input type="text" style="width:200px" class="input-text" value=""  id="user-name" name="title" datatype="*2-16" nullmsg="店铺名不能为空"></td>
          </tr>

          <tr>
              <th width="100" class="text-r"><span class="c-red">*</span> 公司名称：</th>
              <td><input type="text" style="width:200px" class="input-text" value="" placeholder="" id="user-name" name="compay_name" datatype="*2-16" nullmsg="公司名不能为空"></td>
          </tr>

          <tr>
            <th class="text-r"><span class="c-red">*</span> 商户类型：</th>
            <td><label>
                <input name="shop_type" type="radio" id="six_1" value="1" checked>
                企业商户</label>
              <label>
                <input type="radio" name="shop_type" value="2" id="six_0">
                个体商户</label></td>
          </tr>
        <tr>
            <th class="text-r"><span class="c-red">*</span> 经营范围：</th>
            <td>
              <select name="cat_id" id="user-tel" style="width:150px; text-align:center;">
                <?php if(is_array($cat)): $i = 0; $__LIST__ = $cat;if( count($__LIST__)==0 ) : echo "" ;else: foreach($__LIST__ as $key=>$vo): $mod = ($i % 2 );++$i;?><option value="<?php echo ($vo["id"]); ?>" ><?php echo ($vo["name"]); ?></option><?php endforeach; endif; else: echo "" ;endif; ?>
              </select>

            </td>
          </tr>
          <tr>
            <th class="text-r"><span class="c-red">*</span> 联系人姓名：</th>
            <td>
            <select name="admin_id" style="width:110px; text-align:center;" select="selected">
             <option value="<?php echo ($admin["id"]); ?>"><?php echo ($admin["account"]); ?></option> 
            </select>
            </td>
          </tr>
          <tr>
            <th class="text-r"><span class="c-red">*</span> 身份证号：</th>
            <td><input type="text" style="width:300px" class="input-text" value="" placeholder="" id="user-tel" name="card"></td>
          </tr>
          <tr>
            <th class="text-r"><span class="c-red">*</span> 联系人手机：</th>
            <td><input type="text" style="width:300px" class="input-text" value="" placeholder="" id="user-tel" name="mobile"></td>
          </tr>
          <tr>
            <th class="text-r"><span class="c-red">*</span> 客服电话：</th>
            <td><input type="text" style="width:300px" class="input-text" value="" placeholder="" id="user-tel" name="telephone"></td>
          </tr>
           <tr>
            <th class="text-r"><span class="c-red">*</span> 开始营业时间：</th>
            <td><!-- <input type="text" style="width:300px" class="input-text" value="" placeholder="" id="user-tel" name="start_time"> -->
              <select name="start_time" id="user-tel" style="width:110px; text-align:center;">
               <option value="全天">-24小时营业-</option>
               <option value="00:00">-- 00:00 --</option>
               <option value="00:30">-- 00:30 --</option>
               <option value="01:00">-- 01:00 --</option>
               <option value="01:30">-- 01:30 --</option>
               <option value="02:00">-- 02:00 --</option>
               <option value="02:30">-- 02:30 --</option>
               <option value="03:00">-- 03:00 --</option>
               <option value="03:30">-- 03:30 --</option>
               <option value="04:00">-- 04:00 --</option>
               <option value="04:30">-- 04:30 --</option>
               <option value="05:00">-- 05:00 --</option>
               <option value="05:30">-- 05:30 --</option>
               <option value="06:00">-- 06:00 --</option>
               <option value="06:30">-- 06:30 --</option>
               <option value="07:00">-- 07:00 --</option>
               <option value="06:30">-- 07:30 --</option>
               <option value="08:00">-- 08:00 --</option>
               <option value="09:30">-- 08:30 --</option>
               <option value="09:00">-- 09:00 --</option>
               <option value="09:30">-- 09:30 --</option>
               <option value="10:00">-- 10:00 --</option>
               <option value="10:30">-- 10:30 --</option>
               <option value="11:00">-- 11:00 --</option>
               <option value="11:30">-- 11:30 --</option>
               <option value="12:00">-- 12:00 --</option>
               <option value="12:30">-- 12:30 --</option>
               <option value="13:00">-- 13:00 --</option>
               <option value="13:30">-- 13:30 --</option>
               <option value="14:00">-- 14:00 --</option>
               <option value="14:30">-- 14:30 --</option>
               <option value="15:00">-- 15:00 --</option>
               <option value="15:30">-- 15:30 --</option>
               <option value="16:00">-- 16:00 --</option>
               <option value="16:30">-- 16:30 --</option>
               <option value="17:00">-- 17:00 --</option>
               <option value="17:30">-- 17:30 --</option>
               <option value="18:00">-- 18:00 --</option>
               <option value="18:30">-- 18:30 --</option>
               <option value="19:00">-- 19:00 --</option>
               <option value="19:30">-- 19:30 --</option>
               <option value="20:00">-- 20:00 --</option>
               <option value="20:30">-- 20:30 --</option>
               <option value="21:00">-- 21:00 --</option>
               <option value="21:30">-- 21:30 --</option>
               <option value="22:00">-- 22:00 --</option>
               <option value="22:30">-- 22:30 --</option>
               <option value="23:00">-- 23:00 --</option>
               <option value="23:30">-- 23:30 --</option>
             </select>
            </td>
          </tr>
          <tr>
            <th class="text-r"><span class="c-red">*</span> 结束营业时间：</th>
            <td><!-- <input type="text" style="width:300px" class="input-text" value="" placeholder="" id="user-tel" name="end_time"> -->
              <select name="end_time" id="user-tel" style="width:110px; text-align:center;">
               <option value="全天">-24小时营业-</option>
               <option value="00:00">-- 00:00 --</option>
               <option value="00:30">-- 00:30 --</option>
               <option value="01:00">-- 01:00 --</option>
               <option value="01:30">-- 01:30 --</option>
               <option value="02:00">-- 02:00 --</option>
               <option value="02:30">-- 02:30 --</option>
               <option value="03:00">-- 03:00 --</option>
               <option value="03:30">-- 03:30 --</option>
               <option value="04:00">-- 04:00 --</option>
               <option value="04:30">-- 04:30 --</option>
               <option value="05:00">-- 05:00 --</option>
               <option value="05:30">-- 05:30 --</option>
               <option value="06:00">-- 06:00 --</option>
               <option value="06:30">-- 06:30 --</option>
               <option value="07:00">-- 07:00 --</option>
               <option value="07:30">-- 07:30 --</option>
               <option value="08:00">-- 08:00 --</option>
               <option value="08:30">-- 08:30 --</option>
               <option value="09:00">-- 09:00 --</option>
               <option value="09:30">-- 09:30 --</option>
               <option value="10:00">-- 10:00 --</option>
               <option value="10:30">-- 10:30 --</option>
               <option value="11:00">-- 11:00 --</option>
               <option value="11:30">-- 11:30 --</option>
               <option value="12:00">-- 12:00 --</option>
               <option value="12:30">-- 12:30 --</option>
               <option value="13:00">-- 13:00 --</option>
               <option value="13:30">-- 13:30 --</option>
               <option value="14:00">-- 14:00 --</option>
               <option value="14:30">-- 14:30 --</option>
               <option value="15:00">-- 15:00 --</option>
               <option value="15:30">-- 15:30 --</option>
               <option value="16:00">-- 16:00 --</option>
               <option value="16:30">-- 16:30 --</option>
               <option value="17:00">-- 17:00 --</option>
               <option value="17:30">-- 17:30 --</option>
               <option value="18:00">-- 18:00 --</option>
               <option value="18:30">-- 18:30 --</option>
               <option value="19:00">-- 19:00 --</option>
               <option value="19:30">-- 19:30 --</option>
               <option value="20:00">-- 20:00 --</option>
               <option value="20:30">-- 20:30 --</option>
               <option value="21:00">-- 21:00 --</option>
               <option value="21:30">-- 21:30 --</option>
               <option value="22:00">-- 22:00 --</option>
               <option value="22:30">-- 22:30 --</option>
               <option value="23:00">-- 23:00 --</option>
               <option value="23:30">-- 23:30 --</option>
             </select>
            </td>
          </tr>
          <tr>
            <th class="text-r"><span class="c-red">*</span>起送价：</th>
            <td>￥<input type="text" style="width:28px;text-align:right;" class="input-text" value="" placeholder="0.00" id="user-tel" name="start_price">元</td>
          </tr>
          <tr>
            <th class="text-r"><span class="c-red">*</span>配送费：</th>
            <td>￥<input type="text" style="width:28px;text-align:right;" class="input-text" value="" placeholder="0.00" id="user-tel" name="delivery_price">元</td>
          </tr>
          <tr>
            <th class="text-r"><span class="c-red">*</span> 发票：</th>
            <td><label>
                <input name="receipt" type="radio" id="six_1" value="1" checked>
                支持</label>
              <label>
                <input type="radio" name="receipt" value="0" id="six_0">
                不支持</label></td>
          </tr>
          <tr>
            <th class="text-r"><span class="c-red">*</span> 物流：</th>
            <td><label>
                <input name="logistics" type="radio" id="six_1" value="1" checked>
                百度物流</label>
              <label>
                <input type="radio" name="logistics" value="0" id="six_0">
                三方物流</label></td>
          </tr>
          <tr>
            <th class="text-r"><span class="c-red">*</span> 收款方式：</th>
            <td><label>
                <input name="coord_type" type="radio" id="six_0" value="0" checked>
                货到付款
                </label>
              <label>
                <input type="radio" name="coord_type" value="1" id="six_1">
                在线支付<strong style="color:red">(百度钱包)</strong></label>
                 <label>
                <input type="radio" name="coord_type" value="2" id="six_1">
                全选</label>
              </td>
          </tr>
          <tr>
            <th class="text-r"><span class="c-red">*</span>所在地区：</th>
            <td><!-- <input type="text" style="width:300px" class="input-text" value="" placeholder="" id="user-tel" name="area"> -->

              <select id="s_province" name="area"></select>  
              <select id="s_city" disabled="disabled" name="area"></select>  
              <select id="s_county" disabled="disabled" name="area"></select>
           
            <div id="show" ></div>

            </td>
          </tr>
          <tr>
            <th class="text-r"><span class="c-red">*</span>详细地址：</th>
            <td><input type="text" style="width:300px" class="input-text" value="" placeholder="" id="user-tel" name="address"></td>
          </tr>
          <tr>
            <th class="text-r">商铺介绍：</th>
            <td><textarea class="input-text" name="description" id="user-info" style="height:100px;width:300px;resize:none;"></textarea></td>
          </tr>
          <tr>
              <th width="100" class="text-r"><span class="c-red">*</span> 公司Logo：</th>
              <td > 
               <input type="file" name="logo">          
              </td>
          </tr>
          
          <tr>
            <th></th>
            <td><button class="btn btn-success radius" type="submit"><i class="icon-ok"></i> 确定</button></td>
          </tr>
        </tbody>
      </table>
    </form>
  </div>
</div>
<script type="text/javascript" src="/Public/admin/js/jquery.min.js"></script>
<script src="/Public/common/plugin/uploadify/jquery.uploadify.js"></script>
<script src="/Public/common/js/jquery.cityselect.js"></script>
<!-- <script src="/Public/common/js/city.min.js"></script> -->
<script type="text/javascript" src="/Public/admin/js/Validform_v5.3.2_min.js"></script> 
<script type="text/javascript" src="/Public/admin/js/H-ui.js"></script> 
<script type="text/javascript" src="/Public/admin/js/H-ui.admin.js"></script> 
<script type="text/javascript" src="/Public/admin/js/public.js"></script> 
<script type="text/javascript" src="/Public/admin/js/area.js"></script> 
<script type="text/javascript">_init_area();</script>
<script type="text/javascript">



//三级城市联动
var Gid  = document.getElementById ;
var showArea = function(){
  Gid('show').innerHTML = "<h3>省" + Gid('s_province').value + " - 市" +  
  Gid('s_city').value + " - 县/区" + 
  Gid('s_county').value + "</h3>"
              }
Gid('s_county').setAttribute('onchange','showArea()');



$(function(){
  $("#province").citySelect({prov:"北京",nodata:"none"});
});


$(".Huiform").Validform(); 

</script>

</body>
</html>

<!--代码整理：js代码 www.jsdaima.com-->