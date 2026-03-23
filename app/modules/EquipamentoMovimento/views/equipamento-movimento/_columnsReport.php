<?php

use app\modules\Equipamento\Domain\Entity\Equipamento;
use kartik\grid\GridView;
use yii\helpers\ArrayHelper;

return [

    [
        'class' => '\kartik\grid\DataColumn',
        'attribute' => 'equipamento_id',
        'value' => 'equipamento.num_interno',
        'filter' => ArrayHelper::map(Equipamento::find()->asArray()->all(), 'id', 'num_interno'),
        'filterType' => GridView::FILTER_SELECT2,
        'filterWidgetOptions' => [
            'options' => ['prompt' => ''],
            'pluginOptions' => ['allowClear' => true],
        ],
    ],
    [
        'class' => '\kartik\grid\DataColumn',
        'attribute' => 'data',
    ],
    [
        'class' => '\kartik\grid\DataColumn',
        'attribute' => 'destino_id',
        'value' => 'destino.nome'
    ],
    [
        'class' => '\kartik\grid\DataColumn',
        'attribute' => 'tipo_movimento_id',
        'value' => 'tipoMovimento.tipo_movimento',
    ],
    [
        'class' => '\kartik\grid\DataColumn',
        'attribute' => 'observacoes',
    ],

];   