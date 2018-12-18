<?php if (!defined('THINK_PATH')) exit();?><!DOCTYPE html>
<html>
    <head>
        <meta charset="utf-8" />
        <title>首页</title>
        <meta name="keywords" content="左岸首页" />
        <meta name="description" content="左岸首页" />
        <meta name="author" content="左岸首页"/>
       
        <!--响应式框架-->
<link rel="stylesheet" type="text/css" href="/zuoan/Public/css/bootstrap-grid.min.css" />

<!--图标样式-->
<link href="/zuoan/Public/css/font-awesome.min.css" rel="stylesheet">

<!--可无视-->
<link rel="stylesheet" type="text/css" href="/zuoan/Public/css/demo_1.css">
        <style type="text/css">
.demo{
	padding: 2em 0;
}
.product-grid{
	font-family: 'Open Sans', sans-serif;
	text-align: center;
	overflow: hidden;
	position: relative;
	transition: all 0.5s ease 0s;
}
.product-grid:hover{ box-shadow: 0 0 10px rgba(0,0,0,0.3); }
.product-grid .product-image{ overflow: hidden; }
.product-grid .product-image a{ display: block; }
.product-grid .product-image img{
    width: 100%;
    height: auto;
    transition: all 0.5s ease 0s;
}
.product-grid:hover .product-image img{ transform: scale(1.1); }
.product-grid .product-content{
    padding: 12px 12px 15px 12px;
    transition: all 0.5s ease 0s;
}
.product-grid:hover .product-content{ opacity: 0; }
.product-grid .title{
    font-size: 20px;
    font-weight: 600;
    text-transform: capitalize;
    margin: 0 0 10px;
    transition: all 0.3s ease 0s;
}
.product-grid .title a{ color: #000; }
.product-grid .title a:hover{ color: #2e86de; }
.product-grid .price {
    font-size: 18px;
    font-weight: 600;
    color:#2e86de;
}
.product-grid .price span {
    color: #999;
    font-size: 15px;
    font-weight: 400;
    text-decoration: line-through;
    margin-left: 7px;
    display: inline-block;
}
.product-grid .social{
    background-color: #fff;
    width: 100%;
    padding: 0;
    margin: 0;
    list-style: none;
    opacity: 0;
    transform: translateX(-50%);
    position: absolute;
    bottom: -50%;
    left: 50%;
    z-index: 1;
    transition: all 0.5s ease 0s;
}
.product-grid:hover .social{
    opacity: 1;
    bottom: 20px;
}
.product-grid .social li{ display: inline-block; }
.product-grid .social li a{
    color: #909090;
    font-size: 16px;
    line-height: 45px;
    text-align: center;
    height: 45px;
    width: 45px;
    margin: 0 7px;
    border: 1px solid #909090;
    border-radius: 50px;
    display: block;
    position: relative;
    transition: all 0.3s ease-in-out;
}
.product-grid .social li a:hover {
    color: #fff;
    background-color: #2e86de;
    width: 80px;
}
.product-grid .social li a:before,
.product-grid .social li a:after{
    content: attr(data-tip);
    color: #fff;
    background-color: #2e86de;
    font-size: 12px;
    letter-spacing: 1px;
    line-height: 20px;
    padding: 1px 5px;
    border-radius: 5px;
    white-space: nowrap;
    opacity: 0;
    transform:translateX(-50%);
    position: absolute;
    left: 50%;
    top: -30px;
}
.product-grid .social li a:after{
    content: '';
    height: 15px;
    width: 15px;
    border-radius: 0;
    transform:translateX(-50%) rotate(45deg);
    top: -20px;
    z-index: -1;
}
.product-grid .social li a:hover:before,
.product-grid .social li a:hover:after{
    opacity: 1;
}
   @media only screen and (max-width:990px){
    .product-grid{ margin-bottom: 30px; }
}


	</style>
        <script>
            function shopdata(foodname1,data){
              
               number = 1;
//                foodname = $('#qwe').text();
                //idq=document.getElementById("naid").value;
               var foodname=foodname1;
                idq=data;
                $.ajax({
                    url: "<?php echo U('Index/shopc','','');?>",
                    data: {"foodname": foodname, "number": number, "id":idq},
                    type: "post",
                    dataType: "json",
                    success: function (data) {
//                      console.log(data);
                        if (data == 'ok') {
                            window.location.href = "<?php echo U('System/cart','','');?>";
                        } else {
                            alert(data);
                            window.location.href = "<?php echo U('Login/index','','');?>";
                        }
                    },
                    error:function(){
                        alert("132222");
                    }
                    
                });
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
        <section class="Cfn">
            <aside class="C-left">
                <div class="S-time">服务时间：周一~周六<time>09:00</time>-<time>23:00</time></div>
                <div class="C-time">
                    <img src="/zuoan/Public/upload/dc.jpg"/>
                </div>
                <a href="list.html" target="_blank"><img src="/zuoan/Public/images/by_button.png"></a>
                <a href="list.html" target="_blank"><img src="/zuoan/Public/images/dc_button.png"></a>
            </aside>
            <div class="F-middle">
                <ul class="rslides f426x240">
                    <li><a href="javascript:"><img src="/zuoan/Public/upload/01.jpg"/></a></li>
                    <li><a href="javascript:"><img src="/zuoan/Public/upload/02.jpg" /></a></li>
                    <li><a href="javascript:"><img src="/zuoan/Public/upload/03.jpg"/></a></li>
                </ul>
            </div>
        </section>
        <section class="Sfainfor">
            <div class="row">
        
            <?php if(is_array($foodshort)): $i = 0; $__LIST__ = $foodshort;if( count($__LIST__)==0 ) : echo "" ;else: foreach($__LIST__ as $key=>$vo): $mod = ($i % 2 );++$i;?><article class="Sflist">
                    <div id="Indexouter">
                        <ul id="Indextab">
                            <li class="current" style="    margin-left: 381px;
    padding-top: 22px;"><?php echo ($vo["foodname"]); ?></li>
                            <p class="class_B">
                                <span><a href="#" target="_blank"></a></span>
                            </p>
                        </ul>
                        <div id="Indexcontent">
                            <ul style="display:block;">
                                <li>
                                    <div class="SCcontent">
                                        <?php if(is_array($foodname)): $i = 0; $__LIST__ = $foodname;if( count($__LIST__)==0 ) : echo "" ;else: foreach($__LIST__ as $key=>$vb): $mod = ($i % 2 );++$i; if($vo["id"] == $vb["fs_id"] ): ?><div class="col-md-3 col-sm-6">
				<div class="product-grid">
					<div class="product-image">
						<a href="/zuoan/index.php/Home/Index<?php echo ($vb["fn_link"]); ?>?foodname=<?php echo ($vb["id"]); ?>?state=<?php echo ($vb["state"]); ?>">
                                                    <img class="pic-1" style="height: 163px;" src="/zuoan/Public/images/<?php echo ($vb["f_picture"]); ?>">
						</a>
					</div>
					<div class="product-content">
                                            <h3 class="title"><a href="/zuoan/index.php/Home/Index<?php echo ($vb["fn_link"]); ?>?foodname=<?php echo ($vb["id"]); ?>?state=<?php echo ($vb["state"]); ?>" id="qwe"><?php echo ($vb["f_name"]); ?></a></h3>
						<div class="price">￥<?php echo ($vb["f_price"]); ?>
							<!--<span>$14.00</span>-->
						</div>
                                            
					</div>
					<ul class="social">
						<!--<li><a href="" data-tip=""><i class="fa fa-search"></i></a></li>-->
						<li><a href="/zuoan/index.php/Home/Index<?php echo ($vb["fn_link"]); ?>?foodname=<?php echo ($vb["id"]); ?>?state=<?php echo ($vb["state"]); ?>" data-tip="购买"><i class="fa fa-shopping-bag"></i></a></li>
						<li><a href="javascript:void shopdata('<?php echo ($vb["f_name"]); ?>',<?php echo ($vb["id"]); ?>)" data-tip="加入购物车"><i class="fa fa-shopping-cart"></i></a></li>
					</ul>
				</div>
			</div><?php endif; endforeach; endif; else: echo "" ;endif; ?>
                                    </div>
                                </li>
                            </ul>
                        </div>
                    </div>
                </article><?php endforeach; endif; else: echo "" ;endif; ?>
           </div>
        </section>
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
</footer>4
    
</body>
</html>