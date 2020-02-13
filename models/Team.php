<?php

namespace app\models;

use Yii;

/**
 * This is the model class for table "team".
 *
 * @property int $id
 * @property string $team_name
 * @property string $member
 * @property int $create_tab_id
 * @property double $average
 * @property int $create_time
 * @property int $update_time
 */
class Team extends \yii\db\ActiveRecord
{
    /**
     * 关联创建表
     * @return \yii\db\ActiveQuery
     */
    public function getCreateTab()
    {
        $getTab = $this->hasOne(CreateTab::tableName(),['id' => 'create_tab_id']);
        return $getTab;
    }
    public function getTeam()
    {
        $getTeam = $this->hasOne(Team::tableName(),['id' => 'team_id']);
        return $getTeam;
    }
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
            [['create_tab_id', 'create_time', 'update_time'], 'integer'],
            [['average'], 'number'],
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
            'create_tab_id' => 'Create Tab ID',
            'average' => 'Average',
            'create_time' => 'Create Time',
            'update_time' => 'Update Time',
        ];
    }
}
