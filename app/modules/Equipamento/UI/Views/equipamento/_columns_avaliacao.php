<?php

use kartik\editable\Editable;


return [



//    [
//        'class' => 'kartik\grid\CheckboxColumn',
//        'width' => '20px',
//    ],
//    [
//        'class' => 'kartik\grid\SerialColumn',
//        'width' => '30px',
//    ],
//     [
//     'class'=>'\kartik\grid\DataColumn',
//     'attribute'=>'id',
//     ],
    [
        'class' => '\kartik\grid\DataColumn',
        'attribute' => 'num_interno',
    ],
//    [
//        'class'=>'\kartik\grid\DataColumn',
//        'attribute'=>'num_serie',
//    ],




    [
        'class' => '\kartik\grid\DataColumn',
        'attribute' => 'equipamento',
    ],
//    [
//        'class' => '\kartik\grid\DataColumn',
//        'attribute' => 'descricao',
//    ],
    [
        'class'=>'\kartik\grid\DataColumn',
        'attribute'=>'marca',
    ],
//    [
//        'class' => '\kartik\grid\DataColumn',
//        'attribute' => 'avaliacao_data_ultima',
//
//    ],
    [
        'class' => kartik\grid\EditableColumn::class,
        'attribute' => 'avaliacao_data_ultima',

        'refreshGrid' => true,
        'editableOptions' =>  function ($model, $key, $index) {
            return [
                'asPopover' => false,
                'formOptions' => [ 'action' => ['equipamento/editable-update'] ],
            ];
        }

    ],




//     [
//     'class'=>'\kartik\grid\DataColumn',
//     'attribute'=>'avaliacao_estado',
//     ],
    [
        'class' => 'kartik\grid\EditableColumn',
        'attribute' => 'avaliacao_estado',
        'pageSummary' => 'Total',
        'vAlign' => 'middle',
        'width' => '210px',
        'value' => function ($model, $key, $index, $widget) {
            return $model->avaliacao_estado;
        },
        'refreshGrid' => true,

        'editableOptions' =>  function ($model, $key, $index) {
            return [
                'asPopover' => false,
                'header' => 'avaliacao_estado',
//                'inputType' => Editable::INPUT_TEXT,
                'inputType' => Editable::INPUT_DROPDOWN_LIST,
                'data' => ['Apto' => 'Apto', 'Apto Condicional' => 'Apto Condicional', 'Não Apto' => 'Não apto'],
                'options' => ['class'=>'form-control', 'prompt'=>'Select status...'],

                'formOptions' => [ 'action' => ['equipamento/editable-update'] ],
//                'displayValueConfig'=> [
//                    'Bom' => '<i class="fas fa-thumbs-up"></i> Bom',
//                    'Mau' => '<i class="fas fa-thumbs-down"></i> Mau',
//                    'Reprovado' => '<i class="fas fa-hourglass"></i> Reprovado',
//
//                ],


        ];
        }
    ],

//     [
//     'class'=>'\kartik\grid\DataColumn',
//     'attribute'=>'estado_id',
//         'value' => 'estado.estado'
//     ],

    // [
    // 'class'=>'\kartik\grid\DataColumn',
    // 'attribute'=>'caixa',
    // ],

    // [
    // 'class'=>'\kartik\grid\DataColumn',
    // 'attribute'=>'familia_id',
    // ],

    // [
    // 'class'=>'\kartik\grid\DataColumn',
    // 'attribute'=>'sub_familia_id',
    // ],

    // [
    // 'class'=>'\kartik\grid\DataColumn',
    // 'attribute'=>'acessorios',
    // ],
    // [
    // 'class'=>'\kartik\grid\DataColumn',
    // 'attribute'=>'fornecedor_id',
    // ],
    // [
    // 'class'=>'\kartik\grid\DataColumn',
    // 'attribute'=>'observacoes',
    // ],
//    [
//        'class' => 'kartik\grid\ActionColumn',
//        'dropdown' => false,
//        'noWrap' => 'true',
//        'template' => '{update} {delete} {avaliacao}',
//        'vAlign' => 'middle',
//        'urlCreator' => function ($action, $model, $key, $index) {
//            return Url::to([$action, 'id' => $key]);
//        },
////        'viewOptions' => ['role' => 'modal-remote', 'title' => Yii::t('yii2-ajaxcrud', 'View'), 'data-toggle' => 'tooltip', 'class' => 'btn btn-sm btn-outline-success'],
//        'updateOptions' => ['role' => 'modal-remote', 'title' => Yii::t('yii2-ajaxcrud', 'Update'), 'data-toggle' => 'tooltip', 'class' => 'btn btn-sm btn-outline-primary'],
//        'deleteOptions' => ['role' => 'modal-remote', 'title' => Yii::t('yii2-ajaxcrud', 'Delete'), 'class' => 'btn btn-sm btn-outline-danger',
//            'data-confirm' => false,
//            'data-method' => false,// for overide yii data api
//            'data-request-method' => 'post',
//            'data-toggle' => 'tooltip',
//            'data-confirm-title' => Yii::t('yii2-ajaxcrud', 'Delete'),
//            'data-confirm-message' => Yii::t('yii2-ajaxcrud', 'Delete Confirm')],
//        'buttons' => [
//            'avaliacao' => function ($url, $model) {
//
//                return Html::a( '<span class="fas fa-print"></span>', $url, [
//                    'title'              => Yii::t('app', 'Toogle Active'),
//                    'data-pjax'          => '1',
//                    'data-toggle-active' => $model->id
//                ]);
//
//
//            },
//        ],
//    ],

];   