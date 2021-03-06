<?php
/** @var $widget CActiveForm */
/** @var $form UserProfileForm */

/** @var $this SiteController */
$this->pageTitle = $title = Yii::t('wojia', 'Update :item', array(
    ':item' => Yii::t('wojia', 'profile'),
));

/** @var $user WebUser */
$user = Yii::app()->user;
?>

    <div class="page-header">
        <h1><?php echo $title; ?></h1>
    </div>

<?php if ($user->getFlash('update')): ?>
    <div class="alert alert-success">
        <button type="button" class="close" data-dismiss="alert" aria-hidden="true">&times;</button>
        <strong><?php echo Yii::t('wojia', 'Well done!'); ?></strong>
        <?php echo Yii::t('wojia', 'You successfully updated :item.', array(
            ':item' => Yii::t('wojia', 'profile'),
        )); ?>
    </div>
<?php endif; ?>

<?php $widget = $this->beginWidget('CActiveForm', array(
    'id' => 'profile-form',
    'htmlOptions' => array(
        'class' => 'form-horizontal',
        'role' => 'form',
    ),
)); ?>
    <div class="form-group">
        <div class="col-lg-offset-2 col-lg-10">
            <?php echo $widget->errorSummary($form); ?>
        </div>
    </div>
    <div class="form-group">
        <?php echo $widget->label($form, 'name', array(
            'class' => 'col-lg-2 control-label',
        )); ?>
        <div class="col-lg-10">
            <?php echo $widget->textField($form, 'name', array(
                'class' => 'form-control',
                'placeholder' => $form->getAttributeLabel('name'),
                'autofocus' => true,
            )); ?>
        </div>
    </div>
    <div class="form-group">
        <?php echo $widget->label($form, 'email', array(
            'class' => 'col-lg-2 control-label',
        )); ?>
        <div class="col-lg-10">
            <?php echo $widget->textField($form, 'email', array(
                'class' => 'form-control',
                'placeholder' => $form->getAttributeLabel('email'),
            )); ?>
        </div>
    </div>
    <div class="form-group">
        <?php echo $widget->label($form, 'password', array(
            'class' => 'col-lg-2 control-label',
        )); ?>
        <div class="col-lg-10">
            <?php echo $widget->passwordField($form, 'password', array(
                'class' => 'form-control',
                'placeholder' => $form->getAttributeLabel('password'),
            )); ?>
        </div>
    </div>
    <div class="form-group">
        <?php echo $widget->label($form, 'language', array(
            'class' => 'col-lg-2 control-label',
        )); ?>
        <div class="col-lg-10">
            <?php echo $widget->dropDownList($form, 'language', UserProfileForm::getLanguageList(), array(
                'class' => 'form-control',
            )); ?>
        </div>
    </div>
    <div class="form-group">
        <div class="col-lg-offset-2 col-lg-10">
            <?php echo CHtml::submitButton(Yii::t('wojia', 'Update'), array(
                'class' => 'btn btn-primary',
            )); ?>
        </div>
    </div>
<?php $this->endWidget(); ?>