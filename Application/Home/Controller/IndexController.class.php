<?php

namespace Home\Controller;

use Think\Controller;

class IndexController extends Controller {

    public function index() {
        $foodshort = M('foodsort')->select();
        $foodname = M('foodname')->select();
//        $Model = new \Think\Model();
//        $query = 'select a.content,a.appraisedata,b.f_name,b.f_price,b.f_picture,b.fs_id,b.fn_link,c.username from
//                  appraise a,foodname b,user c where a.f_id =b.fn_id and a.id_appraise=c.user_id';
//        $foodname = $Model->query($query);
        $this->assign('foodname', $foodname);
        $this->assign('foodshort', $foodshort);
        $this->display();
    }

    public function detailsp() {
 $foodname = M('foodname')->order('state desc')->limit(0,2)->select();
 
  $this->assign('foodname', $foodname);
        $this->display();
    }

    public function pagedata() {
        $fn_id = $_POST['id'];
        $data = M('foodname')->where("id='$fn_id'")->find();
        $this->ajaxReturn($data);
    }


    public function shopc() {
        $foodname = $_POST['foodname'];
        $number = $_POST['number'];
        $id = $_POST['id'];
        $dataa = '';
        $username = session('username');
        if ($username != null) {
            $b = M('foodname')->where("id='$id'")->find();
            $dt = M('shopping')->where("sc_foodname='$foodname'")->find();
            if ($dt) {
                $count = $dt['sc_count'] + $number;
                $c = M('shopping')->where("sc_foodname='$foodname'")->setField('sc_count', $count);
                  $c = M('shopping')->where("sc_foodname='$foodname'")->setField('sc_total', $count*$b["f_price"]);
                
                if ($c) {
                    $dataa = 'ok';
                }
            } else {
                $data['sc_foodname'] = $foodname;
                $data['sc_price'] = $b['f_price'];
                $data['sc_count'] = $number;
                $data['sc_picture'] = $b['f_picture'];
                $data['user_id'] = session('id');
                $data['sc_total']=$number*$b['f_price'];
//            $data['user_id'] = 1;
                $w = M('shopping')->add($data);
                if ($w) {
                    $dataa = 'ok';
                }
            }
        } else {
            $dataa = '您还未登录，请先登录';
        }
        $this->ajaxReturn($dataa);
    }

    public function exits() {
        session_destroy();
        redirect("Index/index");
    }

    public function searchfood() {
        $foodname = $_POST['foodname'];
        $data='';
//        if ($foodname != '') {
//            $where['f_name'] = array('like', '%' . $foodname . '%');
//        }
        $a=M('foodname')->where("f_name='$foodname'")->find();
        if($a){
            $data=$a['id'];
        }else{
            $data='no';
        } 
        $this->ajaxReturn($data);
    }

}
