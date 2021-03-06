<?php

use yii\helpers\Html;

?>
<? if ($groups): ?>
    <div class="column">
        <h2 class="is-size-5">
            <?= Yii::t('app\main', 'My Groups (').Yii::t('app\main', $role).')' ?>
        </h2>

        <? foreach ($groups as $group): ?>
            <?= Html::a($group->name, '/schedule/'.$group->id, [
                'class' => $group_id == $group->id ? 'button is-success' : 'button is-light',
            ]) ?>
        <? endforeach ?>
    </div>
<? endif ?>