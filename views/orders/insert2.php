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


    <?= $form->field($model, 'branch')->widget(Select2::classname(), [
        'data' => ArrayHelper::map(Branches::find()->andWhere('order_count < max_order_count')->all(),'name','name'),
        'language' => 'en',
     
        'options' => ['placeholder' => 'Select a hhhhhhhhhh'],
        'pluginOptions' => [
            'allowClear' => true
        ],
        'pluginEvents' => [
            "change" =>'S_POST("index.php?=foods/lists&name='.'"$(this).val(),funtion( data){
                $("select#models-contact).html(data);
            ]);',

        ]])
        
        ?>

    
    <?= $form->field($model, 'foodType')->widget(Select2::classname(), [
        'data' => ArrayHelper::map(Foods::find()->all(),'id','type'),
        'language' => 'en',
        'options' => ['placeholder' => 'Select a type', 'id' => 'cat-id'],
        'pluginOptions' => [
            'allowClear' => true
        ],
        ]); ?>
    
 
 <?php

 ?>



<?= Html::submitButton('Create', ['class' => 'btn btn-primary border p-1 mx-auto mt-3']) ?>

<?php ActiveForm::end(); ?>


            
   