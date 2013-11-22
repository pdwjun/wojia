<?php

/**
 * Class ProjectLogModel
 *
 * @property integer $id
 * @property integer $project_id
 * @property integer $user_id
 * @property string $user_name
 * @property string $description
 * @property integer $create_time
 */
class ProjectLogModel extends Model
{
    /**
     * ProjectLogModel instance
     *
     * @param string $className
     * @return ProjectLogModel
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
        return 'project_log';
    }
}