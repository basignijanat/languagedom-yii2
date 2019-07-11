<?php

/* @var $this \yii\web\View */
/* @var $content string */

use app\widgets\Alert;
use yii\helpers\Html;
use yii\bootstrap\Nav;
use yii\bootstrap\NavBar;
use yii\widgets\Breadcrumbs;
use app\assets\AdminAsset;
use app\models\Cart;
use yii\helpers\Url;
use app\models\Checkout;

AdminAsset::register($this);

?>
<?php $this->beginPage() ?>
<!DOCTYPE html>
<html lang="<?= Yii::$app->language ?>">
<head>
    <meta charset="<?= Yii::$app->charset ?>">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <?php $this->registerCsrfMetaTags() ?>
    <title><?= Html::encode($this->title) ?></title>
    <?php $this->head() ?>
</head>
<?php $this->beginBody() ?>
<body class="fix-header">
    <!-- ============================================================== -->
    <!-- Preloader -->
    <!-- ============================================================== -->
    <div class="preloader">
        <svg class="circular" viewBox="25 25 50 50">
            <circle class="path" cx="50" cy="50" r="20" fill="none" stroke-width="2" stroke-miterlimit="10" />
        </svg>
    </div>
    <!-- ============================================================== -->
    <!-- Wrapper -->
    <!-- ============================================================== -->
    <div id="wrapper">
        <!-- ============================================================== -->
        <!-- Topbar header - style you can find in pages.scss -->
        <!-- ============================================================== -->
        <nav class="navbar navbar-default navbar-static-top m-b-0">
            <div class="navbar-header">
                <div class="top-left-part">
                    <!-- Logo -->
                    <a class="logo" href="dashboard.html">
                        <!-- Logo icon image, you can use font-icon also --><b>
                        <!--This is dark logo icon--><img src="<?=Yii::$app->params['adminimage']?>/adminassets/plugins/images/admin-logo.png" alt="home" class="dark-logo" /><!--This is light logo icon--><img src="<?=Yii::$app->params['adminimage']?>/adminassets/plugins/images/admin-logo-dark.png" alt="home" class="light-logo" />
                     </b>
                        <!-- Logo text image you can use text also --><span class="hidden-xs">
                        <!--This is dark logo text--><img src="<?=Yii::$app->params['adminimage']?>/adminassets/plugins/images/admin-text.png" alt="home" class="dark-logo" /><!--This is light logo text--><img src="<?=Yii::$app->params['adminimage']?>/adminassets/plugins/images/admin-text-dark.png" alt="home" class="light-logo" />
                     </span> </a>
                </div>
                <!-- /Logo -->
                <ul class="nav navbar-top-links navbar-right pull-right">
                    <li>
                        <form role="search" class="app-search hidden-sm hidden-xs m-r-10">
                            <input type="text" placeholder="Search..." class="form-control"> <a href=""><i class="fa fa-search"></i></a> </form>
                    </li>
                    <li>
                        <a class="profile-pic" href="#"> <img src="<?=Yii::$app->params['adminimage']?>/adminassets/plugins/images/users/varun.jpg" alt="user-img" width="36" class="img-circle"><b class="hidden-xs">Steave</b></a>
                    </li>
                </ul>
            </div>
            <!-- /.navbar-header -->
            <!-- /.navbar-top-links -->
            <!-- /.navbar-static-side -->
        </nav>
        <!-- End Top Navigation -->
        <!-- ============================================================== -->
        <!-- Left Sidebar - style you can find in sidebar.scss  -->
        <!-- ============================================================== -->
        <div class="navbar-default sidebar" role="navigation">
            <div class="sidebar-nav slimscrollsidebar">
                <div class="sidebar-head">
                    <h3><span class="fa-fw open-close"><i class="ti-close ti-menu"></i></span> <span class="hide-menu">Navigation</span></h3>
                </div>
                <ul class="nav" id="side-menu">
                    <li style="padding: 70px 0 0;">
                        <a href="<?=Url::to(['/admin'])?>" class="waves-effect"><i class="fa fa-clock-o fa-fw" aria-hidden="true"></i>Админпанель</a>
                    </li>
                    <li>
                        <a href="<?=Url::to(['/admin/language'])?>" class="waves-effect"><i class="fa fa-table fa-fw" aria-hidden="true"></i><?= Yii::t('app\admin', 'Languages')?> <span class="pull-right badge badge-info badge-pill ml-auto mr-3 font-medium px-2 py-1"><?=$order_count?></span></a>
                    </li>
                    <li>
                        <a href="<?=Url::to(['/admin/eduform'])?>" class="waves-effect"><i class="fa fa-table fa-fw" aria-hidden="true"></i><?= Yii::t('app\admin', 'Teaching Methods') ?></a>
                    </li>
                    <li>
                        <a href="<?=Url::to(['/admin/userlang'])?>" class="waves-effect"><i class="fa fa-table fa-fw" aria-hidden="true"></i><?= Yii::t('app\admin', 'User Languages') ?></a>
                    </li>
                    <li>
                        <a href="<?=Url::to(['/admin/user'])?>" class="waves-effect"><i class="fa fa-table fa-fw" aria-hidden="true"></i><?= Yii::t('app\admin', 'Users') ?></a>
                    </li>
                    <li>
                        <a href="<?=Url::to(['/admin/teacher'])?>" class="waves-effect"><i class="fa fa-table fa-fw" aria-hidden="true"></i><?= Yii::t('app\admin', 'Teachers') ?></a>
                    </li>
                    <li>
                        <a href="<?=Url::to(['/admin/student'])?>" class="waves-effect"><i class="fa fa-table fa-fw" aria-hidden="true"></i><?= Yii::t('app\admin', 'Students') ?></a>
                    </li>
                    <li>
                        <a href="<?=Url::to(['/admin/comment'])?>" class="waves-effect"><i class="fa fa-table fa-fw" aria-hidden="true"></i><?= Yii::t('app\admin', 'Comments') ?></a>
                    </li>
                    <li>
                        <a href="<?=Url::to(['/admin/price'])?>" class="waves-effect"><i class="fa fa-table fa-fw" aria-hidden="true"></i><?= Yii::t('app\admin', 'Prices') ?></a>
                    </li>
                    <li>
                        <a href="<?=Url::to(['/admin/faq'])?>" class="waves-effect"><i class="fa fa-table fa-fw" aria-hidden="true"></i><?= Yii::t('app\admin', 'FAQ') ?></a>
                    </li>
                </ul>
                <div class="center p-20">
                     <a href="https://wrappixel.com/templates/ampleadmin/" target="_blank" class="btn btn-danger btn-block waves-effect waves-light">Upgrade to Pro</a>
                 </div>
            </div>
            
        </div>
        <!-- ============================================================== -->
        <!-- End Left Sidebar -->
        <!-- ============================================================== -->
        <!-- ============================================================== -->
        <!-- Page Content -->
        <!-- ============================================================== -->
        <div id="page-wrapper">
            <div class="container-fluid">
                <div class="row bg-title">
                    <div class="col-lg-3 col-md-4 col-sm-4 col-xs-12">
                        <h4 class="page-title">Dashboard</h4> </div>
                    <div class="col-lg-9 col-sm-8 col-md-8 col-xs-12">
                        <a href="https://wrappixel.com/templates/ampleadmin/" target="_blank" class="btn btn-danger pull-right m-l-20 hidden-xs hidden-sm waves-effect waves-light">Upgrade to Pro</a>
                        <ol class="breadcrumb">
                            <li><a href="#">Dashboard</a></li>
                        </ol>
                    </div>
                    <!-- /.col-lg-12 -->
                </div>
                <!-- /.row -->
                <!-- ============================================================== -->
                <!-- Different data widgets -->
                <!-- ============================================================== -->
                <!-- .row -->
                <?=$content?>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                    <!-- /.col -->
                </div>
            </div>
            <!-- /.container-fluid -->
            <footer class="footer text-center"> 2017 &copy; Ample Admin brought to you by wrappixel.com </footer>
        </div>
        <!-- ============================================================== -->
        <!-- End Page Content -->
        <!-- ============================================================== -->
    </div>
</body>
<?php $this->endBody() ?>
</html>
<?php $this->endPage() ?>
