$(function(){
	//鼠标经过商品分类事件
	$('.l_cateboxrightul').hover(
		function(){
			$(this).addClass('l_cateboxright_show');
			$('.arrow').addClass('arrow_transform');
			$('.l_cateboxright').css({height:'125px'});
		},function(){
			$(this).removeClass('l_cateboxright_show');
			$('.arrow').removeClass('arrow_transform');
			$('.l_cateboxright').css({height:'40px'});
	});
	//列表页右上角的js排序



//底部
});
