<?php
/** @var $form ServiceCreateForm */
/** @var $widget CActiveForm */

/** @var $this ServiceController */
$this->pageTitle = $title = Yii::t('wojia', 'Create new :item', array(
    ':item' => Yii::t('wojia', 'service'),
));
?>

    <div class="page-header">
        <h1><?php echo $title; ?></h1>
    </div>

<?php $widget = $this->beginWidget('CActiveForm', array(
    'id' => 'service-create-form',
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
        <?php echo $widget->label($form, 'description', array(
            'class' => 'col-lg-2 control-label',
        )); ?>
        <div class="col-lg-10">
            <?php echo $widget->textArea($form, 'description', array(
                'class' => 'form-control',
                'placeholder' => $form->getAttributeLabel('description'),
            )); ?>
        </div>
    </div>
    <div class="form-group">
        <div class="text-center">
            <?php echo CHtml::submitButton(Yii::t('wojia', 'Create'), array(
                'class' => 'btn btn-primary btn-lg',
            )); ?>
            <?php echo CHtml::link(Yii::t('wojia', 'Cancel'), array('index'), array(
                'class' => 'btn btn-warning btn-lg',
            )); ?>
        </div>
    </div>
<?php $this->endWidget(); ?>