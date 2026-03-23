<?php

use kartik\grid\GridView;
use yii\helpers\ArrayHelper;
use yii\helpers\Url;

return [
    [
        'class' => 'kartik\grid\CheckboxColumn',
        'width' => '20px',
    ],
    [
        'class' => 'kartik\grid\SerialColumn',
        'width' => '30px',
    ],
        // [
        // 'class'=>'\kartik\grid\DataColumn',
        // 'attribute'=>'id',
    // ],
    [
        'class' => '\kartik\grid\DataColumn',
        'attribute' => 'equipamento_id',
        'value' => 'equipamento.num_interno',
        'filter' => ArrayHelper::map(\app\modules\Equipamento\Domain\Entity\Equipamento::find()->asArray()->all(), 'id', 'num_interno'),
        'filterType' => GridView::FILTER_SELECT2,
        'filterWidgetOptions' => [
            'options' => ['prompt' => ''],
            'pluginOptions' => ['allowClear' => true],
        ],
        'pageSummary'=>'Total',
        'pageSummaryOptions' => ['colspan' => 6],
    ],
    [
        'class'=>'\kartik\grid\DataColumn',
//        'filter' => ArrayHelper::map(\app\modules\Equipamento\Domain\Entity\Equipamento::find()->asArray()->all(), 'equipamento', 'equipamento'),
        'attribute'=>'equipamento.equipamento',
        'value' => 'equipamento.equipamento',
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
     'attribute'=>'data_prox_manutencao',
//         'contentOptions' => function ($model, $key, $index, $column) {
//             return ['style' => 'background-color:'
//                 . (DateTime::createFromFormat("dd-mm-yyyy",strtotime("16-06-2021"))->diff(DateTime::createFromFormat("dd-mm-yyyy",strtotime("16-03-2021"))) < 1 )
//                     ? 'yellow' : 'blue'];
//         },
     ],
    [
        'class'=>'\kartik\grid\DataColumn',
        'attribute'=>'num_fatura',
    ],
    [
        'class'=>'\kartik\grid\DataColumn',
        'attribute' => 'valor_total',
        'pageSummary'=>true,
        'footer' => true
    ],
    [
        'class' => 'kartik\grid\ActionColumn',
        'dropdown' => false,
        'noWrap' => 'true',
        'template' => '{view} {update} {delete}',
        'vAlign' => 'middle',
        'urlCreator' => function($action, $model, $key, $index) { 
                return Url::to([$action,'id'=>$key]);
        },
        'viewOptions' => ['role' => 'modal-remote', 'title' => Yii::t('yii2-ajaxcrud', 'View'), 'data-toggle' => 'tooltip', 'class' => 'btn btn-sm btn-outline-success'],
        'updateOptions' => ['role' => 'modal-remote', 'title' => Yii::t('yii2-ajaxcrud', 'Update'), 'data-toggle' => 'tooltip', 'class' => 'btn btn-sm btn-outline-primary'],
        'deleteOptions' => ['role' => 'modal-remote', 'title' => Yii::t('yii2-ajaxcrud', 'Delete'), 'class' => 'btn btn-sm btn-outline-danger', 
            'data-confirm' => false,
            'data-method' => false,// for overide yii data api
            'data-request-method' => 'post',
            'data-toggle' => 'tooltip',
            'data-confirm-title' => Yii::t('yii2-ajaxcrud', 'Delete'),
            'data-confirm-message' => Yii::t('yii2-ajaxcrud', 'Delete Confirm') ],
    ],


];   