<?php
namespace Home\Controller;
use Think\Controller;
/*所有的控制器请继承该控制器BaseController*/
class BaseController extends Controller {
    public function __construct(){
        parent::__construct();
    }
   /* 控制器初始化操作*/
    public function _initialize(){
        //检测用户SESSION
        $login=session('user');
       if(isset($login) && $login['islogin']==1){
            $this->assign('user',session('user'));
        }

    }

    //获取用户地址，以便导航条显地址之用。
    public function getUserAddress(){
        $address = M('addresses')->where(array('uid'=>$_SESSION['user']['id']))->order('keychar desc')->select();
        if($address){
            return $address;
        }
    }





}