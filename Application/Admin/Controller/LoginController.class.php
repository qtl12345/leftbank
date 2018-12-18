<?php


namespace Admin\Controller;


use Think\Controller;

class LoginController extends Controller
{
    //登陆页面
    public function login()
    {
        $this->display();
    }

    //登陆判断
    public function landing()
    {
        $user=$_POST['login'];
        $pwd=$_POST['pwd'];
        $u=M('merchants')->where("password ='$pwd' and head ='$user'")->getField('id');
        if($u){
            session('user',$user);  //设置session
            session('ids',$u);  //设置session
            $this->ajaxReturn($u, 'JSON');
           // $this->success('登陆成功','Idex/index',3);
        }else{
            $this->ajaxReturn($u, 'JSON');
        }

    }
}