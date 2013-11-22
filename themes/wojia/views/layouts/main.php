<?php
/** @var Controller $this */

/** @var CClientScript $clientScript */
$clientScript = Yii::app()->clientScript;

// setup script map for jquery and jquery-ui cdn
$clientScript->scriptMap['jquery.js'] = '//ajax.googleapis.com/ajax/libs/jquery/1.10.2/jquery.js';
$clientScript->scriptMap['jquery.min.js'] = '//ajax.googleapis.com/ajax/libs/jquery/1.10.2/jquery.min.js';
$clientScript->scriptMap['jquery-ui.js'] = '//ajax.googleapis.com/ajax/libs/jqueryui/1.10.3/jquery-ui.js';
$clientScript->scriptMap['jquery-ui.min.js'] = '//ajax.googleapis.com/ajax/libs/jqueryui/1.10.3/jquery-ui.min.js';

// register js files
$clientScript->registerCoreScript('jquery');
$clientScript->registerScriptFile('//netdna.bootstrapcdn.com/bootstrap/3.0.0/js/bootstrap.min.js', CClientScript::POS_END);
$clientScript->registerScriptFile(Yii::app()->theme->baseUrl . '/assets/js/main.js', CClientScript::POS_END);

/** @var WebUser $user */
$user = Yii::app()->user;
?>
<!DOCTYPE html>
<html lang="<?php echo substr(Yii::app()->language, 0, 2); ?>">
<head>
    <meta charset="<?php echo Yii::app()->charset; ?>">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta name="description" content="<?php echo Yii::app()->settings->site_description; ?>">
    <meta name="author" content="<?php echo Yii::app()->settings->site_author; ?>">

    <!-- CSS -->
    <link href="<?php echo Yii::app()->theme->baseUrl; ?>/assets/css/bootstrap.min.css" rel="stylesheet">
    <link href="<?php echo Yii::app()->theme->baseUrl; ?>/assets/css/main.css" rel="stylesheet">

    <!-- HTML5 shim and Respond.js IE8 support of HTML5 elements and media queries -->
    <!--[if lt IE 9]>
    <script src="<?php echo Yii::app()->theme->baseUrl; ?>/assets/js/html5shiv.min.js"></script>
    <script src="<?php echo Yii::app()->theme->baseUrl; ?>/assets/js/respond.min.js"></script>
    <![endif]-->

    <!-- Javascript -->
    <script>var baseUrl = "<?php echo Yii::app()->baseUrl; ?>";</script>

    <title><?php echo CHtml::encode($this->pageTitle); ?></title>
</head>
<body>
<div class="page-container">
<div class="navbar navbar-default navbar-fixed-top">
<div class="container">
<div class="navbar-header">
    <button type="button" class="navbar-toggle" data-toggle="collapse" data-target=".navbar-collapse">
        <span class="icon-bar"></span>
        <span class="icon-bar"></span>
        <span class="icon-bar"></span>
    </button>
    <?php echo CHtml::link(
        Yii::app()->settings->site_title,
        $this->createUrl('site/index'),
        array(
            'class' => 'navbar-brand',
        )
    ); ?>
