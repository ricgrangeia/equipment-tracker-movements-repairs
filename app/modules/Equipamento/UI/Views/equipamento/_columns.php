<?php

use app\models\EquipamentoFamilia;
use app\models\EquipamentoSubfamilia;
use app\models\Funcionario;
use app\models\Localization;
use app\modules\Empresa\Empresa;
use app\modules\Equipamento\Domain\Entity\Equipamento;
use app\modules\Equipamento\ModuleEquipamento;
use app\modules\EquipamentoEstado\EquipamentoEstado;
use kartik\grid\GridView;
use yii\helpers\ArrayHelper;
use yii\helpers\Html;
use yii\helpers\Url;


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
//    [
//        'class' => '\kartik\grid\DataColumn',
//        'attribute' => 'num_interno',
//    ],
    [
        'class' => '\kartik\grid\DataColumn',
        'attribute' => 'num_interno',
        'value' => 'num_interno',
        'noWrap' => true,
        'filterType' => GridView::FILTER_TYPEAHEAD,
        'filterWidgetOptions' => [
            'options' => ['placeholder' => 'Num...', 'autocomplete'=>"off"],
            'pluginOptions' => ['highlight' => true],
            'dataset' => [
                [
                    'local' => ArrayHelper::getColumn(Equipamento::find()->select('num_interno')->distinct()->asArray()->all(), 'num_interno'),
                    'limit' => 10,
                ],
            ],
        ],
    ],
//    [
//        'class'=>'\kartik\grid\DataColumn',
//        'attribute'=>'num_serie',
//    ],

    [
        'class' => '\kartik\grid\DataColumn',
        'attribute' => 'empresa_id',
        'value' => 'empresa.empresa',
        'filter' => ArrayHelper::map(Empresa::find()->asArray()->all(), 'id', 'empresa'),
        'filterType' => GridView::FILTER_SELECT2,
        'filterWidgetOptions' => [
            'options' => ['prompt' => ''],
            'pluginOptions' => ['allowClear' => true],
        ],
        'noWrap' => true,
        'width' => '150px',
    ],
//    [
//        'class' => '\kartik\grid\DataColumn',
//        'attribute' => 'equipamento',
//    ],
    [
        'class' => '\kartik\grid\DataColumn',
        'attribute' => 'equipamento',
        'value' => 'equipamento',
        'noWrap' => true,
        'filterType' => GridView::FILTER_TYPEAHEAD,
        'filterWidgetOptions' => [
            'options' => ['placeholder' => 'Equipamento...', 'autocomplete'=>"off"],
            'pluginOptions' => ['highlight' => true],
            'dataset' => [
                [
                    'local' => ArrayHelper::getColumn(Equipamento::find()->select('equipamento')->distinct()->asArray()->all(), 'equipamento'),
                ],
            ],
        ],
    ],
//    [
//        'class' => '\kartik\grid\DataColumn',
//        'attribute' => 'descricao',
//    ],
    [
        'class' => '\kartik\grid\DataColumn',
        'attribute' => 'marca',
        'value' => 'marca',
        'noWrap' => true,
        'filterType' => GridView::FILTER_TYPEAHEAD,
        'filterWidgetOptions' => [
            'options' => ['placeholder' => 'Marca...', 'autocomplete'=>"off"],
            'pluginOptions' => ['highlight' => true],
            'dataset' => [
                [
//                    'local' => ArrayHelper::getColumn(\app\modules\Equipamento\Domain\Entity\Equipamento::find()->select('marca')->distinct()->asArray()->all(), 'marca'),
                    'limit' => 10,
                    'remote' => [
                        'url' => Url::to(['equipamento/marca-list']) . '?marca=%QUERY',
                        'wildcard' => '%QUERY'
                    ]
                ],
            ],
        ],
    ],
    [
        'class' => '\kartik\grid\DataColumn',
        'attribute' => 'familia_descricao',
        'value' => 'familia.familia',
        'filterType' => GridView::FILTER_TYPEAHEAD,
        'filterWidgetOptions' => [
            'options' => ['placeholder' => 'Familia...', 'autocomplete'=>"off"],
            'pluginOptions' => ['highlight' => true],
            'dataset' => [
                [
                    'local' => ArrayHelper::getColumn(EquipamentoFamilia::find()->select('familia')->distinct()->asArray()->all(), 'familia'),
                    'limit' => 10,
                ],
            ],
        ],
        'noWrap' => true,
        'width' => '150px',
    ],
    [
        'class' => '\kartik\grid\DataColumn',
        'attribute' => 'sub_familia_descricao',
        'value' => 'subFamilia.subfamilia',
        'filterType' => GridView::FILTER_TYPEAHEAD,
        'filterWidgetOptions' => [
            'options' => ['placeholder' => 'Sub-Familia...', 'autocomplete'=>"off"],
            'pluginOptions' => ['highlight' => true],
            'dataset' => [
                [
                    'local' => ArrayHelper::getColumn(EquipamentoSubfamilia::find()->select('subfamilia')->distinct()->asArray()->all(), 'subfamilia'),
                    'limit' => 10,
                ],
            ],
        ],
        'noWrap' => true,
        'width' => '150px',
    ],
