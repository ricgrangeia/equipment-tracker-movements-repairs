<?php
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
        'class'=>'\kartik\grid\DataColumn',
        'attribute'=>'nome',
    ],
    [
        'class'=>'\kartik\grid\DataColumn',
        'attribute'=>'code_imo',
//        'contentOptions' => ['class' => 'd-none d-lg-block'],
//        'headerOptions' => ['class' => 'd-none d-lg-block']
    ],
    [
        'class'=>'\kartik\grid\DataColumn',
        'attribute'=>'descricao',
//        'contentOptions' => ['class' => 'd-none d-lg-block'],
//        'headerOptions' => ['class' => 'd-none d-lg-block']
    ],
    [
        'class'=>'\kartik\grid\DataColumn',
        'attribute'=>'data_compra',
    ],
    [
        'class'=>'\kartik\grid\DataColumn',
        'attribute'=>'tipo_imobilizado',
//        'contentOptions' => ['class' => 'd-none d-lg-block'],
//        'headerOptions' => ['class' => 'd-none d-lg-block']
    ],
    // [
        // 'class'=>'\kartik\grid\DataColumn',
        // 'attribute'=>'localizacao',
    // ],
    // [
        // 'class'=>'\kartik\grid\DataColumn',
        // 'attribute'=>'tipo_estado_conservacao',
    // ],
    // [
        // 'class'=>'\kartik\grid\DataColumn',
        // 'attribute'=>'num_serie',
    // ],
    // [
        // 'class'=>'\kartik\grid\DataColumn',
        // 'attribute'=>'familia',
    // ],
    // [
        // 'class'=>'\kartik\grid\DataColumn',
        // 'attribute'=>'sub_familia',
    // ],
    // [
        // 'class'=>'\kartik\grid\DataColumn',
        // 'attribute'=>'observacoes',
    // ],
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