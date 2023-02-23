<?php

namespace app\controllers;

use Yii;
use yii\web\Controller;
use app\models\Foods;
use app\models\Branches;
use app\models\FoodType;
use yii\helpers\ArrayHelper; // load classes

use app\models\FoodsSearch;
use yii\data\ActiveDataProvider;



class FoodsController extends Controller
{

    public function actionIndex()
    {
        $foodSearch = new FoodsSearch();
        return $this->render('index', [
            'dataProvider' => $foodSearch->search(Yii::$app->request->queryParams),
            'searchModel' => $foodSearch
        ]);
    }

   public function actionInsert()
    {
        $food = new Foods();
        $typeItems = ArrayHelper::map(FoodType::find()->all(), 'type', 'type');
        $branchsItems = ArrayHelper::map(Branches::find()->all(), 'name', 'name');
        if ($food->load(Yii::$app->request->post()) && $food->validate()) {
            $data = Yii::$app->request->post();
            $food->name = $data["Foods"]['name'];
            $food->type = $data["Foods"]['type'];
            $food->branch = $data["Foods"]['branch'];
            $food->orderable = $data["Foods"]['orderable'];

            if ($food->save()) {
                Yii::$app->session->set('result', 'successfull!');
                return $this->response->redirect(['foods/index']);
            }
        } else {
            return $this->render('insert', ['model' => $food, 'typeitems' => $typeItems,  'branchitems' => $branchsItems]);

        }
    }

    

    
    public function actionUpdate($id)
    {
        $newValue = new foods();
        $newValue->id = $id;
        $typeItems = ArrayHelper::map(FoodType::find()->all(), 'type', 'type');
        $branchsItems = ArrayHelper::map(Branches::find()->all(), 'name', 'name');

        $food =  Foods::findOne($id);
        $food->scenario = "update";
        if ($food->load(Yii::$app->request->post()) && $food->validate()) {
            $data = Yii::$app->request->post();
            $food->name = $data["Foods"]['name'];
            $food->type = $data["Foods"]['type'];
            $food->branch = $data["Foods"]['branch'];
            $food->orderable = $data["Foods"]['orderable'];

            if ($food->save()) {
                Yii::$app->session->set('result', 'successfull!');
                return $this->response->redirect(['foods/index']); 
            }
            Yii::$app->session->set('result', 'feild!');
        } else {
            return $this->render('update', ['model' => $food, 'typeitems' => $typeItems,  'branchitems' => $branchsItems]);
        }
    }
    
    public function actionDelete($id)
    {
        $food =  Foods::findOne($id) ?? null;
        if ($food != null && $food->ordered == 0) {
            $food->delete();
            Yii::$app->session->set('result', 'successfull!');
            return $this->response->redirect(['foods/index']);
        } else {
            Yii::$app->session->set('result', 'failed!');
            return $this->actionIndex();
        }
    } 
}
