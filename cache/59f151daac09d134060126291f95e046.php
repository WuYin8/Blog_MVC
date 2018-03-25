<!DOCTYPE HTML>
<html dir="ltr" lang="en-US">
	<head>
	<meta http-equiv="Content-Type" content="text/html; charset=utf-8" />

	<title>后台登录</title>

	<!--- CSS --->
	<link rel="stylesheet" href="public/css/styleAdminLogin.css" type="text/css" />


	<!--- Javascript libraries (jQuery and Selectivizr) used for the custom checkbox --->

	<!--[if (gte IE 6)&(lte IE 8)]>
		<script type="text/javascript" src="public/js/jquery-1.7.1.min.js"></script>
		<script type="text/javascript" src="public/js/selectivizr.js"></script>
		<noscript><link rel="stylesheet" href="public/css/fallback.css" /></noscript>
	<![endif]-->

	</head>

	<body>
		<div id="container">
			<form action="index.php?m=admin&a=index" method="post">
				<div class="login">后台管理登录</div>
				<div class="username-text">Username:</div>
				<div class="password-text">Password:</div>
				<div class="username-field">
					<input type="text" name="username" placeholder ="管理员用户名" />
				</div>
				<div class="password-field">
					<input type="password" name="password" placeholder ="密码" />
				</div>
				<div class="login2" width="200px"><a href="index.php?m=index&a=index">返回前台页面</a></div>
				<input type="submit" name="submit" value="GO" />
			</form>
		</div>
	</body>
</html>
