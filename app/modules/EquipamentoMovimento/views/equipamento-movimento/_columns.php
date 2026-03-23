<?php

use app\modules\Equipamento\Domain\Entity\Equipamento;
use app\modules\EquipamentoMovimento\EquipamentoMovimento;
use app\modules\EquipamentoMovimentoTipo\EquipamentoMovimentoTipo;
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
        'filter' => ArrayHelper::map(Equipamento::find()->asArray()->all(), 'id', 'num_interno'),
        'filterType' => GridView::FILTER_SELECT2,
        'filterWidgetOptions' => [
            'options' => ['prompt' => ''],
            'pluginOptions' => ['allowClear' => true],
        ],
    ],
    [
        'class' => '\kartik\grid\DataColumn',
        'attribute' => 'equipamento.equipamento',
        'value' => 'equipamento.equipamento',
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
    [
        'class' => '\kartik\grid\DataColumn',
        'attribute' => 'data',
    ],
    [
        'class' => '\kartik\grid\DataColumn',
        'attribute' => 'destino_id',
        'value' => 'destino.nome',
        'filter' => ArrayHelper::map(\app\models\Funcionario::find()->asArray()->all(), 'id', 'nome'),
        'filterType' => GridView::FILTER_SELECT2,
        'filterWidgetOptions' => [
    'options' => ['prompt' => ''],
    'pluginOptions' => ['allowClear' => true],
],
    ],
    [
        'class' => '\kartik\grid\DataColumn',
        'attribute' => 'tipo_movimento_id',
        'value' => 'tipoMovimento.tipo_movimento',
        'filter' => ArrayHelper::map(EquipamentoMovimentoTipo::find()->asArray()->all(), 'id', 'tipo_movimento'),
    ],
    [
        'class' => '\kartik\grid\DataColumn',
        'attribute' => 'observacoes',
    ],
    // [
    //     'class' => '\kartik\grid\DataColumn',
    //     'attribute' => 'utilizador_responsavel',
    //     'value' => function ($model, $key, $index, $widget) {
    //         if(empty($model->utilizador_responsavel)) return '';
    //         return \mdm\admin\models\User::findOne($model->utilizador_responsavel)->username;
    //     },
    // ],
    // Foi substituido pelo de baixo porque alguns filtros tem o user responsavel a null porque provavelmente foi apagado assim se foi apagado mostra sem nome
    [
        'class' => '\kartik\grid\DataColumn',
        'attribute' => 'utilizador_responsavel',
        'value' => function ($model) {
            return $model->utilizador_responsavel 
                ? (\mdm\admin\models\User::findOne($model->utilizador_responsavel)->username ?? '') 
                : '';
        },
    ],
    [
        'class' => 'kartik\grid\ActionColumn',
        'dropdown' => false,
        'noWrap' => 'true',
        'template' => '{view} {update} {delete}',
        'visibleButtons' => [
                'delete' => function($data){
                    # Só Permite que se possa eliminar o útimo movimento.
                    /** @var EquipamentoMovimento $data */
                    return $data->isLastMovimento();
                },
            ],
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
    ],

];   