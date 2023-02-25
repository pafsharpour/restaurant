<?php

namespace app\models;

use yii\base\Model;
use yii\data\ActiveDataProvider;
use yii\db\ActiveRecord;
use  yii\web\Session;
use app\models\DeleteFailException;
//home


class Foods extends ActiveRecord
{
    const SCENARIO_UPDATE = 'update';

     public function scenarios(): array
    {
        $scenarios = parent::scenarios();
        $scenarios[self::SCENARIO_UPDATE] = ['id', 'name', 'orderable','ordered', 'type', 'branch'];

        return $scenarios;
    } 
    public static function tableName()
    {
        return 'foods';
    }

    public function rules(): array
    {
        //  dd($this->order_count);

        return [
            [['ordered', 'orderable'], 'integer'],
            [['name', 'orderable', 'type', 'branch'], 'required'],
            [['name', 'branch','type'], 'unique', 'targetAttribute' => ['name', 'branch', 'type'], 'message' => 'record already  exists!'],
            ['orderable', 'compare', 'compareValue' => 0, 'operator' => '>='],

            ['orderable', 'compare', 'compareValue' => $this->ordered,
            'operator' => '>=','on' => self::SCENARIO_UPDATE],

            //['order_count', 'compare', 'compareValue' => $this->max_order_count, 'operator' => '<='],

   /*          ['name', 'unique', 'when' => function ($model) {
                return (Branches::find()
                    ->where(['=', 'name', $this->name])->one()) != null
                    && (Branches::find()->where(['=', 'name', $this->name])->one())->id != $this->id;
            }], */
        ];
    }

   
   
    //home
    public function getBranches()
    {
        return $this->hasOne(Branches::class, ['name' => 'branch']);
    }
   



    public static function getFoods($branchName)
    {
        $out = [];
        $data = Foods::find()
                ->where(['branch' => $branchName])
                ->asArray()
                ->all();
        foreach ($data as $dat) {
            $out[] = ['id' => $dat['id'], 'name' => $dat['name']];
        }
        return $output = [
            'output' => $out,
            'selected' => ''
        ];
    }

    public static function getFoodType ($branchName)
    {
        $out = [];
        $data = Foods::find()
                ->where(['branch' => $branchName])
                ->asArray()
                ->all();
                foreach ($data as $dat) {
                    $out[] = ['id' => $dat['id'], 'type' => $dat['type']];
                }
                return $output = [
                    'output' => $out,
                    'selected' => ''
                ];
            }
        
    }
