<?php if (!defined('THINK_PATH')) exit();?>
<!DOCTYPE HTML>
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
<link type="text/css" rel="stylesheet" href="/Public/common/plugin/uploadify/uploadify.css"/>
<!--[if IE 7]>
<link href="font/font-awesome-ie7.min.css" rel="stylesheet" type="text/css" />
<![endif]-->
<title>商家服务</title>
</head>
<body>
<nav class="Hui-breadcrumb"> <i class="icon-home"></i>
  首页
  <span class="c-gray en">&gt;</span>
 <a href="/index.php/Admin/Shop/goodList"> 商家管理 </a>
  <span class="c-gray en">&gt;</span>
  商品添加
  <a class="btn btn-success radius r mr-20" style="line-height:1.6em;margin-top:3px" href="javascript:location.replace(location.href);" title="刷新" > <i class="icon-refresh"></i>
  </a>
</nav>
<form action="/index.php/Admin/Shop/goodAdd" method="post">
<input type="hidden" name="shop_id" value="<?php echo ($shop["id"]); ?>">
  <table class="table table-bg" style="margin:0;padding: 0;">
    <tbody>
      <tr>
        <th class="text-r"><span class="c-red">*</span> 商品名称</th>
        <td><input type="text" name="good_name" class="input-text"></td>
      </tr>
      <tr>
        <th class="text-r"><span class="c-red">*</span> 商品价格</th>
        <td><input type="text" name="price" class="input-text" style="width:50px;text-align:right">元</td>
      </tr>
      <tr>
        <th class="text-r"><span class="c-red">*</span> 商品类别</th>
        <td>
        <select name="shop_cat_id" class="select">
        <?php if(is_array($cat)): foreach($cat as $key=>$vo): ?><option value="<?php echo ($vo["id"]); ?>"><?php echo ($vo["cat_name"]); ?></option><?php endforeach; endif; ?>
        </select></td>
      </tr>
      
     <!--  <tr>
       <th class="text-r">商品描述</th>
       <td><textarea class="input-text" name="description"  style="height:100px;width:280px;resize:none;padding: 0;"></textarea>
       </td>
     </tr> -->
      <tr>
       <th class="text-r">商品状态</th>
       <td>
       <select name="status" class="select">
            <option value="1">上架</option>
            <option value="2">下架</option>
            <option value="3" selected="true">正常</option>
        </select>
       </td>
     </tr>


      <tr>
        <th class="text-r"><span class="c-red">*</span> 包装费</th>
        <td><input type="text" name="box" class="input-text" style="width:50px;text-align:right" value="<?php echo ($edit["box"]); ?>">元</td>
      </tr>
      <tr>
        <th width="100" class="text-r">
          <span class="c-red">*</span>
          商品图片
        </th>
         <td  style="width:310px;height: 150px;position: relative;">

           <div class="imgshow" style="margin-top: 6px; width: 122px;height: 122px;border: 1px solid #ccc;" >
             <img src="" alt="" id="preview" width="122px" height="122px">
             </div>   
             <input id="uploadFiles"  type="text"  /> 
           <input type="hidden" value=""  id="picname" name="pic"></td>
      </tr>
      <tr>
        <th class="text-r"></th>
        <td colspan="2">
          <input class="btn btn-success radius  " type="submit" value="增加">
          <input class="btn btn-danger radius  "type="reset" value="取消">
        </td>
      </tr>
    </tbody>
  </table>
 <!--  <div id="pageNav" class="pageNav"></div> -->
  </form>
<script type="text/javascript" src="/Public/admin/js/jquery.min.js"></script>
<script type="text/javascript" src="/Public/admin/layer/layer.min.js"></script>
<script type="text/javascript" src="/Public/admin/js/pagenav.cn.js"></script>
<script type="text/javascript" src="/Public/admin/js/H-ui.js"></script>
<script type="text/javascript" src="/Public/admin/plugin/My97DatePicker/WdatePicker.js"></script>
<script type="text/javascript" src="/Public/admin/js/jquery.dataTables.min.js"></script>
<script src="/Public/common/plugin/uploadify/jquery.uploadify.js"></script>
<script type="text/javascript" src="/Public/admin/js/H-ui.admin.js"></script>
<script type="text/javascript">
/*window.onload = (function(){
    // optional set
    pageNav.pre="&lt;上一页";
    pageNav.next="下一页&gt;";
    // p,当前页码,pn,总页面
    pageNav.fn = function(p,pn){$("#pageinfo").text("当前页:"+p+" 总页: "+pn);};
    //重写分页状态,跳到第三页,总页33页
    pageNav.go(1,9);
});*/
// $('.table-sort').dataTable({
//   "lengthMenu":false,//显示数量选择 
//   "bFilter": false,//过滤功能
//   "bPaginate": false,//翻页信息
//   "bInfo": false,//数量信息
//   "aaSorting": [[ 3, "desc" ]],//默认第几个排序
//   "bStateSave": true,//状态保存
//   "aoColumnDefs": [
//     //{"bVisible": false, "aTargets": [ 3 ]} //控制列的隐藏显示
//     {"orderable":false,"aTargets":[0,8,9]}// 制定列不参与排序
//   ]
// });
$("#uploadFiles").uploadify({
        formData      : {'dir':'goods','width':150,'height':150},
        buttonText    : '上传图片',
        fileTypeDesc  : 'Image Files',
          fileTypeExts  : '*.gif; *.jpg; *.png',
          swf           : '/Public/common/plugin/uploadify/uploadify.swf',
          uploader      : "<?php echo U('Shop/uploadGoodImg',array('session_id'=>session_id()));?>",
          onUploadSuccess : function(file, data, response) {
        var img=eval("("+data+")");
         $('#preview').attr('src','/Public/upload/goods/'+img.savepath+img.savename).show();
         $('#picname').attr('value',img.savepath+img.savename);   
        }
    });

</script>

</body>
</html>

<!--代码整理：js代码 www.jsdaima.com-->