<?php
/**
 * Created by PhpStorm.
 * User: 袁
 * Date: 2018/10/16
 * Time: 9:27
 */

namespace Admin\Controller;


use Think\Controller;

class SeatController extends Controller
{
    public function seat()
    {
        $this->display();
    }

    public function select()
    {
        $pageIndex = $_POST['page']; //当前页码页码
        $pageSize = $_POST['rows']; //每页显示行

        $count = M('seat')->count();

        $startno = ($pageIndex - 1) * $pageSize;
        $limit = $startno . ',' . $pageSize;

        $studentList = M('seat')->order('id asc')->limit($limit)->select();



        foreach ($studentList as $k => $v) {
            if ($studentList[$k]['state'] == '1') {
                $studentList[$k]['state'] = '未满';
            }
            if ($studentList[$k]['state'] == '0') {
                $studentList[$k]['state'] = '已满';
            }
        }
        $result = array(
            "total" => $count, //记录总数
            "rows" => $studentList  //记录
        );
        $this->ajaxReturn($result, 'JSON');

    }
    //查询类别
    public function selectLB()
    {
            $id = $_POST['lbs_id'];
            $model = D('seat');
            if ($id != -1) {
                $fft=$model->where("state='$id'")->select();
                foreach ($fft as $k => $v) {
                    if ($fft[$k]['state'] == '1') {
                        $fft[$k]['state'] = '未满';
                    }
                    if ($fft[$k]['state'] == '0') {
                        $fft[$k]['state'] = '已满';
                    }
                }
                $this->ajaxReturn($fft, 'json');

            } else {
                $fft=$model->select();
                foreach ($fft as $k => $v) {
                    if ($fft[$k]['state'] == '1') {
                        $fft[$k]['state'] = '未满';
                    }
                    if ($fft[$k]['state'] == '0') {
                        $fft[$k]['state'] = '已满';
                    }
                }
                $this->ajaxReturn($fft, 'json');
            }




    }

    //添加座位
    public function add()
    {
        $data['state'] = $_POST['state'];
        if ($_POST['state'] == '请选择'||$_POST['state'] == -1){
            $msg = "请选择状态";
            $this->ajaxReturn($msg);
        }
        $st = D('seat')->add($data);
        if ($st) {
            $msg = '保存成功';
            $this->ajaxReturn($msg);
        } else {
            $msg = '保存失败';
            $this->ajaxReturn($msg);
        }
    }

    //修改信息
    public function edit()
    {
        $id = $_POST['id'];
        $da = $_POST['work'];
        $data['id'] = $_POST['work'];
        //$data['number'] = $_POST['number'];
        //$data['work'] = $_POST['work'];
        $data['state'] = $_POST['state'];
        if ($_POST['state'] == '请选择'||$_POST['state'] == -1){
            $msg = "请选择状态";
            $this->ajaxReturn($msg);
        }
        if ($_POST['state'] =='未满' ){
            $data['state'] =1;
        }
        if ($_POST['state'] =='已满'){
            $data['state'] =0;
        }
        $list=M('seat')->getField('id',true);
        if($_POST['id']==$_POST['work']){
            $se = D('seat')->where("id='$id'")->save($data);
            if ($se) {
                $msg = "修改成功";
                $this->ajaxReturn($msg);
            } else {
                $msg = "修改失败";
                $this->ajaxReturn($msg);
            }
        }elseif (in_array("$da", $list)){
            $msg = "餐桌重复";
            $this->ajaxReturn($msg);
        }



    }
    //删除座位
    public function del(){
        $id = $_POST['id'];
        $se = D('seat')->where("id='$id'")->delete();
        if ($se) {
            $msg = "删除成功";
            $this->ajaxReturn($msg);
        } else {
            $msg = "删除失败";
            $this->ajaxReturn($msg);
        }
    }
}