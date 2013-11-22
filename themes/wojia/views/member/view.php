<?php
/** @var $model MemberModel */

/** @var $this MemberController */
$this->pageTitle = $title = Yii::t('wojia', 'View :item', array(
    ':item' => Yii::t('wojia', 'member'),
));

/** @var $dateFormatter CDateFormatter */
$dateFormatter = Yii::app()->dateFormatter;
?>

<div class="page-header">
    <h1><?php echo $title; ?></h1>
</div>

<div class="form-horizontal">
    <div class="form-group">
        <label class="col-lg-2 control-label"><?php echo Yii::t('wojia', 'Member ID'); ?></label>

        <div class="col-lg-10">
            <p class="form-control-static"><?php echo $model->id; ?></p>
        </div>
    </div>
    <div class="form-group">
        <label class="col-lg-2 control-label"><?php echo Yii::t('wojia', 'Member name'); ?></label>

        <div class="col-lg-10">
            <p class="form-control-static"><?php echo CHtml::encode($model->name); ?></p>
        </div>
    </div>
    <div class="form-group">
        <label class="col-lg-2 control-label"><?php echo Yii::t('wojia', 'Email'); ?></label>

        <div class="col-lg-10">
            <p class="form-control-static"><?php echo CHtml::encode($model->email); ?></p>
        </div>
    </div>
    <?php foreach ($model->meta as $meta): ?>
        <?php if ($meta->key == 'role') continue; ?>
        <div class="form-group">
            <label class="col-lg-2 control-label">
                <?php echo Yii::t('wojia', ucfirst(str_replace('_', ' ', $meta->key))); ?>
            </label>

            <div class="col-lg-10">
                <p class="form-control-static">
                    <?php if ($meta->key == 'create_time' || $meta->key == 'update_time'): ?>
                        <?php echo $dateFormatter->format('d MMMM yyyy', $meta->value); ?>
                    <?php else: ?>
                        <?php echo CHtml::encode($meta->value); ?>
                    <?php endif; ?>
                </p>
            </div>
        </div>
    <?php endforeach; ?>
    <div class="form-group">
        <div class="text-center">
            <?php echo CHtml::link(Yii::t('wojia', 'Go back'), array('index'), array(
                'class' => 'btn btn-warning',
            )); ?>
        </div>
    </div>
</div>