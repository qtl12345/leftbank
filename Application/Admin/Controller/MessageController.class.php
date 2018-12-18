<?php
/**
 * Created by PhpStorm.
 * User: 袁
 * Date: 2018/10/30
 * Time: 8:42
 */

namespace Admin\Controller;


use Think\Controller;

class MessageController extends Controller
{
//留言管理
    public function message()
    {
        $this->display();
    }
    //查询留言
    public function select()
    {
        $pageIndex = $_POST['page']; //当前页码页码
        $pageSize = $_POST['rows']; //每页显示行

        $count = M('leave')->count();

        $startno = ($pageIndex - 1) * $pageSize;
        $limit = $startno . ',' . $pageSize;

        $l = M('leave')->order('id asc')->limit($limit)->select();
        foreach ($l as $k=>$v){
            $id=$l[$k]['user_id'];
            $l[$k]['user_name']=D('user')->where("id='$id'")->getField('username');
        }
        $result = array(
            "total" => $count, //记录总数
            "rows" => $l  //记录
        );
        $this->ajaxReturn($result, 'JSON');

    }
    //删除留言
    public function del(){
        $id=$_POST['id'];
        $ly=D('leave')->where("id='$id'")->delete();
        if($ly){
            $msg="删除成功";
            $this->ajaxReturn($msg, 'JSON');
        }else{
            $msg="删除失败";
            $this->ajaxReturn($msg, 'JSON');
        }
    }

}