<?php
namespace Admin\Controller;
use Think\Controller;

class ShopController extends Controller
{
	//商铺创建
    public function shopCreate()
    {
        if(empty($_POST)){
            $cat = M('Cats')->select();
            $this->assign('cat',$cat);
            //$admin = M('Admins')->find(session('uid'));
            //$this->assign('admin',$admin);
            $this->display();
        }else{
            $post=I('post.');
            $model = M('Shops');
            $post['create_time']=time();
            //上传
            if($_FILES['logo']['size'] > 0){
            $cfg = array('rootPath' => WORKING_PATH . UPLOAD_PATH);
            $upload = new \Think\Upload($cfg);
            $info = $upload -> uploadOne($_FILES['logo']);
            //dump($info);dump($_FILES);
            if($info){
                //$post['file'] = UPLOAD_PATH . $info['savepath'] . $info['savename'];
                $post['logo'] = $info['name'];
            }
        }
            //dump($post);die;
            $rst = $model->add($post);
            if($rst){
                $this->success('店铺创建成功',U('Index/index'),3);
            }else{
                $this->error('店铺创建失败');
            }  
        }              
    }

    //店铺图片上传
    public function uploadFile(){
        $upload=new \Think\Upload();
        $upload->maxSize   =     3145728 ;// 设置附件上传大小
        $upload->exts      =     array('jpg', 'gif', 'png', 'jpeg');// 设置附件上传类型
        $upload->rootPath  =     "./Public/upload/shops/"; // 设置附件上传目录
        $file  =   $upload->uploadOne($_FILES['Filedata']);
        if(!$file) {
        }else{
            //$image = new \Think\Image(); // 在图片右下角添加水印文字
            //$image->open('./Public/upload/shops/'.$file['savepath'].$file['savename'])->text('baidu','./ThinkPHP/Library/Think/Verify/ttfs/2.ttf',20,'#000000',\Think\Image::IMAGE_WATER_SOUTHEAST)->save('./Public/upload/shops/'.$file['savepath'].$file['savename']);
            //$image->open('./Public/upload/shops/'.$file['savepath'].$file['savename'])->water('./Public/admin/images/baidu_logo.png',\Think\Image::IMAGE_WATER_NORTHWEST,80)->save('./Public/upload/shops/'.$file['savepath'].$file['savename']);
            echo json_encode($file);
        }
    }


    //店铺分类列表
    public function catList(){
        $shop = M('shops')->where(array('admin_id'=>12))->find();
        $cat=M('shop_cats')->where(array('shop_id'=>$shop['id']))->order('keyChar')->select();
        //dump($cat);
        $this->assign('cat',$cat);
        $this->display();
    }

    //店铺分类增加
    public  function catAdd(){
        if(!empty($_POST)){
            $shop = M('shops')->where(array('admin_id'=>$_SESSION['admin']['id']))->find();
            $cat_name=I('post.cat_name');
            if(empty($name)){
                $this->error('分类名不能为空',U('Shop/catList'),2);
            }
            $model = M('shop_cats');
            $data['cat_name']=I('post.cat_name');
            $data['shop_id']=$shop['id'];
            $model->create($data);
            $rst = $model->add();
            if($rst){
                $this->success('增加成功',U('Shop/catList'),1);
            }else {
                $this->error('增加失败请重新增加', U('Shop/catList'), 1);
            }
        }

    }

    //店铺分类修改
    public function catEdit(){
        $id=I('get.id');
        $edit=M('shop_cats')->find($id);
        $this->assign('edit',$edit);
        $this->display();
    }

    //店铺分类更新
    public function catUpdate(){
        if(!empty($_POST)){
            $model=M('shop_cats');
            $post=I('post.');
            $info=$model->save($post);
            if($info===false){
                $this->ajaxReturn(0);
            }else{
                $this->ajaxReturn(1);
            }
        }
    }

    //店铺分类删除
    public function catDel(){
        $id=I('post.id');
        $del=M('shop_cats')->delete($id);
        if($del){
            $this->ajaxReturn(1);
        }else{
            $this->ajaxReturn(0);
        }
    }

