<?php
require_once 'lib/config.php';
require_once '_check.php';
?>
<!DOCTYPE html>
<html>
<head>
    <meta charset="UTF-8">
    <title><?php echo $site_name;  ?></title>
    <meta content='width=device-width, initial-scale=1, maximum-scale=1, user-scalable=no' name='viewport'>
    <!-- Bootstrap 3.3.2 -->
    <link href="asset/css/bootstrap.min.css" rel="stylesheet" type="text/css" />

    <link rel="shortcut icon" href="xyv6.png">
    <!-- Font Awesome Icons -->
    <link href="asset/css/f-a.css" rel="stylesheet" type="text/css" />
    <!-- Ionicons -->
    <link href="asset/css/ionicons.min.css" rel="stylesheet" type="text/css" />
    <!-- Theme style -->
    <link href="asset/css/AdminLTE.min.css" rel="stylesheet" type="text/css" />
    <!-- AdminLTE Skins. Choose a skin from the css/skins
         folder instead of downloading all of them to reduce the load. -->
    <link href="asset/css/skins/_all-skins.min.css" rel="stylesheet" type="text/css" />

    <script src="asset/js/jQuery.min.js"></script>
    <script src="asset/plugins/layer/layer.js"></script>

    <!-- HTML5 Shim and Respond.js IE8 support of HTML5 elements and media queries -->
    <!-- WARNING: Respond.js doesn't work if you view the page via file:// -->
    <!--[if lt IE 9]>
    <script src="https://oss.maxcdn.com/libs/html5shiv/3.7.0/html5shiv.js"></script>
    <script src="https://oss.maxcdn.com/libs/respond.js/1.3.0/respond.min.js"></script>
    <![endif]-->


<!-- jQuery 2.1.3 -->
<script src="asset/js/jQuery.min.js"></script>
<!-- Bootstrap 3.3.2 JS -->
<script src="asset/js/bootstrap.min.js" type="text/javascript"></script>
<!-- SlimScroll -->
<script src="asset/plugins/slimScroll/jquery.slimscroll.min.js" type="text/javascript"></script>
<!-- FastClick -->
<script src='asset/plugins/fastclick/fastclick.min.js'></script>
<!-- AdminLTE App -->
<script src="asset/js/app.min.js" type="text/javascript"></script>

</head>
<body class="skin-blue">
<!-- Site wrapper -->
<div class="wrapper fixed">

    <header class="main-header">
    <a href="https://xiaoyuanv6.com" class="logo"><i class="fa fa-vimeo-square"></i> <?php echo $site_name;  ?></a>
        <!-- Header Navbar: style can be found in header.less -->
        <nav class="navbar navbar-static-top" role="navigation">
            <!-- Sidebar toggle button-->
            <a href="#" class="sidebar-toggle" data-toggle="offcanvas" role="button">
                <span class="sr-only">Toggle navigation</span>
                <span class="icon-bar"></span>
                <span class="icon-bar"></span>
                <span class="icon-bar"></span>
                菜单
            </a>
            <div class="navbar-custom-menu">
                <ul class="nav navbar-nav">
                    <!-- User Account: style can be found in dropdown.less -->
                    <li class="dropdown user user-menu">
                        <a href="#" class="dropdown-toggle" data-toggle="dropdown">
                            <img src="<?php echo \Ss\User\Comm::Gravatar($U->GetEmail());  ?>" class="user-image" alt="User Image"/>
                            <span class="hidden-xs"><?php echo $U->GetUserName(); ?></span>
                        </a>
                        <ul class="dropdown-menu">
                            <!-- User image -->
                            <li class="user-header">
                                <img src="<?php echo \Ss\User\Comm::Gravatar($U->GetEmail());  ?>" alt="User Image" />
                                <p>
                                    <?php echo $U->GetEmail(); ?>
                                    <small>注册时间：<?php echo $U->RegDate(); ?></small>
                                </p>
                            </li>
                            <li class="user-footer">
                                <div class="pull-left">
                                    <a href="my" class="btn btn-default btn-flat">个人信息</a>
                                </div>
                                <div class="pull-right">
                                    <a href="logout" class="btn btn-default btn-flat">退出</a>
                                </div>
                            </li>
                        </ul>
                    </li>
                </ul>
            </div>
        </nav>
    </header>

    <!-- =============================================== -->

    <!-- Left side column. contains the sidebar -->
    <aside class="main-sidebar">
        <!-- sidebar: style can be found in sidebar.less -->
        <section class="sidebar">
            <!-- Sidebar user panel -->
            <div class="user-panel">
                <div class="pull-left image">
                    <img src="<?php echo \Ss\User\Comm::Gravatar($U->GetEmail());  ?>" alt="User Image" />
                </div>
                <div class="pull-left info">
                    <p><?php echo $U->GetUserName(); ?></p>

                    <a href="#"><i class="fa fa-circle text-success"></i> Online</a>
                </div>
            </div>

            <!-- sidebar menu: : style can be found in sidebar.less -->
            <ul class="sidebar-menu">
                <li>
                    <a href="index">
                        <i class="fa fa-dashboard"></i> <span>用户中心</span>
                    </a>
                </li>

                <li>
                    <a href="node">
                        <i class="fa fa-sitemap"></i> <span>节点列表</span>
                    </a>
                </li>

                <li >
                    <a href="my">
                        <i class="fa fa-user"></i> <span>我的信息</span>
                    </a>
                </li>

                <li >
                    <a href="purchase">
                        <i class="fa fa-jpy"></i> <span>购买套餐</span>
                    </a>
                </li>

                <li >
                    <a href="invoices">
                        <i class="fa fa-history"></i> <span>购买记录</span>
                    </a>
                </li>

                <li >
                    <a href="update">
                        <i class="fa  fa-pencil"></i> <span>密码修改</span>
                    </a>
                </li>

                <li>
                    <a style="color: orange" href="invite">
                        <i class="fa fa-user-plus"></i> <span><b>邀请返利</b></span>
                    </a>
                </li>

                <li>
                    <a href="feedback">
                        <i class="fa fa-envelope-o"></i></i> <span>意见反馈</span>
                    </a>
                </li>

            </ul>
        </section>
        <!-- /.sidebar -->
    </aside>
