<?php

use yii\helpers\Html;
use yii\widgets\ActiveForm;
?>

<h2>UPDATE Customer</h2>
<?php
$form = ActiveForm::begin([]);
?>
<?= $form->field($user, 'name') ?>
<?= $form->field($user, 'lastname') ?>
<?= $form->field($user, 'email') ?>
<?= $form->field($user, 'nationalCode') ?>
<?= $form->field($user, 'address') ?>

<div class="form-group">
    <?= Html::submitButton('update', ['class' => 'btn btn-danger border p-1 mx-auto']) ?>
</div>
<?php ActiveForm::end(); ?>