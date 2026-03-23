<?php

use yii\widgets\DetailView;

/* @var $this yii\web\View */
/* @var $model \app\modules\EquipamentoEstado\EquipamentoEstado */
?>
<div class="equipamento-estado-view">
 
    <?= DetailView::widget([
        'model' => $model,
        'attributes' => [
            'id',
            'estado',
        ],
    ]) ?>

</div>
