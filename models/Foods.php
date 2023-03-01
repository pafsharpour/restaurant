<?php

namespace app\models;

use yii\db\ActiveRecord;
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

        return [
            [['ordered', 'orderable'], 'integer'],
            [['name', 'orderable', 'type', 'branch'], 'required'],
            [['name', 'branch','type'], 'unique', 'targetAttribute' => ['name', 'branch', 'type'], 'message' => 'record already  exists!'],
            ['orderable', 'compare', 'compareValue' => 0, 'operator' => '>='],

            ['orderable', 'compare', 'compareValue' => $this->ordered,
            'operator' => '>=','on' => self::SCENARIO_UPDATE],

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
                ->andWhere('orderable > ordered')
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


            public function getOrders()
            {
                return $this->hasMany(Orders::class, ['foods' => 'name']);
            }
        
    }
