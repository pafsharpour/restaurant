<?php

use yii\helpers\Html;
use yii\widgets\ActiveForm;
?>

<h2>UPDATE Branch</h2>
<?php
$form = ActiveForm::begin([]);
?>
<?= $form->field($user, 'name') ?>
<?= $form->field($user, 'address') ?>
<?= $form->field($user, 'max_order_count') ?>

<div class="form-group">
    <?= Html::submitButton('update', ['class' => 'btn btn-danger border p-1 mx-auto']) ?>
</div>
<?php ActiveForm::end(); ?>