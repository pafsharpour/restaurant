<?php
namespace app\models;

use app\models\FoodType;
use yii\base\Model;
use yii\data\ActiveDataProvider;
use yii\db\ActiveRecord;
// <?= Yii::$app->session->getFlash('error'); 


class foodtypeSearch extends FoodType
{
    public function rules(): array
    {
        return [
            [['count', 'type'], 'safe'],
        ];
    }

    public function search(array $params): ActiveDataProvider {
        $this->load($params);
        $query = FoodType::find()->orderBy($this->type);
        $query->andFilterWhere(['like', 'foodtype.type', $this->type]);
        $query->andFilterWhere(['foodtype.count' => $this->count]);
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
