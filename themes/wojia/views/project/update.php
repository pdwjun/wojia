<?php
/** @var $form ProjectUpdateForm */
/** @var $widget CActiveForm */

/** @var $this ProjectController */
$this->pageTitle = $title = Yii::t('wojia', 'Update :item', array(
    ':item' => Yii::t('wojia', 'project'),
));

/** @var $user WebUser */
$user = Yii::app()->user;

/** @var $dateFormatter CDateFormatter */
$dateFormatter = Yii::app()->dateFormatter;

/** @var $clientScript CClientScript */
$clientScript = Yii::app()->clientScript;
$clientScript->registerCss('project-update', '
#attachments_wrap{margin-bottom:20px;}
.table-column-name{}
.table-column-actions{width:97px;}
');
$clientScript->registerScript('project-update', '
$(document).on("click", ".btn-group .btn-danger", function(e){
    e.preventDefault();

    if (!confirm("' . Yii::t('zii', 'Are you sure you want to delete this item?') . '"))
        return;

    var $button = $(this),
        $row = $button.closest("tr"),
        $tbody = $row.closest("tbody"),
        $table = $tbody.closest("table");

    if ($tbody.find("tr").length == 1)
        $table.addClass("hidden");

    $row.addClass("danger").hide("slow");
    $row.find(".field-delete").val(true);
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

    var $row = $tbody.find("tr[data-user-id="+userId+"]");
    if ($row.length) {
        $row.removeClass("danger").show();
        $row.find(".field-delete").val("");
        return;
    }

    $tbody.append(
        $("<tr>").attr("data-user-id",userId).append(
            $("<td>").text(userName).append(
                $("<input>").attr({
                    type:"hidden",
                    name:"ProjectUpdateForm["+$select.data("input")+"]["+userId+"][id]"
                }).val(userId),
                $("<input>").attr({
                    type:"hidden",
                    name:"ProjectUpdateForm["+$select.data("input")+"]["+userId+"][delete]"
                }).val("")
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
$(document).on("change", ".select-status", function(){
    var $select = $(this),
        $options = $select.children("option")
        $option = $options.filter(":selected"),
        statusId = $option.val();

        if (statusId == ' . ProjectModel::STATUS_ABORT . ')
            $("#modal-abort").modal();
});
$(document).on("input propertychange", ".textarea-reason", function(){
    var $textarea = $(this),
        $button = $(".btn-update");

    $button.attr("disabled", $textarea.val().length ? false : true);
});
');
?>

    <div class="page-header">
        <h1><?php echo $title; ?></h1>
    </div>

<?php if ($user->getFlash('update')): ?>
    <div class="alert alert-success">
        <button type="button" class="close" data-dismiss="alert" aria-hidden="true">&times;</button>
        <strong><?php echo Yii::t('wojia', 'Well done!'); ?></strong>
        <?php echo Yii::t('wojia', 'You successfully updated :item.', array(
            ':item' => Yii::t('wojia', 'project'),
        )); ?>
    </div>
<?php endif; ?>

<?php $widget = $this->beginWidget('CActiveForm', array(
    'id' => 'project-update-form',
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
        <?php if (!$user->isCustomer): ?>
            <div class="form-group">
                <?php echo $widget->label($form, 'status', array(
                    'class' => 'col-lg-2 control-label',
                )); ?>
                <div class="col-lg-10">
                    <?php if ($form->status != ProjectModel::STATUS_ABORT): ?>
                        <?php $statusList = ProjectForm::getStatusList(); ?>
                        <?php unset($statusList[ProjectModel::STATUS_ABORT]); ?>
                        <?php echo $widget->dropDownList($form, 'status', $statusList, array(
                            'class' => 'form-control select-status',
                            'prompt' => Yii::t('wojia', 'Select a :item', array(
                                ':item' => Yii::t('wojia', 'status'),
                            )),
                        )); ?>
                    <?php else: ?>
                        <p class="form-control-static"><?php echo Yii::t('wojia', 'Abort'); ?></p>
                    <?php endif; ?>
                </div>
            </div>
        <?php endif; ?>

        <?php if ($form->status == ProjectModel::STATUS_ABORT): ?>
            <div class="form-group">
                <?php echo $widget->label($form, 'reason', array(
                    'class' => 'col-lg-2 control-label',
                )); ?>
                <div class="col-lg-10">
                    <p class="form-control-static"><?php echo CHtml::encode($form->reason); ?></p>
                </div>
            </div>
        <?php endif; ?>

        <?php if ($form->status == ProjectModel::STATUS_COMPLETE && $user->isCustomer): ?>
            <div class="form-group">
                <?php echo $widget->label($form, 'rating', array(
                    'class' => 'col-lg-2 control-label',
                )); ?>
                <div class="col-lg-10">
                    <?php echo $widget->dropDownList($form, 'rating', ProjectForm::getRatingList(), array(
                        'class' => 'form-control',
                        'prompt' => Yii::t('wojia', 'Select a :item', array(
                            ':item' => Yii::t('wojia', 'rating'),
                        )),
                    )); ?>
                </div>
            </div>
            <div class="form-group">
                <?php echo $widget->label($form, 'feedback', array(
                    'class' => 'col-lg-2 control-label',
                )); ?>
                <div class="col-lg-10">
                    <?php echo $widget->textArea($form, 'feedback', array(
                        'class' => 'form-control',
                        'placeholder' => $form->getAttributeLabel('feedback'),
                    )); ?>
                </div>
            </div>
        <?php endif; ?>

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
                        'name' => 'ProjectUpdateForm[expected_start_time]',
                        'value' => $form->expected_start_time ? $dateFormatter->format('MM/dd/yyyy', $form->expected_start_time) : '',
                        'language' => Yii::app()->language,
                        'htmlOptions' => array(
                            'class' => 'form-control',
                            'placeholder' => $form->getAttributeLabel('expected_start_time'),
                        ),
                        'options' => array(
                            'showAnim' => 'fold',
                            'dateFormat' => 'mm/dd/yy',
                            'maxDate' => is_int($form->expected_finish_time) ? date('m/d/Y', $form->expected_finish_time) : $form->expected_finish_time,
                            'onSelect' => 'js: function() {
                                var startTime = $(this).datepicker("getDate");
                                if (startTime) {
                                    startTime.setDate(startTime.getDate() + 1);

                                    $("#ProjectUpdateForm_expected_finish_time")
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
                        'name' => 'ProjectUpdateForm[expected_finish_time]',
                        'value' => $form->expected_finish_time ? $dateFormatter->format('MM/dd/yyyy', $form->expected_finish_time) : '',
                        'language' => Yii::app()->language,
                        'htmlOptions' => array(
                            'class' => 'form-control',
                            'placeholder' => $form->getAttributeLabel('expected_finish_time'),
                        ),
                        'options' => array(
                            'showAnim' => 'fold',
                            'dateFormat' => 'mm/dd/yy',
                            'minDate' => is_int($form->expected_start_time) ? date('m/d/Y', $form->expected_start_time) : $form->expected_start_time,
                            'onSelect' => 'js: function() {
                                var finishTime = $(this).datepicker("getDate");

                                $("#ProjectUpdateForm_expected_start_time")
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
                            'name' => 'ProjectUpdateForm[actual_start_time]',
                            'value' => $form->actual_start_time ? $dateFormatter->format('MM/dd/yyyy', $form->actual_start_time) : '',
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

                                        $("#ProjectUpdateForm_actual_finish_time")
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
                            'name' => 'ProjectUpdateForm[actual_finish_time]',
                            'value' => $form->actual_finish_time ? $dateFormatter->format('MM/dd/yyyy', $form->actual_finish_time) : '',
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

                                    $("#ProjectUpdateForm_actual_start_time")
                                            .datepicker("option", "maxDate", finishTime);
                                }',
                            ),
                        )); ?>
                    </div>
                </div>
            </fieldset>
        <?php endif; ?>

    </div>

    <div class="row">

    <?php if (!$user->isCustomer): ?>
        <fieldset class="col-md-4">
            <legend><?php echo Yii::t('wojia', 'Customers'); ?></legend>
            <div class="form-group">
                <label class="col-lg-3 control-label" for="customer">
                    <?php echo Yii::t('wojia', 'Customer'); ?>
                </label>

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
                    <?php foreach ($form->customers as $customer): ?>
                        <?php $customer = $customer instanceof CustomerModel ? $customer : CustomerModel::model()->findByPk($customer); ?>
                        <?php if ($customer === null) continue; ?>
                        <tr data-user-id="<?php echo $customer->id; ?>">
                            <td>
                                <?php echo CHtml::hiddenField('ProjectUpdateForm[customers][' . $customer->id . '][id]', $customer->id); ?>
                                <?php echo CHtml::hiddenField('ProjectUpdateForm[customers][' . $customer->id . '][delete]', '', array(
                                    'class' => 'field-delete',
                                )); ?>
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
                                    <?php if (!$user->isCustomer): ?>
                                        <a class="btn btn-danger" href="#"
                                           title="<?php echo Yii::t('wojia', 'Delete'); ?>">
                                            <span class="glyphicon glyphicon-trash"></span>
                                        </a>
                                    <?php endif; ?>
                                </div>
                            </td>
                        </tr>
                    <?php endforeach; ?>
                <?php endif; ?>
                </tbody>
            </table>
        </fieldset>
    <?php endif; ?>

    <?php if (!$user->isCustomer): ?>
        <fieldset class="col-md-4">
            <legend><?php echo Yii::t('wojia', 'Members'); ?></legend>
            <?php if (!$user->isCustomer && !$user->isMember): ?>
                <div class="form-group">
                    <label class="col-lg-3 control-label" for="member">
                        <?php echo Yii::t('wojia', 'Member'); ?>
                    </label>

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
            <?php endif; ?>
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
                    <?php foreach ($form->members as $member): ?>
                        <?php $member = $member instanceof MemberModel ? $member : MemberModel::model()->findByPk($member); ?>
                        <?php if ($member === null) continue; ?>
                        <tr data-user-id="<?php echo $member->id; ?>">
                            <td>
                                <?php echo CHtml::hiddenField('ProjectUpdateForm[members][' . $member->id . '][id]', $member->id); ?>
                                <?php echo CHtml::hiddenField('ProjectUpdateForm[members][' . $member->id . '][delete]', '', array(
                                    'class' => 'field-delete',
                                )); ?>
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
                                    <?php if (!$user->isCustomer && !$user->isMember): ?>
                                        <a class="btn btn-danger" href="#"
                                           title="<?php echo Yii::t('wojia', 'Delete'); ?>">
                                            <span class="glyphicon glyphicon-trash"></span>
                                        </a>
                                    <?php endif; ?>
                                </div>
                            </td>
                        </tr>
                    <?php endforeach; ?>
                <?php endif; ?>
                </tbody>
            </table>
        </fieldset>
    <?php endif; ?>

    <?php if (!$user->isCustomer && !$user->isMember && !$user->isManager): ?>
        <fieldset class="col-md-4">
            <legend><?php echo Yii::t('wojia', 'Managers'); ?></legend>
            <div class="form-group">
                <label class="col-lg-3 control-label" for="manager">
                    <?php echo Yii::t('wojia', 'Manager'); ?>
                </label>

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
                    <?php foreach ($form->managers as $manager): ?>
                        <?php $manager = $manager instanceof ManagerModel ? $manager : ManagerModel::model()->findByPk($manager); ?>
                        <?php if ($manager === null) continue; ?>
                        <tr data-user-id="<?php echo $manager->id; ?>">
                            <td>
                                <?php echo CHtml::hiddenField('ProjectUpdateForm[managers][' . $manager->id . '][id]', $manager->id); ?>
                                <?php echo CHtml::hiddenField('ProjectUpdateForm[managers][' . $manager->id . '][delete]', '', array(
                                    'class' => 'field-delete',
                                )); ?>
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
                                    <?php if (!$user->isCustomer && !$user->isMember && !$user->isManager): ?>
                                        <a class="btn btn-danger" href="#"
                                           title="<?php echo Yii::t('wojia', 'Delete'); ?>">
                                            <span class="glyphicon glyphicon-trash"></span>
                                        </a>
                                    <?php endif; ?>
                                </div>
                            </td>
                        </tr>
                    <?php endforeach; ?>
                <?php endif; ?>
                </tbody>
            </table>
        </fieldset>
    <?php endif; ?>

    </div>

<?php if (!$user->isMember && !$user->isCustomer): ?>
    <fieldset>
        <legend><?php echo Yii::t('wojia', 'Attachments'); ?></legend>
        <?php $this->widget('CMultiFileUpload', array(
            'name' => 'attachments',
            'accept' => 'pdf|doc|docx|jpg|jpeg',
        )); ?>
        <?php if ($form->attachments): ?>
            <ul>
                <?php foreach ($form->attachments as $attachment): ?>
                    <li>
                        <?php echo CHtml::link(basename($attachment->uri), $attachment->uri, array(
                            'target' => '_blank',
                        )); ?>
                    </li>
                <?php endforeach; ?>
            </ul>
        <?php else: ?>
            <p><?php echo Yii::t('wojia', 'No attachments.'); ?></p>
        <?php endif; ?>
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

<?php if (!$user->isCustomer): ?>
    <fieldset>
        <legend><?php echo Yii::t('wojia', 'Logs'); ?></legend>
        <?php if ($form->logs): ?>
            <table class="table table-striped">
                <thead>
                <tr>
                    <th><?php echo Yii::t('wojia', 'Log ID'); ?></th>
                    <th><?php echo Yii::t('wojia', 'Date'); ?></th>
                    <th><?php echo Yii::t('wojia', 'User'); ?></th>
                    <th><?php echo Yii::t('wojia', 'Description'); ?></th>
                </tr>
                </thead>
                <tbody>
                <?php foreach ($form->logs as $key => $log): ?>
                    <tr>
                        <td><?php echo $key + 1; ?></td>
                        <td><?php echo $dateFormatter->format('dd MMMM yyyy HH:mm', $log->create_time); ?></td>
                        <td><?php echo CHtml::encode($log->user_name); ?></td>
                        <td><?php echo CHtml::encode($log->description); ?></td>
                    </tr>
                <?php endforeach; ?>
                </tbody>
            </table>
        <?php else: ?>
            <p>
                <?php echo Yii::t('wojia', 'No :item.', array(
                    ':item' => Yii::t('wojia', 'logs'),
                )); ?>
            </p>
        <?php endif; ?>
    </fieldset>
<?php endif; ?>

    <div id="modal-abort" class="modal fade" role="dialog">
        <div class="modal-dialog">
            <div class="modal-content">
                <div class="modal-header">
                    <button type="button" class="close" data-dismiss="modal" aria-hidden="true">&times;</button>
                    <h4 class="modal-title"><?php echo Yii::t('wojia', 'Abort project'); ?></h4>
                </div>
                <div class="modal-body">
                    <div class="form-group">
                        <?php echo $widget->label($form, 'reason', array(
                            'class' => 'col-lg-2 control-label',
                        )); ?>
                        <div class="col-lg-10">
                            <?php echo $widget->textArea($form, 'reason', array(
                                'class' => 'form-control textarea-reason',
                                'placeholder' => $form->getAttributeLabel('reason'),
                            )); ?>
                        </div>
                    </div>
                </div>
                <div class="modal-footer">
                    <?php echo CHtml::button(Yii::t('wojia', 'Close'), array(
                        'class' => 'btn btn-default',
                        'data-dismiss' => 'modal',
                    )); ?>
                    <?php echo CHtml::submitButton(Yii::t('wojia', 'Update'), array(
                        'class' => 'btn btn-primary btn-update',
                        'disabled' => 'disabled',
                    )); ?>
                </div>
            </div>
        </div>
    </div>

    <div class="form-group">
        <div class="text-center">
            <?php echo CHtml::submitButton(Yii::t('wojia', 'Update'), array(
                'class' => 'btn btn-primary btn-lg',
            )); ?>

            <?php if (($user->isAdministrator || $user->isManager) && $form->status != ProjectModel::STATUS_ABORT): ?>
                <?php echo CHtml::link(Yii::t('wojia', 'Abort'), '#modal-abort', array(
                    'class' => 'btn btn-danger btn-lg',
                    'data-toggle' => 'modal'
                )); ?>
            <?php endif; ?>

            <?php echo CHtml::link(Yii::t('wojia', 'Cancel'), array('index'), array(
                'class' => 'btn btn-warning btn-lg',
            )); ?>
        </div>
    </div>
<?php $this->endWidget(); ?>