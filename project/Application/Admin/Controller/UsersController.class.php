<?php
namespace Admin\Controller;
use Think\Controller;

/**
 * 前台用户控制器
 * 
 * @author 潘宏钢 <619328391@qq.com>
 */

class UsersController extends CommonController 
{
    public function get_map()
    {
        if($this->get_level()){
            $ma['bd.vid'] = $_SESSION['adminuser']['id'];
            $users=M('devices')
            ->where($ma)
            ->alias('d')
            ->join('pub_binding bd ON d.id=bd.did', 'LEFT')
            ->field('d.uid')
            ->select();
            $ids = array_column($users,'uid');
            $ids = empty($ids)?['-1']:$ids;
            return ['u.id'=> ['in',$ids]];
        }
    }

	/**
     * 前台用户列表
     * @author 潘宏钢 <619328391@qq.com>
     */
    public function index()
    {	
        // if (IS_POST) {
        //     dump($_POST);die;
        // }
        
        require_once VENDOR_PATH.'PHPExcel.php';
        $phpExcel = new \PHPExcel();
        // dump($phpExcel);
        // 搜索功能
        $map = array(
            'w.nickname' => array('like','%'.trim(I('post.nickname')).'%'),
            'd.device_code' => array('like','%'.trim(I('post.device_code')).'%'),
            'd.phone' => trim(I('post.phone')),
            'd.address' => array('like','%'.trim(I('post.address')).'%'),
            'u.login_ip' => trim(I('post.login_ip'))
        );
        if(trim(I('post.address'))){
            $map['d.address'] = array('like','%'.trim(I('post.address')).'%');
        }

        // 删除数组中为空的值
        $map = array_filter($map, function ($v) {
            if ($v != "") {
                return true;
            }
            return false;
        });

        if($this->get_level()){
            $map['bd.vid'] = $_SESSION['adminuser']['id'];

        }
        $mincreated_at = strtotime(trim(I('post.mincreated_at')))?:0;
        $maxcreated_at = strtotime(trim(I('post.maxcreated_at')))?:-1;
        if (is_numeric($maxcreated_at)) {
            $map['u.created_at'] = array(array('egt',$mincreated_at),array('elt',$maxcreated_at));
        }
        if ($maxcreated_at < 0) {
            $map['u.created_at'] = array(array('egt',$mincreated_at));
        }
        $user = D('users');
        // PHPExcel 导出数据 
        if (I('output') == 1) {
            $data = $user
            ->where($map)
            ->alias('u')
            ->join('__WECHAT__ w ON u.open_id=w.open_id', 'LEFT')
            ->join('__CURRENT_DEVICES__ cd ON u.id=cd.uid', 'LEFT')
            ->join('__DEVICES__ d ON cd.did=d.id', 'LEFT')
            ->join('__BINDING__ bd ON d.id = bd.did ')
            ->field('u.id,w.nickname,d.device_code,d.phone,d.address,u.login_time,u.login_ip,u.created_at')
            ->select();
            $filename = '用户列表数据';
            $title = '用户列表';
            $cellName = ['用户id','姓名','当前设备id','手机号','地址','最后登录时间','登录IP','关注日期'];
            // dump($data);die;
            $myexcel = new \Org\Util\MYExcel($filename,$title,$cellName,$data);
            $myexcel->output();
            return ;
        }        

        $total = $user
            ->where($map)
            ->alias('u')
            ->join('__WECHAT__ w ON u.open_id=w.open_id', 'LEFT')
            ->join('__CURRENT_DEVICES__ cd ON u.id=cd.uid', 'LEFT')
            ->join('__DEVICES__ d ON cd.did=d.id', 'LEFT')
            ->join('__BINDING__ bd ON d.id = bd.did ')
            ->field('d.device_code,d.name,d.address,d.phone,w.*,u.*,cd.uid,cd.did,d.updatetime')
            ->count();
        $page  = new \Think\Page($total,10);
        $pageButton =$page->show();

        $userlist = $user
            ->where($map)
            ->alias('u')

            ->join('__WECHAT__ w ON u.open_id=w.open_id', 'LEFT')
            ->join('__CURRENT_DEVICES__ cd ON u.id=cd.uid', 'LEFT')
            ->join('__DEVICES__ d ON cd.did=d.id', 'LEFT')
            ->join('__BINDING__ bd ON d.id = bd.did ')
            ->field('d.device_code,d.name,d.address,d.phone,w.*,u.*,cd.uid,cd.did,d.updatetime')
            ->limit($page->firstRow.','.$page->listRows)
            ->select();
            // ->getAll();
        $this->assign('list',$userlist);
        $this->assign('button',$pageButton);
        $this->display();
    }

