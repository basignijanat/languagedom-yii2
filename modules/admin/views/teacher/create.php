<?php

use yii\helpers\Html;

/* @var $this yii\web\View */
/* @var $model app\models\Teacher */

$this->title = Yii::t('app\admin', 'Create Teacher`s Profile');
$this->params['breadcrumbs'][] = ['label' => Yii::t('app\admin', 'Administrator'), 'url' => ['/admin']];
$this->params['breadcrumbs'][] = ['label' => Yii::t('app\admin', 'Teachers'), 'url' => ['index']];
$this->params['breadcrumbs'][] = $this->title;
?>
<div class="white-box">

    <h1><?= Html::encode($this->title) ?></h1>

    <?= $this->render('_form', [
        'model' => $model,
		'users' => $users,
    ]) ?>

</div>
