<?php
namespace Home\Controller;
use Think\Controller;

/**
 * 订单
 */
class OrdersController extends CommonController 
{
	//全部订单
    public function orderAll()
    {
        // 获取用户uid
        $uid = $_SESSION['homeuser']['id'];
        if($uid){
     

            
        }
           
        // 显示模板
        $this->display();        
    }

	//待付款订单
    public function orderPay()
    {
        // 获取用户uid
        $uid = $_SESSION['homeuser']['id'];
        // 查询用户全部未支付订单号
        $orders = M('Orders')->order('id desc')->field('id,order_id,created_at')->where("`user_id`={$uid} AND `is_pay`=0")->select();
        // 实例化订单滤芯对象
        $orderFilter = M('OrderFilter');
        // 实例化订单套餐对象
        $orderSetmeal = M('OrderSetmeal');
        // 准备数组装未支付订单信息
        $ordersData = array();

        // 遍历订单未支付订单号
        foreach ($orders as $value) {
            // 获取订单套餐明细
            $ordersData["{$value['order_id']}-{$value['created_at']}"]['orderSetmeal'] = $orderSetmeal->where("`order_id`='{$value['order_id']}'")->select();
            // 获取订单滤芯明细
            $ordersData["{$value['order_id']}-{$value['created_at']}"]['orderFilter'] = $orderFilter->where("`order_id`='{$value['order_id']}'")->select();
        }
        //show($ordersData);die;
        // 分配数据
        $this->assign('ordersData',$ordersData);

        // 显示模板
        $this->display();        
    }

	//待发货订单
    public function orderSend()
    {


        // 显示模板
        $this->display();        
    }

	//待收货订单
    public function orderTake()
    {


        // 显示模板
        $this->display();        
    }
}