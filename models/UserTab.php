<?php

namespace app\models;

use Yii;

/**
 * This is the model class for table "user_tab".
 *
 * @property int $id
 * @property int $create_tab_id
 * @property int $team_id
 * @property int $score1
 * @property int $score2
 * @property int $score3
 * @property int $score4
 * @property int $score5
 * @property int $score6
 * @property int $score7
 * @property int $score8
 * @property int $score9
 * @property int $score10
 * @property int $create_time
 * @property int $update_time
 */
class UserTab extends \yii\db\ActiveRecord
{
    /**
     * {@inheritdoc}
     */
    public static function tableName()
    {
        return 'user_tab';
    }

    /**
     * {@inheritdoc}
     */
    public function rules()
    {
        return [
            [['id', 'create_tab_id', 'team_id'], 'required'],
            [['id', 'create_tab_id', 'team_id', 'score1', 'score2', 'score3', 'score4', 'score5', 'score6', 'score7', 'score8', 'score9', 'score10', 'create_time', 'update_time'], 'integer'],
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
            'create_tab_id' => 'Create Tab ID',
            'team_id' => 'Team ID',
            'score1' => 'Score1',
            'score2' => 'Score2',
            'score3' => 'Score3',
            'score4' => 'Score4',
            'score5' => 'Score5',
            'score6' => 'Score6',
            'score7' => 'Score7',
            'score8' => 'Score8',
            'score9' => 'Score9',
            'score10' => 'Score10',
            'create_time' => 'Create Time',
            'update_time' => 'Update Time',
        ];
    }
}
