<?php


namespace app\controllers\ajax;


use app\controllers\BaseController;
use app\models\Team;

class TeamAjaxController extends BaseAjaxController
{
    public function actionShowTeam()
    {
        $post = \Yii::$app->request->post();

        $list =Team::find()->select(['id','team_name', 'member', 'create_tab_id'])->where(['create_tab_id' => $post['id']])->asArray()->all();

        return $this->outputList($list);
    }
}