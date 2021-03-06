<?php


namespace app\controllers\ajax;


use app\controllers\BaseController;
use app\models\CreateTab;
use app\models\MathRecord;
use app\models\Team;
use app\models\UserTab;

class MathingAjaxController extends BaseAjaxController
{
    static $i = 0;
    static $v = 0;


    const MATH_DEFAULT = 0;
    const MATH_START = 1;
    const MATH_END = 2;

    /**比赛验证
     * @return false|string
     */
    public function actionRule()
    {
        $post = \Yii::$app->request->post();


        $result = CreateTab::find()->select(['id'])->where($post)->asArray()->one();
        if ($result){
            return $this->outputRows('success',$result);
        }else{
            return $this->outputError('验证码错误');
        }

        $status = $this->getStatus($post);
        if ($status['status'] == self::MATH_DEFAULT){
            return $this->outputRows('fail','比赛还没开始');
        }elseif ($status['status'] == self::MATH_END){
            return $this->outputRows('fail','比赛已经结束');
        }

    }

    /**
     * 获取比赛表信息
     * @return false|string
     */
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
        }elseif (!$tab){
            return $this->outputRows('fail','该比赛还没开始');
        } else{
            return $this->outputError();
        }
    }

    /**
     * 比赛计分
     * @return false|string
     * @throws \yii\db\Exception
     */
    public function actionMathRecord()
    {
        $post = \Yii::$app->request->post();

        $sore = [];
        $data = [
            'user_id' =>$post['user_id'],
            'create_tab_id' => $post['tab_id'],
            'team_id' => $post['team_id'],
            'create_time' => time(),
            'evaluate' => $post['evaluate']
        ];
        foreach ($post as $v => $item) {
            if (preg_match("/(score+)/", $v)){
                ++self::$i;
                $sore['score' . self::$i] = $item;
                $data['score' . self::$i] = $item;
                if ( $data['score' . self::$i] > 100){
                    return $this->outputRows('number','每项不能超过100分');
                }elseif (!is_numeric($data['score' . self::$i])){
                    return $this->outputRows('number','分数必须为数字');
                }
            }
        }
        $varCount = $this->getPercent($post,$sore);
        $data['var_count'] = $varCount;

        $where = [
            'user_id' =>$post['user_id'],
            'create_tab_id' => $post['tab_id'],
            'team_id' => $post['team_id'],
        ];
        $isRel = UserTab::find()->where($where)->asArray()->one();
        if ($isRel){
            return $this->outputRows('warning','你已经评论过该队伍');
        }

        $result = \Yii::$app->db->createCommand()->insert(UserTab::tableName(),$data)->execute();
        if ($result){
            return $this->outputRows('success');
        }else{
            return $this->outputError('评分失败！');
        }
//        return $this->outputList($data);

    }