</div>
<div class="collapse navbar-collapse">
    <?php if (!$user->isGuest): ?>
        <ul class="nav navbar-nav">
            <?php if ($user->checkAccess('project:index') || $user->checkAccess('service:index')): ?>
                <li class="dropdown">
                    <a class="dropdown-toggle" href="#" data-toggle="dropdown">
                        <?php echo Yii::t('wojia', 'Projects'); ?>
                        <b class="caret"></b>
                    </a>
                    <ul class="dropdown-menu">
                        <?php if ($user->checkAccess('project:index')): ?>
                            <li class="dropdown-header"><?php echo Yii::t('wojia', 'Projects'); ?></li>
                            <li>
                                <?php echo CHtml::link(
                                    Yii::t('wojia', 'All projects'),
                                    $this->createUrl('project/index')
                                ); ?>
                            </li>
                        <?php endif; ?>
                        <?php if ($user->checkAccess('project:create')): ?>
                            <li>
                                <?php echo CHtml::link(
                                    Yii::t('wojia', 'Add new'),
                                    $this->createUrl('project/create')
                                ); ?>
                            </li>
                        <?php endif; ?>

                        <?php if ($user->checkAccess('service:index')): ?>
                            <li class="divider"></li>
                            <li class="dropdown-header"><?php echo Yii::t('wojia', 'Services'); ?></li>
                            <li>

                                <?php echo CHtml::link(
                                    Yii::t('wojia', 'All services'),
                                    $this->createUrl('service/index')
                                ); ?>
                            </li>
                        <?php endif; ?>
                        <?php if ($user->checkAccess('service:create')): ?>
                            <li>
                                <?php echo CHtml::link(
                                    Yii::t('wojia', 'Add new'),
                                    $this->createUrl('service/create')
                                ); ?>
                            </li>
                        <?php endif; ?>
                    </ul>
                </li>
            <?php endif; ?>

            <?php if (
                $user->checkAccess('customer:index') ||
                $user->checkAccess('customer:create') ||
                $user->checkAccess('member:index') ||
                $user->checkAccess('member:create') ||
                $user->checkAccess('manager:index') ||
                $user->checkAccess('manager:create') ||
                $user->checkAccess('administrator:index')
            ): ?>
                <li class="dropdown">
                    <a class="dropdown-toggle" href="#" data-toggle="dropdown">
                        <?php echo Yii::t('wojia', 'Users'); ?>
                        <b class="caret"></b>
                    </a>
                    <ul class="dropdown-menu">
                        <?php if ($user->checkAccess('customer:index') || $user->checkAccess('customer:create')): ?>
                            <li class="dropdown-header"><?php echo Yii::t('wojia', 'Customers'); ?></li>
                        <?php endif; ?>
                        <?php if ($user->checkAccess('customer:index')): ?>
                            <li>
                                <?php echo CHtml::link(
                                    Yii::t('wojia', 'All customers'),
                                    $this->createUrl('customer/index')
                                ); ?>
                            </li>
                        <?php endif; ?>
                        <?php if ($user->checkAccess('customer:create')): ?>
                            <li>
                                <?php echo CHtml::link(
                                    Yii::t('wojia', 'Add new'),
                                    $this->createUrl('customer/create')
                                ); ?>
                            </li>
                        <?php endif; ?>

                        <?php if ($user->checkAccess('member:index') || $user->checkAccess('member:create')): ?>
                            <li class="divider"></li>
                            <li class="dropdown-header"><?php echo Yii::t('wojia', 'Members'); ?></li>
                        <?php endif; ?>
                        <?php if ($user->checkAccess('member:index')): ?>
                            <li>
                                <?php echo CHtml::link(
                                    Yii::t('wojia', 'All members'),
                                    $this->createUrl('member/index')
                                ); ?>
                            </li>
                        <?php endif; ?>
                        <?php if ($user->checkAccess('member:create')): ?>
                            <li>
                                <?php echo CHtml::link(
                                    Yii::t('wojia', 'Add new'),
                                    $this->createUrl('member/create')
                                ); ?>
                            </li>
                        <?php endif; ?>

                        <?php if ($user->checkAccess('manager:index') || $user->checkAccess('manager:create')): ?>
                            <li class="divider"></li>
                            <li class="dropdown-header"><?php echo Yii::t('wojia', 'Managers'); ?></li>
                        <?php endif; ?>
                        <?php if ($user->checkAccess('manager:index')): ?>
                            <li>
                                <?php echo CHtml::link(
                                    Yii::t('wojia', 'All managers'),
                                    $this->createUrl('manager/index')
                                ); ?>
                            </li>
                        <?php endif; ?>
                        <?php if ($user->checkAccess('manager:create')): ?>
                            <li>
                                <?php echo CHtml::link(
                                    Yii::t('wojia', 'Add new'),
                                    $this->createUrl('manager/create')
                                ); ?>
                            </li>
                        <?php endif; ?>

                        <?php if ($user->checkAccess('administrator:index')): ?>
                            <li class="divider"></li>
                            <li class="dropdown-header"><?php echo Yii::t('wojia', 'Administrators'); ?></li>
                            <li>
                                <?php echo CHtml::link(
                                    Yii::t('wojia', 'All administrators'),
                                    $this->createUrl('administrator/index')
                                ); ?>
                            </li>
                        <?php endif; ?>
                        <?php if ($user->checkAccess('administrator:create')): ?>
                            <li>
                                <?php echo CHtml::link(
                                    Yii::t('wojia', 'Add new'),
                                    $this->createUrl('administrator/create')
                                ); ?>
                            </li>
                        <?php endif; ?>
                    </ul>
                </li>
            <?php endif; ?>

            <?php if ($user->checkAccess('option:index')): ?>
                <li>
                    <?php echo CHtml::link(
                        Yii::t('wojia', 'Settings'),
                        $this->createUrl('option/index')
                    ); ?>
                </li>
            <?php endif; ?>
        </ul>
    <?php endif; ?>

    <ul class="nav navbar-nav navbar-right">
        <?php if ($user->isGuest): ?>
            <li>
                <?php echo CHtml::link(
                    Yii::t('wojia', 'Login'),
                    $this->createUrl('site/login')
                ); ?>
            </li>
        <?php else: ?>
            <li class="dropdown">
                <a class="dropdown-toggle" href="#" data-toggle="dropdown">
                    <?php echo Yii::t('wojia', 'Hi, :name', array(
                        ':name' => CHtml::encode($user->name),
                    )); ?>
                    <b class="caret"></b>
                </a>
                <ul class="dropdown-menu">
                    <li>
                        <?php echo CHtml::link(
                            Yii::t('wojia', 'Edit my profile'),
                            $this->createUrl('site/profile')
                        ); ?>
                    </li>
                    <li>
                        <?php echo CHtml::link(
                            Yii::t('wojia', 'Logout'),
                            $this->createUrl('site/logout')
                        ); ?>
                    </li>
                </ul>
            </li>
        <?php endif; ?>
    </ul>
</div>
</div>
</div>
<div class="container">
    <?php echo $content; ?>
</div>
</div>
<div class="page-footer">
    <div class="container">
        <p class="text-muted copyright">
            <?php echo Yii::t('wojia', 'Copyright &copy; :year by', array(
                ':year' => date('Y'),
            )); ?>
            <?php echo CHtml::encode(Yii::app()->settings->site_title); ?>
        </p>
    </div>
</div>
</body>
</html>