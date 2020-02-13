<?php

namespace app\models;

use Yii;

/**
 * This is the model class for table "math_record".
 *
 * @property int $id
 * @property int $user_id
 * @property int $create_tab_id
 * @property string $avg_count
 * @property int $create_time
 */
class MathRecord extends \yii\db\ActiveRecord
{

    public function getTeam()
    {
        $team = $this->hasOne(Team::tableName(),['id' => 'team_id']);
        return $team;
    }

    public function getCreateTab()
    {
        $tab = $this->hasOne(CreateTab::tableName(),['id'=>'create_tab_id']);
        return $tab;
    }

    /**
     * {@inheritdoc}
     */
    public static function tableName()
    {
        return 'math_record';
    }

    /**
     * {@inheritdoc}
     */
    public function rules()
    {
        return [
            [['id', 'user_id', 'create_tab_id', 'avg_count', 'create_time'], 'required'],
            [['id', 'user_id', 'create_tab_id', 'create_time'], 'integer'],
            [['avg_count'], 'number'],
            [['id'], 'unique'],
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
            'create_tab_id' => 'Create Tab ID',
            'avg_count' => 'Avg Count',
            'create_time' => 'Create Time',
        ];
    }
}
