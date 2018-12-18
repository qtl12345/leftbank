<?php
/**
 * Created by PhpStorm.
 * User: 袁
 * Date: 2018/10/18
 * Time: 11:22
 */

namespace Admin\Controller;


use Think\Controller;

class OrderController extends Controller
{
    public function order()
    {
        $this->display();
    }
    //查询订单
    public function select(){
        $fl=$_POST['datatype'];
        if($fl=='fl'){
            $pageIndex = $_POST['page']; //当前页码页码
            $pageSize = $_POST['rows']; //每页显示行
            $count = M('order')->count();
            $startno = ($pageIndex - 1) * $pageSize;
            $limit = $startno . ',' . $pageSize;
            $map['order_id'] = array('like', array('%' . $_POST['lb'] . '%'), 'OR');
            $studentList = M('order')->where($map)->order('order_id asc')->limit($limit)->select();
            foreach ($studentList as $k => $v) {

                if ( $studentList[$k]['order_state'] == '1') {
                    $studentList[$k]['order_state'] = '已付款';
                }else  {
                    $studentList[$k]['order_state'] = '未付款';
                }
                
                
                 if ( $studentList[$k]['order_table'] == '0') {
                    $studentList[$k]['order_table'] = '无座';
                }
            }
            $result = array(
                "total" => $count, //记录总数
                "rows" => $studentList  //记录
            );
            $this->ajaxReturn($result, 'JSON');
        }else{
            $pageIndex = $_POST['page']; //当前页码页码
            $pageSize = $_POST['rows']; //每页显示行

            $count = M('order')->count();

            $startno = ($pageIndex - 1) * $pageSize;
            $limit = $startno . ',' . $pageSize;

            $studentList = M('order')->order('order_id asc')->limit($limit)->select();
            foreach ($studentList as $k => $v) {

                if ( $studentList[$k]['order_state'] == '1') {
                    $studentList[$k]['order_state'] = '已付款';
                }else  {
                    $studentList[$k]['order_state'] = '未付款';
                }
            }
            $result = array(
                "total" => $count, //记录总数
                "rows" => $studentList  //记录
            );
            $this->ajaxReturn($result, 'JSON');
        }
    }
    //删除订单
    public function del(){
        $id=$_POST['id'];
        $D=M('order')->where("order_id='$id'")->delete();
        if($D){
            $msg="删除成功";
            $this->ajaxReturn($msg,'json');

        }else{
            $msg="删除失败";
            $this->ajaxReturn($msg,'json');
        }

    }
}