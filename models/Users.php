<?php

namespace app\models;

use Yii;

/**
 * This is the model class for table "users".
 *
 * @property int $id
 * @property string $nick_name
 * @property string $open_id
 * @property string $country
 * @property string $province
 * @property string $city
 * @property int $age
 * @property string $sex
 * @property string $avatar_url
 * @property int $create_time
 * @property int $update_time
 */
class Users extends \yii\db\ActiveRecord
{
    /**
     * {@inheritdoc}
     */
    public static function tableName()
    {
        return 'users';
    }

    /**
     * {@inheritdoc}
     */
    public function rules()
    {
        return [
            [['nick_name', 'open_id'], 'required'],
            [['age', 'create_time', 'update_time'], 'integer'],
            [['nick_name'], 'string', 'max' => 100],
            [['open_id', 'avatar_url'], 'string', 'max' => 200],
            [['country', 'province', 'city'], 'string', 'max' => 50],
            [['sex'], 'string', 'max' => 20],
        ];
    }

    /**
     * {@inheritdoc}
     */
    public function attributeLabels()
    {
        return [
            'id' => 'ID',
            'nick_name' => 'Nick Name',
            'open_id' => 'Open ID',
            'country' => 'Country',
            'province' => 'Province',
            'city' => 'City',
            'age' => 'Age',
            'sex' => 'Sex',
            'avatar_url' => 'Avatar Url',
            'create_time' => 'Create Time',
            'update_time' => 'Update Time',
        ];
    }
}
