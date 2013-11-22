<?php

/**
 * Class ProjectModel
 *
 * @property integer $id
 * @property string $name
 * @property integer $status
 * @property string $description
 * @property integer $service_id
 * @property integer $active
 *
 * @property ProjectMetaModel[] $meta
 * @property ProjectUserModel[] $users
 * @property MemberModel[] $members
 * @property ManagerModel[] $managers
 * @property CustomerModel[] $customers
 * @property ProjectAttachmentModel[] $attachments
 * @property ProjectLogModel[] $logs
 */
class ProjectModel extends Model
{
    const STATUS_START = 0;
    const STATUS_PROCESSING = 1;
    const STATUS_COMPLETE = 2;
    const STATUS_ABORT = 3;

    /**
     * ProjectModel instance
     *
     * @param string $className
     * @return ProjectModel
     */
    public static function model($className = __CLASS__)
    {
        return parent::model($className);
    }

    /**
     * Table name
     *
     * @return string
     */
    public function tableName()
    {
        return 'project';
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
            'description' => Yii::t('wojia', 'Description'),
            'service_id' => Yii::t('wojia', 'Service'),
            'active' => Yii::t('wojia', 'Active'),
        );
    }

    /**
     * Relations
     *
     * @return array
     */
    public function relations()
    {
        return array(
            'meta' => array(self::HAS_MANY, 'ProjectMetaModel', 'project_id'),
            'users' => array(self::HAS_MANY, 'ProjectUserModel', 'project_id'),
            'members' => array(self::HAS_MANY, 'MemberModel', array('user_id' => 'id'), 'through' => 'users'),
            'managers' => array(self::HAS_MANY, 'ManagerModel', array('user_id' => 'id'), 'through' => 'users'),
            'customers' => array(self::HAS_MANY, 'CustomerModel', array('user_id' => 'id'), 'through' => 'users'),
            'attachments' => array(self::HAS_MANY, 'ProjectAttachmentModel', 'project_id'),
            'logs' => array(self::HAS_MANY, 'ProjectLogModel', 'project_id'),
        );
    }

    /**
     * Default scope
     *
     * @return array
     */
    public function defaultScope()
    {
        /** @var WebUser $user */
        $user = Yii::app()->user;

        if ($user->isAdministrator)
            return parent::defaultScope();
        else {
            return CMap::mergeArray(
                parent::defaultScope(),
                array(
                    'with' => array(
                        'users' => array(
                            'together' => true,
                            'select' => false,
                            'condition' => '`project_user`.`user_id` = :userId',
                            'params' => array(
                                ':userId' => $user->id,
                            ),
                        ),
                    ),
                    'condition' => '`project`.`active` = :active',
                    'params' => array(
                        ':active' => true,
                    ),
                )
            );
        }
    }

    /**
     * Behaviors
     *
     * @return array
     */
    public function behaviors()
    {
        return array(
            'ProjectBehavior' =>
            'application.behaviors.project.ProjectBehavior',
        );
    }

    /**
     * Set project meta
     *
     * @param string $key
     * @param string $value
     */
    public function setMeta($key, $value = null)
    {
        if (is_array($key)) {
            foreach ($key as $_key => $_value)
                $this->setMeta($_key, $_value);
        } else {
            $model = ProjectMetaModel::model()->findByAttributes(array(
                'project_id' => $this->id,
                'key' => $key,
            ));

            if (null === $model) {
                $model = new ProjectMetaModel;
                $model->project_id = $this->id;
                $model->key = $key;
            }

            $model->value = $value;
            $model->save();
        }
    }

    /**
     * Get project meta
     *
     * @param string $key
     * @return null|string
     */
    public function getMeta($key)
    {
        foreach ($this->meta as $meta) {
            if ($meta->key == $key)
                return $meta->value;
        }
        return null;
    }

    /**
     * Set project user
     *
     * @param integer $id
     */
    public function setUser($id)
    {
        $exist = ProjectUserModel::model()->countByAttributes(array(
            'project_id' => $this->id,
            'user_id' => $id,
        ));

        if ($exist)
            return;

        $model = new ProjectUserModel;
        $model->project_id = $this->id;
        $model->user_id = $id;
        $model->save();
    }

    /**
     * Set attachment
     *
     * @param string $uri
     */
    public function setAttachment($uri)
    {
        $model = new ProjectAttachmentModel;
        $model->project_id = $this->id;
        $model->uri = (string)$uri;
        $model->save();
    }
}