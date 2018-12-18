<?php if (!defined('THINK_PATH')) exit();?><!DOCTYPE html>
<html>
    <head>
        <meta charset="utf-8"/>
        <title>我的订单</title>
        <meta name="keywords" content="DeathGhost,DeathGhost.cn,web前端设,移动WebApp开发"/>
        <meta name="description" content="DeathGhost.cn::H5 WEB前端设计开发!"/>
        <meta name="author" content="DeathGhost"/>
        <style>
            .button {
                background-color: #4CAF50;
                border: none;
                color: white;
                padding: 15px 32px;
                text-align: center;
                text-decoration: none;
                display: inline-block;
                font-size: 16px;
                margin: 4px 2px;
                cursor: pointer;
            }
            /*.pages{float: right}*/
            .pages a,.pages span {
                display:inline-block;
                padding:2px 10px;
                border:1px solid #f0f0f0;
                -webkit-border-radius:3px;
                -moz-border-radius:3px;
                border-radius:3px;
                font-size: 15px;
            }
            .pages a,.pages li {
                display:inline-block;
                list-style: none;
                text-decoration:none; color:#58A0D3;
            }
            .pages a.first,.pages a.prev,.pages a.next,.pages a.end{
                margin:0 auto;
            }
            .pages a:hover{
                border-color:#50A8E6;
            }
            .pages span.current{
                background:#50A8E6;
                color:#FFF;
                font-weight:700;
                border-color:#50A8E6;
            }
            .pages a,.pages li {
                font-size: 15px;
            }
        </style>
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
                <!--user order list-->
                <section>
                    <table class="Myorder">
                        <th class="Font14 FontW">订单编号</th>
                        <th class="Font14 FontW">下单时间</th>
                        <th class="Font14 FontW">联系人</th>
                        <th class="Font14 FontW">商品清单</th>
                        <th class="Font14 FontW">订单总金额</th>
                        <th class="Font14 FontW">餐桌</th>
                        <th class="Font14 FontW">订单状态</th>
                        <?php if(is_array($list)): $i = 0; $__LIST__ = $list;if( count($__LIST__)==0 ) : echo "" ;else: foreach($__LIST__ as $key=>$vo): $mod = ($i % 2 );++$i;?><tr>
                                <td class="FontW"><?php echo ($vo["order_id"]); ?></td>
                                <td><?php echo ($vo["order_time"]); ?></td>
                                <td><?php echo ($vo["order_userid"]); ?></td>
                                <td><?php echo ($vo["order_list"]); ?></td>
                                <td><?php echo ($vo["order_money"]); ?></td>
                            <?php if($vo["order_table"] ==0): ?><td>未付款</td>
                                <?php else: ?> <td><?php echo ($vo["order_table"]); ?></td><?php endif; ?>
                            <?php if($vo["order_state"] ==未付款): ?><td><a style="color:red;"href="/zuoan/index.php/Home/Pay/payfk?orderid=<?php echo ($vo["order_id"]); ?>">付款</a>
                                    <a style="color:red;margin-left: 30px" href="javascript:void(0);" onclick="isorder('<?php echo ($vo["order_id"]); ?>')">取消订单</a></td>
                                <?php else: ?> <td><?php echo ($vo["order_state"]); ?></td><?php endif; ?>
                            </tr><?php endforeach; endif; else: echo "" ;endif; ?>
                    </table>
                    <div class="TurnPage">
                        <tfoot>
                            <!--分页显示？-->
                            <tr>
                                <td textalign="center" cl nowrap="true" colspan="9" height="20">
                                    <div class="pages"><?php echo ($page); ?></div>
                                </td>
                            </tr>
                        </tfoot>
                    </div>
                </section>
            </article>
        </section>
        <script>
            function isorder(orderid) {
                if (confirm("你确定取消订单吗？")) {
                    $.ajax({
                        url: "<?php echo U('Pay/canorder','','');?>",
                        data: {"orderid": orderid},
                        type: "post",
                        dataType: "json",
                        success: function (data) {
                            alert(data);
                            window.location.reload();
                        }
                    });
                } else {
                    return false;
                }
            }
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