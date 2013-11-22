<?php

/**
 * Class ProjectMetaBehavior
 */
class ProjectMetaBehavior extends Behavior
{
    /**
     * Skip attributes
     *
     * @var array
     */
    private $_skipAttributes = array(
        'create_time',
        'update_time',
    );

    /**
     * After save
     *
     * @param CModelEvent $event
     */
    public function afterSave($event)
    {
        // get attribute
        $attribute = $this->owner->key;
        if (in_array($attribute, $this->_skipAttributes))
            return;

        // get value
        $value = $this->owner->value;
        if (!$this->owner->isNewRecord && $this->oldAttributes['value'] == $value)
            return;

        // dates
        if (strstr($attribute, 'time'))
            $value = Yii::app()->dateFormatter->format('dd MMMM yyyy', $value);

        // set description
        $description = $this->owner->isNewRecord ?
            'Created project with attribute ":attribute" and value ":value"' :
            'Updated project with attribute ":attribute" and value ":value"';

        // add log
        $this->addLog(
            $this->owner->project_id,
            Yii::t(
                'wojia',
                $description,
                array(
                    ':attribute' => $this->owner->getAttributeLabel($attribute),
                    ':value' => $value,
                )
            )
        );
    }
}