<?php
/** @var Controller $this */
/** @var ProjectModel $projectModel */
/** @var UserModel $userModel */
?>
<!DOCTYPE html>
<html lang="<?php echo substr(Yii::app()->language, 0, 2); ?>">
<head>
    <meta charset="<?php echo Yii::app()->charset; ?>">
    <title><?php echo Yii::t('wojia', 'You are assigned to a new project'); ?></title>
</head>
<body>
<p>
    <?php echo Yii::t('wojia', 'Dear :name,', array(
        ':name' => CHtml::encode($userModel->name),
    )); ?>
</p>

<p>
    <?php echo Yii::t('wojia', 'This email is to inform you that you have been assigned for a new project: <a href=":project-link" target="_blank">:project-name</a>.', array(
        ':project-link' => $this->createAbsoluteUrl('project/view', array('id' => $projectModel->id)),
        ':project-name' => CHtml::encode($projectModel->name),
    )); ?>
</p>

<p>
    <?php echo Yii::t('wojia', 'If you have any question on this project, please feel free to contact system administrator.'); ?>
</p>

<p>
    <?php echo Yii::t('wojia', 'Regards,<br>K. Young Back Office Services Inc.<br>Tel: 400-821-0913<br>Email: services@hitec.org.cn'); ?>
</p>
</body>
</html>