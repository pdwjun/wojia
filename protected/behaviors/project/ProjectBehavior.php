<?php

/**
 * Class ProjectBehavior
 */
class ProjectBehavior extends Behavior
{
    /**
     * After save
     *
     * @param CModelEvent $event
     */
    public function afterSave($event)
    {
        foreach ($this->owner->attributes as $key => $value) {
            if (!$this->owner->isNewRecord && $this->oldAttributes[$key] == $value)
                continue;

            if ($key == 'id')
                continue;
            elseif ($key == 'status') {
                $statusList = ProjectForm::getStatusList();
                $value = $statusList[$value];
            } elseif ($key == 'service_id') {
                $serviceList = ProjectForm::getServiceList();
                $value = $serviceList[$value];
            }

            $description = $this->owner->isNewRecord ?
                'Created project with attribute ":attribute" and value ":value"' :
                'Updated project with attribute ":attribute" and value ":value"';

            $this->addLog(
                $this->owner->id,
                Yii::t(
                    'wojia',
                    $description,
                    array(
                        ':attribute' => $this->owner->getAttributeLabel($key),
                        ':value' => $value,
                    )
                )
            );
        }
    }
}