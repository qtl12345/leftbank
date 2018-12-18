<?php if (!defined('THINK_PATH')) exit();?><!DOCTYPE html>
<html>
<head>
<meta charset="utf-8" />
<title>确认订单</title>
<meta name="keywords" content="DeathGhost,DeathGhost.cn,web前端设,移动WebApp开发" />
<meta name="description" content="DeathGhost.cn::H5 WEB前端设计开发!" />
<meta name="author" content="DeathGhost"/>


</head>
<body>
<header>
  
<link href="/zuoan/Public/style/style.css" rel="stylesheet" type="text/css" />
<script type="text/javascript" src="/zuoan/Public/js/public.js"></script>
<script type="text/javascript" src="/zuoan/Public/js/jquery-1.8.0.min.js"></script>
<script type="text/javascript" src="/zuoan/Public/js/jqpublic.js"></script>

<section class="Topmenubg">
    <div class="Topnav">
        <div class="LeftNav">
            <?php if($_SESSION['username']== null ): ?><a href="/zuoan/index.php/Home/Login/register">注册</a>/<a href="/zuoan/index.php/Home/Login/index">登录</a>
                <?php else: ?> 
                欢迎您：<span style='color:red'><?php echo (session('username')); ?></span><?php endif; ?>
            <a href="#">QQ客服</a>
            <a href="#">微信客服</a>
            <?php if($_SESSION['username']== null ): else: ?> 
                <a href="<?php echo U('Index/exits','','');?>">退出登录</a><?php endif; ?>
            <a target="_blank" href="http://wpa.qq.com/msgrd?v=3&uin=302795298&site=qq&menu=yes"><img magin-top="10px" border="0" src="http://wpa.qq.com/pa?p=2:302795298:51" alt="联系商家" title="联系商家"/></a>
        </div>
        <div class="RightNav">
            <a href="/zuoan/index.php/Home/Index/index.html">首页</a>
            <a href="/zuoan/index.php/Home/system/index.html">用户中心</a> <a href="/zuoan/index.php/Home/System/user_orderlist" target="_blank" title="我的订单">我的订单</a> <a href="/zuoan/index.php/Home/System/cart">购物车</a>  
        </div>
    </div>
</section>
<div class="Logo_search">
    <div class="Logo">
        <img src="/zuoan/Public/images/logo.jpg" title="DeathGhost" alt="模板">
        <i></i>

    </div>
    <div class="Search"> 
        <form method="get" id="main_a_serach" onsubmit="return check_search(this)">
            <div class="Search_nav" id="selectsearch">

                <a href="javascript:;" onClick="selectsearch(this, 'food_name')">食物名</a>
            </div>
            <div class="Search_area"> 
                <input type="search" id="foodname" name="keyword" placeholder="请输入您所需查找的餐食物名称..." class="searchbox" />
                <input type="button" onclick="searchfood(7)"class="searchbutton" value="搜 索" />
            </div>
        </form>
        <p class="hotkeywords">
            <a href=""id="foodname1"onclick='searchfood(1)'>小炒肉</a>
            <a href="" id="foodname2"onclick='searchfood(2)'>竹笋肉丝</a>
            <a href="" id="foodname3"onclick='searchfood(3)'>蛋炒饭</a>
            <a href="" id="foodname4"onclick='searchfood(4)'>牛肉炒饭</a>
            <a href="" id="foodname5"onclick='searchfood(5)'>干锅鱿鱼</a>
            <a href="" id="foodname6"onclick='searchfood(6)'>糖醋里脊</a>
        </p>
    </div>
    <script>
        function searchfood(ss) {
            if (ss == 7) {
                box = $("#foodname").val();
            } else {
                foodname = document.getElementById("foodname" + ss + "");
                box = foodname.innerText;
            }
            $.ajax({
                url: "<?php echo U('Index/searchfood','','');?>",
                data: {"foodname": box},
                type: "post",
                dataType: "json",
                success: function (data) {
                    if (data == 'no') {
                        window.location.href = "<?php echo U('Index/index','','');?>";
                    } else {
                        window.location.href = "/zuoan/index.php/Home /Index/detailsp?foodname=" + data + "";
                    }
                }
            });
        }
    </script>
</div>
 <nav class="menu_bg">
  <ul class="menu">
   <li><a href="index.html">首页</a></li>
   <li><a href="list.html">订餐</a></li>
   <li><a href="category.html">积分商城</a></li>
   <li><a href="article_read.html">关于我们</a></li>
  </ul>
 </nav>
</header>

<section class="Psection MT20" id="Cflow">

<!--配送方式及支付，则显示如下-->
<!--check order or add other information-->
 <div class="pay_delivery">

  <span class="flow_title">在线支付方式：</span>
   <form action="#">
    <ul>
    <li><input type="radio" name="pay" id="alipay" value="alipay" checked/><label for="alipay"><i class="alipay"></i></label></li>
    <!--<li><input type="radio" name="pay" id="alipay" value="alipay" /><a>现金支付</a></label></li>-->
   
    </ul>
   </form>
  </div>
