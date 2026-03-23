<?php

use app\models\Funcionario;
use app\modules\EquipamentoMovimento\EquipamentoMovimento;
use yii\widgets\DetailView;
use mdm\admin\models\User;

/* @var $this yii\web\View */
/* @var $model EquipamentoMovimento */
?>
<div class="equipamento-movimento-view">
 
    <?= DetailView::widget([
        'model' => $model,
        'attributes' => [
            'id',
            'data',
            'destino_id',
              [
                'attribute'=>'destino_id',
                'value' => Funcionario::findOne($model->destino_id)->nome,
            ],
            'tipo_movimento_id',
            'observacoes:ntext',
            'equipamento_id',
            [
                'attribute'=>'utilizador_responsavel',
                'value' => User::findOne($model->utilizador_responsavel)->username,
            ]
        ],
    ]) ?>

</div>
