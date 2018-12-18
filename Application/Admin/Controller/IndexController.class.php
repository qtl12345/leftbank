<?php
namespace Admin\Controller;
use Think\Controller;
class IndexController extends Controller {
    public function index()
    {
        $id = session('ids');
        if($id){
            $this->display();
        }else{
            $this->display('Login/login');
        }

    }
    //安全退出
    public function tuichu(){
        session(null); // 清空当前的session
        $this->success('正在退出...','http://127.0.0.1/zuoan/index.php/Admin/Login/login',3);
    }
}