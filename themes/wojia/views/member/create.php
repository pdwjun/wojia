<?php
/** @var $widget CActiveForm */
/** @var $form MemberCreateForm */

/** @var $this MemberController */
$this->pageTitle = $title = Yii::t('wojia', 'Create new :item', array(
    ':item' => Yii::t('wojia', 'member'),
));
?>

    <div class="page-header">
        <h1><?php echo $title; ?></h1>
    </div>

<?php $widget = $this->beginWidget('CActiveForm', array(
    'id' => 'member-create-form',
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
            <?php echo $widget->dropDownList($form, 'language', MemberCreateForm::getLanguageList(), array(
                'class' => 'form-control',
            )); ?>
        </div>
    </div>
    <div class="form-group">
        <?php echo $widget->label($form, 'telephone', array(
            'class' => 'col-lg-2 control-label',
        )); ?>
        <div class="col-lg-10">
            <?php echo $widget->textField($form, 'telephone', array(
                'class' => 'form-control',
                'placeholder' => $form->getAttributeLabel('telephone'),
            )); ?>
        </div>
    </div>
    <div class="form-group">
        <?php echo $widget->label($form, 'mobile', array(
            'class' => 'col-lg-2 control-label',
        )); ?>
        <div class="col-lg-10">
            <?php echo $widget->textField($form, 'mobile', array(
                'class' => 'form-control',
                'placeholder' => $form->getAttributeLabel('mobile'),
            )); ?>
        </div>
    </div>
    <div class="form-group">
        <?php echo $widget->label($form, 'address', array(
            'class' => 'col-lg-2 control-label',
        )); ?>
        <div class="col-lg-10">
            <?php echo $widget->textArea($form, 'address', array(
                'class' => 'form-control',
                'placeholder' => $form->getAttributeLabel('address'),
            )); ?>
        </div>
    </div>
    <div class="form-group">
        <?php echo $widget->label($form, 'resume', array(
            'class' => 'col-lg-2 control-label',
        )); ?>
        <div class="col-lg-10">
            <?php echo $widget->textArea($form, 'resume', array(
                'class' => 'form-control',
                'placeholder' => $form->getAttributeLabel('resume'),
            )); ?>
        </div>
    </div>
    <div class="form-group">
        <?php echo $widget->label($form, 'comment', array(
            'class' => 'col-lg-2 control-label',
        )); ?>
        <div class="col-lg-10">
            <?php echo $widget->textArea($form, 'comment', array(
                'class' => 'form-control',
                'placeholder' => $form->getAttributeLabel('comment'),
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