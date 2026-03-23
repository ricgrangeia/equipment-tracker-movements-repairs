<?php

use app\models\Localization;
use yii\widgets\DetailView;
/* @var $this yii\web\View */
/* @var $model app\models\Funcionario */
?>
<div class="funcionario-view">

    <?= DetailView::widget([
        'model' => $model,
        'attributes' => [
            'id',
            'ativo:boolean',
            'nome',
            'localization0.localization',
            'tipo',
        ],
    ]) ?>

</div>