<form   method="post"action="<?php echo U('Pay/pay','','');?>" >
  <div class="inforlist">
   <span class="flow_title">商品清单</span>
    <table>
    <th>名称</th>
    <th>数量</th>
    <th>价格</th>
    <th>小计</th>
    <?php if(is_array($shopdata)): $k = 0; $__LIST__ = $shopdata;if( count($__LIST__)==0 ) : echo "" ;else: foreach($__LIST__ as $key=>$vo): $mod = ($k % 2 );++$k;?><tr>
     <td><?php echo ($vo["sc_foodname"]); ?></td>
    <input name="foodname<?php echo ($k); ?>" type='hidden' value='<?php echo ($vo["sc_foodname"]); ?>'/>
    <input name="foodnameleng"  type='hidden' value="<?php echo ($k); ?>"/>
     <td><?php echo ($vo["sc_count"]); ?></td>
      <input name="count<?php echo ($k); ?>" type='hidden' value='<?php echo ($vo["sc_count"]); ?>'/>
     <td><?php echo ($vo["sc_price"]); ?></td>
     <td id="z"><?php echo ($vo["sc_total"]); ?></td>
    </tr><?php endforeach; endif; else: echo "" ;endif; ?>
   </table>
       

   
   
    <div class="Order_M">
        
       选择座位：     <select class="easyui-combobox"   editable="false" id="TypeName" name="department" panelheight="auto" style="width:160px;">
            
            <option  value = "sss"  selected = "selected" >随机</option >
 </select>
    
    </div>
    <div class="Sum_infor">


<p class="p2">合计：￥<span><input type="text" name="tatol" id="tatol"></input></span></p>
    <input type="submit" value="提交订单"  class="p3button"/>
    </div>
   </div>
   </form>
 </div>
</section>
<script>
    $(function (){
         jQuery.ajax({
        url: "<?php echo U('Home/system/getseatlist','','');?>",//跳转到下一个页面
        // 数据发送方式
        type: "post",
        // 接受数据格式
        dataType: "json",
       // 回调函数，接受服务器端返回给客户端的值，即result值
        success: function (data) {
                           console.log(data);
            if (data.length > 0) {
               for (i = 0; i < data.length; i++) {
                                jQuery("#TypeName").append('<option value=' + data[i].id + '>' + data[i].id + '号座位'+'</option>');
                            }
            }
        },
 
        error: function (data) {
            alert("查询学校失败" + data);
        }
    })
   
        
    });
    
    
    var conts=0;
      $(function(){
                $("td[id=z]").each(function () {
				conts += parseInt($(this).text());
	})
                $("#tatol").val((conts).toFixed(2));
            })
        




</script>
<!--<section class="Psection MT20 Textcenter" style="display:none;" id="Aflow">
   订单提交成功后则显示如下 
  <p class="Font14 Lineheight35 FontW">恭喜你！订单提交成功！</p>
  <p class="Font14 Lineheight35 FontW">您的订单编号为：<span class="CorRed">201409205134</span></p>
  <p class="Font14 Lineheight35 FontW">共计金额：<span class="CorRed">￥359</span></p>
  <p><button type="button" class="Lineheight35"><a href="#" target="_blank">支付宝立即支付</a></button><button type="button" class="Lineheight35"><a href="user_center.html">进入用户中心</button></p>
</section>-->
 <footer>
 <section class="Otherlink">
  <aside>
   <div class="ewm-left">
    <p>手机扫描二维码：</p>
    <img src="/zuoan/Public/images/Android_ico_d.gif">
    <img src="/zuoan/Public/images/iphone_ico_d.gif">
   </div>
   <div class="tips">
    <p>客服热线</p>
    <p><i>156816**0893</i></p>
    <p>配送时间</p>
    <p><time>09：00</time>~<time>22:00</time></p>
    <p>网站公告</p>
   </div>
  </aside>
  <section>
    <div>
    <span><i class="i1"></i>配送支付</span>
    <ul>
     <li><a href="" target="_blank" title="标题">支付方式</a></li>
     <li><a href="" target="_blank" title="标题">配送方式</a></li>
     <li><a href="" target="_blank" title="标题">配送效率</a></li>
     <li><a href="" target="_blank" title="标题">服务费用</a></li>
    </ul>
    </div>
    <div>
    <span><i class="i2"></i>关于我们</span>
    <ul>
     <li><a href="" target="_blank" title="标题">招贤纳士</a></li>
     <li><a href="" target="_blank" title="标题">网站介绍</a></li>
     <li><a href="" target="_blank" title="标题">配送效率</a></li>
     <li><a href="" target="_blank" title="标题">商家加盟</a></li>
    </ul>
    </div>
    <div>
    <span><i class="i3"></i>帮助中心</span>
    <ul>
     <li><a href="" target="_blank" title="标题">服务内容</a></li>
     <li><a href="" target="_blank" title="标题">服务介绍</a></li>
     <li><a href="" target="_blank" title="标题">常见问题</a></li>
     <li><a href="" target="_blank" title="标题">网站地图</a></li>
    </ul>
    </div>
  </section>
 </section>
<div class="copyright">© 版权所有 软件技术1601：<a href="http://127.0.0.1/zuoan/index.php/Home" title="1601">@在线餐厅</a></div>
</footer>
</body>
</html>