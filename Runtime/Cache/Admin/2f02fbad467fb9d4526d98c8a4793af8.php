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
<title>分类编辑_js代码</title>
</head>
<body>
<div class="pd-20">
  <form class="Huiform" action="return false;" method="post" id="cateditform">
    上级栏目：
    <select class="select" id="sel_Sub" onChange="SetSubID(this);">
      <option value="0">顶级分类</option>
    </select>
    <input type="hidden" id="hid_ccid" name="id" value="<?php echo ($edit["id"]); ?>">
    排序：<input class="input-text text-c" style="width:50px" type="text" placeholder="排序" name="keychar" id="class-rank" value="<?php echo ($edit["keychar"]); ?>">
    分类名：<input class="input-text" style="width:170px" type="text" value="<?php echo ($edit["cat_name"]); ?>" placeholder="输入分类" name="cat_name" id="class-val">
    <div class="text-c mt-20"><button type="button" class="btn btn-success" id="catedit_button" name="" ><i class="icon-save"></i> 保存</button></div>
  </form>
</div>
<script type="text/javascript" src="/Public/admin/js/jquery.min.js"></script>
<script type="text/javascript" src="/Public/admin/js/Validform_v5.3.2_min.js"></script> 
<script type="text/javascript" src="/Public/admin/layer/layer.min.js"></script>
<script type="text/javascript" src="/Public/admin/js/H-ui.js"></script>
<script type="text/javascript" src="/Public/admin/js/H-ui.admin.js"></script>

</body>
</html>
<!--代码整理：js代码 www.jsdaima.com-->
<script>
    var index = parent.layer.getFrameIndex(window.name); //获取窗口索引
	    $('#catedit_button').click(function(){
        var form=$('#cateditform').serialize();
/*        var title=$("#oldpassword").val();
        var name=$('#newpassword').val();
        var status=$('input[name="status"]:checked').val();*/
        $.ajax({
            type: "POST",
            url: "/index.php/Admin/Shop/catUpdate",
            data: form,
            success: function(msg){

                parent.window.location.reload();
                parent.layer.msg('更新成功',{icon: 1});
                parent.layer.close(index);
            },
            error:function(){
                alert('失败了');
            }
        });

    });

</script>