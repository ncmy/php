<?php if (!defined('THINK_PATH')) exit();?><!DOCTYPE html>
<html lang="en">
<head>
	<meta charset="UTF-8">
	<title>Document</title>

	<link rel="stylesheet" type="text/css" href="/Public/home/index/css/head.css">
	<link rel="stylesheet" type="text/css" href="/Public/home/list/css/list.css">
	
	<style>
		.stuckMenu{ 
			position: relative;
			/* margin-left:141px; */
			border-left:1px solid #E4E4E4;
		}
		.isStuck{
			position: relative;
			margin:0px auto;
		}

	</style>

</head>
<body>
	
	<div class="l_container">
		<div class="" ="l_main">
			<div class="l_carousel" style="position: relative;">
				<a href="#"><img src="/Public/home/list/pictures/carousel.jpg" alt=""></a>
				<a href="#"><img src="/Public/home/list/pictures/carouse2.jpg" alt=""></a>
				<a href="#"><img src="/Public/home/list/pictures/carouse3.jpg" alt=""></a>
				<ul>
					<li></li>
					<li></li>
					<li></li>
				</ul>
			</div>
			
			<div class="clearfix"></div>

			<div class="l_cate">
				<ul>
					<li class="active" style="color:red">附近的餐厅</li>
					<li class="supermaket">超市购
						<img src="/Public/home/list/pictures/supermaket.png" style="float:right;"  alt="">
					</li>
					<li class="popular">大家都在吃</li>
				</ul>
				<div class="l_acrossline"></div>
			</div>

			<div class="clearfix"></div>
		<!-- 分类菜单栏开始 -->
			<div class="l_catepanel">
				<ul class="l_catelist">
					<li class="l_catebox" data-id=0  onclick='catOrder("catsort",0);'>
						<div class="l_cateimg">
						</div>
						<div class="l_catename">全部</div>
					</li>
					<?php if(is_array($cats)): $i = 0; $__LIST__ = $cats;if( count($__LIST__)==0 ) : echo "" ;else: foreach($__LIST__ as $key=>$vo): $mod = ($i % 2 );++$i;?><li class="l_catebox" data-id=<?php echo ($vo["id"]); ?>  onclick='catOrder("catsort",<?php echo ($vo["id"]); ?>)'>
						<div class="l_cateimg png_<?php echo ($i); ?>">
						</div>
						<div class="l_catename"><?php echo ($vo["name"]); ?></div>
					</li><?php endforeach; endif; else: echo "" ;endif; ?>		
				</ul>
			</div>






			<div class="clearfix"></div>
		<div style="margin: 0px auto;width: 980px ;height: 42px;">
			<div class="l_catebottom">
				<ul class="l_cateboxleftul">
					<li class="l_cateboxleftli"  data-id="1" onclick="mSort('msort',1);" >
						<span style="color:red">默认</span> 
						<span style="border-right: 1px solid #EDE4ED;margin-left: 10px;"></span>
					</li>
					<li class="l_cateboxleftli" data-id="2"  onclick="mSort('msort',2);">
						<span style="color:#333333" >销量</span> 
						<span style="border-right: 1px solid #EDE4ED;margin-left: 10px;"></span>
					</li>
					<li class="l_cateboxleftli" data-id=6 onclick="mSort('msort',6);">
						<span style="color:#333333">餐厅距离</span> 
						<span style="border-right: 1px solid #EDE4ED;margin-left: 10px;"></span>
					</li>
					<li class="l_cateboxleftli" data-id=4 onclick="mSort('msort',4);">
						<span style="color:#333333">评分</span> 
						<span style="border-right: 1px solid #EDE4ED;margin-left: 10px;"></span>
					</li>
					<li class="l_cateboxleftli" data-id=3 onclick="mSort('msort',3);">
						<span style="color:#333333">起送价</span> 
						<span style="border-right: 1px solid #EDE4ED;margin-left: 10px;"></span>
					</li>
					<li class="l_cateboxleftli" data-id=5 onclick="mSort('msort',5);">
						<span style="color:#333333">送餐速度</span> 
						<span style="border-right: 1px solid #EDE4ED;margin-left: 10px;"></span>
					</li>

				</ul>

				<div class="l_cateboxright">
					<ul class="l_cateboxrightul">		
						<li class="l_cateboxrightli" data-id=12 >
							<i></i>
							<span style="height:40px;">支持在线支付</span>
						</li>

						<li class="l_cateboxrightli" data-id=16> 
							<i></i>
							<span>新用户立减</span>
						</li>
			
						<li class="l_cateboxrightli" data-id=50 ><!-- 暂不做 -->
							<i></i>
							<span>预订优惠</span>
						</li>

						<li class="l_cateboxrightli" data-id=13>
							<i></i>
							<span>免费配送</span>
						</li>

						<li class="l_cateboxrightli" data-id=14 >
							<i></i>
							<span>支持代金券</span>
						</li>
						<li class="l_cateboxrightli" data-id=51><!-- 暂不做 -->
							<i></i>
							<span>下单满赠</span>
						</li>

						<li class="l_cateboxrightli" data-id=10>
							<i></i>
							<span>支持开发票</span>
						</li>

						<li class="l_cateboxrightli" data-id=11>
							<i></i>
							<span>百度配送</span>
						</li>

						<li class="l_cateboxrightli" data-id=15>
							<i></i>
							<span>超时赔付</span>
						</li>
						<img class="arrow" src="/Public/home/list/pictures/arrow.png" width="10px" height="10px" alt="">
					</ul>	
				</div>
			</div>
		<div>
			<div class="clearfix"></div>

			<div class="l_lists">
			<!-- 商品开始 -->
				
				<?php if(is_array($data)): $i = 0; $__LIST__ = $data;if( count($__LIST__)==0 ) : echo "" ;else: foreach($__LIST__ as $key=>$vo): $mod = ($i % 2 );++$i;?><div class="cell l_listsbox">
						<div class="l_listsimg">
							<img src="/Public\upload\shops\<?php echo ($vo["logo"]); ?>" alt="">
						</div>
						<div class="l_listsname">
							<div class="l_listsname_title"><?php echo ($vo["title"]); ?></div>
						</div>
						<div class="l_listssell">
							月售<?php echo ($vo["c"]); ?>份
				    	</div>
						<div class="l_listsdistance">
								起送:<?php echo ($vo["start_price"]); ?>   配送:<?php echo ($vo["delivery_price"]); ?>    速度<?php echo ($vo["avg_speed"]); ?>分钟
						</div>
						<div class="l_listspay">
							<img src="/Public/home/list/images/jian.png" alt="">	
							<img src="/Public/home/list/images/jian.png" alt="">	
							<img src="/Public/home/list/images/jian.png" alt="">	
							<img src="/Public/home/list/images/jian.png" alt="">					
						</div>
				</div><?php endforeach; endif; else: echo "" ;endif; ?>
			
				

				<!-- 商品结束 -->
			</div>
		<input type="hidden" name="msort" value="" id="msort"><!-- 这个隐藏主要做为排序之用 -->
		</div>
			<div id='list-footer_end'>
				<!-- <img src="/waimai/Public/home/list/images/loading.gif" alt=""> -->			
			</div>
			<div><?php echo ($show); ?></div>