//获取百分比
    public function getPercent($post,$sore)
    {

        $percent = CreateTab::find()->where(['id' => $post['tab_id']])->asArray()->one();
        $per = [];
        foreach ($percent as $i => $item) {
            if (preg_match("/(content_per+)/", $i) && $item != ''){
                ++self::$v;
                $val = explode(',',$item);
                $per['percent'.self::$v] = $val[1];
            }
        }
        $record = 0;
        for ($k=1;$k<self::$v;$k++){
            $record = $record + (number_format($per['percent'.$k]*$sore['score'.$k]/100,2));
        }

        return $record;
    }

    /**
     * 开始比赛
     * @return false|string
     * @throws \yii\db\Exception
     */
    public function actionStart()
    {
        $post = \Yii::$app->request->post();

        $isTeam = $this->getTeam($post);
        if (!$isTeam){
            return $this->outputRows('fail',3);
        }
        $status = $this->getStatus($post);
        if ($status['status'] != self::MATH_END){
            $query = \Yii::$app->db->createCommand()->update(CreateTab::tableName(),['status' => self::MATH_START,'update_time' => time()],$post)->execute();
            if ($query){
                return $this->outputRows('success',1);
            }else{
                return $this->outputRows('fail',0);
            }
        }else{
            return $this->outputRows('success',2);
        }

    }

    public function getTeam($post)
    {
        return Team::find()->where(['create_tab_id' => $post])->asArray()->all();
    }

    /**
     * 结束比赛
     * @return false|string
     * @throws \yii\db\Exception
     */
    public function actionEnd()
    {
        $post = \Yii::$app->request->post();

        $status = $this->getStatus($post);
        if ($status['status'] == self::MATH_START){
            $list = UserTab::find()->select([ 'team_id', 'create_tab_id', 'avg(var_count)  as avg_count'])
                ->where(['create_tab_id' => $post['id']])->groupBy('team_id')
                ->asArray()->all();
            $countList =[];
            $time = time();
            foreach ($list as $i => $item) {
                $item['create_time'] = $time;
                $countList[] = $item;
            }
            $query = \Yii::$app->db->createCommand()->update(CreateTab::tableName(),['status' => self::MATH_END,'update_time' => time()],$post)->execute();

            $result = \Yii::$app->db->createCommand()->batchInsert(MathRecord::tableName(),[ 'team_id', 'create_tab_id', 'avg_count', 'create_time'],$countList)->execute();

            if ($query && $result){
                return $this->outputRows('success',1);
            }else{
                return $this->outputRows('fail',0);
            }
        }else{
            return $this->outputRows('success',2);
        }
    }

    public function getStatus($post)
    {
        $status = CreateTab::find()->select(['status'])->where($post)->asArray()->one();
        return $status;
    }

    /**
     * 评分列表
     * @return false|string
     */
    public function actionScoreList()
    {
        $post = \Yii::$app->request->post();
        $userId = $post['id'];
        $query = UserTab::find()->from(UserTab::tableName() . " as ut")
            ->select(['ct.id','ct.title','ct.status'])
            ->leftJoin(CreateTab::tableName() . ' as ct' , "ct.id=create_tab_id")
            ->where(['ut.user_id' => $userId])
            ->distinct(['ut.user_id','create_tab_id'])->orderBy('ct.id desc')
            ->asArray()->all();
        $list = [];
        foreach ($query as $value){
            if ($value['status'] == 2){
                $value['background'] = 'rgba(248, 63, 63, 0.707)';
            }else{
                $value['background'] = 'rgba(77, 166, 225, 0.33)';
            }
            $list[] = $value;
        }
        return $this->outputList($list);
    }

    public function actionScoreShow()
    {
        $post = \Yii::$app->request->post();
        $createTabSearch = new \app\models\searchs\CreateTab();
        $where = [
          'u.user_id' => $post['user_id'] ,
            'u.create_tab_id' => $post['create_tab_id']
        ];
//        $where = [
//            'u.user_id' => 'oK3uf4jLAMJArIyZG8fmuv10V81k' ,
//            'u.create_tab_id' => 19
//        ];
        $fields = [
            'u.create_tab_id', 'ct.title','u.team_id','team_name',
            'score1','score2','score3','score4','score5','score6','score7','score8','score9','score10',
            'content_per1','content_per2','content_per3','content_per4','content_per5','content_per6','content_per7','content_per8','content_per9','content_per10',
            'var_count','u.evaluate'
        ];
        $query = UserTab::find()->from(['u' => UserTab::tableName()])->select($fields)
            ->leftJoin(CreateTab::tableName() . ' as ct', 'ct.id=u.create_tab_id')
            ->leftJoin(Team::tableName() . ' as t', 't.id= u.team_id')
            ->where($where)
            ->orderBy('u.id')
            ->asArray()->all();
        $result = $createTabSearch->getContentPercent($query);
//echo "<pre>";
//var_dump($result);die();
        return $this->outputList($result);
    }
}