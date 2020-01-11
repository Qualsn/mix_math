<?php


namespace app\controllers\ajax;


use app\controllers\BaseController;
use app\models\CreateTab;
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

    public function actionHadCreate()
    {
        $post = \Yii::$app->request->post();
        $query = CreateTab::find()->select(['id','title','host','tab_num','status'])->where($post)->orderBy('id desc')->asArray()->all();
        return $this->outputList($query);
    }

    /**
     * 获取user信息
     * @return false|string
     */
    public function actionUserMessage()
    {
        $post = \Yii::$app->request->post();
        $query = Users::find()->where($post)->asArray()->one();

        return $this->outputList($query);
    }

    public function actionEditUser()
    {
        $post = \Yii::$app->request->post();
        $post['update_time'] = time();

        $query = \Yii::$app->db->createCommand()->update(Users::tableName(),$post,['open_id'=>$post['open_id']])->execute();

        if ($query){
            return $this->outputRows('success');
        }else{
            return $this->outputRows('fail');
        }
    }
}