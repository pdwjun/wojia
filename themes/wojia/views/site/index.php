<?php
/** @var SiteController $this */
$this->pageTitle = Yii::t('wojia', 'Home page');

/** @var WebUser $user */
$user = Yii::app()->user;

/** @var ProjectModel[] $pendingProjects */
/** @var ProjectModel[] $finishedProjects */

/** @var $clientScript CClientScript */
$clientScript = Yii::app()->clientScript;
$clientScript->registerCss('project-update', '
#attachments_wrap{margin-bottom:20px;}
.table-column-name{}
.table-column-actions{width:97px;}
');
?>

    <div class="jumbotron">
        <h3>
            <?php if (!$user->isGuest): ?>
                <?php echo Yii::t('wojia', 'Hi :name welcome to', array(
                    ':name' => CHtml::encode($user->name),
                )); ?>
            <?php endif; ?>
            <?php echo Yii::app()->settings->site_title; ?>
        </h3>

        <p><?php echo Yii::app()->settings->site_description; ?></p>

        <p>
            <?php echo Yii::t('wojia', 'Today is :date', array(
                ':date' => date('d/m/Y', time()),
            )); ?>
        </p>
    </div>

<?php if (!$user->isGuest): ?>
    <div class="row">
        <div class="col-md-6">
            <h3><?php echo Yii::t('wojia', 'Pending projects'); ?></h3>
            <?php if ($pendingProjects): ?>
                <table class="table table-striped">
                    <thead>
                    <tr>
                        <th class="table-column-id"><?php echo Yii::t('wojia', 'Project ID'); ?></th>
                        <th class="table-column-name"><?php echo Yii::t('wojia', 'Project name'); ?></th>
                        <th class="table-column-actions"><?php echo Yii::t('wojia', 'Actions'); ?></th>
                    </tr>
                    </thead>
                    <tbody>
                    <?php foreach ($pendingProjects as $project): ?>
                        <tr>
                            <td class="table-column-id"><?php echo $project->id; ?></td>
                            <td class="table-column-name"><?php echo CHtml::encode($project->name); ?></td>
                            <td class="table-column-actions">
                                <div class="btn-group">
                                    <?php if ($user->checkAccess('project:view')): ?>
                                        <a class="btn btn-default"
                                           href="<?php echo $this->createUrl('project/view', array('id' => $project->id)); ?>"
                                           title="<?php echo Yii::t('wojia', 'View'); ?>">
                                            <span class="glyphicon glyphicon-eye-open"></span>
                                        </a>
                                    <?php endif; ?>
                                    <?php if ($user->checkAccess('project:update')): ?>
                                        <a class="btn btn-default"
                                           href="<?php echo $this->createUrl('project/update', array('id' => $project->id)); ?>"
                                           title="<?php echo Yii::t('wojia', 'Edit'); ?>">
                                            <span class="glyphicon glyphicon-edit"></span>
                                        </a>
                                    <?php endif; ?>
                                </div>
                            </td>
                        </tr>
                    <?php endforeach; ?>
                    </tbody>
                </table>
            <?php else: ?>
                <p><?php echo Yii::t('wojia', 'No pending projects'); ?></p>
            <?php endif; ?>
        </div>
        <div class="col-md-6">
            <h3><?php echo Yii::t('wojia', 'Finished projects'); ?></h3>
            <?php if ($finishedProjects): ?>
                <table class="table table-striped">
                    <thead>
                    <tr>
                        <th class="table-column-id"><?php echo Yii::t('wojia', 'Project ID'); ?></th>
                        <th class="table-column-name"><?php echo Yii::t('wojia', 'Project name'); ?></th>
                        <th class="table-column-actions"><?php echo Yii::t('wojia', 'Actions'); ?></th>
                    </tr>
                    </thead>
                    <tbody>
                    <?php foreach ($finishedProjects as $project): ?>
                        <tr>
                            <td class="table-column-id"><?php echo $project->id; ?></td>
                            <td class="table-column-name"><?php echo CHtml::encode($project->name); ?></td>
                            <td class="table-column-actions">
                                <div class="btn-group">
                                    <?php if ($user->checkAccess('project:view')): ?>
                                        <a class="btn btn-default"
                                           href="<?php echo $this->createUrl('project/view', array('id' => $project->id)); ?>"
                                           title="<?php echo Yii::t('wojia', 'View'); ?>">
                                            <span class="glyphicon glyphicon-eye-open"></span>
                                        </a>
                                    <?php endif; ?>
                                    <?php if ($user->checkAccess('project:update')): ?>
                                        <a class="btn btn-default"
                                           href="<?php echo $this->createUrl('project/update', array('id' => $project->id)); ?>"
                                           title="<?php echo Yii::t('wojia', 'Edit'); ?>">
                                            <span class="glyphicon glyphicon-edit"></span>
                                        </a>
                                    <?php endif; ?>
                                </div>
                            </td>
                        </tr>
                    <?php endforeach; ?>
                    </tbody>
                </table>
            <?php else: ?>
                <p><?php echo Yii::t('wojia', 'No finished projects'); ?></p>
            <?php endif; ?>
        </div>
    </div>
<?php endif; ?>