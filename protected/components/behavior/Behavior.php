<?php

/**
 * Class Behavior
 *
 * @property array $oldAttributes
 */
abstract class Behavior extends CActiveRecordBehavior
{
    private $_oldAttributes = array();

    /**
     * After find
     *
     * @param CModelEvent $event
     */
    public function afterFind($event)
    {
        $this->setOldAttributes($this->owner->attributes);
    }

    /**
     * Get old attributes
     *
     * @return array
     */
    public function getOldAttributes()
    {
        return $this->_oldAttributes;
    }

    /**
     * Set old attributes
     *
     * @param array $attributes
     * @return $this
     */
    public function setOldAttributes(array $attributes)
    {
        $this->_oldAttributes = $attributes;
        return $this;
    }

    /**
     * Add log
     *
     * @param integer $projectId
     * @param string $description
     * @return bool
     */
    public function addLog($projectId, $description)
    {
        $model = new ProjectLogModel;
        $model->project_id = $projectId;
        $model->description = $description;
        $model->create_time = time();

        /** @var WebUser $user */
        $user = Yii::app()->user;
        $model->user_id = $user->id;
        $model->user_name = $user->name;

        return $model->save();
    }

    /**
     * Send email
     *
     * @param string $to
     * @param string $subject
     * @param string $message
     * @return bool
     */
    public function mail($to, $subject, $message)
    {
        // headers
        $headers = array();
        $headers[] = strtr('From: :name <:email>', array(
            ':name' => 'K. Young Back Office Services Inc.',
            ':email' => 'no-reply@' . $_SERVER['SERVER_NAME'],
        ));
        $headers[] = 'MIME-Version: 1.0';
        $headers[] = 'Content-type: text/html; charset=utf-8';

        // send
        return mail(
            $to,
            $subject,
            $message,
            implode("\r\n", $headers)
        );
    }
}