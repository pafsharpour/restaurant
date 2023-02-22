<?php
namespace app\models;

use app\models\Branches;
use yii\base\Model;
use yii\data\ActiveDataProvider;
use yii\db\ActiveRecord;
// <?= Yii::$app->session->getFlash('error'); 


class BranchesSearch extends Branches
{
    public function rules(): array
    {
        return [
            [['name', 'address', 'max_order_count','id' ,'order_count'], 'safe'],
        ];
    }

    public function search(array $params): ActiveDataProvider {
        $this->load($params);
        //dd($this->address);
        $query = Branches::find()->orderBy($this->name);
        $query->andFilterWhere(['like', 'branches.name', $this->name]);
        $query->andFilterWhere(['like', 'branches.address', $this->address]);
        $query->andFilterWhere(['branches.max_order_count' => $this->max_order_count]);
        $query->andFilterWhere(['branches.order_count' => $this->order_count]);
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
