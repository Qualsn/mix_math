<?php


namespace app\models;


use yii\db\ActiveRecord;

class Company extends ActiveRecord
{
    public function getUsers()
    {
        $users = $this->hasMany(User::className(),['company_id'=>'id'])->asArray();
        return $users;
    }
}