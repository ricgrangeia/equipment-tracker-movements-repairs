<?php
use yii\helpers\Url;

return [

    [
        'class'=>'\kartik\grid\DataColumn',
        'attribute'=>'equipamento_id',
//        'value' => equipamento.num_interno,

        'value' => function ($model, $key, $index, $widget) {
            return \yii\helpers\Html::a($model->equipamento->num_interno,
                '/equipamento/view/'.$model->equipamento->id,
                ['data-pjax' => 0]
                );
        },

        'format' => 'raw'

    ],
    [
        'class'=>'\kartik\grid\DataColumn',
        'attribute'=>'entidade_reparadora',
    ],
    [
        'class'=>'\kartik\grid\DataColumn',
        'attribute'=>'data_envio',
    ],
    [
        'class'=>'\kartik\grid\DataColumn',
        'attribute'=>'data_recepcao',
    ],
    [
        'class'=>'\kartik\grid\DataColumn',
        'attribute'=>'num_fatura',
    ],
     [
         'class'=>'\kartik\grid\DataColumn',
         'attribute'=>'valor_total',
     ],


];   