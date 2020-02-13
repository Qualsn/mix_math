<?php


namespace app\controllers;


use app\models\LoginForm;
use yii\web\Controller;

class BaseController extends Controller
{
    public function __construct($id,$module,$config=[])
    {
        parent::__construct($id,$module,$config=[]);
        $session = \Yii::$app->session;
        $url = 'http://mixmath.com/index.php?r=site%2Flogin';
        $toUrl ='http://mixmath.com/index.php?' .\Yii::$app->getRequest()->queryString;
        if (\Yii::$app->user->isGuest && $url != $toUrl){
            $url = 'http://mixmath.com/index.php?r=site%2Flogin';
            return $this->redirectLogin($url);
        }else{

        }

    }

    public function redirectLogin($url)
    {
        header("Location: {$url}");exit();
    }

    /**成功信息回调
     * @param array $output
     * @return false|string
     */
    public function outputList($output = []){
        $arr = [
            'code' => 200,
            'msg' => 'success',
            'data'=> $output,
        ];
        return json_encode($arr,JSON_UNESCAPED_LINE_TERMINATORS);
    }

    public function outputRows($msg = '',$content = '')
    {
        $arr = [
            'code' => '',
            'msg' =>$msg,
            'content' => $content,
        ];
        if ($msg == 'success'){
            $arr['code'] = 200;
        }else{
            $arr['code'] = 1000;
        }

        return json_encode($arr,JSON_UNESCAPED_LINE_TERMINATORS);
    }

    /**
     * 回调失败
     * @param array $output
     * @return false|string
     */
    public function outputError($output = [])
    {
        $arr = [
            'code' => 1000,
            'msg' => 'fail',
            'data'=> '错误',
            'content' => $output,
        ];
        return json_encode($arr,JSON_UNESCAPED_LINE_TERMINATORS);
    }
}