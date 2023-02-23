<?php

namespace app\controllers;

use Yii;
use yii\web\Controller;
use app\models\FoodType;
use app\models\foodtypeSearch;
use yii\data\ActiveDataProvider;



class FoodtypeController extends Controller
{

    public function actionIndex()
    {
        $foodTypeSearch = new foodtypeSearch();
        return $this->render('index', [
            'dataProvider' => $foodTypeSearch->search(Yii::$app->request->queryParams),
            'searchModel' => $foodTypeSearch
        ]);
    }

    public function actionInsert()
    {
        $food = new FoodType();
        if ($food->load(Yii::$app->request->post()) && $food->validate()) {
            $data = Yii::$app->request->post();
            $food->type = $data["FoodType"]['type'];

            if ($food->save()) {
                Yii::$app->session->set('result', 'successfull!');
                return $this->response->redirect(['foodtype/index']);
            }
        } else {
            return $this->render('insert', ['user' => $food]);
        }
    } 


    public function actionUpdate($id)
    {
        $newValue = new FoodType();
        $newValue->id = $id;
        $branch =  FoodType::findOne($id);
        if ($branch->load(Yii::$app->request->post()) && $branch->validate()) {
            $data = Yii::$app->request->post();
            $branch->type = $data["FoodType"]['type'];

            if ($branch->save()) {
                Yii::$app->session->set('result', 'successfull!');
                return $this->response->redirect(['foodtype/index']);
            }
            Yii::$app->session->set('result', 'feild!');
        } else {
            return $this->render('update',  ['user' => $branch]);
        }
    }

    

    public function actionDelete($id)
    {
        $foodtype =  FoodType::findOne($id) ?? null;
        if ($foodtype != null && $foodtype->count == 0) {
            $foodtype->delete();
            Yii::$app->session->set('result', 'successfull!');
            return $this->response->redirect(['foodtype/index']);
        } else {
            Yii::$app->session->set('result', 'failed!');
            return $this->actionIndex();
        }
    } 
}

