<?php
/**
 * Created by PhpStorm.
 * User: 袁
 * Date: 2018/10/21
 * Time: 10:17
 */

namespace Admin\Controller;


use Think\Controller;

class MerchantsController extends Controller
{
    public function merchants()
    {
        $this->display();
    }
    //查询数据
    public function select(){
        $pageIndex = $_POST['page']; //当前页码页码
        $pageSize = $_POST['rows']; //每页显示行

        $count = M('merchants')->count();

        $startno = ($pageIndex - 1) * $pageSize;
        $limit = $startno . ',' . $pageSize;

        $studentList = M('merchants')->order('id asc')->limit($limit)->select();
        $result = array(
            "total" => $count, //记录总数
            "rows" => $studentList  //记录
        );
        $this->ajaxReturn($result, 'JSON');

       // $m=D('merchants')->select();
        //$this->ajaxReturn($m,'json');
    }
    //修改数据
    public function edit(){
        $id=$_POST['id'];
        $data['name']=$_POST['name'];
        $data['head']=$_POST['head'];
        $data['password']=$_POST['password'];
        $data['tel']=$_POST['tel'];
        $data['address']=$_POST['address'];
        $m=D('merchants')->where("id=$id")->save($data);
        if($m){
            $msg="修改成功";
            $this->ajaxReturn($msg,'json');
        }else{
            $msg="修改失败";
            $this->ajaxReturn($msg,'json');
        }

    }
}