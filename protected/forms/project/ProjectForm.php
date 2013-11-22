<?php

/**
 * Class ProjectForm
 *
 * @property ProjectModel $model
 */
abstract class ProjectForm extends Form
{
    public $id;
    public $name;
    public $status;
    public $description;
    public $service_id;
    public $create_time;
    public $update_time;
    public $expected_start_time;
    public $expected_finish_time;
    public $actual_start_time;
    public $actual_finish_time;
    public $customers;
    public $members;
    public $managers;
    public $attachments;
    public $logs;
    public $feedback;
    public $reason;
    public $rating;
    public $price;
    public $notification;

    /**
     * Service list
     *
     * @return array
     */
    public static function getServiceList()
    {
        $criteria = new CDbCriteria;
        $criteria->select = 'id, name';
        $criteria->condition = 'service.active = :active';
        $criteria->params = array(':active' => true);

        $models = ServiceModel::model()->findAll($criteria);
        $models = CHtml::listData($models, 'id', 'name');

        return $models;
    }

    /**
     * User list
     *
     * @param string $role
     * @return array
     */
    public static function getUserList($role = UserMetaModel::ROLE_CUSTOMER)
    {
        $criteria = new CDbCriteria;
        $criteria->select = 'id, name';
        $criteria->condition = 'user.active = :active';
        $criteria->params = array(':active' => true);
        $criteria->with = array(
            'meta' => array(
                'together' => true,
                'select' => false,
                'condition' => 'user_meta.key = :key AND user_meta.value = :value',
                'params' => array(
                    ':key' => 'role',
                    ':value' => $role,
                ),
            ),
        );

        $models = UserModel::model()->findAll($criteria);
        $models = CHtml::listData($models, 'id', 'name');

        return $models;
    }

    /**
     * Rating list
     *
     * @return array
     */
    public static function getRatingList()
    {
        return array(
            1 => Yii::t('wojia', 'Failed'),
            2 => Yii::t('wojia', 'Below Average'),
            3 => Yii::t('wojia', 'Average'),
            4 => Yii::t('wojia', 'Above Average'),
            5 => Yii::t('wojia', 'Excellent'),
        );
    }

    /**
     * Count project by status
     *
     * @param integer $status
     * @return string
     */
    public static function countProjectsByStatus($status = ProjectModel::STATUS_START)
    {
        $criteria = new CDbCriteria;
        $criteria->condition = 'project.status = :status AND project.active = :active';
        $criteria->params = array(
            ':status' => $status,
            ':active' => true,
        );

        return ProjectModel::model()->count($criteria);
    }

    /**
     * Labels
     *
     * @return array
     */
    public function attributeLabels()
    {
        return array(
            'id' => Yii::t('wojia', 'Project ID'),
            'name' => Yii::t('wojia', 'Project name'),
            'status' => Yii::t('wojia', 'Status'),
            'feedback' => Yii::t('wojia', 'Feedback'),
            'description' => Yii::t('wojia', 'Description'),
            'service_id' => Yii::t('wojia', 'Service'),
            'create_time' => Yii::t('wojia', 'Create time'),
            'update_time' => Yii::t('wojia', 'Update time'),
            'expected_start_time' => Yii::t('wojia', 'Expected start time'),
            'expected_finish_time' => Yii::t('wojia', 'Expected finish time'),
            'actual_start_time' => Yii::t('wojia', 'Actual start time'),
            'actual_finish_time' => Yii::t('wojia', 'Actual finish time'),
            'reason' => Yii::t('wojia', 'Reason'),
            'rating' => Yii::t('wojia', 'Rating'),
            'price' => Yii::t('wojia', 'Price'),
            'notification' => Yii::t('wojia', 'Send an email'),
        );
    }

    /**
     * Validation rules
     *
     * @return array
     */
    public function rules()
    {
        return array(
            array('name, description, service_id', 'required'),
            array('service_id', 'exist', 'className' => 'ServiceModel', 'attributeName' => 'id'),

            array('status', 'in', 'range' => array_keys(self::getStatusList())),
            array('status', 'default', 'value' => ProjectModel::STATUS_START),

            array('create_time, update_time', 'safe'),

            array('expected_start_time, expected_finish_time', 'required'),
            array('expected_start_time, expected_finish_time', 'date'),

            array('actual_start_time, actual_finish_time', 'safe'),

            array('customers, members, managers', 'safe'),

            array('feedback', 'required', 'on' => 'complete'),
            array('rating', 'required', 'on' => 'complete'),

            array('reason', 'safe'),

            array('price', 'numerical', 'integerOnly' => true),

            array('notification', 'boolean'),
        );
    }

    /**
     * Project status list
     *
     * @return array
     */
    public static function getStatusList()
    {
        return array(
            ProjectModel::STATUS_START => Yii::t('wojia', 'Start'),
            ProjectModel::STATUS_PROCESSING => Yii::t('wojia', 'Processing'),
            ProjectModel::STATUS_COMPLETE => Yii::t('wojia', 'Complete'),
            ProjectModel::STATUS_ABORT => Yii::t('wojia', 'Abort'),
            ProjectModel::STATUS_COMPLETE => Yii::t('wojia', 'Complete'),
        );
    }

    /**
     * Upload attachments
     */
    public function upload()
    {
        $attachments = CUploadedFile::getInstancesByName('attachments');
        if (empty($attachments))
            return;

        // base directory
        $directory = Yii::getPathOfAlias('webroot.upload.project');

        // add year to the directory
        $directory .= DIRECTORY_SEPARATOR . date('Y');
        if (!is_dir($directory)) {
            mkdir($directory, 02777);
            chmod($directory, 02777);
        }

        // add month to the directory
        $directory .= DIRECTORY_SEPARATOR . date('m');
        if (!is_dir($directory)) {
            mkdir($directory, 02777);
            chmod($directory, 02777);
        }

        // add day to the directory
        $directory .= DIRECTORY_SEPARATOR . date('d');
        if (!is_dir($directory)) {
            mkdir($directory, 02777);
            chmod($directory, 02777);
        }

        foreach ($attachments as $attachment) {
            /** @var CUploadedFile $attachment */
            $name = strtr(':directory:separator:name', array(
                ':directory' => $directory,
                ':separator' => DIRECTORY_SEPARATOR,
                ':name' => $attachment->name,
            ));

            if ($attachment->saveAs($name)) {
                $uri = str_replace(
                    Yii::getPathOfAlias('webroot'),
                    '',
                    $name
                );

                $this->model->setAttachment($uri);
            }
        }
    }
}