<?php

use yii\helpers\Html;
use yii\widgets\DetailView;

/* @var $this yii\web\View */
/* @var $model app\models\User */

$this->title = $model->lname.' '.$model->fname.' '.$model->mname;
$this->params['breadcrumbs'][] = ['label' => Yii::t('app\admin', 'Administrator'), 'url' => ['/admin']];
$this->params['breadcrumbs'][] = ['label' => Yii::t('app\admin', 'Users'), 'url' => ['index']];
$this->params['breadcrumbs'][] = $this->title;
\yii\web\YiiAsset::register($this);
?>
<div class="white-box">

    <h1><?= Html::encode($this->title) ?></h1>

    <p>
        <?= Html::a(Yii::t('app\admin', 'Update'), ['update', 'id' => $model->id], ['class' => 'btn btn-primary']) ?>
        <?= Html::a(Yii::t('app\admin', 'Delete'), ['delete', 'id' => $model->id], [
            'class' => 'btn btn-danger',
            'data' => [
                'confirm' => Yii::t('app\admin', 'Are you sure you want to delete this item?'),
                'method' => 'post',
            ],
        ]) ?>
    </p>
	
    <?= DetailView::widget([
        'model' => $model,
        'attributes' => [
            'id',
			['attribute' => 'isadmin', 'value' => $model->isadmin == 0 ? Yii::t('app\admin', 'No') : Yii::t('app\admin', 'Yes')],            
            'username:email',
            'password',
            'authkey',
            'accesstoken',            
            'fname',
            'mname',
            'lname',
            'userpic:image',
        ],
    ]) ?>

</div>
