<?php

use yii\helpers\Html;
use yii\widgets\ActiveForm;
use kartik\select2\Select2;
use yii\web\JsExpression;
use yii\helpers\ArrayHelper;
use app\models\Branches;
use app\models\Foods;
use kartik\depdrop\DepDrop;
use richardfan\widget\JSRegister;


use yii\helpers\Url;


?>

<h2>Create new Orders</h2>
<?php
$form = ActiveForm::begin([]); ?>


<?= $form->field($model, 'orderNumber') ?>

<?= $form->field($model, 'customer')->widget(Select2::classname(), [
        'data' => $Customer,
        'language' => 'en',
        'options' => ['placeholder' => 'Select customer'],
        'pluginOptions' => [
            'allowClear' => true
        ],
        ]); ?>


    <?= $form->field($model, 'branch')->widget(Select2::classname(), [
        'data' => ArrayHelper::map(Branches::find()->andWhere('order_count < max_order_count')->all(),'name','name'),
        'language' => 'en',
        'options' => ['placeholder' => 'Select a branch', 'id' => 'cat-id'],
        'pluginOptions' => [
            'allowClear' => true
        ],
        ]); ?>
    

    <?= $form->field($model, 'foodType')->widget(DepDrop::classname(), [
        'options'=>['id'=>'type-id'],
        'pluginOptions'=>[
            'depends'=>['cat-id'],
            'placeholder'=>'Select type',
            'multiple' => true,
            'url'=>Url::to(['/orders/types'])
        ]
        ]);?>

        <?= $form->field($model, 'foods')->widget(DepDrop::classname(), [
        'options'=>['id'=>'subcat-id'],
        'pluginOptions'=>[
            'depends'=>['cat-id'],
            'placeholder'=>'Select foods',
            'url'=>Url::to(['/orders/foods'])
        ]
        ]); ?>
    
 
 <?php
  // $_SESSION['a'] = 'a';
  // dd($_SESSION['a']);
 ?>



<?= Html::submitButton('Create', ['class' => 'btn btn-primary border p-1 mx-auto mt-3']) ?>

<?php ActiveForm::end(); ?>

