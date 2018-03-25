<!--
Author: W3layouts
Author URL: http://w3layouts.com
License: Creative Commons Attribution 3.0 Unported
License URL: http://creativecommons.org/licenses/by/3.0/
-->
<!DOCTYPE HTML>
<html>
<head>
<title><?=$webTitle;?> - 博客首页</title>
<link href="public/css/bootstrap.css" rel="stylesheet" type="text/css" media="all">
<link href="public/css/style.css" rel="stylesheet" type="text/css" media="all" />
<meta name="viewport" content="width=device-width, initial-scale=1">
<meta http-equiv="Content-Type" content="text/html; charset=utf-8" />
<meta name="keywords" content="Ladies Responsive web template, Bootstrap Web Templates, Flat Web Templates, Andriod Compatible web template, 
Smartphone Compatible web template, free webdesigns for Nokia, Samsung, LG, SonyErricsson, Motorola web design" />
<script type="application/x-javascript"> addEventListener("load", function() { setTimeout(hideURLbar, 0); }, false); function hideURLbar(){ window.scrollTo(0,1); } </script>
<link href='http://fonts.googleapis.com/css?family=Open+Sans:400,300,600,700,800' rel='stylesheet' type='text/css'>
<link rel="stylesheet" href="public/css/flexslider.css" type="text/css" media="screen" />
<script src="public/js/jquery.min.js"></script>
<link rel="stylesheet" href="public/css/swipebox.css">
 <!------ Light Box ------>
    <script src="public/js/jquery.swipebox.min.js"></script> 
    <script type="text/javascript">
		jQuery(function($) {
			$(".swipebox").swipebox();
		});
	</script>
    <!------ Eng Light Box ------>
	 <script src="public/js/responsiveslides.min.js"></script>
	<script>
    $(function () {
      $("#slider").responsiveSlides({
      	auto: true,
      	nav: true,
      	speed: 500,
        namespace: "callbacks",
        pager: true,
      });
    });
  </script>

</head>
<body>
<!-- header -->
	<div class="header">
		<div class="container">
			<div class="logo">
				<a href="index.php?m=index&a=index"><img src="public/images/logo.png" class="img-responsive" alt=""></a>
				<div class="user">
				<?php if(!empty($_SESSION['username'])):?>
					<table >
					<tr>
						<td rowspan="2"><img src="<?=$_SESSION['pic'];?>" width="50px" height="50px" /></td>
						<td width="10px"></td>
						<td><?=$_SESSION['username'];?></td>
					</tr>
					<tr>
						<td width="10px"></td>
						<td><a href="index.php?m=user&a=logout">退出登录</a></td>
					</tr>
					</table>
				<?php endif;?>
				</div>
			</div>
			<div class="header-bottom">
				<div class="head-nav">
					<span class="menu"> </span>
						<ul class="cl-effect-3">
							<li class="active"><a href="index.php?m=index&a=index">首页</a></li>
							<li><a href="index.php?m=blog&a=index">博客</a></li>
							<?php if(empty($_SESSION['username'])):?>
							<li><a href="index.php?m=user&a=index">登录</a></li>
							<?php else: ?>
							<li><a href="index.php?m=person&a=index">个人资料</a></li>
							<?php endif;?>
							<li><a href="index.php?m=send&a=index">发表</a></li>
							<li><a href="index.php?m=admin&a=login">管理</a></li>
								<div class="clearfix"></div>
						</ul>
				</div>
				<!-- script-for-nav -->
					<script>
						$( "span.menu" ).click(function() {
						  $( ".head-nav ul" ).slideToggle(300, function() {
							// Animation complete.
						  });
						});
					</script>
				<!-- script-for-nav -->

				<div class="search2">
					<form method = "post" action = "index.php?m=index&a=search">
						<input type="text" name = "searchStr" placeholder = "Search.." onfocus="this.value = '';">
						<input type="submit" value="">
					</form>
				</div>
					<div class="clearfix"></div>
			</div>
		</div>
	</div>
<!-- header -->	
	<div class="banner">
		<div class="container">
			<div class="slider">
				<div class="callbacks_container">
					<ul class="rslides" id="slider">
					<?php foreach($galleryBig as $vGalleryBig):?>
						<li>
								<img src="<?=$vGalleryBig['path'];?>" class="img-responsive" alt="">
							<div class="caption">
								<p><?=$vGalleryBig['contents'];?></p>
							</div>
						</li>
					<?php endforeach;?>
					</ul>
				</div>
			</div>
		</div>
	</div>
<!-- header -->
<!-- ipsum -->
	<div class="ipsum">
		<div class="container">
			<h3><span>"</span>在我的名片上，我是任天堂的社长；在我的脑海中，我是一名游戏开发人；但在我的心中，我是一名游戏爱好者。  ---岩田聪<span>"</span></h3>
		</div>
	</div>
