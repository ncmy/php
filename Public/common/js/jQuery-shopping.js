;(function($){
	$.extend($.fn,{
		shoping:function(options){
			var self=this,
				$shop=$('.J-shoping'),
				$title=$('.J-shoping-title'),//购物车底部横条
				$cart=$('.J-shoping-title>.J-text'),//购物车底部文字
				$body=$('.J-shoping-body'),//购物车容器。也就是放商品列表
				$num=$('.J-shoping-num'),
				$close=$('.J-shoping-close'),//商品列表的关闭按钮
				$container=$('#shopping-container');//商品列表容器
				$del_one_this=$('.J-shoping-list').find('.del');
				$add_one_this=$('.J-shoping-list').find('.add');
				$choosed=$('.J-shoping-title>.J-shoping-num');//选好了操作			
				var num_arr=[];
				var cart_total=parseFloat($('#cart_total').val()).toFixed(2);//以前的总价，如果SESSION里有商品，这就是商品的总价
				var count_price=0;//总价下面的不管是已增加还是没有增加的都共享一个总价			
				if(cart_total>0){
					count_price=cart_total;
				}				
				var shop_id=$('#shop_id').val();  //商铺的ID为订单所用。
				var shopIdNums=$('#cart_arr_nums').val();
				shopIdNums_source=shopIdNums.split(',');
				if(shopIdNums_source.length>0){
					num_arr=shopIdNums_source;
					//从SESSION里取的值给商品的ID数组初始化，以便增加商品的时个可以不再重复增加
				}
				function add(a, b) {
				//加法
			    var c, d, e;
			    try {
			        c = a.toString().split(".")[1].length;
			    } catch (f) {
			        c = 0;
			    }
			    try {
			        d = b.toString().split(".")[1].length;
			    } catch (f) {
			        d = 0;
			    }
			    return e = Math.pow(10, Math.max(c, d)), (mul(a, e) + mul(b, e)) / e;
			}
			//减法
			function sub(a, b) {
			    var c, d, e;
			    try {
			        c = a.toString().split(".")[1].length;
			    } catch (f) {
			        c = 0;
			    }
			    try {
			        d = b.toString().split(".")[1].length;
			    } catch (f) {
			        d = 0;
			    }
			    return e = Math.pow(10, Math.max(c, d)), (mul(a, e) - mul(b, e)) / e;
			}
			 //乖法
			function mul(a, b) {
			    var c = 0,
			        d = a.toString(),
			        e = b.toString();
			    try {
			        c += d.split(".")[1].length;
			    } catch (f) {}
			    try {
			        c += e.split(".")[1].length;
			    } catch (f) {}
			    return Number(d.replace(".", "")) * Number(e.replace(".", "")) / Math.pow(10, c);
			}
			 function uniqueArray(data){  //去掉重复数组元素
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
					/*清空操作*/
      	var clear_all=$('.shoping-menu span:eq(1)');
	      clear_all.click(function(){
	      	//购物车清空操作。先从服务器删除所有的数据
	   		$.ajax({
					url:'/waimai/index.php/Home/Carts/cartDelAll',
					data:{shopid:shop_id},
					dataType:'json',
					type:'post',
					success:function(data){
						if(data){
							var goods=$('.J-shoping-list');//商品列表
			      		goods.remove();
			      		$container.slideUp('slow');
			      		$('.J-shoping-title a').text('购物车是空的');
			      		num_arr.length=0;//清空购物车的同事把数组删除
			      		count_price=0;//清空购物车重置计数
			      		//清空购物车的同时把页面中的所有商品数量全部重置为0和减一和数量元素全部隐藏，重置为0后加一商品的时候会判断
			      		var parent_all_num=$('.id2015-11-03-222139-32_ .detail_num');
			      		var parent_all_del=$('.id2015-11-03-222139-32_ .detail_del');
			      		parent_all_num.text(0);//页面商品数量重置为1
			      		parent_all_num.hide();//页面数量元素隐藏
			      		parent_all_del.hide();//减一元素隐藏。
						}
					},
					error:function(){
						alert('出错了');
					}
				});      		
	      });	   
      	var parent_del=$('.id2015-11-03-222139-32_ .detail_del');		//页面中的减1操作元素     
			var S={
				init:function(){
					/*始始化操作*/
					parent_del.bind('click',this.clickDel);//页面中的减一操作
					$container=$('#shopping-container').hide();//购物车中的容器初始化为隐藏
					$cart.bind('click',this.clickOnTitle);//单击购物车
					$close.live('click',this.removeList);//单击商品里的删除叉按钮
					$(self).live('click',this.addShoping);//页面中的加一也就是自身操作添加到购物车
					$(document).bind('click',S.slideBoxMini);//单击页面时的操作
					$body.bind('click',this.clickOnBody);//单击购物车容器时的操作
					$del_one_this.live('dblclick',this.delOne);//购物车中的减一操作
					$add_one_this.live('dblclick',this.addOne);//购物车中的加一操作
					$choosed.bind('click',this.choose);//选好了的绑定函数操作
				},
				choose:function(e){
				//点击选好了时要跳到的操作
					var target=$(e.target);
					var result_arr=[];
					var result_string='';
					if(num_arr.length<1){
						target.text('还没选呢');

					}else{
						for(var i=0;i<num_arr.length;i++){
							id=num_arr[i];
							var good_counts=$('.J-shoping-list[data-id='+id+']').find('.num').val();
							result_string+=id+"="+good_counts+"&";			
						}
						result_string=result_string.slice(0,-1);//把字符串中最后一个&去掉
						console.debug(num_arr);
						//选好的订单触发下单该店铺的操作
						$.ajax({
							url:'/waimai/index.php/Home/Carts/cartPay',
							data:{shopid:shop_id},
							dataType:'json',
							type:'post',
							success:function(data){
								if(data==3){
									//没有权限弹出登陆框
									layer.open({
									 type: 2, 
									 title: false,
									 closeBtn: 0,
									 area: ['392px', '390px'], 
									 offset: '100px',
									 //加上边框 
									 content: ['/waimai/index.php/Home/Login/login', 'no'] 
									}); 
								}else if(data==0){
									alert('还没有选择商品');
								}else if(data==1){
									window.location='/waimai/index.php/Home/Orders/index?shopid='+shop_id;
								}

							}
						});
					}				
					return false;
				},
				clickDel:function(e){//页面中的减一操作
						var $target=$(e.target);
						var id=$target.parent('.id2015-11-03-222139-32_').attr('data-id');//获取当前元素父元素的商品ID						
						var parent_num_del=$target.siblings('.detail_num');//获取当前元素相邻的元素商品数量			
						parent_num_del.text(parseInt(parent_num_del.text())-1);//如果减一后小于1则数量和减一元素隐藏并数量重置为0
						var good_num =$('.J-shoping-list[data-id='+id+']'). find('.J-shoping-list-a .num');//查找商品列表中的商品数量
						good_num.val(parseInt(good_num.val()-1));//商品列表中的商品数量减一。
						good_price=parseFloat($('.J-shoping-list[data-id='+id+']>.price').text()).toFixed(2);
						//往购物里减商品
						$.ajax({
								url:'/waimai/index.php/Home/Carts/cartDelOne',
								data:{shopid:shop_id,goodid:id},
								dataType:'json',
								type:'post',
								success:function(data){
									if(data){
										if(parseInt(parent_num_del.text())-1<0){
											parent_num_del.text(0);//重置为0
											$target.hide();
										parent_num_del.hide();
											var del_index = $.inArray(id,num_arr);//检测数组中的当前商品ID下标
											num_arr.splice(del_index,1);//去掉数组重复元素				
											$('.J-shoping-list[data-id='+id+']').remove();//当商品数量为0时删除商品
											count_price=sub(count_price,good_price);//注意还减了一次。因为页面为1就消失了，但商品中的价格还没有减去
											$title.find('.J-text').text('共￥'+count_price+'元');
										}else{						
											count_price=sub(count_price,good_price);
											$title.find('.J-text').text('共￥'+count_price+'元');
										}
									}
								}
						})						
						return false;
				},
				delOne:function(e){//商品列表中的减一操作
					var $target=$(e.target);
					var good_num=$target.siblings('.num');
					var good_id=$target.parents('.J-shoping-list').attr('data-id');//获取当前元素中的商品ID 
					var parent_num=$('.id2015-11-03-222139-32_[data-id='+good_id+']').find('.detail_num');//获取页面父元素中的商品数量
					var good_price=parseFloat($target.parent('.J-shoping-list-a').siblings('.price').text()).toFixed(2);
					good_num.val(parseInt(good_num.val())-1);
					//往服务器购物车里减一
					$.ajax({
						url:'/waimai/index.php/Home/Carts/cartDelOne',
						data:{shopid:shop_id,goodid:good_id,tag:1},
						dataType:'json',
						type:'post',
						success:function(data){
							if(data){
								if(parseInt(good_num.val())>0){//如果商品数量大于1才从总价中减去，不然总价不变
									count_price=sub(count_price,good_price);
									parent_num.text(parseInt(parent_num.text())-1);//页面中的父元素减1
								}else{
									good_num.val(1);//如果商品数量小于1则为1
								}
								$title.find('.J-text').text('共￥'+count_price+'元');
							}
						}
					});				
					return false;
				},
				addOne:function(e){//商品列表中的加一操作
					var $target=$(e.target);
					var good_id=$target.parents('.J-shoping-list').attr('data-id');//获取当前元素中的商品ID 
					var parent_num=$('.id2015-11-03-222139-32_[data-id='+good_id+']').find('.detail_num');//获取页面父元素中的商品数量
					var good_num=$target.siblings('.num');
					var good_price=parseFloat($target.parent('.J-shoping-list-a').siblings('.price').text()).toFixed(2);
					//购物车的列表里的加1操作
					$.ajax({
						url:'/waimai/index.php/Home/Carts/cartAddOne',
						data:{shopid:shop_id,goodid:good_id},
						dataType:'json',
						type:'post',
						success:function(data){
							if(data){
								good_num.val(parseInt(good_num.val())+1);
								count_price=add(count_price,good_price);				
								$title.find('.J-text').text('共￥'+count_price+'元');
								parent_num.text(parseInt(parent_num.text())+1);//页面中的父元素加1							
							}
						}
					});			
					return false;				
				},
				clickOnBody:function(e){
					if(!$(e.target).hasClass('J-shoping-close')){
						e.stopPropagation(); //阻止冒泡	
					};
				},
				addShoping:function(e){
					//增加商品到购物车的操作
					e.stopPropagation();
					var $target=$(e.target),
						id=$target.parent('.id2015-11-03-222139-32_').attr('data-id'),//商品ID
						name=$target.parent('.id2015-11-03-222139-32_').find('p:eq(0)').text(),//	商品名字
						price=$target.parent('.id2015-11-03-222139-32_').find('p:eq(3)').text(),//商品价格
					    x = $target.parent('.id2015-11-03-222139-32_').find('img').offset().left,
						y = $target.parent('.id2015-11-03-222139-32_').find('img').offset().top,
						X = $shop.offset().left,
						Y = $shop.offset().top;		
						var parent_num=$target.siblings('.detail_num');//页面中的商品数量	
						var parent_del_one_this=$target.siblings('.detail_del');

						//console.debug("购物车前"+parent_num.css('display')+'   '+parent_del_one_this.css('display') );
						if ($('#floatOrder').length <= 0) {
							$('body').append('<div id="floatOrder"><img src="'+$target.parent('.id2015-11-03-222139-32_').find('img').attr('src')+'" width="122" height="122" /></div');
						};
						var $obj=$('#floatOrder');
						if(!$obj.is(':animated')){
							$obj.css({'left': x,'top': y}).animate({'left': X,'top': Y,width:"2%",height:"2%"},300,function() {
									$obj.fadeOut(300,function(){
										$obj.remove();	
										/*	$target.data('click',false).addClass('dis-click');*/					
											//var num=Number($num.text());
										//var shake = $title.find('.baseBg-cart');
										//shake.animate({left:'-=10px'},200,function(){shake.animate({left:'+=10px'},200);});		
										/*检测商品ID是否已经添加过了*/
										var tag=jQuery.inArray(id,num_arr);
										num_arr.push(id);
										uniqueArray(num_arr);
										//往购物车里的加商品数量。默认为加1
										$.ajax({
												url:'/waimai/index.php/Home/Carts/cartAddOne',
												data:{shopid:shop_id,goodid:id},
												dataType:'json',
												type:'post',
												success:function(data){
													if(data){

																/*如果没有添加则增加到购物车如果有则数字加１*/
																if(tag==-1){
																	$body.prepend('<div class="J-shoping-list" data-id="'+id+'"><a href="#"title="">'+name+'</a><div class="J-shoping-list-a"><span class="del"></span><input type="text" value="1" class="num"><span class="add"></span></div><div class="price">'+price+'</div><div class="baseBg J-shoping-close"></div></div>');			
																	var good_counts =$('.J-shoping-list[data-id='+id+']'). find('.J-shoping-list-a .num');
																	var good_counts_int=parseInt(good_counts.val());//个数
																	var good_price_float=parseFloat(price);//价格
																	count_price=add(mul(good_counts_int,good_price_float.toFixed(2)),count_price);//总价
																	//console.debug(good_price_float+"  "+good_counts_int+"  "+count_price);
																	$title.find('.J-text').text('共￥'+count_price+'元');
																	parent_num.text(parseInt(parent_num.text())+1);//页面中的商品数量加1
																	if(parseInt( parent_num.text())!=1){												
																		parent_num.text(1);											
																	}
																}else{
																	/*如存在则找存在的ID的商品列表*/
																	var goods_counts =$('.J-shoping-list[data-id='+id+']'). find('.J-shoping-list-a .num');
																	goods_counts.val(parseInt(goods_counts.val())+1);//有则数字加１
																	var goods_counts_int=1;//个数
																	if(isNaN(goods_counts_int))goods_counts_int=0;//判断因删掉商品出现的NAN
																	var goods_price_float=parseFloat(price);//价格
																	count_price=add(mul(goods_counts_int,goods_price_float.toFixed(2)),count_price);//总价
																	//console.debug(goods_price_float+"  "+goods_counts_int+"  "+count_price);
																	$title.find('.J-text').text('共￥'+count_price+'元');
																	parent_num.text(parseInt(parent_num.text())+1);//页面中的商品数量加1
																}
																parent_num.show();
																parent_del_one_this.show();//把页面中的减一和数量放在判断后
																/*把商品ID推入数组中以备下次查询用*/
																//$num.text(num+1);
																/*如果增加到购物车的数量为１时就把购物车显示出来*/
																var good_num=$('.J-shoping-list').length;
														
																if(good_num==1){
																	$('#shopping-container').slideDown('slow');
																}
													}
												}
										});

										
									});
							});	
						};
				},
				clickOnTitle:function(e){
					var length=$('.J-shoping-list').length;	
					/*如果有商品购物车才会有反应*/
					if(length>0){
						if(!$container.hasClass('J-shoping-small')){
							$container.slideToggle();	
						}else{						
							$container.removeClass('J-shoping-small');
							$container.slideDown();
						};
					}else{

					}
					return false;
				},
				slideBoxMini:function(){
					//此处设置点击document时需不需要隐购物车
						/*$container.addClass('J-shoping-small');*/
				},
				removeList:function(e){
					//点击商品删除列表叉时的操作
					var $target=$(e.target),
						$parent=$target.parent('.J-shoping-list');
						var good_id=$target.parents('.J-shoping-list').attr('data-id');//获取当前元素中的商品ID 
						var del_num=$parent.find('.num').val();//减去的总数
						var del_price=$parent.find('.price').text();//减去的价格
						var del_count_price=mul(parseInt(del_num),parseFloat(del_price).toFixed(2));//减去的总价
						var del_id=$parent.attr('data-id');//获取要从数组中删除的重复元素下标
						var del_index = $.inArray(del_id,num_arr);//检测数组中的重复元复下标				
						var parent_del_one_this=$('.id2015-11-03-222139-32_[data-id="'+del_id+'"] .detail_del');//查找页面中和当前产品ID相同的父元素的ID
						var parent_num_this=$('.id2015-11-03-222139-32_[data-id="'+del_id+'"] .detail_num');//					
						if(del_index!=-1){//这一步非常关键，不然会在数组中删除undefined元素。导致程度不稳定。
							num_arr.splice(del_index,1);//去掉数组重复元素		
						}					
						count_price=sub(count_price,del_count_price);//总价
						//console.debug(del_num+'  '+del_price+'  '+del_count_price+"  "+count_price);
						$.ajax({
							url:'/waimai/index.php/Home/Carts/cartBtnDel',
							data:{shopid:shop_id,goodid:good_id},
							dataType:'json',
							type:'post',
							success:function(data){
								if(data){
									parent_num_this.hide();
									parent_del_one_this.hide();
									$title.find('.J-text').text('共￥'+count_price+'元');
									$parent.addClass('J-shoping-list-remove').fadeOut(300,function(){
									$parent.remove();
									S.hideBody();
									if(options&&options.callback){
										options.callback($(self));	
									};	
								});	
							}
						}
					});				
					return false;	
				},
				hideBody:function(){
					var length=$('.J-shoping-list').length;	
					//$num.text(length);
					/*如果没有商品则会隐藏购物车并改变购物车文字*/
					if(length==0){
						$('#shopping-container').hide();
							$container.addClass('J-shoping-small');
							$('.J-shoping-title a').text('购物车是空的');
					};
				}
			};
			S.init(); 
		}
	});	
})(jQuery);

