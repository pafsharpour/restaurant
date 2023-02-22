<?php

namespace app\controllers;

use Yii;
use yii\web\Controller;
use app\models\Branches;
use app\models\BranchesSearch;
use yii\data\ActiveDataProvider;



class BranchesController extends Controller
{

    public function actionIndex()
    {
        $branchesSearch = new BranchesSearch();
        return $this->render('index', [
            'dataProvider' => $branchesSearch->search(Yii::$app->request->queryParams),
            'searchModel' => $branchesSearch
        ]);
    }

    public function actionInsert()
    {
        $branch = new Branches();
        if ($branch->load(Yii::$app->request->post()) && $branch->validate()) {
            $data = Yii::$app->request->post();
            $branch->name = $data["Branches"]['name'];
            $branch->address = $data["Branches"]['address'];
            $branch->max_order_count = $data["Branches"]['max_order_count'];

            if ($branch->save()) {
                Yii::$app->session->set('result', 'successfull!');
                return $this->response->redirect(['branches/index']);
            }
        } else {
            return $this->render('insert', ['user' => $branch]);
        }
    }


    public function actionUpdate($id)
    {
        $newValue = new Branches();
        $newValue->id = $id;
        $branch =  Branches::findOne($id);
        $branch->scenario = "update";
        if ($branch->load(Yii::$app->request->post()) && $branch->validate()) {
            $data = Yii::$app->request->post();
            $branch->name = $data["Branches"]['name'];
            $branch->address = $data["Branches"]['address'];
            $branch->max_order_count = $data["Branches"]['max_order_count'];

            if ($branch->save()) {
                Yii::$app->session->set('result', 'successfull!');
                return $this->response->redirect(['branches/index']);
            }
            Yii::$app->session->set('result', 'feild!');
        } else {
            return $this->render('update',  ['user' => $branch]);
        }
    }


    public function actionDelete($id)
    {
        $branch =  Branches::findOne($id) ?? null;
        if ($branch != null && $branch->order_count == 0) {
            $branch->delete();
            Yii::$app->session->set('result', 'successfull!');
            return $this->response->redirect(['branches/index']);
        } else {
            Yii::$app->session->set('result', 'failed!');
            return $this->actionIndex();
        }
    }
}