    /**
     * 推送信息方法
     * @author 潘宏钢 <619328391@qq.com>
     */
    public function message($id)
    {   
        if (IS_POST) {
 
            // 接收数据
            // 尊敬的${content}，测试喝水建议。
            $phone = $_POST['phone'];
            $content = '用户' . $_POST['name'] . '您好！'.$_POST['content'];

            // 开始接口代码
            $sms = new \Org\Util\SmsDemo;
            $response = $sms::sendSms(
                "阿里云短信测试专用", // 短信签名
                "SMS_112475574", // 短信模板编号
                $phone, // 短信接收者
                Array(  // 短信模板中字段的值
                    "content"=>$content,
                    "product"=>"dsd"
                ),
                "123"   // 流水号,选填
            );

            // 信息推送状态判断
            if($response->Code=='OK'){
                $this->error('消息推送成功！');
            }else{
                $this->error('消息推送失败，错误码：' . $response->Code);
            }

        }else{
            $user = M('users');
            $userinfo = $user->where('id='.$id)->select();
            $this->assign('list',$userinfo);
            $this->display();
        }
    }

    public function user_info()
    {
//        dump(I(''));die;
        $map['open_id'] = I('get.open_id');
        // 微信用户信息
        $user = M('wechat')->where($map)->find();

        // 显示用户基础信息
        $userinfo = M('users')
            ->alias('u')
            ->where($map)
            ->join('__DEVICES__ d ON u.id=d.uid', 'LEFT')
            ->select();

        // 充值记录
        $did = array();
        $code = array();
        foreach ($userinfo as $key => $value) {
            $did[]  = $value['id'];
            $code[] = $value['device_code'];
        }
        $where['_query'] = "status=1";
        if(!empty($did)){
            $where['did']    = array('in',$did);
        }
        $flow    = M('flow')->where($where)->order('addtime desc')->select();

        $balance=[];
        if(!empty($code)){
             $balance = M('devices_statu')
            ->where(['DeviceID' => ['in',$code]])
            ->field('DeviceID,ReFlow')
            ->select();
        }
   
        // 分配数据
        $assign = [
            'userinfo' => json_encode($userinfo),
            'user'     => json_encode($user),
            'flow'     => json_encode($flow),
            'balance'  => json_encode($balance),
        ];
        $this->assign($assign);
        $this->display();

    }


    /**
     * 编辑用户方法
     * @author 潘宏钢 <619328391@qq.com>
     */
    public function edit($id,$status)
    {
        $users = M("users");
        $data['status'] = $_GET['status'];
        $res = $users->where('id='.$id)->save($data); 
        if ($res) {
             $this->redirect('users/index');
        } else {
            $this->error('修改失败啦！');
        }
    }

