<?php

/**
 * Class ProjectMetaModel
 *
 * @property integer $id
 * @property integer $project_id
 * @property string $key
 * @property string $value
 */
class ProjectMetaModel extends Model
{
    /**
     * ProjectMetaModel instance
     *
     * @param string $className
     * @return ProjectMetaModel
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
        return 'project_meta';
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
            'application.behaviors.project.ProjectMetaBehavior',
        );
    }
}