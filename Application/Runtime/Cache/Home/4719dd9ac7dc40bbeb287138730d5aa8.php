<?php if (!defined('THINK_PATH')) exit();?><!DOCTYPE html>
<html>
    <head>
        <meta charset="utf-8" />
        <title>详细信息</title>
        


        <script>
//            $(function () {
//                $('.title-list li').click(function () {
//                    var liindex = $('.title-list li').index(this);
//                    $(this).addClass('on').siblings().removeClass('on');
//                    $('.menutab-wrap div.menutab').eq(liindex).fadeIn(150).siblings('div.menutab').hide();
//                    var liWidth = $('.title-list li').width();
//                    $('.shopcontent .title-list p').stop(false, true).animate({'left': liindex * liWidth + 'px'}, 300);
//                });
//
//                $('.menutab-wrap .menutab li').hover(function () {
//                    $(this).css("border-color", "#ff6600");
//                    $(this).find('p > a').css('color', '#ff6600');
//                }, function () {
//                    $(this).css("border-color", "#fafafa");
//                    $(this).find('p > a').css('color', '#666666');
//                });
//            });

        </script>
        <style>
            .price_a{
                
            }
            .Tran_infor{
                
            }
            .Numerical{
                
            }.yuex{
                
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
        <section class="slp">
            <section class="food-hd">
                <div class="foodpic">
                    <img src="" id="showimg">

                </div>
                <div class="foodtext">
                    <div class="foodname_a">
                        <h1 id="foodnamee"style="text-align: center;padding-top: 25px;padding-bottom: 21px;"></h1>
                        <!--<p>西安市丈八路220号</p>-->
                    </div>
                    <div class="price_a">
                                         
                        <p class="price01">价格：￥<span id="prices"></span></p>
                        <ul class="Tran_infor1" style="text-align: right">
                                            <li>
                                                <p class="Numerical" style="margin-right: 14px;margin-top: -30px;text-align: right;font-weight:bold;color:#b77e5e;font-size:15px;">0</p>
                                                <p class="yuex">月销量</p>
                                                
                                            </li>
                                          
                                        </ul>
                    </div>
                                     
                    <form action="" id="formshopping">
                        <div class="BuyNo">
                            <span>我要买：<input type="number" name="number" required autofocus min="1" value="1"/>份</span>
                            <div class="Buybutton">
                                <input type="button" value="加入购物车" class="BuyB" onclick="shopdata()">
                                <!--<a href="javascript:void(0);"onclick="sporder()"><span class="Backhome">详情</span></a>-->
                            </div>
                        </div>
                    </form>
                </div>
                <div class="viewhistory">
                    <span class="VHtitle">热销商品</span>
                     <ul class="Fsulist">
                         
                    <?php if(is_array($foodname)): $i = 0; $__LIST__ = $foodname;if( count($__LIST__)==0 ) : echo "" ;else: foreach($__LIST__ as $key=>$vb): $mod = ($i % 2 );++$i;?><li>    
                            <a href="/zuoan/index.php/Home/Index<?php echo ($vb["fn_link"]); ?>?foodname=<?php echo ($vb["id"]); ?>" target="_blank" title="酱爆茄子"><img src="/zuoan/Public/images/<?php echo ($vb["f_picture"]); ?>"></a>
                            <p><?php echo ($vb["f_name"]); ?></p>
                            <p>￥<?php echo ($vb["f_price"]); ?></p>
                        </li><?php endforeach; endif; else: echo "" ;endif; ?>
                      
                    </ul>
                </div>
            </section>
        </section>
        <!--End content-->
        <script>
            function getParams(key) {
                var reg = new RegExp("(^|&)" + key + "=([^&]*)(&|$)");
                //如果地址栏中出现中文则进行编码    
                var r = encodeURI(window.location.search).substr(1).match(reg);
                if (r != null) {
                    //将中文编码的字符重新变成中文
                    return decodeURI(unescape(r[2]));
                }
                return null;
            }
            $.ajax({
                url: "<?php echo U('Index/pagedata','','');?>",
                data: {"id": getParams("foodname")},
                type: "post",
                dataType: "json",
                success: function (data) {
                    $("#foodnamee").text(data['f_name']);
                    $("#prices").text(data['f_price']);
                     $(".Numerical").text(data['state']);
                    $("#showimg").attr("src", "/zuoan/Public/images/" + data['f_picture']);
                }
            });
            function shopdata() {
                number = $('input[name="number"]').val();
                foodname = $('#foodnamee').text();
                $.ajax({
                    url: "<?php echo U('Index/shopc','','');?>",
                    data: {"foodname": foodname, "number": number, "id": getParams("foodname")},
                    type: "post",
                    dataType: "json",
                    success: function (data) {
                        if (data == 'ok') {
                            window.location.href = "<?php echo U('System/cart','','');?>";
                        } else {
                            alert(data);
                            window.location.href = "<?php echo U('Login/index','','');?>";
                        }
                    }
                });
            }
            function sporder() {
                number = $("input[name='number']").val();
                foodname = $("#foodnamee").text();
                alert(number);
                alert(foodname);
                $.ajax({
                    url: "<?php echo U('System/sporder','','');?>",
                    data: {"foodname":foodname,"number":number},
                    type: "post",
                    dataType: "json",
                    success: function (data) {
                        
                    }
                });
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