<?php

/**
 * Class Model
 */
abstract class Model extends CActiveRecord
{
    /**
     * Default scope
     *
     * @return array
     */
    public function defaultScope()
    {
        return array(
            'alias' => $this->tableName(),
        );
    }
}