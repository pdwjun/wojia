<?php
/** @var $this SiteController */
$this->pageTitle = $title = Yii::t('wojia', 'Error #:code', array(
    ':code' => $code,
));
?>

<div class="page-header">
    <h1><?php echo $title; ?></h1>
</div>
<p><?php echo CHtml::encode($message); ?></p>