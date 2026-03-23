<?php

use yii\widgets\DetailView;

/* @var $this yii\web\View */
/* @var $model app\models\Imobilizado */
?>
<div class="imobilizado-view">
 
    <?= DetailView::widget([
        'model' => $model,
        'attributes' => [
            'id',
            'nome',
            'code_imo',
            'descricao:ntext',
            'data_compra',
            'tipo_imobilizado',
            'localizacao',
            'tipo_estado_conservacao',
            'num_serie',
            'familia',
            'sub_familia',
            'observacoes:ntext',
        ],
    ]) ?>

</div>
