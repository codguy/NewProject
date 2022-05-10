<?php
 
namespace app\models;
 
use app\models\Users;
class AcessRuules extends \yii\filters\AccessRule {
 
    /**
     * @inheritdoc
     */
    protected function matchRole($user)
    {
        if (empty($this->roles)) {
            return true;
        }
        foreach ($this->roles as $role) {
            if ($role == '?') {
                if ($user->getIsGuest()) {
                    return true;
                }
            } elseif ($role == 1) {
                return true;
            }
        }
        return false;
    }
}