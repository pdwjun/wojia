<?php

/**
 * Class ProjectAttachmentBehavior
 */
class ProjectAttachmentBehavior extends Behavior
{
    /**
     * After save
     *
     * @param CModelEvent $event
     */
    public function afterSave($event)
    {
        $this->addLog(
            $this->owner->project_id,
            Yii::t(
                'wojia',
                'Attach file ":name"',
                array(
                    ':name' => basename($this->owner->uri),
                )
            )
        );
    }
}