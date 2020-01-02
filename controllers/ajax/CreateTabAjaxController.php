<?php


namespace app\controllers\ajax;


use app\controllers\BaseController;
use app\models\CreateTab;
use app\models\Team;

class CreateTabAjaxController extends BaseController
{

    static $i = 0;
    /**
     * 创建评分表接口
     * @return false|string
     * @throws \yii\db\Exception
     */
    public function actionCreateTab()
    {
        $model = new CreateTab();
        $post = \Yii::$app->request->post();
        $data = [
          'title' =>  $post['title'],
            'host' => $post['host'],
            'address' => $post['address'],
            'tab_num' => $post['num_tab'],
            'create_time' => time(),
            'user_id' => $post['open_id'],
        ];
        for($i = 1; $i<=10; $i++){
            $percent = 'percent' . $i;
            $contentPer = 'content_per' . $i;
            $content = 'content' . $i;
            if (isset($post[$percent])){
                $data[$contentPer] =  $post[$content] . ',' . $post[$percent] ;
            }
        }
        if ($post['id'] == 0){
            $result = \Yii::$app->db->createCommand()->insert(CreateTab::tableName(),$data)->execute();
        }else{
            $result = \Yii::$app->db->createCommand()->update(CreateTab::tableName(),$data,['id' => $post['id']])->execute();
        }

        $id=\Yii::$app->db->getLastInsertID();
        if ($result){
            $tabID = ['tab_id' =>  $id];
            return $this->outputList($tabID);
        }else{
            return $this->outputRows('fail');
        }
    }

    /**
     * 主页显示表
     * @return false|string、
     */
    public function actionMainIndex()
    {
        $list = CreateTab::find()->select(['id','title','host'])->orderBy('id desc')->asArray()->all();
        return $this->outputList($list);
    }


    public function actionCreateMain()
    {
        $post = \Yii::$app->request->post();
        $id = $post['id'];
//        $id = 15;
        $list = CreateTab::find()->where(['id' => $id])->asArray()->one();
        $result = [];
        $content = "content";
        $percent = "percent";
        foreach ($list as $k => $item) {
            if (preg_match("/(content_per+)/",$k)){
                $contentPer = explode(',',$item);
                if (isset($contentPer[1])){
                    ++self::$i;
                    $result[$content . self::$i] = $contentPer[0];
                    $result[$percent . self::$i] = $contentPer[1];

                }
            }else{
                $result[$k] = $item;
            }
        }
        $result['content_len'] = self::$i;

        return $this->outputList($result);
    }

    public function actionAddTeam()
    {
        $post = \Yii::$app->request->post();
        $model = new Team();
        $tabId = $post['math_num'];
        $data = [];
        for($i = 1; $i<=10; $i++){
            $teamName = 'team_name' . $i;
            $member = 'team_member' . $i;
            if (isset($post[$teamName])){
                $data[self::$i] = ['create_tab_id' => $tabId,'team_name' => $post[$teamName],'member' => $post[$member],'create_time' => time()];
                self::$i++;
            }
        }
        $result = \Yii::$app->db->createCommand()->batchInsert(Team::tableName(),['create_tab_id','team_name','member',  'create_time'],$data)->execute();

        return $this->outputList($result);
    }

}