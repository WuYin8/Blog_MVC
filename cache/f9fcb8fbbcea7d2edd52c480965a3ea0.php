<!DOCTYPE html>
<html>
<head>
<title>提示页面</title>
<meta name="viewport" content="width=device-width, initial-scale=1">
<meta http-equiv="Content-Type" content="text/html; charset=utf-8" />
<meta name="keywords" content="" />
<meta http-equiv="refresh" content="<?=$sec;?>;url=<?=$url;?>">
<link href="public/css/styleNotice.css" rel="stylesheet" type="text/css" media="all">
<link href="public/css/font-awesome.css" rel="stylesheet" type="text/css" media="all">
<!-- online-fonts -->
<link href="http://fonts.googleapis.com/css?family=Open+Sans:300,300i,400,400i,600,600i,700,700i,800,800i&subset=cyrillic,cyrillic-ext,greek,greek-ext,latin-ext,vietnamese" rel="stylesheet">
<!--//online-fonts -->
<body>
<div class="header">
	<h1>萌萌的提示页面</h1>
</div>
<div class="w3-main">
	<div class="agile-info">
		<h3>oops!</h3>
		<p><?=$msg;?></p>
			
		<a href="<?=$url;?>">手动返回</a>
	</div>
</div>

</body>
</html>