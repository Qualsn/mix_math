<?php


namespace app\models;


use yii\db\ActiveRecord;

class Users extends ActiveRecord
{
    public function getCompany()
    {
        $company = $this->hasOne(Company::className(),['id'=>'company_id'])->asArray();
        return $company;
    }

}