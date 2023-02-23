<?php

use yii\helpers\Html;
use yii\widgets\ActiveForm;
?>

<h2>Create new Branch</h2>

<?php
$form = ActiveForm::begin([]);
?>
<?= $form->field($user, 'type') ?>

<div class="form-group">
    <?= Html::submitButton('Create', ['class' => 'btn btn-danger border p-1 mx-auto']) ?>
</div>
<?php ActiveForm::end(); ?>