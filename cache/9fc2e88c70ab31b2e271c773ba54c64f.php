<!DOCTYPE html>
<html >
<head>
<meta charset="UTF-8">
<title>登录/注册</title>
<meta name="description" content="HTML5交互式注册登录切换jQuery特效代码，用户体验友好！" /> 
<meta name="keywords" content="HTML5,交互式,注册登录,切换,jQuery特效代码" />
<meta name="author" content="js代码" />
<meta name="Copyright" content="js代码" />
<link rel="stylesheet" href="public/css/styleUser.css">
<link rel="stylesheet" type="text/css" href="./public/public/bootstrap/css/bootstrap.css">
  <link rel="stylesheet" type="text/css" href="./public/public/bootstrap/js/bootstrap.min.css">
  <link rel="stylesheet" type="text/css" href="./public/public/bootstrap/js/bootstrap.css">
  <link rel="stylesheet" type="text/css" href="./public/public/bootstrap/js/datetime.css">
  <script type="text/javascript" src="./public/public/jquery-1.8.1.min.js"></script>
  <style>
    .butt{
      width:274px;
    }
    #code{
      width:116px;
    }
  </style>
</head>
<body>
<body>
<div class="cotn_principal">
<div class="logo">
  <a href="index.php?m=index&a=index"><img src="public/images/logo.png" class="img-responsive" alt="" title = "点击回到首页"></a>
<div class="user">
  <div class="cont_centrar">
    <div class="cont_login">
      <div class="cont_info_log_sign_up">
        <div class="col_md_login">
          <div class="cont_ba_opcitiy">
            <h2>登录</h2>
            <p>已有账号，直接登录！</p>
            <button class="btn_login" onclick="cambiar_login()">登录</button>
          </div>
        </div>
        <div class="col_md_sign_up">
          <div class="cont_ba_opcitiy">
            <h2>注册</h2>
            <p>还没有账号？免费注册！</p>
            <button class="btn_sign_up" onclick="cambiar_sign_up()">注册</button>
          </div>
        </div>
      </div>
      <div class="cont_back_info">
        <div class="cont_img_back_grey"> <img src="public/images/po.jpg" alt="" /> </div>
      </div>
      <div class="cont_forms" >
        <div class="cont_img_back_"> <img src="public/images/po.jpg" alt="" /> </div>
        <form method = "post" action = "index.php?m=user&a=login">
          <div class="cont_form_login"> <a href="#" onclick="ocultar_login_sign_up()" >X</a>
            <h2>登录</h2>
              <input type="text" name = "loginName" placeholder="用户名称" />
              <input type="password" name = "loginPwd" placeholder="密码" />
              <button class="btn_login" onclick="cambiar_login()">登录</button>
          </div>
        </form>
        <form method = "post" action = "index.php?m=user&a=register">
          <div class="cont_form_sign_up"> <a href="#" onclick="ocultar_login_sign_up()">X</a>
            <h2>注册</h2>
            <input type="text" name = "registerName" placeholder="用户名长度为6~12位" />
            <input type="password" name = "registerPwd" placeholder="密码长度为6~12位" />
            <input type="password" name = "registerPwd2" placeholder="确认密码" />
            <input type="text" name = "phone" placeholder="手机号码" id = "phone" />
            <input class = "phoneCode" name = "code" type="text" placeholder="手机验证码" /><a href='javascript:;'  class="btn btn-info" id='getcode' onclick='getcode()'>获取验证码</a>
            <script>
              function getcode()
              {
                $('#getcode').text('60秒后重新获取');
                $('#getcode').removeAttr('onclick');
                var phone = $('#phone').val();
                //写个定时修改文本settime
                var time = 59;
                var into = setInterval(function(){

                  $('#getcode').text(time+'秒后重新获取');
                  time =time -1;
                  if(time<=-1){
                    clearInterval(into);
                    $('#getcode').text('获取验证码');
                    $('#getcode').attr('onclick');
                  }
                },1000);
                // alert(phone);
                //ajax    参数1,url  index1.php   参数2, 数据   1234565432
                $.get('index.php?m=user&a=Code',{phone:phone},function(date){
                  console.log(date);
                });
              }
            </script>
            <button class="btn_sign_up" onclick="cambiar_sign_up()">注册</button>
          </div>
        </form>
      </div>
    </div>
  </div>
</div>
<script src="public/js/user.js"></script>
</body>
</body>
</html>