    /**
     * 用户充值流水列表
     * @author 潘宏钢 <619328391@qq.com>
     */
    public function flow()
    {
        // if (IS_POST) {
        //     dump($_POST);die;
        // }
        
        require_once VENDOR_PATH.'PHPExcel.php';
        $phpExcel = new \PHPExcel();

        // 搜索功能
        $map = array(
            'f.id' => trim(I('post.id')),
            'd.name' => trim(I('post.name')),
            'f.flow' => trim(I('post.flow')),
            'f.mode' => trim(I('post.mode')),
            '_query' => "status=1",
        );
        $minmoney = trim(I('post.minmoney'))?:0;
        $maxmoney = trim(I('post.maxmoney'))?:-1;
        if (is_numeric($maxmoney)) {
            $map['f.money'] = array(array('egt',$minmoney*100),array('elt',$maxmoney*100));
        }
        if ($maxmoney < 0) {
            $map['f.money'] = array(array('egt',$minmoney*100));      
        }
        $minflow = trim(I('post.minflow'))?:0;
        $maxflow = trim(I('post.maxflow'))?:-1;
        if (is_numeric($maxflow)) {
            $map['f.flow'] = array(array('egt',$minflow),array('elt',$maxflow));
        }
        if ($maxflow < 0) {
            $map['f.flow'] = array(array('egt',$minflow));      
        }
        $mincurrentflow = trim(I('post.mincurrentflow'))?:0;
        $maxcurrentflow = trim(I('post.maxcurrentflow'))?:-1;
        if (is_numeric($maxcurrentflow)) {
            $map['f.currentflow'] = array(array('egt',$mincurrentflow),array('elt',$maxcurrentflow));
        }
        if ($maxcurrentflow < 0) {
            $map['f.currentflow'] = array(array('egt',$mincurrentflow));      
        }  
        // 删除数组中为空的值
        $map = array_filter($map, function ($v) {
            if ($v != "") {
                return true;
            }
            return false;
        });

        if($this->get_level()){
            $map['bd.vid'] = $_SESSION['adminuser']['id'];

        }


        $flow = M('flow');
        // PHPExcel 导出数据 
        if (I('output') == 1) {
            $data = $flow->where($map)
                ->alias('f')
                ->join('__DEVICES__ d ON f.did=d.id','LEFT')
                ->join('__USERS__ u ON d.uid=u.id', 'LEFT')
                ->join('__BINDING__ bd ON d.id = bd.did ')
                ->field('f.id,d.name,f.money,f.flow,f.currentflow,f.mode,f.addtime')
                ->select();
            $filename = '充值记录数据';
            $title = '充值记录';
            $cellName = ['充值流水id','用户昵称','充值金额','充值流量（天）','账户余量（天）','充值方式','充值时间'];
            // dump($data);die;
            $myexcel = new \Org\Util\MYExcel($filename,$title,$cellName,$data);
            $myexcel->output();
            return ;
        }       

        $total = $flow->where($map)
            ->alias('f')
            ->join('__DEVICES__ d ON f.did=d.id','LEFT')
            ->join('__USERS__ u ON d.uid=u.id', 'LEFT')
            ->join('__BINDING__ bd ON d.id = bd.did ')
            ->field('f.*,d.name,u.balance')
            ->count();
        $page  = new \Think\Page($total,8);
        $pageButton =$page->show();

        $list = $flow->where($map)->limit($page->firstRow.','.$page->listRows)
            ->alias('f')
            ->join('__DEVICES__ d ON f.did=d.id','LEFT')
            ->join('__USERS__ u ON d.uid=u.id', 'LEFT')
            ->join('__BINDING__ bd ON d.id = bd.did ')
            ->field('f.*,d.name,u.balance,bd.vid')
            ->select();
        $this->assign('list',$list);
        $this->assign('button',$pageButton);
        $this->display();        
    }

    
    // 解除用户绑定
    public function unbind()
    {
        $code['device_code'] = I('post.device_code');
        $data = [
            'uid' => null,
            'name' => null,
            'address' => null,
            'phone' => null,
        ];
        $device = M('devices');
        $current_devices = M('current_devices');

        $deviceInfo = $device->where($code)->find();
        $did = $deviceInfo['id'];
        $uid = $deviceInfo['uid'];
        $device->startTrans();
        $current_devices->startTrans();
        $current_device = $current_devices->where('did='.$did)->find();
        if(!empty($current_device)){
            $bind_device = $device->where('uid='.$uid)->select();
            if(count($bind_device) == 1){
                $current_status = $current_devices->where('did='.$did)->delete();
            } else {
                foreach ($bind_device as $key => $value) {
                    $device_tmp[$key] = $value['id'];
                    if($value['id'] == $did){
                        unset($device_tmp[$key]);
                    }
                    $device_tmp[0] = $device_tmp[$key];
                }
                $current_status = $current_devices->where('uid='.$uid)->save(['did'=>$device_tmp[0]]);
            }
            if($current_status){
                $current_devices->commit();
            } else {
                $current_devices->rollback();
                $this->ajaxReturn(['code'=>203,'msg'=>'解绑失败']);
            }
        }

        $status['status'] = 0;
        $orders = M('orders')->where('device_id='.$deviceInfo['id'])->find();
        $flow = M('flow')->where('did='.$deviceInfo['id'])->find();
        // 订单记录判断回滚
        if($order){
            $orders_status = M('orders')->where('device_id='.$deviceInfo['id'])->save($status);
        } else {
            $orders_status = true;
        }

        if($flow){
            $flow_status = M('flow')->where('did='.$deviceInfo['id'])->save($status);
        } else {
            $flow_status = true;
        }

        $device_status = $device->where('id='.$deviceInfo['id'])->save($data);
        // 设备状态判断回滚
        if($device_status && $orders_status){
            $device->commit();
            $this->ajaxReturn(['code'=>200,'msg'=>'解绑成功']);
        } else {
            $device->rollback();
            $this->ajaxReturn(['code'=>203,'msg'=>'解绑失败']);
        }
    }
}
