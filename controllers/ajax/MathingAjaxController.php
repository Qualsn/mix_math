<?php


namespace app\controllers\ajax;


use app\controllers\BaseController;
use app\models\CreateTab;
use app\models\Team;

class MathingAjaxController extends BaseController
{
    static $i = 0;
    //比赛验证
    public function actionRule()
    {
        $post = \Yii::$app->request->post();
        $result = CreateTab::find()->select(['id'])->where($post)->asArray()->one();
        if ($result){
            return $this->outputRows('success',$result);
        }else{
            return $this->outputError('验证码错误');
        }

    }

    public function actionMathMessage()
    {
        $post = \Yii::$app->request->post();
        $id = $post['id'];
        $tab = CreateTab::find()->where(['id' => $id])->asArray()->one();
        $team = Team::find()->select(['id','team_name','member'])->where(['create_tab_id' => $id])->asArray()->all();
        $result = [];
        $contents = [];
        $content = "content";
        $percent = "percent";
        foreach ($tab as $k => $item) {
            if (preg_match("/(content_per+)/",$k)){
                $contentPer = explode(',',$item);
                if (isset($contentPer[1])){
//                    $contents[$content . self::$i] = $contentPer[0];
//                    $percents[$percent . self::$i] = $contentPer[1];
                    array_push($contents,[$content . self::$i => $contentPer[0], $percent . self::$i=> $contentPer[1]]);
                    self::$i++;

                }
            }else{
                $result[$k] = $item;
            }
        }

        $rel = [
            'content' => $contents,
            'table' => $result,
            'team' => $team
        ];
        if ($team && $tab){
            return $this->outputList($rel);
        }else{
            return $this->outputError();
        }
    }
}