<?php

/**
 * Class PhpAuthManager
 */
class PhpAuthManager extends CPhpAuthManager
{
    /**
     * Initialize
     */
    public function init()
    {
        parent::init();

        $user = Yii::app()->user;
        if (!$user->isGuest)
            $this->assign($user->role, $user->id);
    }
}