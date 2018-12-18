<?php

namespace Home\Controller;

use Think\Controller;

class PayController extends Controller {

    public function canorder() {
        $orderid = $_POST['orderid'];
        $message='';
        $reslut=M('order')->delete($orderid);
        if($reslut){
            $message='取消订单成功';
        } else {
             $message='系统繁忙';
        }
        $this->ajaxReturn($message);
    }

    public function delshoping() {
        M('order')->where("order_state=0")->delete();
        $tateid = $_SESSION['sateid']; //座位id
        $data = $_GET['foodname'];  //订单内容
        //编码
        $m = mb_convert_encoding($data, 'utf-8', 'gb2312');
        $u = urldecode($m);
        $foodqd = urldecode(mb_convert_encoding($_GET['foodqd'], 'utf-8', 'gb2312'));
        $_GET['foodname'] = urldecode($m);
       
        
        $xiaoling = M("foodname");
        $shopping = M("shopping");
        //分割字符
        $array = explode("|", $u);
        $abc = explode("|",$foodqd);
        for ($t = 0; $t <= count($abc); $t++) {
            $bbc[$t]= substr($abc[$t],-4,-3);
             $shuzi=(int)$bbc[$t]+$xiaoling->where("f_name='$array[$t]'")->getField('state');
            $xiaoling->where("f_name='$array[$t]'")->setField('state',$shuzi);
        }
       
        //删除购物车内容
        for ($t = 0; $t <= count($array); $t++) {
            $shopping->where("sc_foodname='$array[$t]'")->delete();
        }
        $cz = M('seat')->where("state='1'")->getField('id', true); // 获取id数组
        $k = array_rand($cz, 1); //从数组中随机选择一个或多个元素
        if ($tateid == 'sss') {
            $data2['order_table'] = $cz[$k];
        } else {
            $data2['order_table'] = $tateid;
        }

        $seat_id = $data2['order_table'];
        $data2['order_id'] = $_GET['out_trade_no'];
        $data2['order_money'] = $_GET['total_amount'];
        $data2['order_time'] = date("Y-m-d H:i", time());
        $data2['order_userid'] = session('username');
        $data2['order_list'] = substr($foodqd, 0, strlen($foodqd) - 1);
        //var_dump($data2['order_table']);
        $d = M('order')->data($data2)->add();
        if ($d) {
            if ($tateid == "sss") {
                $cz = M('seat')->where("id='$seat_id'")->setField('state', 0);
            } else {
                $cz = M('seat')->where("id='$tateid'")->setField('state', 0);
            }
        }
        header("Content-Type: text/html; charset=UTF-8");
        // var_dump($tateid);     
        unset($_SESSION['tateid']); //删除座位SESSion
        redirect("/zuoan/index.php/Home/system/user_orderlist");
    }

