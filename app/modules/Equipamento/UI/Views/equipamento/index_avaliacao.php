<?php

use kartik\grid\GridView;
use yii\bootstrap4\Modal;
use yii\helpers\Html;
use yii2ajaxcrud\ajaxcrud\CrudAsset;

/* @var $this yii\web\View */
/* @var $searchModel \app\modules\Equipamento\Domain\Entity\EquipamentoSearch */
/* @var $dataProvider yii\data\ActiveDataProvider */

$this->title = 'Equipamentos';
$this->params['breadcrumbs'][] = $this->title;

CrudAsset::register($this);


?>
<div class="equipamento-index">
    <div id="ajaxCrudDatatable">

        <?=

         GridView::widget([
            'id' => 'kv-grid-demo',
            'dataProvider' => $dataProvider,
            'filterModel' => $searchModel,
            'columns' => require(__DIR__ . '/_columns_avaliacao.php'), // check the configuration for grid columns by clicking button above
            'containerOptions' => ['style' => 'overflow: auto'], // only set when $responsive = false
            'headerRowOptions' => ['class' => 'kartik-sheet-style'],
            'filterRowOptions' => ['class' => 'kartik-sheet-style'],
            'pjax' => true, // pjax is set to always true for this demo
            // set your toolbar
              'responsive'=>true,
    'hover'=>true,
            'toolbar' =>  [
                [
                    'content' =>
                        Html::button('<i class="fas fa-plus"></i>', [
                            'class' => 'btn btn-success',
                            'title' => 'Add Book',
                            'onclick' => 'alert("This will launch the book creation form.\n\nDisabled for this demo!");'
                        ]) . ' '.
                        Html::a('<i class="fas fa-redo"></i>', ['grid-demo'], [
                            'class' => 'btn btn-outline-secondary',
                            'title'=>Yii::t('app', 'Reset Grid'),
                            'data-pjax' => 0,
                        ]),
                    'options' => ['class' => 'btn-group mr-2 me-2']
                ],
                '{export}',
                '{toggleData}',
            ],
            'toggleDataContainer' => ['class' => 'btn-group mr-2 me-2'],
            // set export properties
            'export' => [
                'fontAwesome' => true
            ],
            // parameters from the demo form

            'panel' => [
                'type' => GridView::TYPE_PRIMARY,

            ],
            'persistResize' => false,
            'toggleDataOptions' => ['minCount' => 10],

            'itemLabelSingle' => 'book',
            'itemLabelPlural' => 'books'
        ]);
        ?>









<!---->
<!--        --><?//= GridView::widget([
//            'id' => 'crud-datatable',
//            'dataProvider' => $dataProvider,
//            'filterModel' => $searchModel,
//            'containerOptions' => ['style' => 'overflow: auto'], // only set when $responsive = false
//            'headerRowOptions' => ['class' => 'kartik-sheet-style'],
//            'filterRowOptions' => ['class' => 'kartik-sheet-style'],
//            'pjax' => true,
//            'columns' => require(__DIR__ . '/_columns_avaliacao.php'),
//            'toolbar' => [
//                ['content' =>
//                    Html::a(Yii::t('yii2-ajaxcrud', 'Create New'), ['create'],
//                        ['role' => 'modal-remote', 'title' => Yii::t('yii2-ajaxcrud', 'Create New') . ' Equipamentos', 'class' => 'btn btn-outline-primary']) .
//                    Html::a('<i class="fa fa-redo"></i>', [''],
//                        ['data-pjax' => 1, 'class' => 'btn btn-outline-success', 'title' => Yii::t('yii2-ajaxcrud', 'Reset Grid')]) .
//                    '{toggleData}' .
//                    '{export}'
//
////                    Html::a('<i class="fa far fa-hand-point-up"></i> Privacy Statement', ['/equipamento/report'], [
////                        'class' => 'btn btn-danger',
////                        'target' => '_blank',
////                        'data-toggle' => 'tooltip',
////                        'title' => 'Will open the generated PDF file in a new window'
////                    ])
//                ],
//            ],
//            'striped' => true,
//            'condensed' => true,
//            'responsive' => true,
//            'responsiveWrap' => false,
//            'panel' => [
//                'type' => 'default',
//                'heading' => '<i class="fa fa-list"></i> <b>' . $this->title . '</b>',
//                'before' => '<em>* ' . Yii::t('yii2-ajaxcrud', 'Resize Column') . '</em>',
//                'after' => BulkButtonWidget::widget([
//                        'buttons' => Html::a('<i class="fa fa-trash"></i>&nbsp; ' . Yii::t('yii2-ajaxcrud', 'Delete All'),
//                            ["bulkdelete"],
//                            [
//                                "class" => "btn btn-danger btn-xs",
//                                'role' => 'modal-remote-bulk',
//                                'data-confirm' => false, 'data-method' => false,// for overide yii data api
//                                'data-request-method' => 'post',
//                                'data-confirm-title' => Yii::t('yii2-ajaxcrud', 'Delete'),
//                                'data-confirm-message' => Yii::t('yii2-ajaxcrud', 'Delete Confirm')
//                            ]),
//                    ]) .
//                    '<div class="clearfix"></div>',
//            ]
//        ]) ?>
    </div>
</div>
<?php Modal::begin([
    "id" => "ajaxCrudModal",
    "footer" => "", // always need it for jquery plugin
    "clientOptions" => [
        "tabindex" => false,
        "backdrop" => "static",
        "keyboard" => false,
    ],
    "options" => [
        "tabindex" => false
    ]
]) ?>
<?php Modal::end(); ?>

