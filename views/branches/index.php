<?php

use app\widgets\Alert;
use app\models\Branches;
use yii\helpers\Html;
use yii\helpers\Url;
use yii\grid\ActionColumn;
use yii\grid\GridView;


$this->title = 'Branches list';
$this->params['breadcrumbs'][] = $this->title;
?>
<?= Alert::widget() ?>

<div class="country-index">

    <h1><?= Html::encode($this->title) ?></h1>

    <p>
        <?= Html::a('create', ['/branches/insert'], ['class' => 'mx-2 btn btn-primary']) ?>

    </p>

    <?php // echo $this->render('_search', ['model' => $searchModel]); 
    ?>

    <?= GridView::widget([
        'dataProvider' => $dataProvider,
        'filterModel' => $searchModel,
        'columns' => [
            ['class' => 'yii\grid\SerialColumn'],
            'id',
            [
                'attribute' => 'name',
                'value' => function ($user) {
                    return $user->name;
                },
                'label' => 'Name'
            ],
            

            'address',
           'order_count',
            'max_order_count',


            [
                'class' => ActionColumn::className(),
                'urlCreator' => function ($action, Branches $model, $key, $index, $column) {
                    return Url::toRoute([$action, 'id' => $model->id]);
                }
            ],
        ],
    ]); ?>


</div>