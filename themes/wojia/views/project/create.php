<?php
/** @var $form ProjectCreateForm */
/** @var $widget CActiveForm */

/** @var $this ProjectController */
$this->pageTitle = $title = Yii::t('wojia', 'Create new :item', array(
    ':item' => Yii::t('wojia', 'project'),
));

/** @var WebUser $user */
$user = Yii::app()->user;

/** @var $clientScript CClientScript */
$clientScript = Yii::app()->clientScript;
$clientScript->registerCss('project-create', '
#attachments_wrap{margin-bottom:20px;}
.table-column-name{}
.table-column-actions{width:97px;}
');
$clientScript->registerScript('project-create', '
$(document).on("click", ".btn-danger", function(e){
    e.preventDefault();

    if (!confirm("' . Yii::t('zii', 'Are you sure you want to delete this item?') . '"))
        return;

    var $button = $(this),
        $row = $button.closest("tr"),
        $tbody = $row.closest("tbody"),
        $table = $tbody.closest("table");

    if ($tbody.find("tr").length == 1)
        $table.addClass("hidden");

    $row.remove();
});
$(document).on("change", ".select-user", function(){
    var $select = $(this),

        $options = $select.children("option"),
        $option = $options.filter(":selected"),

        userId = $option.val(),
        userName = $option.text(),

        $table = $($select.data("table"))
        $tbody = $table.children("tbody");

    $options.attr("selected", false);

    if ($table.is(":hidden"))
        $table.removeClass("hidden");

    if ($tbody.find("tr[data-user-id="+userId+"]").length)
        return;

    $tbody.append(
        $("<tr>").attr("data-user-id",userId).append(
            $("<td>").text(userName).append(
                $("<input>").attr({
                    type:"hidden",
                    name:"ProjectCreateForm["+$select.data("input")+"][]"
                }).val(userId)
            ),
            $("<td>").append(
                $("<div>").addClass("btn-group").append(
//                    $("<a>").attr({
//                        href:"/"+$select.data("user-role")+"/view/"+userId,
//                        title:"' . Yii::t('wojia', 'View') . '",
//                        target:"_blank"
//                    }).addClass("btn btn-default").append(
//                        $("<span>").addClass("glyphicon glyphicon-eye-open")
//                    ),
                    $("<a>").attr({
                        href:"#",
                        title:"' . Yii::t('wojia', 'Delete') . '"
                    }).addClass("btn btn-danger").append(
                        $("<span>").addClass("glyphicon glyphicon-trash")
                    )
                )
            )
        )
    );
});
');
?>

    <div class="page-header">
        <h1><?php echo $title; ?></h1>
    </div>

<?php $widget = $this->beginWidget('CActiveForm', array(
    'id' => 'project-form',
    'htmlOptions' => array(
        'enctype' => 'multipart/form-data',
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
        <legend><?php echo Yii::t('wojia', 'Project'); ?></legend>
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
            <?php echo $widget->label($form, 'service_id', array(
                'class' => 'col-lg-2 control-label',
            )); ?>
            <div class="col-lg-10">
                <?php echo $widget->dropDownList($form, 'service_id', ProjectForm::getServiceList(), array(
                    'class' => 'form-control',
                    'prompt' => Yii::t('wojia', 'Select a :item', array(
                        ':item' => Yii::t('wojia', 'service'),
                    )),
                )); ?>
            </div>
        </div>

        <?php if (!$user->isMember): ?>
            <div class="form-group">
                <?php echo $widget->label($form, 'price', array(
                    'class' => 'col-lg-2 control-label',
                )); ?>
                <div class="col-lg-10">
                    <?php echo $widget->textField($form, 'price', array(
                        'class' => 'form-control',
                        'placeholder' => $form->getAttributeLabel('price'),
                    )); ?>
                </div>
            </div>
        <?php endif; ?>

    </fieldset>


    <div class="row">
        <fieldset class="col-md-6">
            <legend><?php echo Yii::t('wojia', 'Expected dates'); ?></legend>
            <div class="form-group">
                <?php echo $widget->label($form, 'expected_start_time', array(
                    'class' => 'col-lg-2 control-label',
                )); ?>
                <div class="col-lg-10">
                    <?php $this->widget('zii.widgets.jui.CJuiDatePicker', array(
                        'model' => $form,
                        'attribute' => 'expected_start_time',
                        'language' => Yii::app()->language,
                        'htmlOptions' => array(
                            'class' => 'form-control',
                            'placeholder' => $form->getAttributeLabel('expected_start_time'),
                        ),
                        'options' => array(
                            'showAnim' => 'fold',
                            'dateFormat' => 'mm/dd/yy',
                            'onSelect' => 'js: function() {
                                    var startTime = $(this).datepicker("getDate");
                                    if (startTime) {
                                        startTime.setDate(startTime.getDate() + 1);

                                        $("#ProjectCreateForm_expected_finish_time")
                                            .datepicker("setDate", startTime)
                                            .datepicker("option", "minDate", startTime);
                                    }
                                }',
                        ),
                    )); ?>
                </div>
            </div>
            <div class="form-group">
                <?php echo $widget->label($form, 'expected_finish_time', array(
                    'class' => 'col-lg-2 control-label',
                )); ?>
                <div class="col-lg-10">
                    <?php $this->widget('zii.widgets.jui.CJuiDatePicker', array(
                        'model' => $form,
                        'attribute' => 'expected_finish_time',
                        'language' => Yii::app()->language,
                        'htmlOptions' => array(
                            'class' => 'form-control',
                            'placeholder' => $form->getAttributeLabel('expected_finish_time'),
                        ),
                        'options' => array(
                            'showAnim' => 'fold',
                            'dateFormat' => 'mm/dd/yy',
                            'onSelect' => 'js: function() {
                                    var finishTime = $(this).datepicker("getDate");

                                    $("#ProjectCreateForm_expected_start_time")
                                            .datepicker("option", "maxDate", finishTime);
                                }',
                        ),
                    )); ?>
                </div>
            </div>
        </fieldset>

        <?php if (!$user->isCustomer): ?>
            <fieldset class="col-md-6">
                <legend><?php echo Yii::t('wojia', 'Actual dates'); ?></legend>
                <div class="form-group">
                    <?php echo $widget->label($form, 'actual_start_time', array(
                        'class' => 'col-lg-2 control-label',
                    )); ?>
                    <div class="col-lg-10">
                        <?php $this->widget('zii.widgets.jui.CJuiDatePicker', array(
                            'model' => $form,
                            'attribute' => 'actual_start_time',
                            'language' => Yii::app()->language,
                            'htmlOptions' => array(
                                'class' => 'form-control',
                                'placeholder' => $form->getAttributeLabel('actual_start_time'),
                            ),
                            'options' => array(
                                'showAnim' => 'fold',
                                'dateFormat' => 'mm/dd/yy',
                                'onSelect' => 'js: function() {
                                    var startTime = $(this).datepicker("getDate");
                                    if (startTime) {
                                        startTime.setDate(startTime.getDate() + 1);

                                        $("#ProjectCreateForm_actual_finish_time")
                                            .datepicker("setDate", startTime)
                                            .datepicker("option", "minDate", startTime);
                                    }
                                }',
                            ),
                        )); ?>
                    </div>
                </div>
                <div class="form-group">
                    <?php echo $widget->label($form, 'actual_finish_time', array(
                        'class' => 'col-lg-2 control-label',
                    )); ?>
                    <div class="col-lg-10">
                        <?php $this->widget('zii.widgets.jui.CJuiDatePicker', array(
                            'model' => $form,
                            'attribute' => 'actual_finish_time',
                            'language' => Yii::app()->language,
                            'htmlOptions' => array(
                                'class' => 'form-control',
                                'placeholder' => $form->getAttributeLabel('actual_finish_time'),
                            ),
                            'options' => array(
                                'showAnim' => 'fold',
                                'dateFormat' => 'mm/dd/yy',
                                'onSelect' => 'js: function() {
                                    var finishTime = $(this).datepicker("getDate");

                                    $("#ProjectCreateForm_actual_start_time")
                                            .datepicker("option", "maxDate", finishTime);
                                }',
                            ),
                        )); ?>
                    </div>
                </div>
            </fieldset>
        <?php endif; ?>

    </div>

<?php if (!$user->isCustomer && !$user->isMember): ?>
    <div class="row">
        <fieldset class="col-md-4">
            <legend><?php echo Yii::t('wojia', 'Customers'); ?></legend>
            <div class="form-group">
                <label class="col-lg-3 control-label"
                       for="customer"><?php echo Yii::t('wojia', 'Customer'); ?></label>

                <div class="col-lg-9">
                    <?php echo CHtml::dropDownList('customer', null, ProjectForm::getUserList(UserMetaModel::ROLE_CUSTOMER), array(
                        'class' => 'form-control select-user',
                        'prompt' => Yii::t('wojia', 'Select a customer'),
                        'data-table' => '.table-customers',
                        'data-input' => 'customers',
                        'data-user-role' => 'customer',
                    )); ?>
                </div>
            </div>
            <table class="
                table
                table-striped
                table-customers
                <?php if (empty($form->customers)): ?>hidden<? endif; ?>
            ">
                <thead>
                <tr>
                    <th class="table-column-name"><?php echo Yii::t('wojia', 'Customer name'); ?></th>
                    <th class="table-column-actions"><?php echo Yii::t('wojia', 'Actions'); ?></th>
                </tr>
                </thead>
                <tbody>
                <?php if ($form->customers): ?>
                    <?php foreach ($form->customers as $customerId): ?>
                        <?php $customer = CustomerModel::model()->findByPk($customerId); ?>
                        <?php if ($customer === null) continue; ?>
                        <tr data-user-id="<?php echo $customer->id; ?>">
                            <td>
                                <?php echo CHtml::hiddenField('ProjectCreateForm[customers][]', $customer->id); ?>
                                <?php echo CHtml::encode($customer->name); ?>
                            </td>
                            <td>
                                <div class="btn-group">
                                    <?php if ($user->checkAccess('customer:view')): ?>
                                        <a class="btn btn-default"
                                           href="<?php echo $this->createUrl('customer/view', array('id' => $customer->id)); ?>"
                                           title="<?php echo Yii::t('wojia', 'View'); ?>"
                                           target="_blank">
                                            <span class="glyphicon glyphicon-eye-open"></span>
                                        </a>
                                    <?php endif; ?>
                                    <a class="btn btn-danger" href="#"
                                       title="<?php echo Yii::t('wojia', 'Delete'); ?>">
                                        <span class="glyphicon glyphicon-trash"></span>
                                    </a>
                                </div>
                            </td>
                        </tr>
                    <?php endforeach; ?>
                <?php endif; ?>
                </tbody>
            </table>
        </fieldset>
        <fieldset class="col-md-4">
            <legend><?php echo Yii::t('wojia', 'Members'); ?></legend>
            <div class="form-group">
                <label class="col-lg-3 control-label"
                       for="member"><?php echo Yii::t('wojia', 'Member'); ?></label>

                <div class="col-lg-9">
                    <?php echo CHtml::dropDownList('customer', null, ProjectForm::getUserList(UserMetaModel::ROLE_MEMBER), array(
                        'class' => 'form-control select-user',
                        'prompt' => Yii::t('wojia', 'Select a member'),
                        'data-table' => '.table-members',
                        'data-input' => 'members',
                        'data-user-role' => 'member',
                    )); ?>
                </div>
            </div>
            <table class="
                table
                table-striped
                table-members
                <?php if (empty($form->members)): ?>hidden<? endif; ?>
            ">
                <thead>
                <tr>
                    <th class="table-column-name"><?php echo Yii::t('wojia', 'Member name'); ?></th>
                    <th class="table-column-actions"><?php echo Yii::t('wojia', 'Actions'); ?></th>
                </tr>
                </thead>
                <tbody>
                <?php if ($form->members): ?>
                    <?php foreach ($form->members as $memberId): ?>
                        <?php $member = MemberModel::model()->findByPk($memberId); ?>
                        <?php if ($member === null) continue; ?>
                        <tr data-user-id="<?php echo $member->id; ?>">
                            <td>
                                <?php echo CHtml::hiddenField('ProjectCreateForm[members][]', $member->id); ?>
                                <?php echo CHtml::encode($member->name); ?>
                            </td>
                            <td>
                                <div class="btn-group">
                                    <?php if ($user->checkAccess('member:view')): ?>
                                        <a class="btn btn-default"
                                           href="<?php echo $this->createUrl('member/view', array('id' => $member->id)); ?>"
                                           title="<?php echo Yii::t('wojia', 'View'); ?>"
                                           target="_blank">
                                            <span class="glyphicon glyphicon-eye-open"></span>
                                        </a>
                                    <?php endif; ?>
                                    <a class="btn btn-danger" href="#"
                                       title="<?php echo Yii::t('wojia', 'Delete'); ?>">
                                        <span class="glyphicon glyphicon-trash"></span>
                                    </a>
                                </div>
                            </td>
                        </tr>
                    <?php endforeach; ?>
                <?php endif; ?>
                </tbody>
            </table>
        </fieldset>
        <fieldset class="col-md-4">
            <legend><?php echo Yii::t('wojia', 'Managers'); ?></legend>
            <div class="form-group">
                <label class="col-lg-3 control-label"
                       for="manager"><?php echo Yii::t('wojia', 'Manager'); ?></label>

                <div class="col-lg-9">
                    <?php echo CHtml::dropDownList('customer', null, ProjectForm::getUserList(UserMetaModel::ROLE_MANAGER), array(
                        'class' => 'form-control select-user',
                        'prompt' => Yii::t('wojia', 'Select a manager'),
                        'data-table' => '.table-managers',
                        'data-input' => 'managers',
                        'data-user-role' => 'manager',
                    )); ?>
                </div>
            </div>
            <table class="
                table
                table-striped
                table-managers
                <?php if (empty($form->managers)): ?>hidden<? endif; ?>
            ">
                <thead>
                <tr>
                    <th class="table-column-name"><?php echo Yii::t('wojia', 'Manager name'); ?></th>
                    <th class="table-column-actions"><?php echo Yii::t('wojia', 'Actions'); ?></th>
                </tr>
                </thead>
                <tbody>
                <?php if ($form->managers): ?>
                    <?php foreach ($form->managers as $managerId): ?>
                        <?php $manager = ManagerModel::model()->findByPk($managerId); ?>
                        <?php if ($manager === null) continue; ?>
                        <tr data-user-id="<?php echo $manager->id; ?>">
                            <td>
                                <?php echo CHtml::hiddenField('ProjectCreateForm[managers][]', $manager->id); ?>
                                <?php echo CHtml::encode($manager->name); ?>
                            </td>
                            <td>
                                <div class="btn-group">
                                    <?php if ($user->checkAccess('manager:view')): ?>
                                        <a class="btn btn-default"
                                           href="<?php echo $this->createUrl('manager/view', array('id' => $manager->id)); ?>"
                                           title="<?php echo Yii::t('wojia', 'View'); ?>"
                                           target="_blank">
                                            <span class="glyphicon glyphicon-eye-open"></span>
                                        </a>
                                    <?php endif; ?>
                                    <a class="btn btn-danger" href="#"
                                       title="<?php echo Yii::t('wojia', 'Delete'); ?>">
                                        <span class="glyphicon glyphicon-trash"></span>
                                    </a>
                                </div>
                            </td>
                        </tr>
                    <?php endforeach; ?>
                <?php endif; ?>
                </tbody>
            </table>
        </fieldset>
    </div>
<?php endif; ?>

<?php if (!$user->isCustomer): ?>
    <fieldset>
        <legend><?php echo Yii::t('wojia', 'Attachments'); ?></legend>
        <?php $this->widget('CMultiFileUpload', array(
            'name' => 'attachments',
            'accept' => 'pdf|doc|docx',
        )); ?>
    </fieldset>
<?php endif; ?>

<?php if ($user->isManager || $user->isAdministrator): ?>
    <fieldset>
        <legend><?php echo Yii::t('wojia', 'Notifications'); ?></legend>
        <div class="form-group">
            <?php echo $widget->label($form, 'notification', array(
                'class' => 'col-lg-2 control-label',
            )); ?>
            <div class="col-lg-10">
                <label class="checkbox">
                    <?php echo $widget->checkBox($form, 'notification'); ?>
                </label>
            </div>
        </div>
    </fieldset>
<?php endif; ?>

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