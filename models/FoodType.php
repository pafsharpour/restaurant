<?php

namespace app\models;

use yii\base\Model;
use yii\data\ActiveDataProvider;
use yii\db\ActiveRecord;
use  yii\web\Session;
use app\models\DeleteFailException;
//home


class FoodType extends ActiveRecord
{

    public static function tableName()
    {
        return 'foodtype';
    }

    public function rules(): array
    {
        //  dd($this->order_count);

        return [
            ['count', 'integer'],
            ['type', 'required'],
            ['count', 'compare', 'compareValue' => 0, 'operator' => '>='],
            ['type', 'unique', 'when' => function ($model) {
                return (FoodType::find()
                    ->where(['=', 'type', $this->type])->one()) != null
                    && (FoodType::find()->where(['=', 'type', $this->type])->one())->id != $this->id;
            }],
        ];
    }



    //home
    public function getFood()
    {
       // return $this->hasMany(Foods::className(), ['type' => 'type'])->viaTable('UserCar', ['user_id' => 'id']);
       // return $this->hasMany(User::className(), ['id' => 'user_id'])->viaTable('UserCar', ['car_id' => 'id']);

    }
}
