<?php

use yii\helpers\Html;
use yii\widgets\ActiveForm;
use yii\helpers\ArrayHelper; // load classes
use kartik\select2\Select2;

?>
<?php $form = ActiveForm::begin(); ?>

<?= $form->field($model, 'name') ?>
<?= $form->field($model, 'orderable') ?>

<?= $form->field($model, 'type')->widget(Select2::className(), [
    //"name" => "user",
    'data' => $typeitems,
    'options' => ['placeholder' => 'Select type of food ...'],
    'pluginOptions' => [
        'allowClear' => true
    ],
]); ?>


<?= $form->field($model, 'branch')->widget(Select2::className(), [
    'data' => $branchitems,
    'options' => ['placeholder' => 'Select a branch ...'],
    'pluginOptions' => [
        'allowClear' => true
    ],
]); ?>
<div class="form-group">
    <?= Html::submitButton('Create', ['class' => 'btn btn-primary border p-1 mx-auto mt-3']) ?>
</div>
<?php ActiveForm::end(); ?>