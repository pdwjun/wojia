<?php

/**
 * Class OptionController
 */
class OptionController extends Controller
{
    /**
     * Access rules
     *
     * @return array
     */
    public function accessRules()
    {
        return CMap::mergeArray(
            array(
                array(
                    'allow',
                    'actions' => array('index'),
                    'roles' => array('option:index'),
                ),
            ),
            parent::accessRules()
        );
    }

    public function actionIndex()
    {
        $form = new OptionForm;

        // get form attributes
        if ($attributes = Yii::app()->request->getPost('OptionForm')) {
            // set form attributes
            $form->setAttributes($attributes);

            if ($form->save()) {
                // set updated flash
                Yii::app()->user->setFlash('update', true);

                // refresh
                $this->refresh();
            }
        }

        $this->render('index', array(
            'form' => $form,
        ));
    }
}