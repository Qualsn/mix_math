<?php

namespace app\models;

use Yii;

/**
 * This is the model class for table "user_auth".
 *
 * @property int $id
 * @property string $user_id
 * @property int $auth_id
 * @property int $create_time
 * @property int $is_del
 */
class UserAuth extends \yii\db\ActiveRecord
{
    /**
     * {@inheritdoc}
     */
    public static function tableName()
    {
        return 'user_auth';
    }

    /**
     * {@inheritdoc}
     */
    public function rules()
    {
        return [
            [['user_id', 'create_time'], 'required'],
            [['auth_id', 'create_time', 'is_del'], 'integer'],
            [['user_id'], 'string', 'max' => 200],
        ];
    }

    /**
     * {@inheritdoc}
     */
    public function attributeLabels()
    {
        return [
            'id' => 'ID',
            'user_id' => 'User ID',
            'auth_id' => 'Auth ID',
            'create_time' => 'Create Time',
            'is_del' => 'Is Del',
        ];
    }
}
