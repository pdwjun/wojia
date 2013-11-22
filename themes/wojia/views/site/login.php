<?php
/** @var $widget CActiveForm */
/** @var $form UserLoginForm */

/** @var $this SiteController */
$this->pageTitle = Yii::t('wojia', 'Login');
?>

<?php $widget = $this->beginWidget('CActiveForm', array(
    'id' => 'login-form',
    'htmlOptions' => array(
        'class' => 'form-horizontal form-login',
        'role' => 'form',
    ),
)); ?>
<div class="form-group">
    <div class="col-lg-offset-2 col-lg-10">
        <h2><?php echo Yii::t('wojia', 'Please log in'); ?></h2>
        <?php echo $widget->errorSummary($form); ?>
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
            'autofocus' => true,
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
    <div class="col-lg-offset-2 col-lg-10">
        <div class="checkbox">
            <label>
                <?php echo $widget->checkBox($form, 'rememberMe'); ?>
                <?php echo $form->getAttributeLabel('rememberMe'); ?>
            </label>
        </div>
    </div>
</div>
<div class="form-group">
    <div class="col-lg-offset-2 col-lg-10">
        <?php echo CHtml::submitButton(Yii::t('wojia', 'Login'), array(
            'class' => 'btn btn-primary',
        )); ?>
    </div>
</div>
<?php $this->endWidget(); ?>