</body>
</html>
<script src="/Public/common/js/stickUp.min.js"></script>
<script src="/Public/common/js/waterfall.js"></script>
<script src="/Public/home/list/js/list.js"></script>
<script>

	    jQuery(function($) { 
	    	//初始化首页幻灯片隐藏
	    	$('.l_carousel img').css('display','none');
	    	//为页面绑定滚动事件
	    	$(document).ready( function() {
	      		$('.l_catebottom').stickUp({
	      			itemClass: 'menuItem', 
	      			itemHover: 'active'
	      		}); 
	    	 	});
	     });

</script>
<script>
//删除数组中的重复元素
function uniqueArray(data){ 
	data = data || [];  
	var a = {};  
	for (var i=0; i<data.length; i++) {  
	   var v = data[i];  
	   if (typeof(a[v]) == 'undefined'){  
			a[v] = 1;  
	   }  
	};  
	data.length=0;  
	for (var i in a){  
		data[data.length] = i;  
	}  
	return data;  
} 
//定义排序变量
var catsort=0;
var msort=1;
var sort=[];
var page=1;
var p=2;
//异步传输函数向服务器取值．
//大致思路，有三处排序，每次排序上左都有默认排序值，右边有的话就加入，没有就不加
function ajaxData(type,id){
	var data={};
	if(type=='catsort'){
	//类型排序
		data={catsort:id,msort:msort};	
		if(sort.length>0){
			data={catsort:id,msort:msort,sort:sort.join(',')};
		}	
		catsort=id;
	}else if(type=='msort'){
	//综合排序
		data={catsort:catsort,msort:id};
		if(sort.length>0){
			data={catsort:catsort,msort:id,sort:sort.join(',')};
		}
		msort=id;

	}else if(type=='sortadd'){
		
	//右边数组排序当单击选中的时候
		sort.push(id);
		uniqueArray(sort);		
		data={catsort:catsort,msort:msort,sort:sort.join(',')}		
		//console.debug('加入'+data['cat']);
		
	}else if(type=='sortdel'){
		
	//右边数组排序当单击取消的时候
		var del_index = $.inArray(id,sort);
		//检测数组是否存在重复的数组元素．
		if(del_index!=-1){
			sort.splice(del_index,1);
			//去掉数组重复元素		
		}
		data={catsort:catsort,msort:msort,sort:sort.join(',')};
	}
	//console.debug(" 总的"+data.catsort+' '+ data.msort+'  '+data.sort);
	$.ajax({
		url:"/index.php/Home/List/getShopsByOrder",
		data:data,
		type:'POST',
		dataType:'json',
		success:function(data){
			if(data.length>0){
					//以下是给加载数据的图标
					if(!$("#list-footer_end").find("#loadingpic").size()){
							$("#list-footer_end").find("p").remove();
							//$('#list-footer_end').append('<p id="loadingpic" style="margin:0px auto;text-align:center;"><img src ="/waimai/Public/home/list/images/loading.gif" width="84px" height="84px"  class="loading-pic"/></p>');
		  			}
		  	}else{
		  		$("#list-footer_end").find("#loadingpic").remove();
					if(!$("#list-footer_end").find("p").size()){
						$('#list-footer_end').append('<p style="text-align:center;">没有更多数据了．．．．</p>');	  			
					}	
		  	}
				var son='';
			//console.debug(data);
				for(var i=0;i<data.length;i++){
				//下在的被４整除的可以设置向左漂浮弹出层．以便以后完美善
				if((i+1)%4==0){
					son+='<div class="cell l_listsbox list_box_right "  onclick="goToShop('+data[i]['id']+')"  data-id='+i+'><div class="l_listsimg"><img src="/Public/upload/shops/'+data[i]['logo']+'" alt="" width="226px" height="140px"></div><div class="l_listsname"><div class="l_listsname_title">'+data[i]['title']+'</div></div><div class="l_listssell">'+data[i]['total']+'</div><div class="l_listsdistance">起送:'+data[i]['start_price']+'  配送:'+data[i]['delivery_price']+'     速度'+data[i]['avg_speed']+'分钟</div><div class="l_listspay"><img src="/Public/home/list/images/jian.png" alt="">	<img src="/Public/home/list/images/jian.png" alt="">	<img src="/Public/home/list/images/jian.png" alt=""><img src="/Public/home/list/images/jian.png" alt="">	</div></div>';
				}else{
					son+='<div class="cell l_listsbox "  onclick="goToShop('+data[i]['id']+')"  data-id='+i+'><div class="l_listsimg"><img src="/Public/upload/shops/'+data[i]['logo']+'" alt="" width="226px" height="140px"></div><div class="l_listsname"><div class="l_listsname_title">'+data[i]['title']+'</div></div><div class="l_listssell">'+data[i]['total']+'</div><div class="l_listsdistance">起送:'+data[i]['start_price']+'  配送:'+data[i]['delivery_price']+'     速度'+data[i]['avg_speed']+'分钟</div><div class="l_listspay"><img src="/Public/home/list/images/jian.png" alt="">	<img src="/Public/home/list/images/jian.png" alt="">	<img src="/Public/home/list/images/jian.png" alt=""><img src="/Public/home/list/images/jian.png" alt="">	</div></div>';
				}
				//document.write(i+"  "+data[i]['title']+'<br/>');记得有data[i]['title']
			}
			$('.l_lists').find('.cell').remove();
			$('.l_lists').prepend(son);//此处不能用append否则第一次增加的数据永远在下面
		
		},
		error:function(){
			console.debug('发生错误');
		}
	});
}

