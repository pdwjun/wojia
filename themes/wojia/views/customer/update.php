<?php
/** @var $form CustomerUpdateForm */
/** @var $widget CActiveForm */

/** @var $this CustomerController */
$this->pageTitle = $title = Yii::t('wojia', 'Update :item', array(
    ':item' => Yii::t('wojia', 'customer'),
));

/** @var $user WebUser */
$user = Yii::app()->user;

/** @var $dateFormatter CDateFormatter */
$dateFormatter = Yii::app()->dateFormatter;
?>

    <div class="page-header">
        <h1><?php echo $title; ?></h1>
    </div>

<?php if ($user->getFlash('update')): ?>
    <div class="alert alert-success">
        <button type="button" class="close" data-dismiss="alert" aria-hidden="true">&times;</button>
        <strong><?php echo Yii::t('wojia', 'Well done!'); ?></strong>
        <?php echo Yii::t('wojia', 'You successfully updated :item.', array(
            ':item' => Yii::t('wojia', 'customer'),
        )); ?>
    </div>
<?php endif; ?>

<?php $widget = $this->beginWidget('CActiveForm', array(
    'id' => 'customer-update-form',
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
        <legend><?php echo Yii::t('wojia', 'User'); ?></legend>
        <div class="form-group">
            <?php echo $widget->label($form, 'id', array(
                'class' => 'col-lg-2 control-label',
            )); ?>
            <div class="col-lg-10">
                <p class="form-control-static"><?php echo $form->id; ?></p>
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
                <?php echo $widget->dropDownList($form, 'language', CustomerUpdateForm::getLanguageList(), array(
                    'class' => 'form-control',
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
            <?php echo $widget->label($form, 'create_time', array(
                'class' => 'col-lg-2 control-label',
            )); ?>
            <div class="col-lg-10">
                <p class="form-control-static"><?php echo $dateFormatter->format('d MMMM yyyy', $form->create_time); ?></p>
            </div>
        </div>
        <div class="form-group">
            <?php echo $widget->label($form, 'update_time', array(
                'class' => 'col-lg-2 control-label',
            )); ?>
            <div class="col-lg-10">
                <p class="form-control-static"><?php echo $dateFormatter->format('d MMMM yyyy', $form->update_time); ?></p>
            </div>
        </div>
    </fieldset>
    <fieldset>
        <legend><?php echo Yii::t('wojia', 'Company'); ?></legend>
        <div class="form-group">
            <?php echo $widget->label($form, 'company', array(
                'class' => 'col-lg-2 control-label',
            )); ?>
            <div class="col-lg-10">
                <?php echo $widget->textField($form, 'company', array(
                    'class' => 'form-control',
                    'placeholder' => $form->getAttributeLabel('company'),
                )); ?>
            </div>
        </div>
        <div class="form-group">
            <?php echo $widget->label($form, 'tax', array(
                'class' => 'col-lg-2 control-label',
            )); ?>
            <div class="col-lg-10">
                <?php echo $widget->textField($form, 'tax', array(
                    'class' => 'form-control',
                    'placeholder' => $form->getAttributeLabel('tax'),
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
            <?php echo $widget->label($form, 'fax', array(
                'class' => 'col-lg-2 control-label',
            )); ?>
            <div class="col-lg-10">
                <?php echo $widget->textField($form, 'fax', array(
                    'class' => 'form-control',
                    'placeholder' => $form->getAttributeLabel('fax'),
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
            <?php echo $widget->label($form, 'award', array(
                'class' => 'col-lg-2 control-label',
            )); ?>
            <div class="col-lg-10">
                <?php echo $widget->textField($form, 'award', array(
                    'class' => 'form-control',
                    'placeholder' => $form->getAttributeLabel('award'),
                )); ?>
            </div>
        </div>
    </fieldset>
    <div class="form-group">
        <div class="text-center">
            <?php echo CHtml::submitButton(Yii::t('wojia', 'Update'), array(
                'class' => 'btn btn-primary btn-lg',
            )); ?>
            <?php echo CHtml::link(Yii::t('wojia', 'Cancel'), array('index'), array(
                'class' => 'btn btn-warning btn-lg',
            )); ?>
        </div>
    </div>
<?php $this->endWidget(); ?>