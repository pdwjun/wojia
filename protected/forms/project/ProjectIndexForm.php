<?php

/**
 * Class ProjectIndexForm
 *
 * @property CActiveDataProvider $dataProvider
 */
class ProjectIndexForm extends ProjectForm
{
    /**
     * Validation rules
     *
     * @return array
     */
    public function rules()
    {
        return array(
            array('id, name, status, description', 'safe'),
        );
    }

    /**
     * Get database data provider
     *
     * @return CActiveDataProvider
     */
    public function getDataProvider()
    {
        // set database criteria
        $criteria = new CDbCriteria;
        $criteria->compare('project.id', $this->id);
        $criteria->compare('project.name', $this->name, true);
        $criteria->compare('project.status', $this->status);
        $criteria->compare('project.description', $this->description, true);

        // return database data provider
        return new CActiveDataProvider($this->model, array(
            'criteria' => $criteria,
            'pagination' => array(
                'pageSize' => Yii::app()->settings->projects_per_page,
            ),
        ));
    }
}