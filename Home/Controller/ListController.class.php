<?php
namespace Home\Controller;
use Think\Controller;

class ListController extends BaseController {

    //遍历店铺数据列表。
    public function index(){
        $shopId=($_COOKIE['shop'])?$_COOKIE['shop']:(isset($_SESSION['location']['shop'])?$_SESSION['location']['shop']:'');
        if($shopId) {
            $locationName = isset($_COOKIE['locationName'])? $_COOKIE['locationName'] : (isset($_SESSION['location']['locationName']) ? $_SESSION['location']['locationName'] : '');
        }
        //把获取的商铺ID号进行折分成数组
        $shopId=explode('#',urldecode($shopId));
        S('shopId',$shopId);//把百度数据库商铺ID保存到缓存中
        $map['id']=array('IN',$shopId);
        $count=M('shops')-> count();
        $page=new \Think\Page($count,15);
        $page ->setConfig('prev','上一页');
        $page ->setConfig('next','下一页');
        $page ->setConfig('first','首页');
        $page ->setConfig('last','末页');
        $page ->lastSuffix = false;
        $show=$page->show();
        $data=M('shops')->field('t1.*,count(t2.shop_id) as c')
        ->alias('t1')
        ->join('left join waimai_orders as t2 on t1.id=t2.shop_id')
        ->group('t1.id')
        ->limit($page->firstRow,$page->listRows)
        ->select();
        //dump($data);
        
        
        $cats=M('cats')->select();
        $this->assign('cats',$cats);//dump($cats);
        $this->assign('data',$data);
        $this->assign('show',$show);
        //获取用户地址
        $address=$this->getUserAddress();//dump($address);
        $this->assign('address',$address);
        $this->display();
    }
    //获取店铺列表，并根据相应的属性进行排序搜索
    public function getShopsByOrder(){
        $shopId=S('shopId');
        $shopId=implode(',',$shopId);
        $mode=M();
        $catid=I('catsort',"");//从客户端接收的类型查询ID如：送药上门
        $msort=I('msort',"");//从客户端接收的综合查询ID如：按销量或评分
        $sort=I('sort',"");//从客户端接收的数组查询ID：如：新用户优惠和立减优惠
        $sort=explode(',',$sort);
        $data=S('list-data'.$locationName.$catid.$msort.$sort) or '';
        //以下为调用网上数据
        $sql = "select s.id,s.title,s.logo,s.address,s.title,s.start_price,s.delivery_price,s.avg_speed,d.id as detail_id, SUM(d.nums) as total from __SHOPS__ s LEFT JOIN __DETAILS__ d ON s.id=d.shop_id WHERE s.id IN( $shopId )  ";
        //以下语句为调用本地数据
        //$sql = "select s.id,s.title,s.logo,s.address,s.title,s.start_price,s.delivery_price,s.avg_speed,d.id as detail_id, SUM(d.nums) as total from __SHOPS__ s LEFT JOIN __DETAILS__ d ON s.id=d.shop_id WHERE 1=1  ";
        //if(!empty($data)){//如果在本地缓存里有数据就不用再
            $data=S('list-data'.$locationName.$catid.$msort.$sort);
        //}else {
            if ($catid > 0) {
                //商铺类型
                $sql .= "  AND  s.cat_id={$catid}";
            }
            if (in_array(10, $sort)) {
                //支持发票10
                $sql .= "   AND  s.receipt=1";
            }
            if (in_array(11, $sort)) {
                //百度配送11
                $sql .= "   AND  s.logistics=1";
            }
            if (in_array(12, $sort)) {
                //支持在线支付12
                $sql .= "   AND  s.pay_online=1";
            }
            if (in_array(13, $sort)) {
                //免费配送13
                $sql .= "   AND  s.delivery_price=1";
            }
            if (in_array(14, $sort)) {
                //支持代金券14
                $sql .= "   AND  s.coupon=1";
            }
            if (in_array(15, $sort)) {
                //超时赔付15
                $sql .= "   AND  s.overtime=1";
            }
            if (in_array(16, $sort)) {
                //新用户优惠16
                $sql .= "   AND  s.newuser=1";
            }
            //$sql .= " AND s.id IN (" . $shopId . ") ";
            if ($msort == 1 OR $msort == 2) {
                //默认排序和按销量
                $sql .= "  GROUP BY   s.id  ORDER BY  total DESC ";
            } else if ($msort == 3) {
                //按起送价
                $sql .= "  GROUP BY   s.id  ORDER BY  s.start_price";
            } else if ($msort == 4) {
                //按评分
                $sql .= "  GROUP BY   s.id  ORDER BY s.score DESC";
            } else if ($msort == 5) {
                //按送餐速度
                $sql .= "  GROUP BY   s.id  ORDER BY s.avg_speed";
            } else {
                $sql .= "  GROUP BY   s.id  ORDER BY  total DESC ";
            }
            $data = $mode->query($sql);
            //S('list-data'.$locationName.$catid.$msort.$sort, $data);
        //}

        $count=count($data);
        $page= new \Think\Page($count,20);
        $sql.=" limit {$page->firstRow},{$page->listRows}" ;
       // echo $sql;
        $data=$mode->query($sql);
        echo json_encode($data);
    }

    //接收从导航栏查询条件检索出商品或商铺
    public function goodAndShopSearch(){
        $data=array();
        $shops=S('shopId');
        $shopId=implode(',',$shops);
        $mode=M();
        //查询符合条件的商铺及其销量
        $search=I('search');
        //$sql="select s.id,s.title, SUM(d.nums) as total from __SHOPS__ s LEFT JOIN __DETAILS__ d ON s.id=d.shop_id WHERE s.title like '%{$search}%' and s.id in ({$shopId}) group by s.id order by d.nums  DESC  limit 5 ";
        $sql="select s.id,s.title, SUM(d.nums) as total from __SHOPS__ s LEFT JOIN __DETAILS__ d ON s.id=d.shop_id WHERE s.title like '%{$search}%' and s.state=1 group by s.id order by d.nums  DESC  limit 5 ";
        $shopData=$mode->query($sql);
        $data['shop']=$shopData;
        $goodLike['good_name']=array('like','%'.I('search').'%');
        $goodLike['status']=1;
        //$goodData=M('goods')->table('__GOODS__  g')->field('g.id,g.good_name,g.price,s.id as shop_id,s.title')->join('LEFT JOIN __SHOPS__ s ON g.shop_id = s.id')->where("s.id in ({$shopId})")->where($goodLike)->group('s.id')->limit(5)->select();
        //查询商品和价格以及相应的店铺的ID
        $goodData=M('goods')->table('__GOODS__  g')->field('g.id,g.good_name,g.price,s.id as shop_id,s.title')->join('LEFT JOIN __SHOPS__ s ON g.shop_id = s.id')->where($goodLike)->order('g.price desc')->limit(5)->select();
        $data['good']=$goodData;
        $this->ajaxReturn($data);
    }
    

   

}