    public function pay() {
        $remarks = '';
        $total = $_POST['tatol'];
        $seate = $_POST["department"];
        session_start();   //开启会话
        $_SESSION["sateid"] = $seate;
        $foodarray = '';
        $leng = $_POST['foodnameleng'];
        for ($i = 1; $i <= $leng; $i++) {
            $foodarray = $foodarray . $_POST['foodname' . $i] . '|';
            $remarks = $remarks . $_POST['foodname' . $i] . "*" . $_POST['count' . $i] . "份" . "|";
        }
        $id = session('id');
        $uniqid = uniqid();
        $data['order_id'] = uniqid();
        $data['order_userid'] = session('username');
        $data['order_list'] = substr($remarks, 0, -1);
        $data['order_time'] = date("Y-m-d H:i", time());
        $data['order_money'] = $total;
        $data['order_state'] = 0;
        $data['order_table'] = 0;
        M('order')->where("id='$id'")->add($data);
//       $this->display();
        Vendor('pc');

        /*         * * 请填写以下配置信息 ** */
        $appid = '2016092100559087';            //https://open.alipay.com 账户中心->密钥管理->开放平台密钥，填写添加了电脑网站支付的应用的APPID
        $outTradeNo = uniqid();     //你自己的商品订单号，不能重复
        $payAmount = $total;          //付款金额，单位:元
        $orderName = substr($remarks, 0, -1);    //订单标题
        $signType = 'RSA2';            //签名算法类型，支持RSA2和RSA，推荐使用RSA2
        $rsaPrivateKey = 'MIIEpQIBAAKCAQEAwtDKxDH+Yk1hZ7coqKMJougQA6tyc6URYgK7dBiQGIqQN7lHVsk6DSt8uB9GiH/2l1rRe6lBxs/ZXMYgg7jom4SaXVJXTnN4nW4nvtG6PUgWQP+DpBR/iZlb2NjphQoUrmye0L71u/Zo8nRCTDbtB/BT9TQzE/xdixfk9sQO81+Q8iZ3PkwoGzMK8xEjY4z0V5LuB0mjsVIXB/cEWuKKDlk/thElwq6mCSpFnKKum4yTXXLyTO7LBBTUZVjlhcFbkt4Mx8YL3/OKpL6jPXv6j37eUbxcUL+T1aFCNQGBQ1pOQpQFILbsKM23r+1Zcc8VSW0Gt9j3puFbzvjvHaz4MQIDAQABAoIBAQCQngIHhr06KAsovNSX6v+aSP6qWrlJk73FrhWNZzaAoUvRsd59VD+dyyx4We84IRXi4W4kiE7l0SGgNwun/LnfyJ32rMtW120wILesdW/1UfADLCqCwRyz/n4qCUvAkO0tVkDG4Rr1/0OEyDz26scmX4dTvP411d9zA7faX0xh6MEZI4wYG6QuCZb3fnns5bJbGqPoST10D/7S1k2OV2Dww/FLSlk+xBRMySpDEtrMFpUI6XcPjtEZNUAhLEE++PRH8EhP1Os+MuNvYB624lswT1gfoyL/xFuA7cxCU7VNdk+Ph2k1ZIhAECAvAUfY46zChtXBmymOiBjh6ORVSWKBAoGBAO7BvMzukC4gwSGzuHuEpNVkZF4fxY8dnL7h9OY54xTs5xZiYdHiDP4ag/pnCJorE/X9ajirm/Cnfxah+/J0OJG0ajxAtE9ExMwpgWayB5/Fn7dKpCqfd+W/CScsphSXt1ShUp0tp1GdPC0lmc0uEwEhhgbhVbI/TnkiqA9Po5W5AoGBANDipXpi477obcfGYnehnbVjcsOKn60TW9Tt0FuAmtm1jucPcroM88U0s37/WsG27E+1pTrcgxpOaDTtBrOs0TAotTXX0ItjrXI+OPaV3idPub9RSy4m0S6SJA9fCMJcyq1ngR2KGt3NSjUJQs9dnbfpHgy6Su3gd25WzvEYVrI5AoGBALWI7SrMgSfxk6cyZSTVeBcgXAgNFEN6+oFQgMrEXNq+Pf6RE1toCwTx2EN+L9Y4xtaUtj0cjlbuo/zrcQuqPpDaoqPpdq+G1DN/o3oYBx/+PTA6OpSF573yAN2eXzDtImHgv1XvLncpnGWfX0/Ypm6HtMZqcqQy6lHEfhAWN4VRAoGBAJILdQEttOgcX+0GcoAMGlThFDNNb7i1yUYFg+EF+L5wp1o7vc4BEkr2Pu1zIgRAndZZPQ37cRpqaYdflYj4MkYGoDPmEWPzrCgtAuy8+dbocgkmkHbTIvv5p4arvlcOQ5KbxHVfwssDJngQYorTfFtCfQUPFyZcA4S84vFEQBFZAoGAS1Uk/NuhjiW1rYz+W7erP8QBynICIDfT8lxsEKEpTS8QDb1Qx/rYLzSiTx7uzCDixOLLfLXaxzz3m0TfjE9YCI8XIMggBeYyNcvvu8UOHQG6Qq58nYF+YLSIeRs7pZf2GiWsMO/ybDMmKwDnlt+zyYRCvJrKiv/9vVaMcn4MaVQ=';        //商户私钥，填写对应签名算法类型的私钥，如何生成密钥参考：https://docs.open.alipay.com/291/105971和https://docs.open.alipay.com/200/105310
        $returnUrl = "http://127.0.0.1/zuoan/index.php/Home/Pay/delshoping?foodname=$foodarray&foodqd=$remarks"; //付款成功后的同步回调地址
        $notifyUrl = "http://127.0.0.1/zuoan/index.php/Home/Pay/delshoping?foodname=$foodarray&foodqd=$remarks";  //付款成功后的异步回调地址
        /*         * * 配置结束 ** */
        $aliPay = new \AlipayService();
        $aliPay->setAppid($appid);
        $aliPay->setReturnUrl($returnUrl);
        $aliPay->setNotifyUrl($notifyUrl);
        $aliPay->setRsaPrivateKey($rsaPrivateKey);
        $aliPay->setTotalFee($payAmount);
        $aliPay->setOutTradeNo($outTradeNo);
        $aliPay->setOrderName($orderName);
        $sHtml = $aliPay->doPay();
        echo $sHtml;
    }

    function updatorder() {
        $orderid = $_GET['orderid'];
        $cz = M('seat')->where("state='1'")->getField('id', true); // 获取id数组
        $k = array_rand($cz, 1);
        $data['order_table'] = $cz[$k];
        $data['order_state'] = 1;
        M('order')->where("order_id='$orderid'")->save($data);
        M('seat')->where("id='$cz[$k]'")->setField('state', 0);
        redirect("/zuoan/index.php/Home/system/user_orderlist");
    }

