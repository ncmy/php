<?php
/**
 * Created by PhpStorm.
 * User: Administrator
 * Date: 2016/7/12
 * Time: 23:59
 */
namespace Admin\Controller;

use Think\Controller;

class OrdersController extends Controller
{
    public function orderList()
    {
        $model = M('Orders');
        $word = I('post.word');
        if($word){
        	$where .= "t1.order_sn = '{$word}' or t3.phone like '%{$word}%'";
            //dump($where);
        }else{
        	$where .= '';           
        }
        $count = $model -> count();  
       // $shop_id = M('Shops')->find(session('uid'));
        //$where = "t1.shop_id = {$shop_id['id']}";	   	
		$page = new \Think\Page($count,4);
		$page ->setConfig('prev','上一页');
        $page ->setConfig('next','下一页');
        $page ->setConfig('first','首页');
        $page ->setConfig('last','末页');
        $page ->lastSuffix = false;
        $show = $page -> show();  //dump($show);
    	$data = $model ->field('t1.*,t2.nums,t2.price,t3.name,t3.phone,t3.address,t3.code') 
		    	->alias('t1')
		     	->join('left join waimai_details as t2 on t1.order_sn=t2.id left join waimai_users as t3 on t1.user_id=t3.id')
                ->order('t1.id desc')
                ->group('t1.id desc')
		    	->where($where)
		    	->limit($page->firstRow,$page->listRows)
		    	->select();
                //dump($data);
    	$this->assign('count',$count);
    	$this->assign('show',$show);
    	$this->assign('data',$data);
        $this->display();
    }
     public function orderDetail(){
        $order = M('Orders')->where(array('id'=>I('id')))->find();//dump($order);die;
        $order['user']=M('Users')->where(array('id'=>$order['user_id']))->find();
        //dump($order['user']);die;
        $order['detail']=M('Details')->where(array('order_id'=>$order['id']))->select();
        //dump($order['detail']);die;
        $this->assign('order',$order);
        $this->display();
    }
}
