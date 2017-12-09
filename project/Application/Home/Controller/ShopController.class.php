<?php
namespace Home\Controller;
use Think\Controller;
use \Org\Util\WeixinJssdk;

class ShopController extends CommonController 
{
    // 商城首页
    public function index()
    {

        // 显示模板
        $this->display();
    }

    // 商城滤芯产品
    public function filterElement()
    {
    	// 实例化Filters对象
		$User = M('Filters');
		// 查询滤芯产品总记录数
		$count = $User->count();
		// 实例化分页类 传入总记录数和每页显示的记录数(25)
		$Page = new \Think\Page($count,25);
		// 分页显示输出
		$show = $Page->show();
		// 进行分页数据查询 注意limit方法的参数要使用Page类的属性
		$list = $User->limit($Page->firstRow.','.$Page->listRows)->select();
		// 赋值数据集
		$this->assign('list',$list);
		// 赋值分页输出
		$this->assign('page',$show);

		// dump($list);die;
        // 显示模板
        $this->display();
    }
}