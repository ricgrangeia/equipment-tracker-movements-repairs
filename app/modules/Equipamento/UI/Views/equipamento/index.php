<?php

use app\modules\Equipamento\Domain\Entity\Equipamento;
use kartik\grid\GridView;
use yii\bootstrap4\Modal;
use yii\helpers\Html;
use yii2ajaxcrud\ajaxcrud\BulkButtonWidget;
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
        <?= GridView::widget([
            'id' => 'crud-datatable',
            'dataProvider' => $dataProvider,
            'filterModel' => $searchModel,
            'pjax' => true,
            'rowOptions' => function($model,$key,$index,$widget) {
                /** @var Equipamento $model */
                if ($model->estado->shouldBeHighlighted()) {
                    return ['style' => 'background-color: pink'];
                }
            },
            'columns' => require(__DIR__ . '/_columns.php'),
            'toolbar' => [
                ['content' =>
                    Html::a(Yii::t('app-equipamento', 'Create New'), ['create'],
                        ['role' => 'modal-remote', 'title' => Yii::t('yii2-ajaxcrud', 'Create New') . ' Equipamentos', 'class' => 'btn btn-outline-primary']) .
                    Html::a('<i class="fa fa-redo"></i>', [''],
                        ['data-pjax' => 1, 'class' => 'btn btn-outline-success', 'title' => Yii::t('yii2-ajaxcrud', 'Reset Grid')]) .
                    '{toggleData}' .
                    '{export}'

//                    Html::a('<i class="fa far fa-hand-point-up"></i> Privacy Statement', ['/equipamento/report'], [
//                        'class' => 'btn btn-danger',
//                        'target' => '_blank',
//                        'data-toggle' => 'tooltip',
//                        'title' => 'Will open the generated PDF file in a new window'
//                    ])
                ],
            ],
            'striped' => true,
            'condensed' => true,
            'responsive' => true,
            'responsiveWrap' => false,
            'panel' => [
                'type' => 'default',
                'heading' => '<i class="fa fa-list"></i> <b>' . $this->title . '</b>',
                'before' => '<em>* ' . Yii::t('yii2-ajaxcrud', 'Resize Column') . '</em>',
                'after' => BulkButtonWidget::widget([
                        'buttons' => Html::a('<i class="fa fa-trash"></i>&nbsp; ' . Yii::t('yii2-ajaxcrud', 'Delete All'),
                            ["bulkdelete"],
                            [
                                "class" => "btn btn-danger btn-xs",
                                'role' => 'modal-remote-bulk',
                                'data-confirm' => false, 'data-method' => false,// for overide yii data api
                                'data-request-method' => 'post',
                                'data-confirm-title' => Yii::t('yii2-ajaxcrud', 'Delete'),
                                'data-confirm-message' => Yii::t('yii2-ajaxcrud', 'Delete Confirm')
                            ]),
                    ]) .
                    '<div class="clearfix"></div>',
            ]
        ]) ?>
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
