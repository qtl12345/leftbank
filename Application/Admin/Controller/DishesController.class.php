<?php
/**
 * Created by PhpStorm.
 * User: 袁
 * Date: 2018/10/15
 * Time: 8:20
 */

namespace Admin\Controller;


use Think\Controller;

class DishesController extends Controller
{
    //菜名管理
    public function dishes()
    {
        $this->display();
    }

    //查询菜名
    public function select()
    {
        $pageIndex = $_POST['page']; //当前页码页码
        $pageSize = $_POST['rows']; //每页显示行

        $count = M('foodname')->count();

        $startno = ($pageIndex - 1) * $pageSize;
        $limit = $startno . ',' . $pageSize;

        $studentList = M('foodname')->order('id asc')->limit($limit)->select();
        $result = array(
            "total" => $count, //记录总数
            "rows" => $studentList  //记录
        );
        $this->ajaxReturn($result, 'JSON');
    }


    //查询类别
    public function selectLB()
    {
        if ($_POST['datatype'] == 'lbs') {
            $id = $_POST['lbs_id'];
            $gjz = $_POST['gjz'];
            $model = D();
            if ($id != "请选择") {
                if ($gjz != '') {
                    $fft = $model->query("select * from foodname where fs_id='$id' and  f_name like '%$gjz%'");
                } else {
                    $fft = $model->query("select * from foodname where fs_id='$id' ");
                }
            } else {
                if ($gjz != '') {
                    $fft = $model->query("select * from foodname where f_name like '%$gjz%'");
                } else {
                    $fft = $model->query('select * from foodname');
                }
            }
            $this->ajaxReturn($fft, 'json');
        } else {
            $ft = D('foodsort')->select();
            $this->ajaxReturn($ft, 'json');
        }

    }

    //图片上传
    function savePhoto()
    {

        $config = array(
            'rootPath' => './Public/images/', //保存根路径
            'saveName' => $_POST['name'], //上传文件命名规则，[0]-函数名，[1]-参数，多个参数使用数组
            'replace' => true, //存在同名是否覆盖
            'autoSub' => false, //不生成时间目录
        );
        $upload = new \Think\Upload($config); // 实例化上传类
        // 上传文件
        $info = $upload->upload();
        if (!$info) {// 上传错误提示错误信息
            $gg = $this->error($upload->getError());
        } else {// 上传成功 获取上传文件信息
            foreach ($info as $file) {
                $gg = $file['savepath'] . $file['savename'];
            }
        }
        $this->ajaxReturn($gg, 'json');
    }

    //添加保存
    public function save()
    {
        $data['fs_id'] = $_POST['lb'];
        $data['f_name'] = $_POST['foodname'];
        $data['f_price'] = $_POST['price'];
        $fg=D('foodname')->Field('f_name')->select();
        foreach ($fg as $k => $v) {
            if ( $_POST['foodname'] == $v['f_name']) {
                $alert = '菜名重复';
                $this->ajaxReturn($alert, 'json');
            }
        }
        if ($_POST['face'] == "") {
            if ($_POST['studentFace'] == '') {
                $data['f_picture'] = 'noface.gif';
            } else {
                $data['f_picture'] = trim(strrchr($_POST['studentFace'], '/'), '/');//照片
            }
        } else {
            $data['f_picture'] = $_POST['face']; //照片
        }
        $ffs = D('foodname')->data($data)->add();
        if ($ffs) {
            $s = '保存成功';
            $this->ajaxReturn($s, 'json');
        } else {
            $s = '保存失败';
            $this->ajaxReturn($s, 'json');
        }

    }

    //修改菜单
    public function edit()
    {
        $id = $_POST['id'];
        $data['fs_id'] = $_POST['lb'];
        $data['f_name'] = $_POST['foodname'];
        $data['f_price'] = $_POST['price'];
        $fg=D('foodname')->Field('f_name')->select();
        if ($_POST['face'] == "") {
            //$data['f_picture'] = 'noface.gif';
            $data['f_picture'] = trim(strrchr($_POST['studentFace'], '/'), '/');//照片
        } else {
            $data['f_picture'] = $_POST['face']; //照片
        }
        foreach ($fg as $k => $v) {
            if ( $_POST['foodname'] == $v['f_name']) {
                if($_POST['face']==$v['f_picture']){
                    if($_POST['price']==$v['price']){
                        $alert = '菜名重复';
                        $this->ajaxReturn($alert, 'json');
                    }

                }

            }
        }

        $food = D('foodname')->where("id='$id'")->save($data);
        //$food=true;
        if ($food) {
            $msg = "修改成功";
            // $msg=trim(strrchr($_POST['studentFace'], '/'),'/');
            $this->ajaxReturn($msg, 'json');
        } else {
            $msg = "修改失败";
            $this->ajaxReturn($msg, 'json');
        }


    }

    //删除菜单
    public function del()
    {
        $id = $_POST['id'];
        $food = D('foodname');
        $num = $food->where("id='$id'")->delete();
        if($_POST['face']!=""){
            $tmpfile = './Public/images/'.$_POST['face'];     //组合实现的文件名称
            unlink ($tmpfile);
        }
        if ($num) {
            $type = '删除成功！';
            $this->ajaxReturn($type, 'json');
        } else {
            $type = '删除失败！';
            $this->ajaxReturn($type, 'json');
        }

    }
}