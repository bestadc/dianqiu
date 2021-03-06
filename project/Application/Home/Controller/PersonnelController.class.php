<?php
namespace Home\Controller;
use Think\Controller;
use \Org\Util\WeixinJssdk;
/**
 * 安装人员系统
 */
class PersonnelController extends Controller
{

    function _initialize(){

        if (session('pid') == null) {
            $this->error('你未登陆',U('home/users/login'),2);
        }

    }
    public function dcode() {
        $data = I('post.');

        $info = M('devices')->where(['devices_code'=>$data['dcode']])->find();
        if ($info) {
            return $this->ajaxReturn(['code'=>200]);
        } else {
            return $this->ajaxReturn(['code'=>404,'message'=>'查询不到该设备']);
        }
    }
    /*
     * 安装人员登录成功首页
     */
    public function index()
    {

        $this->display('index');

    }
    /*
     * 点击安装之后页面
     */
    public function personal(){
        //个人资料
        $user= M('personnel')->field('name,phone')->where('id', '=',session('pid'))->find();
        //未安装统计
        $not_install= M('work')->where(['result'=>0,'type'=>0,'personnel_id'=>session('pid')])->count();
        //安装统计
        $install= M('work')->where(['result'=>2,'type'=>0,'personnel_id'=>session('pid')])->count();
        $this->assign('user', $user);
        $this->assign('not_install', $not_install);
        $this->assign('install', $install);
        $this->display();
    }
    /*
     * 安装设备列表
     */
    public function dutyList(){
        //处理结果(0：未处理 1：正在处理 2：已处理)
        $where['result'] = I('get.result');
        //工单类型(0：安装 1：维修 2：维护)
        $where['type'] = 0;
        //安装人
        $where['personnel_id'] = session('pid');
        $list = M('work')->field('number,dcode,id')->where($where)->select();
        $this->assign('list', $list);
        $this->display();
    }
    /*
     * 安装设备添加
     */
    public function infoDetail($id)
    {
        $map = I('post.');

        $map['personnel_id'] = session('pid');
        $map['id'] = $id;
        //查询数据
        $perSonnel_info = D('Personnel');
        $info = $perSonnel_info->per_detail($map);

        if (IS_POST) {

            $status = $perSonnel_info->status($map);
            if ($status['code']==403) {
                $this->error($status['message']);
            } else {
                $vid = $status['data'];
            }
            $data = I('post.');
            $data['pid'] = $map['personnel_id'];
            $data['vid'] = $vid;
            $add_info = M('install')->add($data);
            if ($add_info) {
                $work_info = M('work')->where(['id'=>$map['id'],'personnel_id'=>$map['personnel_id']])->save(['dcode'=>$map['dcode'],'result'=>2]);
                if ( $work_info) {

                    $this->success('安装成功',U('home/Personnel/personal'),2);
                } else {
                    $this->error('安装失败');
                }
            }
        } else {
            $this->assign('info',$info);
            $this->display();
        }

    }
    /*
     * 充值
     */
    public function topup() {
        $this->display('chongzhi');
    }
}