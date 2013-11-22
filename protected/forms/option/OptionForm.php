<?php

/**
 * Class OptionForm
 */
class OptionForm extends CFormModel
{
    public $site_title;
    public $site_description;
    public $site_author;
    public $customers_per_page;
    public $members_per_page;
    public $managers_per_page;
    public $administrators_per_page;
    public $projects_per_page;
    public $services_per_page;
    /**
     * @var Settings
     */
    private $_settings;

    /**
     * Attributes labels
     *
     * @return array
     */
    public function attributeLabels()
    {
        return array(
            'site_title' => Yii::t('wojia', 'Site title'),
            'customers_per_page' => Yii::t('wojia', 'Customers per page'),
            'members_per_page' => Yii::t('wojia', 'Members per page'),
            'managers_per_page' => Yii::t('wojia', 'Managers per page'),
            'administrators_per_page' => Yii::t('wojia', 'Administrators per page'),
            'projects_per_page' => Yii::t('wojia', 'Projects per page'),
            'site_description' => Yii::t('wojia', 'Site description'),
            'site_author' => Yii::t('wojia', 'Site author'),
            'services_per_page' => Yii::t('wojia', 'Services per page'),
        );
    }

    /**
     * Rules
     *
     * @return array
     */
    public function rules()
    {
        return array(
            array('site_title, site_description, site_author', 'safe'),
            array('customers_per_page', 'safe'),
            array('members_per_page', 'safe'),
            array('managers_per_page', 'safe'),
            array('administrators_per_page', 'safe'),
            array('projects_per_page', 'safe'),
            array('services_per_page', 'safe'),
        );
    }

    /**
     * Init
     */
    public function init()
    {
        $this->_settings = Yii::app()->settings;

        foreach ($this->_settings->all() as $key => $value)
            if (property_exists($this, $key))
                $this->{$key} = $value;
    }

    /**
     * Save
     *
     * @return bool
     */
    public function save()
    {
        if ($this->validate()) {
            $this->_settings->set(array(
                'site_title' => $this->site_title,
                'site_description' => $this->site_description,
                'site_author' => $this->site_author,
                'customers_per_page' => $this->customers_per_page,
                'members_per_page' => $this->members_per_page,
                'managers_per_page' => $this->managers_per_page,
                'administrators_per_page' => $this->administrators_per_page,
                'projects_per_page' => $this->projects_per_page,
                'services_per_page' => $this->services_per_page,
            ));

            return true;
        } else
            return false;
    }
}