<?php
/** @var $widget CActiveForm */

/** @var $form ServiceIndexForm */
$dataProvider = $form->dataProvider;

/** @var WebUser $user */
$user = Yii::app()->user;

/** @var $this ServiceController */
$this->pageTitle = $title = Yii::t('wojia', 'Services');

$actionWidth = 16;
if ($user->checkAccess('service:update'))
    $actionWidth += 40;
if ($user->checkAccess('service:active'))
    $actionWidth += 40;

/** @var $clientScript CClientScript */
$clientScript = Yii::app()->clientScript;
$clientScript->registerCss('service-index', '
.table-column-actions {width: ' . $actionWidth . 'px}
');
$clientScript->registerScript('service-index', '
$(document).on("click", ".btn-panel-search", function(e){
    e.preventDefault();

    $(this).addClass("hidden");
    $(".panel-search").removeClass("hidden");
});
$(document).on("click", ".btn-danger", function(e) {
    e.preventDefault();

    var $button = $(this),
        $row = $button.closest("tr"),
        $icon = $button.children("span");

    var message = "' . Yii::t('wojia', 'Are you sure you want to enable this item?') . '";
    if ($icon.hasClass("glyphicon-ok-sign"))
        message = "' . Yii::t('wojia', 'Are you sure you want to disable this item?') . '";

    if (!confirm(message))
        return;

    $.ajax({
        url: $button.attr("href"),
        dataType: "JSON",
        beforeSend: function() {
            $row
                .css("opacity", 0.5)
                .find("a").attr("disabled", true);
        },
        success: function (data) {
            $row
                .css("opacity", 1)
                .find("a").attr("disabled", false);

            if ($icon.hasClass("glyphicon-ok-sign")) {
                $row.addClass("danger");

                $button.attr("title", "' . Yii::t('wojia', 'Disable') . '");

                $icon
                    .removeClass("glyphicon-ok-sign")
                    .addClass("glyphicon-minus-sign");
            } else {
                $row.removeClass("danger");

                $button.attr("title", "' . Yii::t('wojia', 'Enable') . '");

                $icon
                    .removeClass("glyphicon-minus-sign")
                    .addClass("glyphicon-ok-sign");
            }
        }
    });
});
');
?>

    <div class="page-header">
        <h1><?php echo $title; ?></h1>
    </div>

<?php if ($user->getFlash('create')): ?>
    <div class="alert alert-success">
        <button type="button" class="close" data-dismiss="alert" aria-hidden="true">&times;</button>
        <strong><?php echo Yii::t('wojia', 'Well done!'); ?></strong>
        <?php echo Yii::t('wojia', 'You successfully created :item.', array(
            ':item' => Yii::t('wojia', 'service'),
        )); ?>
    </div>
<?php elseif (Yii::app()->user->getFlash('delete')): ?>
    <div class="alert alert-success">
        <button type="button" class="close" data-dismiss="alert" aria-hidden="true">&times;</button>
        <strong><?php echo Yii::t('wojia', 'Well done!'); ?></strong>
        <?php echo Yii::t('wojia', 'You successfully deleted :item.', array(
            ':item' => Yii::t('wojia', 'service'),
        )); ?>
    </div>
<?php endif; ?>

    <p>
        <a class="btn btn-info btn-panel-search" href="#"
           title="<?php echo Yii::t('wojia', 'Advanced search'); ?>"><?php echo Yii::t('wojia', 'Advanced search'); ?></a>
    </p>
    <div class="panel panel-default panel-search hidden">
        <div class="panel-heading"><?php echo Yii::t('wojia', 'Advanced search'); ?></div>
        <div class="panel-body">
            <?php $widget = $this->beginWidget('CActiveForm', array(
                'id' => 'customer-index-form',
                'method' => 'get',
                'htmlOptions' => array(
                    'class' => 'form',
                    'role' => 'form',
                ),
            )); ?>
            <div class="form-group">
                <?php echo $widget->label($form, 'id'); ?>
                <?php echo $widget->textField($form, 'id', array(
                    'class' => 'form-control',
                    'placeholder' => $form->getAttributeLabel('id'),
                    'autofocus' => true,
                )); ?>
            </div>
            <div class="form-group">
                <?php echo $widget->label($form, 'name'); ?>
                <?php echo $widget->textField($form, 'name', array(
                    'class' => 'form-control',
                    'placeholder' => $form->getAttributeLabel('name'),
                )); ?>
            </div>
            <div class="form-group">
                <?php echo $widget->label($form, 'description'); ?>
                <?php echo $widget->textField($form, 'description', array(
                    'class' => 'form-control',
                    'placeholder' => $form->getAttributeLabel('description'),
                )); ?>
            </div>
            <?php echo CHtml::submitButton(Yii::t('wojia', 'Search'), array(
                'class' => 'btn btn-primary',
            )); ?>
            <?php echo CHtml::link(Yii::t('wojia', 'Cancel'), array('index'), array(
                'class' => 'btn btn-warning',
            )); ?>
            <?php $this->endWidget(); ?>
        </div>
    </div>

<?php if ($dataProvider->itemCount): ?>
    <table class="table table-striped">
        <thead>
        <tr>
            <th class="table-column-id"><?php echo Yii::t('wojia', 'Service ID'); ?></th>
            <th class="table-column-name"><?php echo Yii::t('wojia', 'Service name'); ?></th>
            <th class="table-column-description"><?php echo Yii::t('wojia', 'Description'); ?></th>
            <th class="table-column-actions"><?php echo Yii::t('wojia', 'Actions'); ?></th>
        </tr>
        </thead>
        <tbody>
        <?php foreach ($dataProvider->data as $data): ?>
            <tr <?php if (!$data->active): ?>class="danger"<?php endif; ?>>
                <td><?php echo $data->id; ?></td>
                <td><?php echo CHtml::encode($data->name); ?></td>
                <td><?php echo CHtml::encode($data->description); ?></td>
                <td>
                    <div class="btn-group">
                        <?php if ($user->checkAccess('service:update')): ?>
                            <a class="btn btn-default"
                               href="<?php echo $this->createUrl('service/update', array('id' => $data->id)); ?>"
                               title="<?php echo Yii::t('wojia', 'Edit'); ?>">
                                <span class="glyphicon glyphicon-edit"></span>
                            </a>
                        <?php endif; ?>
                        <?php if ($user->checkAccess('service:active')): ?>
                            <a class="btn btn-danger"
                               href="<?php echo $this->createUrl('service/active', array('id' => $data->id)); ?>"
                               title="<?php echo Yii::t('wojia', $data->active ? 'Enable' : 'Disable'); ?>">
                                <span class="
                                glyphicon
                                glyphicon-<?php if ($data->active): ?>ok<?php else: ?>minus<?php endif; ?>-sign
                                "></span>
                            </a>
                        <?php endif; ?>
                    </div>
                </td>
            </tr>
        <?php endforeach; ?>
        </tbody>
    </table>
    <?php $this->widget('CLinkPager', array(
        'pages' => $dataProvider->pagination,
        'header' => false,
        'firstPageLabel' => '&laquo;&laquo;',
        'prevPageLabel' => '&laquo;',
        'nextPageLabel' => '&raquo;',
        'lastPageLabel' => '&raquo;&raquo;',
        'selectedPageCssClass' => 'active',
        'htmlOptions' => array(
            'class' => 'pagination',
        ),
    )); ?>
<?php else: ?>
    <p><?php echo Yii::t('wojia', 'No services.'); ?></p>
<?php endif; ?>