ajaxData('catsort',0);//进入页面的时候默认会启动这个函数

//导航使用的排序函数
function catOrder(obj,id){
	//点击的时候给当前的文字添加红色
	$('.l_catebox').find('.l_catename').css({color:'#333'});
	$('.l_catebox[data-id='+id+']').find('.l_catename').css({color:'red'});
	page=2;
	p=2;//每次点击排序的时候都让从往下滚动的事件页码从第二页开始取重置必须的，不然P会累加
	ajaxData(obj,id);
}
//综合排序使用的排序函数
function mSort(obj,id){
	//点击的时候给当前的文字添加红色
	$('.l_cateboxleftli >span:nth-child(1)').css({color:'#333'});
	$('.l_cateboxleftli[data-id='+id+'] > span:nth-child(1)').css({color:'red'});
	page=2;
	p=2;//每次点击排序的时候都让从往下滚动的事件页码从第二页开始取重置必须的，不然P会累加
	ajaxData(obj,id);
}

var opt={
  getResource:function(index,render){
  	//以下是做判断如果是默认的则从第二页开始取数据，如果点了排序则因PAGE＝２所以重新从每２页取数据
  	if(page==2){		
  		var html='';
	  //下面的是异步加载
	  $.ajax({
			url:"/index.php/Home/List/getShopsByOrder",
			//p为传入的页数服务器端用$_GET['p']获取
			data:{p:p,catsort:catsort,msort:msort,sort:sort.join(',')},
			type:'GET',
			dataType:'json',
			success:function(data){
				console.debug("这是每"+p +  "次 <br/>index "+index);
				var html='';
				//console.debug(data);
				if(data.length>0){
					//以下是给加载数据的图标
					if(!$("#list-footer_end").find("#loadingpic").size()){
							$("#list-footer_end").find("p").remove();
							$('#list-footer_end').append('<p id="loadingpic" style="margin:0px auto;text-align:center;"><img src ="/waimai/Public/home/list/images/loading.gif" width="84px" height="84px"  class="loading-pic"/></p>');
		  			}
					p++;	//这里P是全局的．
					for(var i=0;i<data.length;i++){
						console.debug(data[i]['id']);
				//document.write(i+"  "+data[i]['title']+'<br/>');记得有data[i]['title'];
				//下在的被４整除的可以设置向左漂浮弹出层．以便以后完美善
							if((i+1)%4==0){
								html+='<div class="cell l_listsbox list_box_right " onclick="goToShop('+data[i]['id']+')"  data-id='+i+'><div class="l_listsimg"><img src="/Public/upload/shops/'+data[i]['logo']+'" alt="" width="226px" height="140px"></div><div class="l_listsname"><div class="l_listsname_title">'+data[i]['title']+'</div></div><div class="l_listssell">'+data[i]['total']+'</div><div class="l_listsdistance">起送:'+data[i]['start_price']+'  配送:'+data[i]['delivery_price']+'     速度'+data[i]['avg_speed']+'分钟</div><div class="l_listspay"><img src="/Public/home/list/images/jian.png" alt="">	<img src="/Public/home/list/images/jian.png" alt="">	<img src="/Public/home/list/images/jian.png" alt=""><img src="/Public/home/list/images/jian.png" alt="">	</div></div>';
							}else{
								html+='<div class="cell l_listsbox "  onclick="goToShop('+data[i]['id']+')"  data-id='+i+'><div class="l_listsimg"><img src="/Public/upload/shops/'+data[i]['logo']+'" alt="" width="226px" height="140px"></div><div class="l_listsname"><div class="l_listsname_title">'+data[i]['title']+'</div></div><div class="l_listssell">'+data[i]['total']+'</div><div class="l_listsdistance">起送:'+data[i]['start_price']+'  配送:'+data[i]['delivery_price']+'     速度'+data[i]['avg_speed']+'分钟</div><div class="l_listspay"><img src="/Public/home/list/images/jian.png" alt="">	<img src="/Public/home/list/images/jian.png" alt="">	<img src="/Public/home/list/images/jian.png" alt=""><img src="/Public/home/list/images/jian.png" alt="">	</div></div>';
							}

					}
					render(html);						
				}else{	
					$("#list-footer_end").find("#loadingpic").remove();
					if(!$("#list-footer_end").find("p").size()){
						$('#list-footer_end').append('<p style="text-align:center;">没有更多数据了．．．．</p>');	  			
					}	  			
				}
			},
		error:function(){
			console.debug('发生错误');
		}
	});
}else{
  		var p_index=index+1;
  		var html='';
	  //下面的是异步加载
	  console.debug("这是第"+p_index +  "次 <br/>index "+index);
	  $.ajax({
			url:"/index.php/Home/List/getShopsByOrder",
			//p为传入的页数服务器端用$_GET['p']获取
			data:{p:p_index,catsort:catsort,msort:msort,sort:sort.join(',')},
			type:'GET',
			dataType:'json',
			success:function(data){		
				var html='';
				//console.debug(data);
				if(data.length>0){
					if(!$("#list-footer_end").find("#loadingpic").size()){
							$("#list-footer_end").find("p").remove();
							$('#list-footer_end').append('<p id="loadingpic" style="margin:0px auto;text-align:center;"><img src ="/waimai/Public/home/list/images/loading.gif" width="84px" height="84px"  class="loading-pic"/></p>');
		  			}
					for(var i=0;i<data.length;i++){
						console.debug(data[i]['id']);
						//document.write(i+"  "+data[i]['title']+'<br/>');记得有data[i]['title'];
						//下在的被４整除的可以设置向左漂浮弹出层．以便以后完美善
							if((i+1)%4==0){
								html+='<div class="cell l_listsbox list_box_right "  onclick="goToShop('+data[i]['id']+')"  data-id='+i+'><div class="l_listsimg"><img src="/Public/upload/shops/'+data[i]['logo']+'" alt="" width="226px" height="140px"></div><div class="l_listsname"><div class="l_listsname_title">'+data[i]['title']+'</div></div><div class="l_listssell">'+data[i]['total']+'</div><div class="l_listsdistance">起送:'+data[i]['start_price']+'  配送:'+data[i]['delivery_price']+'     速度'+data[i]['avg_speed']+'分钟</div><div class="l_listspay"><img src="/Public/home/list/images/jian.png" alt="">	<img src="/Public/home/list/images/jian.png" alt="">	<img src="/Public/home/list/images/jian.png" alt=""><img src="/Public/home/list/images/jian.png" alt="">	</div></div>';
							}else{
								html+='<div class="cell l_listsbox "  onclick="goToShop('+data[i]['id']+')"  data-id='+i+'><div class="l_listsimg"><img src="/Public/upload/shops/'+data[i]['logo']+'" alt="" width="226px" height="140px"></div><div class="l_listsname"><div class="l_listsname_title">'+data[i]['title']+'</div></div><div class="l_listssell">'+data[i]['total']+'</div><div class="l_listsdistance">起送:'+data[i]['start_price']+'  配送:'+data[i]['delivery_price']+'     速度'+data[i]['avg_speed']+'分钟</div><div class="l_listspay"><img src="/Public/home/list/images/jian.png" alt="">	<img src="/Public/home/list/images/jian.png" alt="">	<img src="/Public/home/list/images/jian.png" alt=""><img src="/Public/home/list/images/jian.png" alt="">	</div></div>';
							}

					}
					render(html);					
				}else{
					$("#list-footer_end").find("#loadingpic").remove();
					if(!$("#list-footer_end").find("p").size()){
						$('#list-footer_end').append('<p style="text-align:center;">没有更多数据了．．．．</p>');	  			
					}
				}
			},
		error:function(){
			console.debug('发生错误');
		}
	});
 }
},
  auto_imgHeight:true,
  insert_type:2
  //上面的类型是从左到右的须序依次插入
}
$(function(){
	//给容器增加流式加载效果
	$('.l_lists').waterfall(opt);
	//排序方
});

