<?php

namespace app\models;

use yii\base\Model;
use yii\data\ActiveDataProvider;
use yii\db\ActiveRecord;
use  yii\web\Session;
use app\models\DeleteFailException;
//home


class Orders extends ActiveRecord
{
  /*   const SCENARIO_UPDATE = 'update';

    public function scenarios(): array
    {
        $scenarios = parent::scenarios();
        $scenarios[self::SCENARIO_UPDATE] = ['id', 'name', 'max_order_count','address'];

        return $scenarios;
    } */
    public static function tableName()
    {
        return 'orders';
    }

    public function rules(): array
    {
        //  dd($this->order_count);

        return [
            [['branch', 'foodType','foods','customer'],'required'],
        ];
    }


   public function getid() 
   {
    $max = (new \yii\db\Query())
    ->from('orders')
    ->max('id');
        if ($max == null){
            return 0;
        }
        return $max+1; 
   }

   
    //home
    public function getFoods()
    {
        return $this->hasOne(Foods::class, ['name' => 'foods']);
    }
    public function getType()
    {
        return $this->hasOne(Foods::class, ['type' => 'foodType']);
    }
}
