<?php if (!defined('THINK_PATH')) exit();?><!DOCTYPE html>
<html>
    <head>
        <meta charset="utf-8" />
        <title>用户中心</title>
        <meta name="keywords" content="DeathGhost,DeathGhost.cn,web前端设,移动WebApp开发" />
        <meta name="description" content="DeathGhost.cn::H5 WEB前端设计开发!" />
        <meta name="author" content="DeathGhost"/>
        <script>
            if (<?php echo ($username); ?> == 1) {
                alert("请先登录后查看用户中心");
                window.location.href = "<?php echo U('Login/index','','');?>";
            }
        </script>
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
            <a href="#">     <a target="_blank" href="http://wpa.qq.com/msgrd?v=3&uin=302795298&site=qq&menu=yes"><img magin-top="10px" border="0" src="http://wpa.qq.com/pa?p=2:302795298:51" alt="联系商家" title="联系商家"/></a>
      </a>
            <a href="#">微信客服</a>
            <?php if($_SESSION['username']== null ): else: ?> 
                <a href="<?php echo U('Index/exits','','');?>">退出登录</a><?php endif; ?>
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
        <!--Start content-->
        <section class="Psection MT20">
            <nav class="U-nav Font14 FontW">
                <ul>
                    <li><i></i><a href="/zuoan/index.php/Home/system">用户中心首页</a></li>
                    <li><i></i><a href="/zuoan/index.php/Home/system/user_orderlist">我的订单</a></li>
                    <li><i></i><a href="/zuoan/index.php/Home/system/user_message">我的留言</a></li>
                    <!--<li><i></i><a href="user_coupon.html">我的优惠券</a></li>-->
                    <!--<li><i></i><a href="user_favorites.html">我的收藏</a></li>-->
                    <li><i></i><a href="/zuoan/index.php/Home/system/user_account">账户管理</a></li>
                    <li><i></i><a href="<?php echo U('Index/exits','','');?>">安全退出</a></li>
                </ul>
            </nav>
            <article class="U-article Overflow">
                <!--"引用“user_page/user_index.html”"-->
                <section class="usercenter">
                    <span class="Weltitle Block Font16 CorRed FontW Lineheight35">Welcome欢迎光临！</span>
                    <div class="U-header MT20 Overflow">
                        <img src="/zuoan/Public/upload/testuser.jpg">
                        <p class="Font14 FontW"><span style="color:red"><?php echo (session('username')); ?></span>欢迎您回到 用户中心！</p>
                        <p class="Font14 FontW">当前时间：<span id="nowTime"style="color:red"><?php echo (session('username')); ?></span></p>
                    </div>
                    <ul class="s-States Overflow FontW" id="Lbn">
                        <li class="Font14 FontW">在线提醒：</li>
                        <li><a href="/zuoan/index.php/Home/System /user_orderlist">待付款(<?php echo ($fpay); ?>)</a></li>
                        <li><a href="/zuoan/index.php/Home/System /user_orderlist">已付款(<?php echo ($tpay); ?>)</a></li>
                        <li></li>
                        <li></li>
                    </ul>
                </section>
            </article>
        </section>
        <script>
            function showTime() {
                nowtime = new Date();
                year = nowtime.getFullYear();
                month = nowtime.getMonth() + 1;
                date = nowtime.getDate();
                document.getElementById("nowTime").innerText = year + "年" + month + "月" + date + "日 " + nowtime.toLocaleTimeString();
            }
            setInterval("showTime()", 1000);
        </script>
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