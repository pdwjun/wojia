<?php
/** @var $model ProjectModel */

/** @var $this ProjectController */
$this->pageTitle = $title = Yii::t('wojia', 'View :item', array(
    ':item' => Yii::t('wojia', 'project'),
));

/** @var $dateFormatter CDateFormatter */
$dateFormatter = Yii::app()->dateFormatter;

/** @var WebUser $user */
$user = Yii::app()->user;

/** @var $clientScript CClientScript */
$clientScript = Yii::app()->clientScript;
$clientScript->registerCss('project-update', '
.table-column-name{}
.table-column-actions{width:70px;}
');
?>

<div class="page-header">
    <h1><?php echo $title; ?></h1>
</div>

<div class="form-horizontal">
<fieldset>
    <legend><?php echo Yii::t('wojia', 'Project'); ?></legend>
    <div class="form-group">
        <label class="col-lg-2 control-label"><?php echo Yii::t('wojia', 'Project ID'); ?></label>

        <div class="col-lg-10">
            <p class="form-control-static"><?php echo $model->id; ?></p>
        </div>
    </div>
    <div class="form-group">
        <label class="col-lg-2 control-label"><?php echo Yii::t('wojia', 'Project name'); ?></label>

        <div class="col-lg-10">
            <p class="form-control-static"><?php echo CHtml::encode($model->name); ?></p>
        </div>
    </div>
    <div class="form-group">
        <label class="col-lg-2 control-label"><?php echo Yii::t('wojia', 'Status'); ?></label>

        <div class="col-lg-10">
            <?php $statusList = ProjectForm::getStatusList(); ?>
            <p class="form-control-static"><?php echo $statusList[$model->status]; ?></p>
        </div>
    </div>

    <?php if ($model->status == ProjectModel::STATUS_ABORT): ?>
        <div class="form-group">
            <label class="col-lg-2 control-label"><?php echo Yii::t('wojia', 'Reason'); ?></label>

            <div class="col-lg-10">
                <p class="form-control-static"><?php echo CHtml::encode($model->getMeta('reason')); ?></p>
            </div>
        </div>
    <?php endif; ?>

    <?php if ($model->status == ProjectModel::STATUS_COMPLETE): ?>
        <div class="form-group">
            <label class="col-lg-2 control-label"><?php echo Yii::t('wojia', 'Rating'); ?></label>

            <div class="col-lg-10">
                <p class="form-control-static"><?php echo CHtml::encode($model->getMeta('rating')); ?></p>
            </div>
        </div>
        <div class="form-group">
            <label class="col-lg-2 control-label"><?php echo Yii::t('wojia', 'Feedback'); ?></label>

            <div class="col-lg-10">
                <p class="form-control-static"><?php echo CHtml::encode($model->getMeta('feedback')); ?></p>
            </div>
        </div>
    <?php endif; ?>

    <div class="form-group">
        <label class="col-lg-2 control-label"><?php echo Yii::t('wojia', 'Description'); ?></label>

        <div class="col-lg-10">
            <?php echo CHtml::encode($model->description); ?>
        </div>
    </div>
    <div class="form-group">
        <label class="col-lg-2 control-label"><?php echo Yii::t('wojia', 'Service'); ?></label>

        <div class="col-lg-10">
            <?php $serviceList = ProjectForm::getServiceList(); ?>
            <?php echo isset($serviceList[$model->service_id]) ? $serviceList[$model->service_id] : Yii::t('wojia', 'None'); ?>
        </div>
    </div>
    <div class="form-group">
        <label class="col-lg-2 control-label"><?php echo Yii::t('wojia', 'Create time'); ?></label>

        <div class="col-lg-10">
            <p class="form-control-static"><?php echo $dateFormatter->format('d MMMM yyyy', $model->getMeta('create_time')); ?></p>
        </div>
    </div>
    <div class="form-group">
        <label class="col-lg-2 control-label"><?php echo Yii::t('wojia', 'Update time'); ?></label>

        <div class="col-lg-10">
            <p class="form-control-static">
                <?php echo $dateFormatter->format('d MMMM yyyy', $model->getMeta('update_time')); ?>
            </p>
        </div>
    </div>
</fieldset>
<div class="row">
    <fieldset class="col-md-6">
        <legend><?php echo Yii::t('wojia', 'Expected dates'); ?></legend>
        <div class="form-group">
            <label class="col-lg-2 control-label">
                <?php echo Yii::t('wojia', 'Expected start time'); ?>
            </label>

            <div class="col-lg-10">
                <p class="form-control-static">
                    <?php echo $dateFormatter->format('d MMMM yyyy', $model->getMeta('expected_start_time')); ?>
                </p>
            </div>
        </div>
        <div class="form-group">
            <label class="col-lg-2 control-label">
                <?php echo Yii::t('wojia', 'Expected finish time'); ?>
            </label>

            <div class="col-lg-10">
                <p class="form-control-static">
                    <?php echo $dateFormatter->format('d MMMM yyyy', $model->getMeta('expected_finish_time')); ?>
                </p>
            </div>
        </div>
    </fieldset>
    <fieldset class="col-md-6">
        <legend><?php echo Yii::t('wojia', 'Actual dates'); ?></legend>
        <div class="form-group">
            <label class="col-lg-2 control-label">
                <?php echo Yii::t('wojia', 'Actual start time'); ?>
            </label>

            <div class="col-lg-10">
                <p class="form-control-static">
                    <?php echo $dateFormatter->format('d MMMM yyyy', $model->getMeta('actual_start_time')); ?>
                </p>
            </div>
        </div>
        <div class="form-group">
            <label class="col-lg-2 control-label">
                <?php echo Yii::t('wojia', 'Actual finish time'); ?>
            </label>

            <div class="col-lg-10">
                <p class="form-control-static">
                    <?php echo $dateFormatter->format('d MMMM yyyy', $model->getMeta('actual_finish_time')); ?>
                </p>
            </div>
        </div>
    </fieldset>
</div>
<div class="row">
    <fieldset class="col-md-4">
        <legend><?php echo Yii::t('wojia', 'Customers'); ?></legend>
        <?php if ($model->customers): ?>
            <table class="table table-striped">
                <thead>
                <tr>
                    <th class="table-column-name"><?php echo Yii::t('wojia', 'Customer name'); ?></th>
                    <?php if ($user->checkAccess('customer:view')): ?>
                        <th class="table-column-actions"><?php echo Yii::t('wojia', 'Actions'); ?></th>
                    <?php endif; ?>
                </tr>
                </thead>
                <tbody>
                <?php foreach ($model->customers as $customer): ?>
                    <tr data-user-id="<?php echo $customer->id; ?>">
                        <td>
                            <?php echo CHtml::encode($customer->name); ?>
                        </td>
                        <?php if ($user->checkAccess('customer:view')): ?>
                            <td>
                                <div class="btn-group">
                                    <a class="btn btn-default"
                                       href="<?php echo $this->createUrl('customer/view', array('id' => $customer->id)); ?>"
                                       title="<?php echo Yii::t('wojia', 'View'); ?>"
                                       target="_blank">
                                        <span class="glyphicon glyphicon-eye-open"></span>
                                    </a>
                                </div>
                            </td>
                        <?php endif; ?>
                    </tr>
                <?php endforeach; ?>
                </tbody>
            </table>
        <?php else: ?>
            <p>
                <?php echo Yii::t('wojia', 'No :item.', array(
                    ':item' => Yii::t('wojia', 'customers'),
                ));
                ?>
            </p>
        <?php endif; ?>
    </fieldset>

    <?php if (!$user->isCustomer): ?>
        <fieldset class="col-md-4">
            <legend><?php echo Yii::t('wojia', 'Members'); ?></legend>
            <?php if ($model->members): ?>
                <table class="table table-striped">
                    <thead>
                    <tr>
                        <th class="table-column-name"><?php echo Yii::t('wojia', 'Member name'); ?></th>
                        <?php if ($user->checkAccess('members:view')): ?>
                            <th class="table-column-actions"><?php echo Yii::t('wojia', 'Actions'); ?></th>
                        <?php endif; ?>
                    </tr>
                    </thead>
                    <tbody>
                    <?php foreach ($model->members as $member): ?>
                        <tr data-user-id="<?php echo $member->id; ?>">
                            <td>
                                <?php echo CHtml::hiddenField('ProjectUpdateForm[members][]', $member->id); ?>
                                <?php echo CHtml::encode($member->name); ?>
                            </td>
                            <?php if ($user->checkAccess('members:view')): ?>
                                <td>
                                    <div class="btn-group">
                                        <a class="btn btn-default"
                                           href="<?php echo $this->createUrl('member/view', array('id' => $member->id)); ?>"
                                           title="<?php echo Yii::t('wojia', 'View'); ?>"
                                           target="_blank">
                                            <span class="glyphicon glyphicon-eye-open"></span>
                                        </a>
                                    </div>
                                </td>
                            <?php endif; ?>
                        </tr>
                    <?php endforeach; ?>
                    </tbody>
                </table>
            <?php else: ?>
                <p>
                    <?php echo Yii::t('wojia', 'No :item.', array(
                        ':item' => Yii::t('wojia', 'members'),
                    ));
                    ?>
                </p>
            <?php endif; ?>
        </fieldset>
    <?php endif; ?>

    <fieldset class="col-md-4">
        <legend><?php echo Yii::t('wojia', 'Managers'); ?></legend>
        <?php if ($model->managers): ?>
            <table class="table table-striped">
                <thead>
                <tr>
                    <th class="table-column-name"><?php echo Yii::t('wojia', 'Manager name'); ?></th>
                    <?php if ($user->checkAccess('manager:view')): ?>
                        <th class="table-column-actions"><?php echo Yii::t('wojia', 'Actions'); ?></th>
                    <?php endif; ?>
                </tr>
                </thead>
                <tbody>
                <?php foreach ($model->managers as $manager): ?>
                    <?php $manager = $manager instanceof ManagerModel ? $manager : ManagerModel::model()->findByPk($manager); ?>
                    <?php if ($manager === null) continue; ?>
                    <tr data-user-id="<?php echo $manager->id; ?>">
                        <td>
                            <?php echo CHtml::hiddenField('ProjectUpdateForm[managers][]', $manager->id); ?>
                            <?php echo CHtml::encode($manager->name); ?>
                        </td>
                        <?php if ($user->checkAccess('manager:view')): ?>
                            <td>
                                <div class="btn-group">
                                    <a class="btn btn-default"
                                       href="<?php echo $this->createUrl('manager/view', array('id' => $manager->id)); ?>"
                                       title="<?php echo Yii::t('wojia', 'View'); ?>"
                                       target="_blank">
                                        <span class="glyphicon glyphicon-eye-open"></span>
                                    </a>
                                </div>
                            </td>
                        <?php endif; ?>
                    </tr>
                <?php endforeach; ?>
                </tbody>
            </table>
        <?php else: ?>
            <p>
                <?php echo Yii::t('wojia', 'No :item.', array(
                    ':item' => Yii::t('wojia', 'managers'),
                ));
                ?>
            </p>
        <?php endif; ?>
    </fieldset>
</div>

<?php if (!$user->isMember): ?>
    <fieldset>
        <legend><?php echo Yii::t('wojia', 'Attachments'); ?></legend>
        <?php if ($model->attachments): ?>
            <ul>
                <?php foreach ($model->attachments as $attachment): ?>
                    <li>
                        <?php echo CHtml::link(basename($attachment->uri), $attachment->uri, array(
                            'target' => '_blank',
                        ));
                        ?>
                    </li>
                <?php endforeach; ?>
            </ul>
        <?php else: ?>
            <p>
                <?php echo Yii::t('wojia', 'No :item.', array(
                    ':item' => Yii::t('wojia', 'attachments'),
                ));
                ?>
            </p>
        <?php endif; ?>
    </fieldset>
<?php endif; ?>

<?php if (!$user->isCustomer): ?>
    <fieldset>
        <legend><?php echo Yii::t('wojia', 'Logs'); ?></legend>
        <?php if ($model->logs): ?>
            <table class="table table-striped">
                <thead>
                <tr>
                    <th><?php echo Yii::t('wojia', 'ID'); ?></th>
                    <th><?php echo Yii::t('wojia', 'Date'); ?></th>
                    <th><?php echo Yii::t('wojia', 'User'); ?></th>
                    <th><?php echo Yii::t('wojia', 'Description'); ?></th>
                </tr>
                </thead>
                <tbody>
                <?php foreach ($model->logs as $key => $log): ?>
                    <tr>
                        <td><?php echo $key + 1; ?></td>
                        <td><?php echo $dateFormatter->format('dd MMMM yyyy HH:mm', $log->create_time); ?></td>
                        <td><?php echo CHtml::encode($log->user_name); ?></td>
                        <td><?php echo CHtml::encode($log->description); ?></td>
                    </tr>
                <?php endforeach; ?>
                </tbody>
            </table>
        <?php else: ?>
            <p>
                <?php echo Yii::t('wojia', 'No :item.', array(
                    ':item' => Yii::t('wojia', 'logs'),
                ));
                ?>
            </p>
        <?php endif; ?>
    </fieldset>
<?php endif; ?>

<div class="form-group">
    <div class="text-center">
        <?php echo CHtml::link(Yii::t('wojia', 'Go back'), array('index'), array(
            'class' => 'btn btn-warning btn-lg',
        ));
        ?>
    </div>
</div>
</div>