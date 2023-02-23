<?php
namespace app\models;

use app\models\Foods;
use yii\base\Model;
use yii\data\ActiveDataProvider;
use yii\db\ActiveRecord;
// <?= Yii::$app->session->getFlash('error'); 


class FoodsSearch extends Foods
{
    public function rules(): array
    {
        return [
            [['name', 'type',  'branch', 'orderable','id' ,'ordered'], 'safe'],
        ];
    }

    public function search(array $params): ActiveDataProvider {
        $this->load($params);
        //dd($this->address);
        $query = Foods::find()->orderBy($this->name);
        $query->andFilterWhere(['like', 'foods.name', $this->name]);
        $query->andFilterWhere(['like', 'foods.type', $this->type]);
        $query->andFilterWhere(['like', 'foods.branch', $this->branch]);
        $query->andFilterWhere(['foods.orderable' => $this->orderable]);
        $query->andFilterWhere(['foods.ordered' => $this->ordered]);
        $query->andFilterWhere(['branches.id' => $this->id]);
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
