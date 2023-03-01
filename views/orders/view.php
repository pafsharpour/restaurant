<?php
use yii\helpers\Html;
use app\models\Foods;

?>
<h1>order details</h1>
<ul>
        <?= "Order Number"?>:
        <?= $model->orderNumber ?> 
</ul>
<ul>
         <?= "Customer name"?>:
        <?= $model->customer ?> 
</ul>
<ul>
         <?= "Branch name"?>:
        <?= $model->branch ?> 
</ul>
<ul>
         <?= "Food type"?>:
        <?php 
        $f = Foods::find()->where(['id'=>$model->foodType])->one();?>
        <?= $f->type ?> 


         <?= "- Foods"?>:
         <?= $f->name ;?>
</ul>