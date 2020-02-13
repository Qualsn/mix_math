<?php


namespace app\controllers\ajax;


use app\controllers\BaseController;
use app\models\CreateTab;

class MainAjaxController extends BaseAjaxController
{

    /**
     * 主页显示表
     * @return false|string、
     */
    public function actionMainIndex()
    {
        $request = \Yii::$app->request;
        $query = CreateTab::find()->select(['id','title','host']);
        if ($request->isPost){
            $post = $request->post();
            $search = $post['search'];
            $where =[];
            if (is_numeric($search)){
                $where = ['id' => $search];
            }else{
                $where = ['like','title',$search];
            }


            if (empty($search)){
                $rel =  $query->orderBy('id desc')->asArray()->all();
            }else{
                $rel = $query->where($where)->orderBy('id desc')->asArray()->all();
            }
            return $this->outputList($rel);
        }

        $list = $query->orderBy('id desc')->asArray()->all();
        return $this->outputList($list);
    }
}