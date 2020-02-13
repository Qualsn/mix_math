<?php

namespace app\models;

use Yii;

/**
 * This is the model class for table "create_tab".
 *
 * @property int $id
 * @property string $title 比赛名称
 * @property string $user_id 用户id
 * @property string $host 主办方
 * @property string $tab_num 表唯一编号
 * @property string $address 举办地点
 * @property int $status 队伍编号
 * @property string $content_per1 评分项 %
 * @property string $content_per2 评分项目id
 * @property string $content_per3 百分比id
 * @property string $content_per4
 * @property string $content_per5
 * @property string $content_per6
 * @property string $content_per7
 * @property string $content_per8
 * @property string $content_per9
 * @property string $content_per10
 * @property string $comment 评价
 * @property int $sum 总分
 * @property int $create_time
 * @property int $update_time
 * @property int $is_del
 */
class CreateTab extends \yii\db\ActiveRecord
{
    /**
     * {@inheritdoc}
     */
    public static function tableName()
    {
        return 'create_tab';
    }

    public function getUsers()
    {
        $users =  $this->hasOne(Users::tableName(),['id' => 'user_id']);
    }

    /**
     * {@inheritdoc}
     */
    public function rules()
    {
        return [
            [['user_id'], 'required'],
            [['status', 'sum', 'create_time', 'update_time', 'is_del'], 'integer'],
            [['title', 'tab_num'], 'string', 'max' => 50],
            [['user_id', 'host', 'address', 'content_per1', 'content_per2', 'content_per3', 'content_per4', 'content_per5', 'content_per6', 'content_per7', 'content_per8', 'content_per9', 'content_per10'], 'string', 'max' => 100],
            [['comment'], 'string', 'max' => 200],
        ];
    }

    /**
     * {@inheritdoc}
     */
    public function attributeLabels()
    {
        return [
            'id' => 'ID',
            'title' => 'Title',
            'user_id' => 'User ID',
            'host' => 'Host',
            'tab_num' => 'Tab Num',
            'address' => 'Address',
            'status' => 'Status',
            'content_per1' => 'Content Per1',
            'content_per2' => 'Content Per2',
            'content_per3' => 'Content Per3',
            'content_per4' => 'Content Per4',
            'content_per5' => 'Content Per5',
            'content_per6' => 'Content Per6',
            'content_per7' => 'Content Per7',
            'content_per8' => 'Content Per8',
            'content_per9' => 'Content Per9',
            'content_per10' => 'Content Per10',
            'comment' => 'Comment',
            'sum' => 'Sum',
            'create_time' => 'Create Time',
            'update_time' => 'Update Time',
            'is_del' => 'Is Del',
        ];
    }
}
