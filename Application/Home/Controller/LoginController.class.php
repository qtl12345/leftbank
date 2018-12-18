<?php

namespace Home\Controller;

use Think\Controller;
use Think\Verify;

class LoginController extends Controller {

    public function index() {
        //  $this->show('<style type="text/css">*{ padding: 0; margin: 0; } div{ padding: 4px 48px;} body{ background: #fff; font-family: "微软雅黑"; color: #333;font-size:24px} h1{ font-size: 100px; font-weight: normal; margin-bottom: 12px; } p{ line-height: 1.8em; font-size: 36px } a,a:hover{color:blue;}</style><div style="padding: 24px 48px;"> <h1>:)</h1><p>欢迎使用 <b>ThinkPHP</b>！</p><br/>版本 V{$Think.version}</div><script type="text/javascript" src="http://ad.topthink.com/Public/static/client.js"></script><thinkad id="ad_55e75dfae343f5a1"></thinkad><script type="text/javascript" src="http://tajs.qq.com/stats?sId=9347272" charset="UTF-8"></script>','utf-8');
        $this->display();
    }

    public function head() {
        $this->display();
    }

    public function register() {
        $this->display();
    }

    public function user_orderlist() {
        $this->display();
    }

    //登录判断
    function dologin() {

        $erromassgin = "";
        $username = $_POST['name'];

        $very = new Verify();
        $d = M('user')->where("username='$username'")->find();
        if ($d['state'] == 1) {
            if ($very->check($_POST['veriy'])) {

                $m = M('user');
                $d = $m->where("username='$username'")->find();

                if ($d) {
                    if ($d['password'] == $_POST['pwd']) {
                        session("username", $d['username']);
                        session("id", $d['id']);
                        $this->assign("rule", $d['username']);
//                    $this->display("Index/index");
                        redirect("/zuoan/index.php/Home/Index/index");
                    } else {
                        $erromassgin = "用户名或密码错误";
                        $this->assign('erromassgin', $erromassgin);
                    }
                } else {
                    $erromassgin = "用户名密码错误";
                    $this->assign('erromassgin', $erromassgin);
                }
            } else {
                $erromassgin = "验证码错误!";

                $this->assign('erromassgin', $erromassgin);
            }
        } else {
            $erromassgin = "该用户已被锁定!";
             $this->assign('erromassgin', $erromassgin);
        }

        $this->display("Login/index");

        // var_dump($_POST);   
    }

    //注册 
    function doregister() {

        $errinfo = '';
        $username = $_POST['name'];
        //  $email = $_POST['email'];
        $verify = new Verify();
        $user = M('user');
        $usernamestat = $user->where("username='$username'")->find();
        // $emailstat =$user->where("email='$email'")->find();
//        if ($verify->check($_POST['captcha'])) {
        if ($_POST['pwd'] == $_POST['repwd']) {

            if (!$usernamestat) {

                $User = M("user"); // 实例化User对象
                $data['username'] = $_POST['name'];
                $data['password'] = $_POST['pwd'];
                $data['email'] = $_POST['email'];
                $data['telphone'] = $_POST['phone'];
                $User->add($data);
                $this->success("注册成功！","/zuoan/index.php/Home/Login/index", 3);
               // redirect("/zuoan/index.php/Home/Login/index", 3, '注册成功！');
            } else {
                $errinfo = "用户名已存在！";
                $this->assign('errinfo', $errinfo);
                 $this->display('Login/register');
            }
        } else {
            $errinfo = "两次密码不一致！";
            $this->assign('errinfo', $errinfo);
             $this->display('Login/register');
        }
//        } else {
//            $errinfo = "验证码错误！";
//            $this->assign('errinfo', $errinfo);
//        }
        //   redirect('/zuoan/index.php/Home/register',array('errinfo'=>$errinfo));
       
    }

    //验证码
    function captchaImg() {
        $config = array('fontSize' => 30, // 验证码字体大小   
            'length' => 4, // 验证码位数   
            'codeSet' => '1234567890',
            'useCurve' => false,
        );
        $Verify = new Verify($config);
        $Verify->entry();
    }

}
