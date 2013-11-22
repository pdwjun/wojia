<?php

/**
 * Class Controller
 */
abstract class Controller extends CController
{
    public $layout = '/layouts/main';

    /**
     * Init
     */
    public function init()
    {
        /** @var WebUser $user */
        $user = Yii::app()->user;
        if ($user->isGuest) {
            $language = 'en';
            if (isset($_SERVER['HTTP_ACCEPT_LANGUAGE']))
                $language = substr($_SERVER['HTTP_ACCEPT_LANGUAGE'], 0, 2);
            Yii::app()->setLanguage($language == 'zh' ? 'zh_cn' : 'en');
        } else {
            if ($language = $user->model->getMeta('language'))
                Yii::app()->setLanguage($language);
        }
    }

    /**
     * Filters
     *
     * @return array
     */
    public function filters()
    {
        return array(
            'accessControl',
        );
    }

    /**
     * Access rules
     *
     * @return array
     */
    public function accessRules()
    {
        return array(
            array(
                'deny',
                'users' => array('*'),
            ),
        );
    }

    /**
     * Set page tile
     *
     * @param string $pageTitle
     */
    public function setPageTitle($pageTitle)
    {
        parent::setPageTitle(implode(' · ', array_merge(
            (array)$pageTitle,
            (array)Yii::app()->settings->site_title
        )));
    }
}