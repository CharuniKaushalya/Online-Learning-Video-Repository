<?php

namespace app\models;
use Yii;

class PermissionHelpers {

    public static function requireAdmin() {
        if(Yii::$app->user->identity->role == 100)
        {
            return true;
        }
        else return false;
    }
}
?>