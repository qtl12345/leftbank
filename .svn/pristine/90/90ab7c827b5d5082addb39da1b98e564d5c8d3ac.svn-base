<?php
/**
 * Created by PhpStorm.
 * User: 袁
 * Date: 2018/10/11
 * Time: 10:58
 */

namespace Admin\Controller;


use Think\Controller;

class SortController extends Controller
{
    //类别管理
    public function sort()
    {
        $this->display();
    }

    //查询类别数据
    public function select()
    {

        if ($_POST['datatype'] == 'lb') {
            $pageIndex = $_POST['page']; //当前页码页码
            $pageSize = $_POST['rows']; //每页显示行
            $count = M('foodsort')->count();
            $startno = ($pageIndex - 1) * $pageSize;
            $limit = $startno . ',' . $pageSize;
            $map['foodname'] = array('like', array('%' . $_POST['lb'] . '%'), 'OR');
            $studentList = M('foodsort')->where($map)->order('id asc')->limit($limit)->select();
            $result = array(
                "total" => $count, //记录总数
                "rows" => $studentList  //记录
            );
            $this->ajaxReturn($result, 'JSON');

        } else {
            $pageIndex = $_POST['page']; //当前页码页码
            $pageSize = $_POST['rows']; //每页显示行
            $count = M('foodsort')->count();
            $startno = ($pageIndex - 1) * $pageSize;
            $limit = $startno . ',' . $pageSize;
            $studentList = M('foodsort')->order('id asc')->limit($limit)->select();
            $result = array(
                "total" => $count, //记录总数
                "rows" => $studentList  //记录
            );
            $this->ajaxReturn($result, 'JSON');

        }


    }

    //添加菜品类别
    public function add()
    {
        $fooodname = $_POST['foodname'];
        $foods = D('foodsort');
        $old = $foods->Field('foodname')->select();
        foreach ($old as $k => $v) {
            if ($fooodname == $v['foodname']) {
                $alert = '菜品名重复';
               $this->ajaxReturn($alert, 'json');
            }
        }

        $data['foodname']=$_POST['foodname'];
        $num=$foods->add($data);
        if($num){
            $alert = '添加成功';
            $this->ajaxReturn($alert, 'json');
        }


    }
    //修改菜谱类别
    public function edit(){
        $id=$_POST['id'];
        $data['fooodname'] = $_POST['name'];
        $data['food_id']=$_POST['id'];
        $food=D('foodsort');
        $num=$food->where("id='$id'")->setField('foodname',$data['fooodname']);
        if($num){
            $type='修改成功！';
            $this->ajaxReturn($type, 'json');
        }else{
            $type='修改失败！';
            $this->ajaxReturn($type, 'json');
        }

    }
    //删除菜谱类别
    public function del(){
        $id=$_POST['id'];
        $food=D('foodsort');
        $num=$food->where("id='$id'")->delete();
        if($num){
            $msg='删除成功！';
            $this->ajaxReturn($msg, 'json');
        }else{
            $msg='删除失败！';
            $this->ajaxReturn($msg, 'json');
        }
    }
}