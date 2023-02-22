<?php

use app\widgets\Alert;
use app\models\Customer;
use yii\helpers\Html;
use yii\helpers\Url;
use yii\grid\ActionColumn;
use yii\grid\GridView;


$this->title = 'Customer list';
$this->params['breadcrumbs'][] = $this->title;
?>
<?= Alert::widget() ?>

<div class="country-index">

    <h1><?= Html::encode($this->title) ?></h1>

    <p>
        <?= Html::a('create', ['/customer/insert'], ['class' => 'mx-2 btn btn-primary']) ?>

    </p>

    <?php // echo $this->render('_search', ['model' => $searchModel]); 
    ?>

    <?= GridView::widget([
        'dataProvider' => $dataProvider,
        'filterModel' => $searchModel,
        'columns' => [
            ['class' => 'yii\grid\SerialColumn'],

            [
                'attribute' => 'name',
                'value' => function ($user) {
                    return $user->name;
                },
                'label' => 'Name'
            ],
            'lastname',
            'email',
            'nationalCode',
            'address',

            [
                'class' => ActionColumn::className(), 'template' => '{delete} {update}',
                'urlCreator' => function ($action, Customer $model, $key, $index, $column) {
                    return Url::toRoute([$action, 'id' => $model->id]);
                }
            ],
        ],
    ]); ?>


</div>