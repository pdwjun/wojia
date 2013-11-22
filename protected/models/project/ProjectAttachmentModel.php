<?php

/**
 * Class ProjectAttachmentModel
 *
 * @property integer $id
 * @property integer $project_id
 * @property string $uri
 */
class ProjectAttachmentModel extends Model
{
    /**
     * ProjectAttachmentModel instance
     *
     * @param string $className
     * @return ProjectAttachmentModel
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
        return 'project_attachment';
    }

    /**
     * Behaviors
     *
     * @return array
     */
    public function behaviors()
    {
        return array(
            'ProjectAttachmentBehavior' =>
            'application.behaviors.project.ProjectAttachmentBehavior',
        );
    }
}