<?php

namespace Home\Controller;

use Think\Controller;

class SystemController extends Controller {

    public function index() {
        $username = session("username");
        if ($username == null) {
            $this->assign("username", 1);
        }
        $tfk = M('order')->where("order_state=1")->count();
        $wfk = M('order')->where("order_state=0")->count();
        $this->assign("fpay", $wfk);
        $this->assign("tpay", $tfk);
        $this->display();
    }

    public function c_order() {
        $orderid = $_GET['orderid'];
        $shopdata = M('order')->where("order_id='$orderid'")->find();
//        var_dump($shopdata);
        $this->assign('shopdata', $shopdata);
        $this->display();
    }

    //购物车
    public function cart() {
        $user_id = session('id');
        $username = session("username");
        if ($username != null) {
            $shopdata = M('shopping')->where("user_id='$user_id'")->select();
            $this->assign('shopdata', $shopdata);
        } else {
            $this->assign('datamess', '123');
        }
        $this->display();
    }

//购物车删除操作
    public function cdelete() {
        $name = $_POST['name'];
        $data = '';
        $a = M('shopping')->where("sc_foodname='$name'")->delete();
        if ($a) {
            $data = 1;
        } else {
            $data = 2;
        }
        $this->ajaxReturn($data);
    }

    //查询座位
    public function getseatlist() {

        $seatlist = M("seat");
        $data = $seatlist->where("state=1")->select();
        $this->ajaxReturn($data);
    }

    //设置座位状态
    public function setseat() {
        $id = $_POST['state'];
        $seat = M("seat");
        $seat->where("id='$id'")->setField("state", '0');
    }

    function counts() {
        $user_id = session('id');
        $countdata = M('shopping')->where("user_id='$user_id'")->count();
        $this->ajaxReturn($countdata);
    }

//留言分页
    public function user_message() {
        $user_id = session('id');
//        $me=M('leave')->where("user_id='$user_id'")->select();
        $User = M('leave'); // 实例化User对象
        $count = $User->where("user_id='$user_id'")->count(); // 查询满足要求的总记录数
        $Page = new \Think\Page($count, 3); // 实例化分页类 传入总记录数和每页显示的记录数(25)
        $Page->setConfig('header', '<li class="rows">共<b>%TOTAL_ROW%</b>条记录&nbsp;第<b>%NOW_PAGE%</b>页/共<b>%TOTAL_PAGE%</b>页</li>');
        $Page->setConfig('prev', '上一页');
        $Page->setConfig('next', '下一页');
        $Page->setConfig('last', '末页');
        $Page->setConfig('first', '首页');
        $Page->setConfig('theme', '%FIRST%%UP_PAGE%%LINK_PAGE%%DOWN_PAGE%%END%%HEADER%');
        $Page->lastSuffix = false; //最后一页不显示为总页数
        $show = $Page->show(); // 分页显示输出// 进行分页数据查询 注意limit方法的参数要使用Page类的属性
        $list = $User->where("user_id='$user_id'")->order('id')->limit($Page->firstRow . ',' . $Page->listRows)->select();
//        $this->assign('list',$list);// 赋值数据集
        $this->assign("message", $list);
        $this->assign('page', $show); // 赋值分页输出
        $this->display();
    }

    //查询订单
    public function user_orderlist() {
        if ($_SESSION['username'] == null) {
            $this->assign("erromassgin", "请先登录");
            $this->display('Login/index');
        } else {
            $username = $_SESSION['username'];
            $User = M('order');
//            $list = $User->where("order_userid='$username'")->select();
            $count = $User->where("order_userid='$username'")->count();
            $Page = new \Think\Page($count, 4); // 实例化分页类 传入总记录数和每页显示的记录数(25)
            $Page->setConfig('header', '<li class="rows">共<b>%TOTAL_ROW%</b>条记录&nbsp;第<b>%NOW_PAGE%</b>页/共<b>%TOTAL_PAGE%</b>页</li>');
            $Page->setConfig('prev', '上一页');
            $Page->setConfig('next', '下一页');
            $Page->setConfig('last', '末页');
            $Page->setConfig('first', '首页');
            $Page->setConfig('theme', '%FIRST%%UP_PAGE%%LINK_PAGE%%DOWN_PAGE%%END%%HEADER%');
            $Page->lastSuffix = false; //最后一页不显示为总页数
            $show = $Page->show(); // 分页显示输出// 进行分页数据查询 注意limit方法的参数要使用Page类的属性
            $list = $User->where("order_userid='$username'")->order('order_time desc')->limit($Page->firstRow . ',' . $Page->listRows)->select();
            foreach ($list as $k => $v) {
                if ($list[$k]['order_state'] == 1) {
                    $list[$k]['order_state'] = '已付款';
                } else {
                    $list[$k]['order_state'] = '未付款';
                }
            }
            $this->assign('page', $show);
            $this->assign('list', $list);
            $this->display();
        }
    }

    function sporder() {
        $name = $_POST['foodname'];
        $number = $_POST['number'];
        
    }

//结算页面
    public function confirm_order() {
        //var_dump($_POST);
        $food = $_GET['count'];
        $datafood = '';
        foreach (explode(',', $food) as $key => $value) {
            $exp = explode(":", $value);
            $hi = M('shopping')->where("sc_foodname='$exp[0]'")->find();
            $r = array(
                "sc_count" => $exp[1],
                "sc_total" => $hi['sc_price'] * $exp[1]
            );
            M("shopping")->where("sc_foodname='$exp[0]'")->setField($r);
            $datafood = M("shopping")->where("sc_foodname='$exp[0]'")->find();
            $v = $datafood['id'] . ',' . $v;
        }
        $whered = substr($v, 0, -1);
        $shopdata = M('shopping')->where("id in ($whered)")->select();
        $this->assign('shopdata', $shopdata);
        $this->display();
    }

    public function user_account() {
        $user_id = session('id');
        $username = session("username");
        if ($username != null) {
            $data = M('user')->where("username='$username'")->find();
            $this->assign('userdata', $data);
        }
//        var_dump($data);
//        die();
        $this->display();
    }

//修改密码
    public function upinformation() {
        if (!empty($_POST)) {
            $email = $_POST['email'];
            $tel = $_POST['tel'];
            $ypassword = $_POST['ypassword'];
            $password = $_POST['password'];
            $id = session('id');
            $message = '';
            $m = M('user')->where("id='$id'")->find();
            if ($m['password'] != $ypassword) {
                $message = "1";
                $this->ajaxReturn($message);
            }
            $data = array('email' => $email, 'telephone' => $tel, 'password' => $password);
            $arr = M("user")->where("id='$id'")->setField($data);
            if ($arr) {
                $message = "2";
                $this->ajaxReturn($message);
            }
        }
    }

//添加留言
    function userleave() {
        $leave = $_POST['leave'];
        $data['content'] = $leave;
        $data['user_id'] = session('id');
        $data['leavedata'] = date("Y-m-d");
        $m = M('leave')->add($data);
        $message = '';
        if ($m) {
            $message = '留言成功';
        }
        $this->ajaxReturn($message);
    }

//删除留言
    function dmessage() {
        $id = $_POST['id'];
        $mss = M('leave')->where("id='$id'")->delete();
        if ($mss) {
            $this->ajaxReturn("删除成功");
        }
    }

}

?>