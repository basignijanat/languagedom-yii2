<?php

use yii\helpers\Html;
use yii\grid\GridView;

/* @var $this yii\web\View */
/* @var $searchModel app\models\UserlangSearch */
/* @var $dataProvider yii\data\ActiveDataProvider */

$this->title = Yii::t('app\admin', 'User Languages');
$this->params['breadcrumbs'][] = ['label' => Yii::t('app\admin', 'Administrator'), 'url' => ['/admin']];
$this->params['breadcrumbs'][] = $this->title;
?>
<div class="white-box">

    <h1><?= Html::encode($this->title) ?></h1>

    <p>
        <?= Html::a(Yii::t('app\admin', 'Create User Language'), ['create'], ['class' => 'btn btn-success']) ?>
    </p>

    <?php // echo $this->render('_search', ['model' => $searchModel]); ?>

    <?= GridView::widget([
        'dataProvider' => $dataProvider,
        'filterModel' => $searchModel,
        'columns' => [
            ['class' => 'yii\grid\SerialColumn'],

            'id',
            'name',
            'shortname',
            'val',

            ['class' => 'yii\grid\ActionColumn'],
        ],
    ]); ?>


</div>