   //商品列表
    public function goodList(){
        $shop = M('shops')->where(array('admin_id' =>12))->find();//店铺资料
        $cat = M('shop_cats')->where(array('shop_id' => $shop['id']))->order('keyChar')->select();//分类
        //dump($cat);
        $shop_cat_id=I('shop_cat_id',-1);
        $good_name=trim(I('good_name'));
        if($shop_cat_id>-1){
            $where['shop_cat_id']=$shop_cat_id;
        }
        if(!empty($good_name)){
            $where['_string']="good_name like '%{$good_name}%'";
        }
        $where['shop_id']=$shop['id'];
        $good = M('goods')->where($where)->order('sales desc')->select();//所有商品
        $page=new \Think\Page(count($good),4);
        $page ->setConfig('prev','上一页');
        $page ->setConfig('next','下一页');
        $page ->setConfig('first','首页');
        $page ->setConfig('last','末页');
        $page ->lastSuffix = false;
        $show=$page->show();
        $good = M('goods')->where(array('shop_id' => $shop['id']))->where($where)->limit($page->firstRow,$page->listRows)->order('sales desc')->select();//所有商品
        foreach ($good as $key => &$value) {
            //把所有商品的.OO的后缀去掉，但小数不会去掉
            $value['price'] = trim($value['price'], '.00');
            $good[$key]['cat'] = M('shop_cats')->where(array('id' => $value['shop_cat_id']))->find();
        }
        $this->assign('cat', $cat);
        $this->assign('goods', $good);
        $this->assign('show',$show);
        $this->assign('shopCatId',$shop_cat_id);
        $this->assign('good_name',$good_name);
        $this->display();

    }
    //商品增加
    public function goodAdd(){
        if(!empty($_POST)){
            $_POST['add_time']=time();
            $good=M('goods');
            $good->create();
            if($good->add()){
                $this->success('增加成功',U('Shop/goodList'),1);
            }else{
                $this->error('增加失败请重新增加', U('Shop/goodList'), 1);
            }

        }else{
            $shop = M('shops')->where(array('admin_id'=>$_SESSION['admin']['id']))->find();//店铺资料
            $cat=M('shop_cats')->where(array('shop_id'=>$shop['id']))->order('keyChar')->select();//分类
            $this->assign('shop',$shop);
            $this->assign('cat',$cat);
            $this->display();
        }
    }
     //商品修改
    public function goodEdit(){
        $shop = M('shops')->where(array('admin_id'=>$_SESSION['admin']['id']))->find();//店铺资料
        $cat=M('shop_cats')->where(array('shop_id'=>$shop['id']))->order('keyChar')->select();//分类
        $good=M('goods')->where(array('id'=>I('id')))->find();
        $this->assign('good',$good);
        $this->assign('cat',$cat);
        $this->display();

    }
    //商品更新
    public function goodUpdate(){
        if(!empty($_POST)){
            $update=M('goods');
            if(empty($_POST['pic'])){
                unset($_POST['pic']);
            }
            $tag=$update->save($_POST);
            if($tag===false){
                $this->ajaxReturn(0);
            }else{
                $this->ajaxReturn(1);
            }
        }
    }
     //商品删除
    public function goodDel(){
        $id=I('post.id');
        $shop = M('shops')->where(array('admin_id'=>$_SESSION['admin']['id']))->find();
        $del=M('goods')->where(array('shop_id'=>$shop['id']))->delete($id);
        if($del){
            $this->ajaxReturn(1);
        }else{
            $this->ajaxReturn(0);
        }
    }
      //商品图片上传
    public function uploadGoodImg(){
        $upload=new \Think\Upload();
        $upload->maxSize   =     3145728 ;// 设置附件上传大小
        $upload->exts      =     array('jpg', 'gif', 'png', 'jpeg');// 设置附件上传类型
        $upload->rootPath  =     "./Public/upload/goods/"; // 设置附件上传目录
        $file  =   $upload->uploadOne($_FILES['Filedata']);
        if(!$file) {
        }else{
            echo json_encode($file);
        }
    }
}