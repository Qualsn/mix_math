<?php


namespace app\controllers\ajax;


use app\controllers\BaseController;
use app\models\MathRecord;
use app\models\searchs\CreateTab;
use app\models\Team;

class RecordResultAjaxController extends BaseAjaxController
{

    public function actionResult()
    {
        $post = \Yii::$app->request->post();
        $userId = $post['user_id'];
//        $userId = 'oK3uf4jLAMJArIyZG8fmuv10V81k';
        $where = [
            'and',
            ['user_id' =>$userId],
            ['status' => 2]
        ];
        $list = CreateTab::find()->select(['id','title','host','update_time'])
            ->where($where)
            ->orderBy('id desc')
            ->asArray()->all();
        $arrList = [];
        foreach ($list as $item) {
            $item['update_time'] = date("Y-m-d",$item['update_time']);
            $arrList[] = $item;
        }
        return $this->outputList($arrList);
    }

    public function actionResultTeam()
    {
        $post = \Yii::$app->request->post();
        $fields = [
            'mr.id',
            't.team_name',
            't.member',
            'avg_count'
        ];
        $list = MathRecord::find()
            ->select($fields)
            ->from(['mr' => MathRecord::tableName()])
            ->leftJoin(Team::tableName() . " as t", "t.id=mr.team_id")
            ->where(['mr.create_tab_id' => $post['create_tab_id']])
            ->orderBy('avg_count desc')
            ->asArray()
            ->all();
//        echo "<pre>";
//        var_dump($list);die();
        return $this->outputList($list);
    }

}