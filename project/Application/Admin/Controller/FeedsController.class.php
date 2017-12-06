<?php
namespace Admin\Controller;
use Think\Controller;

/**
 * 客户反馈及报修控制器
 * 
 * @author 潘宏钢 <619328391@qq.com>
 */

class FeedsController extends CommonController 
{
	/**
     * 反馈列表
     * @author 潘宏钢 <619328391@qq.com>
     */
    public function feedslist()
    {	
        // 根据用户昵称进行搜索
        $map = '';
    	if(!empty($_GET['name'])) $map['name'] = array('like',"%{$_GET['name']}%");

        $user = M('feeds');
        $total = $user->where($map)
                        ->join('pub_users ON pub_feeds.uid = pub_users.id')
                        ->field('pub_feeds.*,pub_users.name,pub_users.phone')
                        ->count();
        $page  = new \Think\Page($total,8);
        $pageButton =$page->show();

        $userlist = $user->where($map)
                        ->join('pub_users ON pub_feeds.uid = pub_users.id')
                        ->field('pub_feeds.*,pub_users.name,pub_users.phone')
                        ->limit($page->firstRow.','.$page->listRows)
                        ->select();

        $this->assign('list',$userlist);
        $this->assign('button',$pageButton);
        $this->display();
    }

    /**
     * 反馈删除
     * @author 潘宏钢 <619328391@qq.com>
     */
    public function feedsdel($id)
    {
        
        $res = M('feeds')->delete($id);
        if($res){
            $this->success('删除成功',U('Feeds/feedslist'));
        }else{
            $this->error('删除失败');
        }
    
    }

    /**
     * 报修列表
     * @author 潘宏钢 <619328391@qq.com>
     */
    public function repairlist()
    {
        
    }
    
}