<?php
/**
 * Created by PhpStorm.
 * User: 袁
 * Date: 2018/10/21
 * Time: 10:17
 */

namespace Admin\Controller;

use Think\Controller;
class UserController extends Controller
{
    public function user()
    {
        $this->display();
    }
    public function select(){
        if ($_POST['datatype'] == 'fl') {
            $pageIndex = $_POST['page']; //当前页码页码
            $pageSize = $_POST['rows']; //每页显示行

            $count = M('user')->count();

            $startno = ($pageIndex - 1) * $pageSize;
            $limit = $startno . ',' . $pageSize;
            $map['username'] = array('like', array('%' . $_POST['lb'] . '%'), 'OR');
            $studentList = M('user')->where($map)->order('id asc')->limit($limit)->select();
            $result = array(
                "total" => $count, //记录总数
                "rows" => $studentList  //记录
            );
            $this->ajaxReturn($result, 'JSON');
//            $fs = D('user');
//            $map['username'] = array('like', array('%' . $_POST['lb'] . '%'), 'OR');
//            $f=$fs->where($map)->select();
//            $this->ajaxReturn($f,'json');
        } else {
            $pageIndex = $_POST['page']; //当前页码页码
            $pageSize = $_POST['rows']; //每页显示行

            $count = M('user')->count();

            $startno = ($pageIndex - 1) * $pageSize;
            $limit = $startno . ',' . $pageSize;

            $studentList = M('user')->order('id asc')->limit($limit)->select();
            foreach ($studentList as $k => $v) {

                if ( $studentList[$k]['state'] == '1') {
                    $studentList[$k]['state'] = '正常';
                }
                if ( $studentList[$k]['state'] == '0') {
                    $studentList[$k]['state'] = '拉黑';
                }
            }
            $result = array(
                "total" => $count, //记录总数
                "rows" => $studentList  //记录
            );
            $this->ajaxReturn($result, 'JSON');
//            $fs = D('user')->select();
//            foreach ($fs as $k => $v) {
//
//                if ($v['state'] == '1') {
//                    $fs[$k]['state'] = '正常';
//                }
//                if ($v['state'] == '0') {
//                    $fs[$k]['state'] = '拉黑';
//                }
//            }
//            $this->ajaxReturn($fs,'json');
        }
    }
    //加入黑名单
    function add(){
        $id=$_POST['id'];
        $data['state']=0;
        $u=M('user')->where("id='$id'")->save($data);
        if($u){
            $msg='修改成功';
            $this->ajaxReturn($msg,'json');
        }else{
            $msg='修改失败';
            $this->ajaxReturn($msg,'json');
        }
    }
    //移除黑名单
    function remove(){
        $id=$_POST['id'];
        $data['state']=1;
        $us=M('user')->where("id='$id'")->save($data);
        if($us){
            $msg='修改成功';
            $this->ajaxReturn($msg,'json');
        }else{
            $msg='修改失败';
            $this->ajaxReturn($msg,'json');
        }
    }
}