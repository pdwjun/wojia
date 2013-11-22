<?php

/**
 * Class UserModel
 *
 * @property integer $id
 * @property string $name
 * @property string $email
 * @property string $password
 * @property integer $active
 *
 * @property UserMetaModel[] $meta
 */
class UserModel extends Model
{
    /**
     * UserModel instance
     *
     * @param string $className
     * @return UserModel
     */
    public static function model($className = __CLASS__)
    {
        return parent::model($className);
    }

    /**
     * Table name
     *
     * @return string
     */
    public function tableName()
    {
        return 'user';
    }

    /**
     * Relations
     *
     * @return array
     */
    public function relations()
    {
        return array(
            'meta' => array(self::HAS_MANY, 'UserMetaModel', 'user_id'),
        );
    }

    /**
     * Set user meta
     *
     * @param string $key
     * @param string $value
     */
    public function setMeta($key, $value = null)
    {
        if (is_array($key)) {
            foreach ($key as $_key => $_value)
                $this->setMeta($_key, $_value);
        } else {
            $model = UserMetaModel::model()->findByAttributes(array(
                'user_id' => $this->id,
                'key' => $key,
            ));

            if (null === $model) {
                $model = new UserMetaModel;
                $model->user_id = $this->id;
                $model->key = $key;
            }

            $model->value = $value;
            $model->save();
        }
    }

    /**
     * Get user meta
     *
     * @param string $key
     * @return null|string
     */
    public function getMeta($key)
    {
        foreach ($this->meta as $meta) {
            if ($meta->key == $key)
                return $meta->value;
        }
        return null;
    }
}