<!-- ipsum -->
 <!-- portfolio-section -->
 <div class="container">
	 <div class="portfolio"  id="portfolio">
	 <div class="welcome-top">
				<div id="portfoliolist">
				<?php foreach($gallery as $vgallery):?>
					<div class="portfolio card mix_all  wow bounceIn" data-wow-delay="0.4s" data-cat="card" style="display: inline-block; opacity: 1;">
						<div class="portfolio-wrapper grid_box">
							<div class="welcome-1">	
								<a href="<?=$vgallery['path'];?>" class="swipebox"  title="Image Title"> <img src="<?=$vgallery['path'];?>" class="img-responsive" alt=""><span class="zoom-icon"></span> </a>
							</div>
						</div>
		            </div>		
				<?php endforeach;?>
    </div>
	</div>
	  <!-- Script for gallery Here -->
				<script type="text/javascript" src="public/js/jquery.mixitup.min.js" ></script>
					<script type="text/javascript">
					$(function () {
						
						var filterList = {
						
							init: function () {
							
								// MixItUp plugin
								// http://mixitup.io
								$('#portfoliolist').mixitup({
									targetSelector: '.portfolio',
									filterSelector: '.filter',
									effects: ['fade'],
									easing: 'snap',
									// call the hover effect
									onMixEnd: filterList.hoverEffect()
								});				
							
							},
							
							hoverEffect: function () {
							
								// Simple parallax effect
								$('#portfoliolist .portfolio').hover(
									function () {
										$(this).find('.label').stop().animate({bottom: 0}, 200, 'easeOutQuad');
										$(this).find('img').stop().animate({top: -30}, 500, 'easeOutQuad');				
									},
									function () {
										$(this).find('.label').stop().animate({bottom: -40}, 200, 'easeInQuad');
										$(this).find('img').stop().animate({top: 0}, 300, 'easeOutQuad');								
									}		
								);				
							
							}
				
						};
						
						// Run the show!
						filterList.init();
						
						
					});	
					</script>
<!-- portfolio-section  -->

		</div>
</div>
<!-- more -->
<div class="more-recent">
	<div class="container">
		<div class="col-md-6 more-left">
			<h3><span>多一点</span> 关于网站</h3>
			<p><?=$webMore;?></p>
		</div>
		<div class="col-md-6 recent">
			<h3><span>最近</span> 发表</h3>
			<?php foreach($detailsThree as $vthree):?>
				<div class="recent-top">
					<div class="recent-left">
						<img src="<?=$vthree['path'];?>" class="img-responsive" alt="">
					</div>
					<div class="recent-right">
						<h5><?php echo date('Y-m-d H:i:s',$vthree['addtime']);?><span><?=$vthree['title'];?></span></h5>
						<p><?=$vthree['content'];?></p>
					</div>
						<div class="clearfix"></div>
				</div>
			<?php endforeach;?>
				<div class="button"><a class="more" href="index.php?m=blog&a=index"><i>查看更多</i></a></div>
		</div>
			<div class="clearfix"></div>
	</div>
</div>
<!-- more -->
<!-- footer -->
<div class="footer">
	<div class="container">
		<div class="col-md-4 social">
			<h4>友情链接</h4>
			<ul>
				<?php foreach($link as $vlink):?>
					<li>
						<a href="<?=$vlink['url'];?>"><?=$vlink['name'];?></a>
						<br />
						"——<?=$vlink['description'];?>"
					</li>
					<!-- <div class="clearfix"></div>	 -->
				<?php endforeach;?>
			</ul>
		</div>
		<div class="col-md-4 information">
			<h4>网站介绍</h4>
			<p><?=$webInfo;?></p>
		</div>
		<div class="col-md-4 searby">
			<h4>快速搜索</h4>
			<div class="col-md-6 by1">
					<li><a href="index.php?m=index&a=search&searchStr=帖子">帖子</a></li>
					<li><a href="index.php?m=index&a=search&searchStr=侠盗飞车5">侠盗飞车5 </a></li>
					<li><a href="index.php?m=index&a=search&searchStr=刺客信条">刺客信条</a></li>
					<li><a href="index.php?m=index&a=search&searchStr=彩虹六号：围攻">彩虹六号：围攻</a></li>
					<li><a href="index.php?m=index&a=search&searchStr=幽灵行动：荒野">幽灵行动：荒野</a></li>
					<li><a href="index.php?m=index&a=search&searchStr=Switch">Switch</a></li>
					<li><a href="index.php?m=index&a=search&searchStr=看门狗">看门狗</a></li>
				</div>
				<div class="col-md-6 by1">
					<li><a href="index.php?m=index&a=search&searchStr=回复">回复</a></li>
					<li><a href="index.php?m=index&a=search&searchStr=steam">steam</a></li>
					<li><a href="index.php?m=index&a=search&searchStr=细胞分裂6">细胞分裂6</a></li>
					<li><a href="index.php?m=index&a=search&searchStr=荣耀战魂">荣耀战魂</a></li>
					<li><a href="index.php?m=index&a=search&searchStr=尼尔：机械纪元">尼尔：机械纪元</a></li>
					<li><a href="index.php?m=index&a=search&searchStr=使命召唤14">使命召唤14</a></li>
					<li><a href="index.php?m=index&a=search&searchStr=">战地1</a></li>
					
				</div>
				
					<div class="clearfix"> </div>
		</div>
			<div class="clearfix"></div>
			<div class="bottom">
					<p>Copyrights © 2015 <?=$webName;?> | Template by <a href="<?=$webUrl;?>"><?=$webTitle;?></a></p>
				</div>
	</div>
</div>
<!-- footer -->
</body>
</html>