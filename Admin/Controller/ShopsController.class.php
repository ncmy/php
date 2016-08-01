<?php
/**
 * Created by PhpStorm.
 * User: Adminipostator
 * Date: 2016/7/13
 * Time: 0:01
 */
namespace Admin\Controller;

use Think\Controller;
class ShopsController extends Controller
{
    //所有商铺列表
	public function shopsList()
	{
		$shopSearch = I('post.shopSearch');//dump($shopSearch);
        if($shopSearch){
        	$where = "t1.title like '%{$shopSearch}%' or
			            t2.account like '%$shopSearch%' or 
			        	t1.compay_name like '%$shopSearch%' or
			        	t1.telephone like '%$shopSearch%'";	
        	//dump($where);
        }else{
        	$where = '';
        }
		$model = M('Shops');
		$count = $model->count();
		$page = new \Think\Page($count,10);
		$page ->setConfig('prev','上一页');
        $page ->setConfig('next','下一页');
        $page ->setConfig('first','首页');
        $page ->setConfig('last','末页');
        $page ->lastSuffix = false;
        $show = $page -> show(); 
		$data = $model->field('t1.*,t2.account')
                ->alias('t1')
                ->join('left join waimai_admins as t2 on t1.admin_id=t2.id')	    	
                //->order('t1.id desc')
		    	->where($where)
		    	->limit($page->firstRow,$page->listRows)
		    	->select();
		//dump($count);
		$this->assign('count',$count);
		$this->assign('show',$show);
		$this->assign('data',$data);
		$this->display();
	}
    //商铺状态修改
	public function shopsEdit()
	{
		$id=I('get.id');//dump($id);
		$model = M('Shops');
		$data = $model->find($id);
		$this->assign('data',$data);
		$this->display();
	}
    //商铺状态修改完成
	public function shopsUpdate(){
        if(!empty($_POST)){
            $data['id'] = I('id');
            $data['state'] = I('state');
            $res = M('Shops');
            if($res->save($data)){
                $this->ajaxReturn(1);
            }
        }
    }
    //商铺详情
    public function shopsDetail()
    {
    	$id=I('id');//dump($id);
    	$model = M('Shops');
    	$data = $model->field('t1.*,t2.account')
                ->alias('t1')
                ->join('left join waimai_admins as t2 on t1.admin_id=t2.id')            
                ->where('t1.id='.$id)
                ->select();    	//dump($data);
    	$this->assign('data',$data);
    	$this->display();
    }
    //编辑店铺
    public function shopsEdits(){
        $model = M('Shops'); 
        $id=I('get.id');
        $data = $model->find($id);
        $this->assign('data',$data);   
        $this->display();  
        if(!empty($_POST)){
           $post=I('post.');
            if(!empty($logo)){
                $str['logo'] = I('logo');
            }
            $rst=$model->save($post);
            if($rst===false){
                $this->error('店铺更新失败');
            }else{
                $this->success('店铺更新成功',U('Shop/shopList'));
            }
        }        
    }
    //个人商铺列表
    public function shopList()
    {
        $model = M('Shops');
        $data = $model->field('t1.*,t2.account')
                ->alias('t1')
                ->join('left join waimai_admins as t2 on t1.admin_id=t2.id')            
                //->where('t1.admin_id =' .session('uid'))
                ->select();
        //dump($data);
        $this->assign('data',$data);
        $this->display();
    }

}