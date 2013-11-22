<?php

/**
 * Class MemberIndexForm
 *
 * @property CActiveDataProvider $dataProvider
 */
class MemberIndexForm extends MemberForm
{
    /**
     * Rules
     *
     * @return array
     */
    public function rules()
    {
        return array(
            array('id, name, email', 'safe'),
        );
    }

    /**
     * Get data provider
     *
     * @return CActiveDataProvider
     */
    public function getDataProvider()
    {
        $criteria = new CDbCriteria;

        $criteria->compare('user.id', $this->id);
        $criteria->compare('user.name', $this->name, true);
        $criteria->compare('user.email', $this->email, true);

        return new CActiveDataProvider($this->model, array(
            'criteria' => $criteria,
            'pagination' => array(
                'pageSize' => Yii::app()->settings->members_per_page,
            ),
        ));
    }
}