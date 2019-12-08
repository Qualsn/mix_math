<?php

namespace app\models;

use Yii;

/**
 * This is the model class for table "team".
 *
 * @property int $id
 * @property string $team_name
 * @property string $member
 * @property int $reate_tab_id
 * @property int $create_time
 * @property int $update_time
 */
class Team extends \yii\db\ActiveRecord
{
    /**
     * {@inheritdoc}
     */
    public static function tableName()
    {
        return 'team';
    }

    /**
     * {@inheritdoc}
     */
    public function rules()
    {
        return [
            [['team_name', 'member'], 'required'],
            [['reate_tab_id', 'create_time', 'update_time'], 'integer'],
            [['team_name', 'member'], 'string', 'max' => 50],
        ];
    }

    /**
     * {@inheritdoc}
     */
    public function attributeLabels()
    {
        return [
            'id' => 'ID',
            'team_name' => 'Team Name',
            'member' => 'Member',
            'reate_tab_id' => 'Reate Tab ID',
            'create_time' => 'Create Time',
            'update_time' => 'Update Time',
        ];
    }
}
