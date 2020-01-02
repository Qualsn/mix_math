<?php


namespace app\controllers\ajax;


use app\controllers\BaseController;
use app\models\User;
use app\models\Users;

class UserAjaxController extends BaseController
{
//判断登录与存储user
    public function actionUser()
    {
        $post = \Yii::$app->request->post();

        $openId = Users::find()->where(['open_id' => $post['open_id']])->asArray()->one();
        if (!empty($openId)){
            return $this->outputRows('success');
        }else{
            $post['create_time'] =time();
            $result = \Yii::$app->db->createCommand()->insert(Users::tableName(),$post)->execute();
            if ($result){
                return $this->outputRows('success');
            }else{
                return $this->outputRows('error');
            }
        }
    }

    public function actionGetUser()
    {
        $post = \Yii::$app->request->post();
        $list = Users::find()->where(['open_id' => $post['open_id']])->asArray()->one();
        $arr = [];
        foreach ($list as $i => $item) {
            if ($i == 'nick_name'){
                $arr['nickName'] = $item;
            }elseif ($i == 'open_id'){
                $arr['openId'] = $item;
            }elseif ($i == 'avatar_url'){
                $arr['avatarUrl'] = $item;
            } else{
                $arr[$i] = $item;
            }
        }
        return $this->outputList($arr);
    }
}