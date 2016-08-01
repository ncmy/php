<?php if (!defined('THINK_PATH')) exit();?><!DOCTYPE html">
<html>
<head>
<title>百度外卖</title>
<meta http-equiv="Content-Type" content="text/html; charset=utf-8" />
<script language="javascript" type="text/javascript" src="/Public/common/js/jquery-1.8.3.min.js"></script>
<script language="javascript" type="text/javascript" src="/Public/common/js/jquery.coolautosuggest.js"></script>
<link rel="stylesheet" type="text/css" href="/Public/home/index/css/jquery.coolautosuggest.css">
<link rel="stylesheet" type="text/css" href="/Public/home/index/css/index_css.css">

<!-- End Save for Web Styles -->
</head>
<body style="background-color:#FFFFFF;text-align: center;">
<!-- Save for Web Slices (source.psd) -->
<div id="__01">
	<div id="index-01_">	
	</div>
	<div id="index-02_">
		<img id="index_02" src="/Public/home/index/images/index_02.gif" width="146" height="50" alt="" />
	</div>
	<div id="index-03_">
	</div>
	<div id="index-04_">
		<span style="color:white"><a href=""></a></span>
	</div>
	<div id="index-05_">
		<span  style="color:white"><a href=""></a></span>
	</div>
	<div id="index-06_">		
	</div>
	<div id="index_18">
		<img src="/Public/home/index/images/index_banner.png">
	</div>
	<div id="index_16">
		<div id="index_17">	
		北京	
		</div>
		<div>
			<input type="text" name="" id="search" placeholder="请输入你的订餐地址(写字楼或小区、学校)">
			<input type="image" src="/Public/home/index/images/index_button.png" id="button">
		</div>	
	</div>
	<div id="index-07_">
		<img id="index_07" src="/Public/home/index/images/index_07.gif" width="1261" height="430" alt="" />
	</div>
	<div id="index-08_">	
	</div>
	<div id="index-09_">
	</div>
	<div id="index-10_">
		<img id="index_10" src="/Public/home/index/images/index_video.png" width="501" height="318" alt="" />
	</div>
	<div id="index-11_">	
	</div>
	<div id="index-12_">
		<img id="index_12" src="/Public/home/index/images/index_12.gif" width="319" height="318" alt="" />
	</div>
	<div id="index-13_">
	</div>
	<div id="index-14_">
	</div>
	<div id="index-15_">
		<img id="index_15" src="/Public/home/index/images/index_15.gif" width="1261" height="215" alt="" />
	</div>
</div>
</body>
</html>
<script>
//添加cookie
function addCookie(objName,objValue,objHours){
    var str = objName + "=" + escape(objValue);
    if(objHours > 0){
    //为0时不设定过期时间，浏览器关闭时cookie自动消失
     var date = new Date();
     var ms = objHours*3600*1000;
     date.setTime(date.getTime() + ms);
     str += "; expires=" + date.toGMTString();
    }
    document.cookie = str;
   }
$("#search").coolautosuggest({
						url:"/index.php/Home/index/query?chars=",
						showName:true,
						minChars:4,
						showDescription:true,
						showThumbnail:true,
						onSelected:function(result){
                            //$('#suggestions_holder').show();
                            //result里有地区名字，经纬度，每个推荐地名２０００米以内的店铺数量
						    var jwd=result.lng+'#'+result.lat;
                            //通过经纬度去查询２０００米以内的店铺id
							$.getJSON('http://5.liuzhenjuan.sinaapp.com/query.php?callback=?',{lng:result.lng,lat:result.lat},function(data){
									var shop=encodeURIComponent(data.join('#'));
                                    //window.location='/index.php/Home/Shops/index/?shop='+shop;
                                    $.ajax({
                                        url:'/index.php/Home/Shops/setShopList',
                                        data:{jwd:jwd,shop:shop,name:result.data},//jwd：经纬度 shop:商铺id列表 name:地区名字
                                        type:'POST',
                                        dataType:'json',
                                        success:function(data){
                                                window.location='/index.php/Home/List/index';
                                                //$('#suggestions_holder').hide();
                                        }
                                    });
							});
						}
					});
        $('#button').click(function(){
            changeLocation('#search');
        });


//单击按钮跳转事件

 function	changeLocation(obj){
	var location=$(obj).val();
	    	$.getJSON('http://5.liuzhenjuan.sinaapp.com/queryone.php?callback=?',{chars:location},function(jwd){
						$.getJSON('http://5.liuzhenjuan.sinaapp.com/query.php?callback=?',{lng:jwd.lng,lat:jwd.lat},function(data){

							var shop=encodeURIComponent(data.join('#'));                      
                          $.ajax({
                              url:'/index.php/Home/Shops/setShopList',
                              data:{jwd:jwd,shop:shop,name:location},//jwd：经纬度 shop:商铺id列表 name:地区名字
                              type:'POST',
                              dataType:'json',
                              success:function(shopID){
                                      window.location='/index.php/Home/List/index';
                              }
                        });
					});
			});
}

</script>