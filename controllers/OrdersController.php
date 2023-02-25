<?php

namespace app\controllers;

use Yii;
use yii\web\Controller;
use app\models\Orders;
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
        $orders = new Orders();
        $orders->orderNumber = join(array('ORD',$orders->getid()));
       //dd($orders);

       $Branchesitems = ArrayHelper::map(Branches::find()->all(), 'name', 'name');






       /*  if ($orders->load(Yii::$app->request->post()) && $orders->validate()) {
            $data = Yii::$app->request->post();
            $orders->OrderNumber = $data["Orders"]['name'];
            $orders->address = $data["Orders"]['address'];
            $orders->max_order_count = $data["Branches"]['max_order_count'];

            if ($orders->save()) {
                Yii::$app->session->set('result', 'successfull!');
                return $this->response->redirect(['orders/index']);
            }
        } else {
            return $this->render('insert', ['user' => $orders]);
        } */
        return $this->render('insert', ['model' => $orders]);
       // return $this->render('insert', ['orders' => $orders, 'branches'=>$Branchesitems, 'data'=>$this->actionCityList()]);

    }

/*
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
    */


  /*   public function actionCityList($q = null) {
        Yii::$app->response->format = \yii\web\Response::FORMAT_JSON;
        $out = ['results' => ['id' => '', 'name' => '']];
        if (!is_null($q)) {
            $query = new \yii\db\Query();
            $query->select('id, name')
                ->from('foods')
                ->where(['=', 'branch', $q])
                ->limit(100);
            $command = $query->createCommand();
            $data = $command->queryAll();
            $out['results'] = array_values($data);
        }
      /*   elseif ($id > 0) {
            $out['results'] = ['id' => $id, 'name' => Foods::find($id)->name];
        } 
        return $out;
    }  
     */

 
/*      public function actionFoods() {
        $out = [];
        dd('fuck');
        if (isset($_POST['depdrop_parents'])) {
        $parents = $_POST['depdrop_parents'];

        if ($parents != null) {
        $cat_name = $parents[0];
        $out = \app\models\Orders::getFoods($cat_name);
        dd('fg');
        echo Json::encode(['output'=>$out, 'selected'=>'']);
        return;
        }
        }
        echo Json::encode(['output'=>'', 'selected'=>'']);
        }
 */

        public function actionLists($name)
    {
        dd('gtgtgt');
        if ($name != null) {
            $ids = explode(",", $name);
            foreach ($ids as $name_branch) {
                $foods = Foods::GetFoods($name_branch);
                if (count($foods) > 0) {
                    foreach ($foods as $food) {
                        echo "<option value='" . $food . "'>" . $food . "</option>";
                    }
                } else {
                    echo "'<option>-</option>'";
                }
            }
        }
    }
 

    public function actionSubcat() {
        $out = [];
        if (isset($_POST['depdrop_parents'])) {
            $parents = $_POST['depdrop_parents'];
            if ($parents != null) {
                $cat_id = $parents[0];
                $out = Foods::getFoods($cat_id);
                echo Json::encode($out);
                return;
            }
        }
        echo Json::encode(['output'=>'', 'selected'=>'']);
        }
    
        public function actionProd() {
        $out = [];
        if (isset($_POST['depdrop_parents'])) {
            $parents = $_POST['depdrop_parents'];
            if ($parents != null) {
                    $cat_id = $parents[0];
                    $out = Foods::getFoodType($cat_id);
                    echo Json::encode($out); 
               echo Json::encode($out);
               //echo Json::encode(['output'=>$out, 'selected'=>$data['selected']]);
               return;
            }
        }
        echo Json::encode(['output'=>'', 'selected'=>'']);
    }
} 
