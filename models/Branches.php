<?php

namespace app\models;

use yii\base\Model;
use yii\data\ActiveDataProvider;
use yii\db\ActiveRecord;
use  yii\web\Session;
use app\models\DeleteFailException;
//home


class Branches extends ActiveRecord
{
    const SCENARIO_UPDATE = 'update';

    public function scenarios(): array
    {
        $scenarios = parent::scenarios();
        $scenarios[self::SCENARIO_UPDATE] = ['id', 'name', 'max_order_count','address'];

        return $scenarios;
    }
    public static function tableName()
    {
        return 'branches';
    }

    public function rules(): array
    {
        //  dd($this->order_count);

        return [
            [['max_order_count', 'order_count'], 'integer'],
            [['name', 'max_order_count', 'address'], 'required'],
            ['max_order_count', 'compare', 'compareValue' => 0, 'operator' => '>='],

            ['max_order_count', 'compare', 'compareValue' => $this->order_count,
            'operator' => '>=','on' => self::SCENARIO_UPDATE],

            //['order_count', 'compare', 'compareValue' => $this->max_order_count, 'operator' => '<='],

            ['name', 'unique', 'when' => function ($model) {
                return (Branches::find()
                    ->where(['=', 'name', $this->name])->one()) != null
                    && (Branches::find()->where(['=', 'name', $this->name])->one())->id != $this->id;
            }],
        ];
    }


   
    //home
    public function getCar()
    {
        //return $this->hasMany(Car::className(), ['id' => 'car_id'])->viaTable('UserCar', ['user_id' => 'id']);
    }
}
