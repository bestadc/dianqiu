<?php
namespace Home\Controller;
use Think\Controller;
use \Org\Util\WeixinJssdk;

/**
 * 支付系统
 */
class PaymentSystemController extends CommonController 
{
    /**
     * [index 购买类型判断-分配支付流程]
     * @return [type] [description]
     */
    public function action()
    {
        // 获取用户uid
        $uid = $_SESSION['homeuser']['id'];

        // 判断用户是否存在
        if($uid){
            // 遍历购物车
            // 遍历用户购物车套餐
            $setmeal = M('cartSetmeal')
            ->where("`uid`='{$uid}' AND `num`>0")
            ->join('pub_setmeal ON pub_setmeal.id = pub_cart_setmeal.sid')
            ->select();

            // 遍历用户购物车滤芯
            $filters = M('cartFilters')
            ->where("`uid`='{$uid}'  AND `num`>0")
            ->join('pub_filters ON pub_filters.id = pub_cart_filters.fid')
            ->select();

            // 定义一个变量用来装套餐数量
            $setmealNum = 0;
            // 如果有套餐产品
            if($setmeal){
                // 遍历，统计套餐总数量
                foreach ($setmeal as $value) {
                    // 将套餐数量进行累加
                    $setmealNum += $value['num'];
                }   
            }


            // 异常处理，购物车没有产品
            if(empty($setmeal) && empty($filters)){
                //重定向到商城页面地址
                redirect(U('/Home/Shop/filterElement'), 1, '<p style="color:red;">请先选择产品...</p>'); 
            } 

            // 情况一：购买套餐（1个套餐1件）
            if(empty($filters) && $setmealNum==1){
                show('购买套餐（1个套餐1件）<br/>');
            }

            // 情况二：购买套餐（1个套餐1件以上）购买套餐（多个套餐1件）购买套餐（多个套餐多件）
            if(empty($filters) && $setmealNum>1){
                show('购买套餐（1个套餐1件以上）购买套餐（多个套餐1件）购买套餐（多个套餐多件）<br/>');
            }

            // 情况三：包含滤芯产品
            if($filters){
                show('包含滤芯产品<br/>');
            }
            
            show('套餐情况：<br/>');
            show($setmeal);
            show('滤芯情况：<br/>');
            show($filters);
        }   
    }

}