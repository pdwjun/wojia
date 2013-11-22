<?php

/**
 * Class Settings
 */
class Settings extends CApplicationComponent
{
    private $_options = array();

    /**
     * Initialize
     */
    public function init()
    {
        $models = OptionModel::model()->findAllByAttributes(array(
            'language' => Yii::app()->language,
        ));
        foreach ($models as $model)
            $this->_options[$model->key] = $model->value;
    }

    /**
     * Get attribute
     *
     * @param string $key
     * @return string
     */
    public function __get($key)
    {
        return $this->get($key);
    }

    /**
     * Set attribute
     *
     * @param string $key
     * @param mixed $value
     * @return mixed|void
     */
    public function __set($key, $value)
    {
        $this->set($key, $value);
    }

    /**
     * Get attribute
     *
     * @param string $key
     * @return string
     * @throws CException
     */
    public function get($key)
    {
        if (array_key_exists($key, $this->_options))
            return $this->_options[$key];
        else
            return null;
    }

    /**
     * Set attribute
     *
     * @param string $key
     * @param string $value
     */
    public function set($key, $value = null)
    {
        if (is_array($key)) {
            foreach ($key as $_key => $_value)
                $this->set($_key, $_value);
        } else {
            $model = OptionModel::model()->findByAttributes(array(
                'key' => $key,
                'language' => Yii::app()->language,
            ));

            if (null === $model) {
                $model = new OptionModel;
                $model->key = $key;
                $model->language = Yii::app()->language;
            }

            $model->value = $value;
            $model->save();
        }
    }

    /**
     * All attributes
     *
     * @return array
     */
    public function all()
    {
        return $this->_options;
    }
}