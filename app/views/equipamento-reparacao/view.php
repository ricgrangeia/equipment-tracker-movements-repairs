<?php

use yii\widgets\DetailView;

/* @var $this yii\web\View */
/* @var $model app\models\EquipamentoReparacao */
?>
<div class="equipamento-reparacao-view">
 
    <?= DetailView::widget([
        'model' => $model,
        'attributes' => [
//            'id',
            'equipamento.num_interno',
            'entidade_reparadora',
            'data_envio',
            'data_recepcao',
            'data_prox_manutencao',
            'num_fatura',
            'valor_total',
            'observacoes',
        ],
    ]) ?>

</div>
