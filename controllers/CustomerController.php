<?php

namespace app\controllers;

use Yii;
use yii\web\Controller;
use app\models\Customer;
use app\models\CustomerSearch;
use yii\data\ActiveDataProvider;



class CustomerController extends Controller
{

    public function actionIndex()
    {
        $userSearch = new CustomerSearch();
        return $this->render('index', [
            'dataProvider' => $userSearch->search(Yii::$app->request->queryParams),
            'searchModel' => $userSearch
        ]);
    }

   public function actionInsert()
    {
        $customer = new Customer();
        if ($customer->load(Yii::$app->request->post()) && $customer->validate()) {
            $data = Yii::$app->request->post();
            $customer->name = $data["Customer"]['name'];
            $customer->lastname = $data["Customer"]['lastname'];
            $customer->email = $data["Customer"]['email'];
            $customer->nationalCode = $data["Customer"]['nationalCode'];
            $customer->address = $data["Customer"]['address'];

            if ($customer->save()) {
                Yii::$app->session->set('result', 'successfull!');
                return $this->response->redirect(['customer/index']);
            }
        } else {
            return $this->render('insert', ['user' => $customer]);
        }
    }

    
    public function actionUpdate($id)
    {
        $newValue = new Customer();
        $newValue->id = $id;
        $customer =  Customer::findOne($id);
        if ($customer->load(Yii::$app->request->post()) && $customer->validate()) {
            $data = Yii::$app->request->post();
            $customer->name = $data["Customer"]['name'];
            $customer->lastname = $data["Customer"]['lastname'];
            $customer->email = $data["Customer"]['email'];
            $customer->nationalCode = $data["Customer"]['nationalCode'];
            $customer->address = $data["Customer"]['address'];

            if ($customer->save()) {
                Yii::$app->session->set('result', 'successfull!');
                return $this->response->redirect(['customer/index']);
            }
            Yii::$app->session->set('result', 'feild!');
        } else {
            return $this->render('update',  ['user' => $customer]);
        }
    }

    /*
    public function actionDelete($id)
    {
        $user =  User::findOne($id) ?? null;
        if ($user != null) {
            $user->delete();
            Yii::$app->session->set('result', 'successfull!');
            return $this->response->redirect(['user/index']);
        } else {
            Yii::$app->session->set('result', 'failed!');
            return $this->actionIndex();
        }
    } */
}
