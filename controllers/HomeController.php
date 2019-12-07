<?php


namespace app\controllers;


use app\models\Company;
use app\models\User;
use app\models\Users;
use yii\data\Pagination;
use yii\web\Controller;

class HomeController extends Controller
{
    public function actionIndex()
    {
        $query = Users::find()->where(['is_del' => '1'])->with('company');
        $pagination = new Pagination([
            'defaultPageSize' => 5,
            'totalCount' => $query->count(),
        ]);
        $user = $query->orderBy('name')
            ->offset($pagination->offset)
            ->limit($pagination->limit)->all();

        $data = [
            'user' => $user,
            'pagination' => $pagination
        ];
        return $this->renderPartial('index', $data);
    }

    //添加
    public function actionAdd()
    {
        $request = \Yii::$app->request;
        if ($request->isAjax) {
            $users = new Users();
//            $company_id=$_POST['company_id'];
//            $name = $_POST['name'];
            $company_id = $request->post("company_id");
            $name = $request->post('name');
            $company = Company::find()->asArray()->all();
            $rel = deep_in_array($company_id, $company);
            if ($rel) {
                $users->name = $name;
                $users->company_id = $rel;
                $result = $users->save();
                if ($result) {
                    return '添加成功';
                } else {
                    return '添加失败';
                }

            } else {
                $companys = new Company();
                $companys->cname = $company_id;
                $result_c = $companys->save();;
                $num = $companys->attributes['id'];
                $users->name = $name;
                $users->company_id = $num;
                $result_s = $users->save();

                if ($result_c && $result_s) {
                    return '添加成功';
                } else {
                    return '添加失败';
                }

            }

        } else {
            return $this->renderPartial('add');
        }

    }

    //修改
    public function actionUpd()
    {
        $request = \Yii::$app->request;
        if ($request->isAjax) {
            $name = $request->post('name');
            $cname = $request->post('company_id');
            $id = $request->post('id');

            $users = Users::findOne($id);
            $company = Company::find()->asArray()->all();
            $rel = deep_in_array($cname, $company);
            if ($rel) {
                $users->name = $name;
                $users->company_id = $rel;
                $result_a = $users->save();
                if ($result_a) {
                    return '修改成功';
                } else {
                    return '修改失败';
                }
            } else {
                $com = new Company();
                $com->cname = $cname;
                $com->save();
                $num = $com->attributes['id'];
                $users->name = $name;
                $users->company_id = $num;
                $result_b = $users->save();
                if ($result_b) {
                    return '修改成功';
                } else {
                    return '修改失败';
                }
            }
        } else {
            $id = $_GET['id'];
            $data = Users::find()->where(['id' => $id])->with('company')->asArray()->all();
//        var_dump($data[0]);
            return $this->renderPartial('upd', ['data' => $data[0]]);
        }

    }

    //删除
    public function actionDel()
    {
        $request = \Yii::$app->request;
        if ($request->isAjax) {
            $id = $_POST['id'];
            $users = Users::findOne($id);
            $users->is_del = '0';
            $result = $users->save();
            if ($result) {
                return '删除成功';
            }
            return '删除失败';
        }
    }


    public function actionAdds()
    {
        $request = $_POST;

        print_r($request);
        die();
        return $this->renderPartial('adds');
    }


}