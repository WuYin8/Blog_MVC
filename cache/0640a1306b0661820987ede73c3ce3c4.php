<!--
Author: W3layouts
Author URL: http://w3layouts.com
License: Creative Commons Attribution 3.0 Unported
License URL: http://creativecommons.org/licenses/by/3.0/
-->
<!DOCTYPE HTML>
<html>
<head>
<title><?=$webTitle;?> - 个人资料</title>
<link href="public/css/bootstrap.css" rel="stylesheet" type="text/css" media="all">
<link href="public/css/style.css" rel="stylesheet" type="text/css" media="all" />
<link rel="stylesheet" href="public/editor/css/editormd.css" />
		<script src="public/editor/js/jquery.min.js"></script>
		<script src="public/editor/editormd.min.js"></script>
		<script type="text/javascript">
			$(function() {
				testEditor = editormd("test-editormd", {
						width   : "100%",
						height  : 600,
						syncScrolling : "single",
						path    : "public/editor/lib/"
					});

			});
		</script>
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
				<a href="index.html"><img src="public/images/logo.png" class="img-responsive" alt=""></a>
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
							<li><a href="index.php?m=index&a=index">首页</a></li>
							<li><a href="index.php?m=blog&a=index">博客</a></li>
							<?php if(empty($_SESSION['username'])):?>
							<li><a href="index.php?m=user&a=index">登录</a></li>
							<?php else: ?>
							<li class="active"><a href="index.php?m=person&a=index">个人资料</a></li>
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
	<div class="main">
		<div class="container">
		   <div class="content">	 	 
		 		<div class="section group">
				<div class="col-md-99 cont span_2_of_3">
				  <div class="contact-form">
				  <form  method = "post" action = "index.php?m=person&a=change" enctype="multipart/form-data">
								<div class="contact-form-row">
									<div>
										<span class = 'tspan'>更改用户名 :</span>
										<input type="text" class="text" name = "username" placeholder="<?=$_SESSION['username'];?>" />
									</div>
									<div>
										<span class = 'tspan'>更改头像 :</span>
										<img src = "<?=$_SESSION['pic'];?>" width="50px" height="50px" />
										<input type="file" name="face" />
										<input type="hidden" name="MAX_FILE_SIZE" value="2000000" />
									</div>
									<div>
										<span class = 'tspan'>更改密码(旧密码) :</span>
										<input type="password" class="text" name = "pwd" placeholder="确认旧密码后才能修改密码与手机号" onfocus="this.value = '';" />
									</div>
									<div>
										<span class = 'tspan'>更改密码(新密码) :</span>
										<input type="password" class="text" name = "newPwd" placeholder="密码长度为6~12字节" onfocus="this.value = '';"  />
									</div>
									<div>
										<span class = 'tspan'>更改手机号 :</span>
										<input type="text" class="text" name = "phone" placeholder="确认旧密码后才能修改手机号" onfocus="this.value = '';"  />
									</div>
									<div class="clearfix"> </div>
								<input type="submit" name="submit" value="确认修改" />
								</div>
								</form>
								<div class="clearfix"> </div>
						</div>
				<div class="col-md-3 rsidebar span_1_of_3 services_list">
				    
				  </div>	
					<div class="clearfix"> </div>				  
		      </div>
			</div>
		</div>
	</div>
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