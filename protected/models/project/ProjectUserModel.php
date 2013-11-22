<?php

/**
 * Class ProjectUserModel
 *
 * @property integer $id
 * @property integer $project_id
 * @property integer $user_id
 */
class ProjectUserModel extends Model
{
    /**
     * ProjectUserModel instance
     *
     * @param string $className
     * @return ProjectUserModel
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
        return 'project_user';
    }

    /**
     * Behaviors
     *
     * @return array
     */
    public function behaviors()
    {
        return array(
            'ProjectUserBehavior' =>
            'application.behaviors.project.ProjectUserBehavior',
        );
    }
}