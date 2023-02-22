<?php

namespace app\models;

use yii\base\Model;
use yii\data\ActiveDataProvider;
use yii\db\ActiveRecord;
use  yii\web\Session;

//home


class Customer extends ActiveRecord
{

    public static function tableName()
    {
        return 'customer';
    }

    public function rules(): array
    {
        return [
            [['name', 'lastname', 'email', 'nationalCode','address'], 'required'],
            ['email', 'email'],
            ['nationalCode', 'string', 'length'=>10],
            ['nationalCode', 'match', 'pattern'=>'/^([0-9])+$/'],

            ['email', 'unique', 'when' => function ($model) {
                return (Customer::find()
                    ->where(['=', 'email', $this->email])->one()) != null
                    && (Customer::find()->where(['=', 'email', $this->email])->one())->id != $this->id;
            }],

            ['nationalCode', 'unique', 'when' => function ($model) {
                return (Customer::find()
                    ->where(['=', 'nationalCode', $this->nationalCode])->one()) != null
                    && (Customer::find()->where(['=', 'nationalCode', $this->nationalCode])->one())->id != $this->id;
            }],
        ];
    }
    //home
    public function getCar()
    {
        //return $this->hasMany(Car::className(), ['id' => 'car_id'])->viaTable('UserCar', ['user_id' => 'id']);
    }
}
