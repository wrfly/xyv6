<?php
require_once 'lib/config.php';
?>
<!DOCTYPE html>
<html lang="zh-CN">
<head>
    <meta charset="utf-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <title><?php echo $site_name;  ?></title>
    <!-- Bootstrap core CSS -->
    <link href="asset/css/bootstrap.min.css" rel="stylesheet">
    <link href="asset/css/flat-ui.css" rel="stylesheet">
    <!-- Custom styles for this template -->
    <link href="asset/css/sticky-footer-navbar.css" rel="stylesheet">
    <!-- HTML5 shim and Respond.js for IE8 support of HTML5 elements and media queries -->
    <!--[if lt IE 9]>
    <script src="http://cdn.bootcss.com/html5shiv/3.7.2/html5shiv.min.js"></script>
    <script src="http://cdn.bootcss.com/respond.js/1.4.2/respond.min.js"></script>
    <![endif]-->
</head>

<body>

<!-- Fixed navbar -->
<nav class="navbar navbar-default navbar-fixed-top">
    <div class="container">
        <div class="navbar-header">
            <button type="button" class="navbar-toggle collapsed" data-toggle="collapse" data-target="#navbar" aria-expanded="false" aria-controls="navbar">
                <span class="sr-only">Toggle navigation</span>
                <span class="icon-bar"></span>
                <span class="icon-bar"></span>
                <span class="icon-bar"></span>
            </button>
            <a class="navbar-brand" href=""><?php echo $site_name;  ?></a>
        </div>

    </div>
</nav>

<!-- Begin page content -->
<div class="container">
    <div class="page-header">
        <h4>用户协议 Terms of Service </h4>
    </div>
    <h5>使用前必读</h5>
    <p>
        <ul>
            <!-- <li>如果你是为了打游戏而使用校园V6，那么对不起，我们让你失望了，V6并不支持那些无聊的游戏，它只能上网，下载，以及聊天。</li> -->
            <li>如果你是为了免费流量而使用校园V6，那么我们也许又让你失望了，免费用户只有3个G，而且只能使用特定的节点。</li>
            <li>我们的服务不适合伸手的人，尽管你觉着这样很好，但，没人有义务和责任为你提供免费的服务。</li>
            <li>我们的服务不适合懒惰的人，因为懒惰也属于七宗罪。</li>
            <li>我们的服务不会提供，也永远不会提供给违反法律法规的人，热爱自己的祖国，你是一个有尊严的人。</li>
            <li>我们不是公益慈善机构，但我们尽量做到让免费用户也能享受到更好的网络，所以，请您在下载的时候，尽量选择人少的节点，尽量在人少的时候下载，以免对其他免费用户造成影响，为了自己，也是为了大家。只要这个项目存在，我们会一直给免费用户提供充足的带宽，也许流量不够用，但相信我，我们尽力了。</li>
            <li>最后，向clowwindy致敬，向那个曾经存在过的项目致敬，向那些追求自由的人致敬！</li>
        </ul>
    </p>
    <h5>隐私</h5>
    <p>
        <ul>
            <li>本站接受各大网站的邮箱地址作为注册地址，并以邮箱作为用户的唯一凭证。</li>
            <li>本站会加密存储用户密码，如果丢失密码，请在登录页面找回密码。</li>
            <li>本站不会保存任何上网内容，包括用户上网记录，cookies，以及任何流量信息。</li>
        </ul>
    </p>

    <h5>使用条款</h5>
    <p>
        <ul>
            <li>禁止使用本站服务传播非法信息，非法信息包括但不限于政治，宗教，民族分裂，以及任何违反中华人民共和国法律的信息。</li>
            <li>禁止使用本站服务进行任何违法恶意活动，包括但不限于煽动民族分裂，国家分裂等严重损害国家利益以及国家形象的行为。</li>
            <li>使用任何节点，需遵循节点所属国家的相关法律以及中国法律。</li>
            <li>禁止滥用本站提供的服务，不得进行BT下载，浏览不良信息等。</li>
            <li>任何违法使用条款的用户，我们将会删除违规账户并没收使用本站服务的权利。</li>
       </ul>
    </p>

    <h5>其它</h5>
    <p>
    <ul>
        <li>最终解释权归本站所有。</li>
        <li>TOS更新时用户需要遵守最新TOS。</li>
    </ul>
    </p>

</div>

<footer class="footer">
    <div class="container">
        <p class="text-muted"><strong>Copyright &copy; 2015-<?php echo date('Y'); ?> <a href="#"><?php echo $site_name;  ?></a>.</strong> All rights reserved. Based on <b>ss-panel</b> </p>
    </div>
</footer>


<!-- Bootstrap core JavaScript
================================================== -->
<!-- Placed at the end of the document so the pages load faster -->
<script src="asset/js/jQuery.min.js"></script>
<script src="asset/js/bootstrap.min.js"></script>

</body>
</html>