//为每个右边的优惠排序分类增加事件，以及改变背景，驱动排序方法
$('.l_cateboxrightli').each(function(i){
		var index=0;
		//用toggole事件
		$(this).toggle(
			function(){
			index=$(this).attr('data-id');
			$(this).find('i').css({
			background:"url(/waimai/waimai/Public/home/list/pictures/checkbox.png) no-repeat -45px -43px"
			});
			var del=$(this).detach();
			//删除并并保元素
			$('.l_cateboxrightul').prepend(del);
			page=2;
			p=2;//每次点击排序的时候都让从往下滚动的事件页码从第二页开始取重置必须的，不然P会累加
			ajaxData('sortadd',index);
			//当单击选中的时候排序，传入ID
		},function(){
			$(this).find('i').css({
			background:"url(/waimai/waimai/Public/home/list/pictures/checkbox.png) no-repeat -45px -63px"
			});
			var del=$(this).detach();
			//删除并并保元素
			$('.l_cateboxrightul').append(del);
			index=$(this).attr('data-id');
			page=2;
			p=2;//每次点击排序的时候都让从往下滚动的事件页码从第二页开始取重置必须的，不然P会累加
			ajaxData('sortdel',index);
			//当取消选中的时候排序并传入ID以备删除		
		});
})


</SCRIPT>
<script>
//以下为换灯片方法
	$(function(){
	var index = 0;	// 图片的索引
	var d = null;	// 图片定时器
	function run(){
		d = setInterval(function(){
			$('.l_carousel img').css('display','none');
			$('.l_carousel li').css('background','red');
			$('.l_carousel img:eq('+index+')').css('display', 'block');
			$('.l_carousel li:eq('+index+')').css('background', 'green');
			index++;
			if (index >= $('.l_carousel img').length) {
				index = 0;
			}
		},2000)
	}
	run();
	$('.l_carousel img,.l_carousel li').mouseover(function(){
		// 1.清除定时
		clearInterval(d);
		$('.l_carousel img').css('display','none');
		$('.l_carousel li').css('background','red');
		// 2.获取图片的索引
		index = $(this).index();
		$('.l_carousel img:eq('+index+')').css('display','block');
		$('.l_carousel li:eq('+index+')').css('background', 'green');
		}).mouseout(function(){
			run();
		})
	});
</script>