    function payfk() {
        $orderid = $_GET['orderid'];
        $result = M('order')->where("order_id='$orderid'")->find();
        $orderid = $result['order_id'];
        Vendor('pc');
        /*         * * 请填写以下配置信息 ** */
        $appid = '2016092100559087';            //https://open.alipay.com 账户中心->密钥管理->开放平台密钥，填写添加了电脑网站支付的应用的APPID
        $outTradeNo = $result['order_id'];     //你自己的商品订单号，不能重复
        $payAmount = $result['order_money'];          //付款金额，单位:元
        $orderName = $result['order_list'];    //订单标题
        $signType = 'RSA2';            //签名算法类型，支持RSA2和RSA，推荐使用RSA2
        $rsaPrivateKey = 'MIIEpQIBAAKCAQEAwtDKxDH+Yk1hZ7coqKMJougQA6tyc6URYgK7dBiQGIqQN7lHVsk6DSt8uB9GiH/2l1rRe6lBxs/ZXMYgg7jom4SaXVJXTnN4nW4nvtG6PUgWQP+DpBR/iZlb2NjphQoUrmye0L71u/Zo8nRCTDbtB/BT9TQzE/xdixfk9sQO81+Q8iZ3PkwoGzMK8xEjY4z0V5LuB0mjsVIXB/cEWuKKDlk/thElwq6mCSpFnKKum4yTXXLyTO7LBBTUZVjlhcFbkt4Mx8YL3/OKpL6jPXv6j37eUbxcUL+T1aFCNQGBQ1pOQpQFILbsKM23r+1Zcc8VSW0Gt9j3puFbzvjvHaz4MQIDAQABAoIBAQCQngIHhr06KAsovNSX6v+aSP6qWrlJk73FrhWNZzaAoUvRsd59VD+dyyx4We84IRXi4W4kiE7l0SGgNwun/LnfyJ32rMtW120wILesdW/1UfADLCqCwRyz/n4qCUvAkO0tVkDG4Rr1/0OEyDz26scmX4dTvP411d9zA7faX0xh6MEZI4wYG6QuCZb3fnns5bJbGqPoST10D/7S1k2OV2Dww/FLSlk+xBRMySpDEtrMFpUI6XcPjtEZNUAhLEE++PRH8EhP1Os+MuNvYB624lswT1gfoyL/xFuA7cxCU7VNdk+Ph2k1ZIhAECAvAUfY46zChtXBmymOiBjh6ORVSWKBAoGBAO7BvMzukC4gwSGzuHuEpNVkZF4fxY8dnL7h9OY54xTs5xZiYdHiDP4ag/pnCJorE/X9ajirm/Cnfxah+/J0OJG0ajxAtE9ExMwpgWayB5/Fn7dKpCqfd+W/CScsphSXt1ShUp0tp1GdPC0lmc0uEwEhhgbhVbI/TnkiqA9Po5W5AoGBANDipXpi477obcfGYnehnbVjcsOKn60TW9Tt0FuAmtm1jucPcroM88U0s37/WsG27E+1pTrcgxpOaDTtBrOs0TAotTXX0ItjrXI+OPaV3idPub9RSy4m0S6SJA9fCMJcyq1ngR2KGt3NSjUJQs9dnbfpHgy6Su3gd25WzvEYVrI5AoGBALWI7SrMgSfxk6cyZSTVeBcgXAgNFEN6+oFQgMrEXNq+Pf6RE1toCwTx2EN+L9Y4xtaUtj0cjlbuo/zrcQuqPpDaoqPpdq+G1DN/o3oYBx/+PTA6OpSF573yAN2eXzDtImHgv1XvLncpnGWfX0/Ypm6HtMZqcqQy6lHEfhAWN4VRAoGBAJILdQEttOgcX+0GcoAMGlThFDNNb7i1yUYFg+EF+L5wp1o7vc4BEkr2Pu1zIgRAndZZPQ37cRpqaYdflYj4MkYGoDPmEWPzrCgtAuy8+dbocgkmkHbTIvv5p4arvlcOQ5KbxHVfwssDJngQYorTfFtCfQUPFyZcA4S84vFEQBFZAoGAS1Uk/NuhjiW1rYz+W7erP8QBynICIDfT8lxsEKEpTS8QDb1Qx/rYLzSiTx7uzCDixOLLfLXaxzz3m0TfjE9YCI8XIMggBeYyNcvvu8UOHQG6Qq58nYF+YLSIeRs7pZf2GiWsMO/ybDMmKwDnlt+zyYRCvJrKiv/9vVaMcn4MaVQ=';        //商户私钥，填写对应签名算法类型的私钥，如何生成密钥参考：https://docs.open.alipay.com/291/105971和https://docs.open.alipay.com/200/105310
        $returnUrl = "http://127.0.0.1/zuoan/index.php/Home/Pay/updatorder?orderid=$orderid"; //付款成功后的同步回调地址
        $notifyUrl = "http://127.0.0.1/zuoan/index.php/Home/Pay/updatorder?orderid=$orderid";  //付款成功后的异步回调地址
        /*         * * 配置结束 ** */
        $aliPay = new \AlipayService();
        $aliPay->setAppid($appid);
        $aliPay->setReturnUrl($returnUrl);
        $aliPay->setNotifyUrl($notifyUrl);
        $aliPay->setRsaPrivateKey($rsaPrivateKey);
        $aliPay->setTotalFee($payAmount);
        $aliPay->setOutTradeNo($outTradeNo);
        $aliPay->setOrderName($orderName);
        $sHtml = $aliPay->doPay();
        echo $sHtml;
    }

}
