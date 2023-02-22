<?php
namespace app\models;

use app\models\Customer;
use yii\base\Model;
use yii\data\ActiveDataProvider;
use yii\db\ActiveRecord;
// <?= Yii::$app->session->getFlash('error'); 


class CustomerSearch extends Customer
{
    public function rules(): array
    {
        return [
            [['name', 'lastname', 'id','email' ,'address','nationalCode'], 'safe'],
        ];
    }

    public function search(array $params): ActiveDataProvider {
        $this->load($params);
        $query = Customer::find();//->orderBy($this->name);
        $query->andFilterWhere(['like', 'customer.name', $this->name]);
        $query->andFilterWhere(['like', 'customer.lastname', $this->lastname]);
        $query->andFilterWhere(['like', 'customer.email', $this->email]);
        $query->andFilterWhere(['like', 'customer.nationalCode', $this->nationalCode]);
        $query->andFilterWhere(['like', 'customer.address', $this->address]);
        $query->andFilterWhere(['customer.id' => $this->id]);
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
