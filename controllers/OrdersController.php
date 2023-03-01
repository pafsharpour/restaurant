<?php

namespace app\controllers;


use Yii;
use yii\web\Controller;
use app\models\Orders;
use app\models\Customer;

use app\models\OrdersSearch;
use yii\data\ActiveDataProvider;
use yii\helpers\ArrayHelper; // load classes
use app\models\Branches;
use app\models\Foods;
use yii\web\Response;
use yii\helpers\Json;





class OrdersController extends Controller
{

    public function actionIndex()
    {
        $orderSearch = new OrdersSearch();
        return $this->render('index', [
            'dataProvider' => $orderSearch->search(Yii::$app->request->queryParams),
            'searchModel' => $orderSearch
        ]);
    }

     public function actionInsert()
    {
        $model = new Orders();
        $model->orderNumber = join(array('ORD',$model->getid()));
       $Customeritems = ArrayHelper::map(Customer::find()->all(), 'name', 'name');
       $Branchesitems = ArrayHelper::map(Branches::find()->all(), 'name', 'name');
         if ($model->load(Yii::$app->request->post()) && $model->validate()) {
            $data = Yii::$app->request->post();
            $model->customer = $data["Orders"]['customer'];
            $model->foods = $data["Orders"]['foods'];
            $model->foodType = $data["Orders"]['foodType'];
            $model->branch = $data["Orders"]['branch'];


            
                $transaction = Yii::$app->db->beginTransaction();
                try {
                    $branch = Branches:: find()->where(['name'=>$model->branch])->one();
                    $branch->order_count += 1;
                    $branch->save();
    
                    $food = Foods:: find()->where(['id'=>$model->foods])->one();
                    $food->ordered += 1; 
                    $food->save();
 
                    
                    $model->save();
                    $transaction->commit();
                    Yii::$app->session->set('result', 'successfull!');
                    return $this->response->redirect(['orders/index']);
                } catch (Exception $e) {
                    $transaction->rollBack();
                    return $this->render('insert', ['model' => $model, 'Customer'=>$Customeritems]);
                }
            
            
        } 
        return $this->render('insert', ['model' => $model,'Customer'=>$Customeritems]);

    }




    public function actionView($id)
    {
        $orders =  Orders::findOne($id);
        return $this->render('view',  ['model' => $orders]);
        }



    public function actionDelete($id)
    {
        $order =  Orders::findOne($id) ?? null;
        if ($order != null) {
            $transaction = Yii::$app->db->beginTransaction();
            try {
                $branch = Branches:: find()->where(['name'=>$order->branch])->one();
                $branch->order_count -= 1;
                $branch->save();


                $food = Foods:: find()->where(['id'=>$order->foods])->one();
                $food->ordered -= 1;
                $food->save();


                $order->delete();

                $transaction->commit();

            } catch (Exception $e) {
                $transaction->rollBack();
            }
            Yii::$app->session->set('result', 'successfull!');
            return $this->response->redirect(['orders/index']);
        } else {
            Yii::$app->session->set('result', 'failed!');
            return $this->actionIndex();
        }
    }
    
    public function actionFoods() {
        $out = [];
        if (isset($_POST['depdrop_parents'])) {
            $parents = $_POST['depdrop_parents'];
            if ($parents != null) {
                $cat_id = $parents[0];
                $out = Foods::getFoods($cat_id);
                $_SESSION['a'] = $out;

                echo Json::encode($out);
                return;
            }
        }
        echo Json::encode(['output'=>'', 'selected'=>'']);
        }
    
    public function actionTypes() {
            $out = [];
            if (isset($_POST['depdrop_parents'])) {
                $_SESSION['a'] = $_POST['depdrop_parents'];
                $parents = $_POST['depdrop_parents'];
                if ($parents != null) {
                    $cat_id = $parents[0];
                    $out = Foods::getFoodType($cat_id);
                    $_SESSION['a'] = $out;
    
                    echo Json::encode($out);
                    return;
                }
            }
            echo Json::encode(['output'=>'', 'selected'=>'']);
            }


            public function actionInsert2()
            {
                $model = new Orders();
                $model->orderNumber = join(array('ORD',$model->getid()));
               $Customeritems = ArrayHelper::map(Customer::find()->all(), 'name', 'name');
               $Branchesitems = ArrayHelper::map(Branches::find()->all(), 'name', 'name');
                 if ($model->load(Yii::$app->request->post()) && $model->validate()) {
                    $data = Yii::$app->request->post();
                    $model->customer = $data["Orders"]['customer'];
                    $model->foods = $data["Orders"]['foods'];
                    $model->foodType = $data["Orders"]['foodType'];
                    $model->branch = $data["Orders"]['branch'];
        
        
                    
                        $transaction = Yii::$app->db->beginTransaction();
                        try {
                            $branch = Branches:: find()->where(['name'=>$model->branch])->one();
                            $branch->order_count += 1;
                            $branch->save();
            
                            $food = Foods:: find()->where(['id'=>$model->foods])->one();
                            $food->ordered += 1; 
                            $food->save();
         
                            
                            $model->save();
                            $transaction->commit();
                            Yii::$app->session->set('result', 'successfull!');
                            return $this->response->redirect(['orders/index']);
                        } catch (Exception $e) {
                            $transaction->rollBack();
                            return $this->render('insert2', ['model' => $model, 'Customer'=>$Customeritems]);
                        }
                    
                    
                } 
                return $this->render('insert2', ['model' => $model,'Customer'=>$Customeritems]);
        
            }


          

        
} 
