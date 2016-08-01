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
<title>商家服务</title>
</head>
<body>
<nav class="Hui-breadcrumb"><i class="icon-home"></i> 首页 <span class="c-gray en">&gt;</span> 商家服务 <span class="c-gray en">&gt;</span> 商品品类 <a class="btn btn-success radius r mr-20" style="line-height:1.6em;margin-top:3px" href="javascript:location.replace(location.href);" title="刷新" ><i class="icon-refresh"></i></a></nav>
<div class="pd-20 text-c">
<form class="Huiform" action="/index.php/Admin/Shop/shopcatAdd" method="post">
    商品品类名称：
    <input class="input-text" style="width:250px" type="text"  name="name" placeholder="输入分类" id="article-class-val">  

    <button type="submit" class="btn btn-success" id="" name="" <i class="icon-plus"></i>
    添加
    </button>
</form>
  <div class="cl pd-5 bg-1 bk-gray mt-20">
    <span class="l"><a href="javascript:;" onClick="cat_del()" class="btn btn-danger radius"><i class="icon-trash"></i> 批量删除</a></span>
    <span class="r">共有数据：<strong><?php echo ($count); ?></strong> 条</span>
  </div>
  <table class="table table-border table-bordered table-hover table-bg table-sort">

    <thead>
      <tr class="text-c">
        <th><input type="checkbox" name="" value=""></th>
        <th>ID</th>
        <th>品类名称</th>
        <th>操作</th>
      </tr>
    </thead>

    <tbody>
    <?php if(is_array($data)): $i = 0; $__LIST__ = $data;if( count($__LIST__)==0 ) : echo "" ;else: foreach($__LIST__ as $key=>$vo): $mod = ($i % 2 );++$i;?><tr class="text-c">
        <td><input type="checkbox" value="" name=""></td>
        <td><?php echo ($vo["id"]); ?></td>
        <td><?php echo ($vo["name"]); ?></td>
        <td class="f-14 user-manage">
          <a title="编辑" href="javascript:;" onClick="article_class_edit('<?php echo ($vo["id"]); ?>','800','400','修改','catEdit')" class="ml-5" style="text-decoration:none"> <i class="icon-edit"></i>
          </a>
          <a title="删除" href="javascript:;" onClick="cat_del(this,'<?php echo ($vo["id"]); ?>')" class="ml-5" style="text-decoration:none"> <i class="icon-trash"></i>
          </a>
        </td>
      </tr><?php endforeach; endif; else: echo "" ;endif; ?>
    </tbody>
  </table>

  <div id="pageNav" class="pageNav"></div>
</div>

<script type="text/javascript" src="/Public/admin/js/jquery.min.js"></script>
<script type="text/javascript" src="/Public/admin/layer/layer.min.js"></script>
<script type="text/javascript" src="/Public/admin/js/pagenav.cn.js"></script>
<script type="text/javascript" src="/Public/admin/js/H-ui.js"></script>
<script type="text/javascript" src="/Public/admin/plugin/My97DatePicker/WdatePicker.js"></script>
<script type="text/javascript" src="/Public/admin/js/jquery.dataTables.min.js"></script>
<script type="text/javascript" src="/Public/admin/js/H-ui.admin.js"></script>
<script type="text/javascript">
  // window.onload = (function(){
  //     // optional set
  //     pageNav.pre="&lt;上一页";
  //     pageNav.next="下一页&gt;";
  //     // p,当前页码,pn,总页面
  //     pageNav.fn = function(p,pn){$("#pageinfo").text("当前页:"+p+" 总页: "+pn);};
  //     //重写分页状态,跳到第三页,总页33页
  //     pageNav.go(1,9);
  // });
/*$('.table-sort').dataTable({
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
});*/

  function cat_del(obj,id){
    layer.confirm('确定要删除吗?',function(index){
      $.ajax({
        type:"post",
        url:"/index.php/Admin/Shop/catDel",
        data:{id:id},
        success:function(msg){
          if(msg){
            $(obj).parents("tr").remove();
            layer.msg('已删除',1);
            window.location.reload()
          }
        },
        error:function(msg){
          layer.msg('删除失败!',1);
        }
      });
    });
  }

</script>

</body>
</html>

<!--代码整理：js代码 www.jsdaima.com-->