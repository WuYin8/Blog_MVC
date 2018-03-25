<!DOCTYPE html>
<html xmlns="http://www.w3.org/1999/xhtml">
<head>
    <meta charset="utf-8" />
    <meta name="viewport" content="width=device-width, initial-scale=1.0" />
    <title>后台管理</title>
    <!-- BOOTSTRAP STYLES-->
    <link href="public/css/bootstrapAdmin.css" rel="stylesheet" />
    <!-- FONTAWESOME STYLES-->
    <link href="public/css/font-awesome.css" rel="stylesheet" />
    <!-- CUSTOM STYLES-->
    <link href="public/css/custom.css" rel="stylesheet" />
    <!-- GOOGLE FONTS-->
    <!-- <link href='http://fonts.googleapis.com/css?family=Open+Sans' rel='stylesheet' type='text/css' /> -->
</head>
<body>
    <div id="wrapper">
        <div class="navbar navbar-inverse navbar-fixed-top">
            <div class="adjust-nav">
                <div class="navbar-header">
                    <button type="button" class="navbar-toggle" data-toggle="collapse" data-target=".sidebar-collapse">
                        <span class="icon-bar"></span>
                        <span class="icon-bar"></span>
                        <span class="icon-bar"></span>
                    </button>
                    <a class="navbar-brand" href="index.php?m=index&a=index"><img src="public/images/logo.png" height="50px" /></a>
                </div>
                <div class="navbar-collapse collapse">
                    <ul class="nav navbar-nav navbar-right">
                        <li><img src="<?=$_SESSION['pic'];?>" width="50px" height="50px" /></li>
                        <li class = "adminName"><?=$_SESSION['username'];?></li>
                        <li><a href="index.php?m=admin&a=logout">退出登录</a></li>
                    </ul>
                </div>

            </div>
        </div>
        <!-- /. NAV TOP  -->
        <nav class="navbar-default navbar-side" role="navigation">
            <div class="sidebar-collapse">
                <ul class="nav" id="main-menu">
                    <li class="text-center user-image-back">
                        <img src="assets/img/find_user.png" class="img-responsive" />
                     
                    </li>
                    <li>
                        <a href="index.php?m=admin&a=index"><i class="fa fa-table "></i>用户管理</a>
                    </li>
                    <li>
                        <a href="index.php?m=admin&a=content"><i class="fa fa-qrcode "></i>文章管理</a>
                    </li>
                    <li>
                        <a href="index.php?m=admin&a=reply"><i class="fa fa-bar-chart-o"></i>回复管理</a>
                    </li>
                    <li>
                        <a href="#"><i class="fa fa-edit "></i>回收站<span class="fa arrow"></span></a>
                        <ul class="nav nav-second-level">
                            <li>
                                <a href="index.php?m=admin&a=userDel">用户锁定管理</a>
                            </li>
                            <li>
                                <a href="index.php?m=admin&a=contentDel">文章回收站</a>
                            </li>
                            <li>
                                <a href="index.php?m=admin&a=replyDel">回复回收站</a>
                            </li>
                        </ul>
                    </li>
                </ul>

            </div>

        </nav>
        <!-- /. NAV SIDE  -->
        <div id="page-wrapper">
            <div id="page-inner">
                <div class="row">
                    <div class="col-md-12">
                        <h2>
                            <?php if($_GET['a'] == 'index'):?>
                            用户管理
                            <?php elseif($_GET['a'] == 'userDel'):?>
                            用户锁定管理
                            <?php endif;?>

                        </h2>
                        <hr />
                    </div>
                </div>
                <div class="row">
                    <div class="col-md-6">
                        <!-- <h5>Table  Sample One</h5> -->
                         <?php if($_GET['a'] == 'index'):?>
                            <form action="index.php?m=admin&a=userLock" method = "post">
                            <?php elseif($_GET['a'] == 'userDel'):?>
                           <form action="index.php?m=admin&a=userDel" method = "post">
                            <?php endif;?>
                        
                        <table class="table table-striped table-bordered table-hover">
                                <tr>
                                    <th>选择</th>
                                    <th>用户名</th>
                                    <th>头像</th>
                                    <th>手机号</th>
                                    <?php if($_GET['a'] == 'userDel'):?>
                                    <th>删除</th>
                                    <?php endif;?>

                                </tr>
                                <?php if(!empty($users)):?>
                                <?php foreach($users as $vUser):?>
                                <tr>
                                    <?php if($vUser['undertype'] == '0'):?>
                                    <td><input type = "checkbox" name = "uid[]" value = "<?=$vUser['uid'];?>"/></td>
                                    <?php elseif($vUser['undertype'] == '1'):?>
                                    <td>管理员</td>
                                    <?php endif;?>
                                    <td><?=$vUser['username'];?></td>
                                    <td><?=$vUser['picture'];?></td>
                                    <td><?=$vUser['phone'];?></td>
                                    <?php if($_GET['a'] == 'userDel'):?>
                                        <td>
                                            <a href="index.php?m=admin&a=deleteUser&delId=<?=$vUser['uid'];?>">删除
                                        </td>
                                    <?php endif;?>
                                </tr>
                               <?php endforeach;?>
                               <?php endif;?>
                        </table>
                         <!-- 分页 -->
                        <div class="pagination pagination__posts">
                            <a href="<?=$page['first'];?>">首页</a>&nbsp;
                            <a href="<?=$page['prev'];?>">前页</a>&nbsp;
                            <a href="<?=$page['next'];?>">后页</a>&nbsp;
                            <a href="<?=$page['end'];?>">尾页</a>
                        <div class="clearfix"></div>    
                        </div>
                        <!-- 分页 -->
                            <?php if($_GET['a'] == 'index'):?>
                            <input type = "submit" value = "锁定" class="btn btn-danger btn-lg btn-block" />
                            <?php elseif($_GET['a'] == 'userDel'):?>
                            <input type = "submit" value = "解锁" class="btn btn-danger btn-lg btn-block" />
                            <?php endif;?>
                    </form>
                    </div>
                </div>
                    
                
                   
                <!-- /. ROW  -->
               
            </div>
            <!-- /. PAGE INNER  -->
        </div>
        <!-- /. PAGE WRAPPER  -->
    </div>
    <!-- /. WRAPPER  -->
    <!-- SCRIPTS -AT THE BOTOM TO REDUCE THE LOAD TIME-->
    <!-- JQUERY SCRIPTS -->
    <script src="public/js/jquery-1.10.2.js"></script>
    <!-- BOOTSTRAP SCRIPTS -->
    <script src="public/js/bootstrap.min.js"></script>
    <!-- METISMENU SCRIPTS -->
    <script src="public/js/jquery.metisMenu.js"></script>
    <!-- CUSTOM SCRIPTS -->
    <script src="public/js/custom.js"></script>


</body>
</html>
