<?php
namespace Home\Controller;
use Think\Controller;
use \Org\Util\WeixinJssdk;
use Home\Controller\WechatController;
/**
 * 前共控制器
 * 前台控制器除login外必须继承我
 * @author 吴智彬 <519002008@qq.com>
 */

class CommonController extends Controller 
{
	/**
     * 初始化
     * @author 吴智彬 <519002008@qq.com>
     */
    public function _initialize()
    {	
        // 获取用户信息写入缓存
        if(empty($_SESSION['homeuser'])){
            // 实例化微信JSSDK对象
            $weixin = new WeixinJssdk;
            // 获取用户open_id
            $openId = $weixin->GetOpenid();           
            // 查询用户信息
            $info = M('Users')->where("open_id='{$openId}'")->find();
            // 判断用户是否存在
            if($info){
               // 将用户信息缓存
                $_SESSION['homeuser'] = $info; 
            }else{
                // 用户不存在
                // 请先关注公众号
                $this->error('请先关注公众号',U('/Home/Wechat/follow'),5);
            }
        }
    }
}