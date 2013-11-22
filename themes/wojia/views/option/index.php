<?php
/** @var $form OptionForm */
/** @var $widget CActiveForm */

/** @var $this OptionController */
$this->pageTitle = Yii::t('wojia', 'Settings');
?>

    <div class="page-header">
        <h1><?php echo Yii::t('wojia', 'General settings'); ?></h1>
    </div>

<?php if (Yii::app()->user->getFlash('update')): ?>
    <div class="alert alert-success">
        <button type="button" class="close" data-dismiss="alert" aria-hidden="true">&times;</button>
        <strong><?php echo Yii::t('wojia', 'Well done!'); ?></strong>
        <?php echo Yii::t('wojia', 'You successfully updated :item.', array(
            ':item' => Yii::t('wojia', 'settings'),
        )); ?>
    </div>
<?php endif; ?>

<?php $widget = $this->beginWidget('CActiveForm', array(
    'id' => 'option-general-form',
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
    <fieldset>
        <legend><?php echo Yii::t('wojia', 'General'); ?></legend>
        <div class="form-group">
            <?php echo $widget->label($form, 'site_title', array(
                'class' => 'col-lg-2 control-label',
            )); ?>
            <div class="col-lg-10">
                <?php echo $widget->textField($form, 'site_title', array(
                    'class' => 'form-control',
                    'placeholder' => $form->getAttributeLabel('site_title'),
                    'autofocus' => true,
                )); ?>
            </div>
        </div>
        <div class="form-group">
            <?php echo $widget->label($form, 'site_description', array(
                'class' => 'col-lg-2 control-label',
            )); ?>
            <div class="col-lg-10">
                <?php echo $widget->textArea($form, 'site_description', array(
                    'class' => 'form-control',
                    'placeholder' => $form->getAttributeLabel('site_description'),
                )); ?>
            </div>
        </div>
        <div class="form-group">
            <?php echo $widget->label($form, 'site_author', array(
                'class' => 'col-lg-2 control-label',
            )); ?>
            <div class="col-lg-10">
                <?php echo $widget->textField($form, 'site_author', array(
                    'class' => 'form-control',
                    'placeholder' => $form->getAttributeLabel('site_author'),
                )); ?>
            </div>
        </div>
    </fieldset>
    <fieldset>
        <legend><?php echo Yii::t('wojia', 'Projects'); ?></legend>
        <div class="form-group">
            <?php echo $widget->label($form, 'projects_per_page', array(
                'class' => 'col-lg-2 control-label',
            )); ?>
            <div class="col-lg-10">
                <?php echo $widget->textField($form, 'projects_per_page', array(
                    'class' => 'form-control',
                    'placeholder' => $form->getAttributeLabel('projects_per_page'),
                )); ?>
            </div>
        </div>
    </fieldset>
    <fieldset>
        <legend><?php echo Yii::t('wojia', 'Services'); ?></legend>
        <div class="form-group">
            <?php echo $widget->label($form, 'services_per_page', array(
                'class' => 'col-lg-2 control-label',
            )); ?>
            <div class="col-lg-10">
                <?php echo $widget->textField($form, 'services_per_page', array(
                    'class' => 'form-control',
                    'placeholder' => $form->getAttributeLabel('services_per_page'),
                )); ?>
            </div>
        </div>
    </fieldset>
    <fieldset>
        <legend><?php echo Yii::t('wojia', 'Customers'); ?></legend>
        <div class="form-group">
            <?php echo $widget->label($form, 'customers_per_page', array(
                'class' => 'col-lg-2 control-label',
            )); ?>
            <div class="col-lg-10">
                <?php echo $widget->textField($form, 'customers_per_page', array(
                    'class' => 'form-control',
                    'placeholder' => $form->getAttributeLabel('customers_per_page'),
                )); ?>
            </div>
        </div>
    </fieldset>
    <fieldset>
        <legend><?php echo Yii::t('wojia', 'Members'); ?></legend>
        <div class="form-group">
            <?php echo $widget->label($form, 'members_per_page', array(
                'class' => 'col-lg-2 control-label',
            )); ?>
            <div class="col-lg-10">
                <?php echo $widget->textField($form, 'members_per_page', array(
                    'class' => 'form-control',
                    'placeholder' => $form->getAttributeLabel('members_per_page'),
                )); ?>
            </div>
        </div>
    </fieldset>
    <fieldset>
        <legend><?php echo Yii::t('wojia', 'Managers'); ?></legend>
        <div class="form-group">
            <?php echo $widget->label($form, 'managers_per_page', array(
                'class' => 'col-lg-2 control-label',
            )); ?>
            <div class="col-lg-10">
                <?php echo $widget->textField($form, 'managers_per_page', array(
                    'class' => 'form-control',
                    'placeholder' => $form->getAttributeLabel('managers_per_page'),
                )); ?>
            </div>
        </div>
    </fieldset>
    <fieldset>
        <legend><?php echo Yii::t('wojia', 'Administrators'); ?></legend>
        <div class="form-group">
            <?php echo $widget->label($form, 'administrators_per_page', array(
                'class' => 'col-lg-2 control-label',
            )); ?>
            <div class="col-lg-10">
                <?php echo $widget->textField($form, 'administrators_per_page', array(
                    'class' => 'form-control',
                    'placeholder' => $form->getAttributeLabel('administrators_per_page'),
                )); ?>
            </div>
        </div>
    </fieldset>
    <div class="form-group">
        <div class="text-center">
            <?php echo CHtml::submitButton(Yii::t('wojia', 'Update'), array(
                'class' => 'btn btn-primary btn-lg',
            )); ?>
            <?php echo CHtml::resetButton(Yii::t('wojia', 'Cancel'), array(
                'class' => 'btn btn-warning btn-lg',
            )); ?>
        </div>
    </div>
<?php $this->endWidget(); ?>