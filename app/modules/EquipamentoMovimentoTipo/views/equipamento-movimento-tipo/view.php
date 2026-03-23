<?php

use app\modules\EquipamentoMovimentoTipo\EquipamentoMovimentoTipo;
use yii\widgets\DetailView;

/* @var $this yii\web\View */
/* @var $model EquipamentoMovimentoTipo */
?>
<div class="equipamento-movimento-tipo-view">
 
    <?= DetailView::widget([
        'model' => $model,
        'attributes' => [
            'id',
            'tipo_movimento',
        ],
    ]) ?>

</div>