//    [
//        'class' => '\kartik\grid\DataColumn',
//        'attribute' => 'sub_familia_descricao',
////        'value' => 'subfamilia.subfamilia',
//
//        'filter' => ArrayHelper::map(\app\models\EquipamentoSubfamilia::find()->asArray()->all(), 'subfamilia', 'subfamilia'),
//        'filterType' => GridView::FILTER_SELECT2,
//        'value' => function ($model, $key, $index, $widget) {
//            /** @var \app\modules\Equipamento\Domain\Entity\Equipamento $model */
//            return $model->getSubFamiliaDescricao();
//        },
//        'filterWidgetOptions' => [
//            'options' => ['prompt' => ''],
//            'pluginOptions' => ['allowClear' => true],
//        ],
//        'noWrap' => true,
//        'width' => '150px',
//    ],

	[
		'filter' => ArrayHelper::map( Localization::find()->asArray()->all(), 'id', 'localization'),
		'label' => ModuleEquipamento::t('equipamento', 'Localizacao'),
		'class' => '\kartik\grid\DataColumn',
		'attribute' => 'localization_id',
		'value' => 'localization.localization',

	],

    [
        'class' => '\kartik\grid\DataColumn',
        'header' => 'Requerente',
        'noWrap' => true,
        'attribute' => 'location',
        'filterAttribute' => 'location',
        'value' => function ($model, $key, $index, $widget) {
            return $model->getLastDestino();
        },
        'filter' => ArrayHelper::map(Funcionario::find()->asArray()->all(), 'id', 'nome', 'tipo'),
        'filterType' => GridView::FILTER_SELECT2,
        'filterWidgetOptions' => [
            'options' => ['prompt' => ''],
            'pluginOptions' => ['allowClear' => true],
        ],
    ],
    [
        'class' => '\kartik\grid\DataColumn',
        'header' => 'Data',

        'value' => function ($model, $key, $index, $widget) {
            return $model->getLastDestinoData();
        },
    ],


    // [
    // 'class'=>'\kartik\grid\DataColumn',
    // 'attribute'=>'modelo',
    // ],
//     [
//     'class'=>'\kartik\grid\DataColumn',
//     'attribute'=>'estado_id',
//         'value' => 'estado.estado'
//     ],
    [
        'class' => '\kartik\grid\DataColumn',
        'attribute' => 'estado_id',
        'value' => 'estado.estado',
        'filter' => ArrayHelper::map(EquipamentoEstado::find()->asArray()->all(), 'id', 'estado'),
        'filterType' => GridView::FILTER_SELECT2,
        'filterWidgetOptions' => [
            'options' => ['prompt' => ''],
            'pluginOptions' => ['allowClear' => true],
        ],
        'noWrap' => true,
        'width' => '150px',
    ],
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
    [
        'class' => 'kartik\grid\ActionColumn',
        'dropdown' => false,
        'noWrap' => 'true',
        'template' => '{view} {update} {delete} {report}',
        'vAlign' => 'middle',
        'urlCreator' => function ($action, $model, $key, $index) {
            return Url::to([$action, 'id' => $key]);
        },
        'viewOptions' => ['role' => 'modal-remote', 'title' => Yii::t('yii2-ajaxcrud', 'View'), 'data-toggle' => 'tooltip', 'class' => 'btn btn-sm btn-outline-success'],
        'updateOptions' => ['role' => 'modal-remote', 'title' => Yii::t('yii2-ajaxcrud', 'Update'), 'data-toggle' => 'tooltip', 'class' => 'btn btn-sm btn-outline-primary'],
        'deleteOptions' => ['role' => 'modal-remote', 'title' => Yii::t('yii2-ajaxcrud', 'Delete'), 'class' => 'btn btn-sm btn-outline-danger',
            'data-confirm' => false,
            'data-method' => false,// for overide yii data api
            'data-request-method' => 'post',
            'data-toggle' => 'tooltip',
            'data-confirm-title' => Yii::t('yii2-ajaxcrud', 'Delete'),
            'data-confirm-message' => Yii::t('yii2-ajaxcrud', 'Delete Confirm')],
        'buttons' => [
            'report' => function ($url) {
                return Html::a(
                    '<span class="fas fa-print"></span>',
                    $url,
                    [
                        'title' => 'Relatório',
                        'data-pjax' => '0',
                        'class' => 'btn btn-sm btn-outline-primary',
                        'target' => '_blank'
                    ]
                );
            },
        ],
    ],

];