<?php
namespace app\models;

use app\models\Orders;
use yii\base\Model;
use yii\data\ActiveDataProvider;
use yii\db\ActiveRecord;
// <?= Yii::$app->session->getFlash('error'); 


class OrdersSearch extends Orders
{
    public function rules(): array
    {
        return [
            [['customer', 'branch', 'orderNumber','id' ,'foods'], 'safe'],
        ];
    }

    public function search(array $params): ActiveDataProvider {
        $this->load($params);
        //dd($this->address);
        $query = Orders::find();//->orderBy($this->orderNumber);
        $query->andFilterWhere(['like', 'orders.customer', $this->customer]);
        $query->andFilterWhere(['like', 'orders.address', $this->branch]);
        //$query->andFilterWhere(['orders.max_order_count' => $this->]);
        //$query->andFilterWhere(['orders.order_count' => $this->order_count]);
        $query->andFilterWhere(['orders.id' => $this->orderNumber]);
        $provider = new ActiveDataProvider([
            'query' => $query,
            'sort'=> [
                'attributes' => ['id',],
            ],
                
            'pagination' => [
                'pageSize' => 20,
            ],
        ]);
        return $provider;
    } 
}
