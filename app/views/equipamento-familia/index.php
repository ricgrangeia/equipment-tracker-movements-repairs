<?php

use app\models\EquipamentoFamilia;
use app\models\EquipamentoSubfamilia;
use yii\helpers\ArrayHelper;
use yii\helpers\Url;
use yii\helpers\Html;
use yii\bootstrap4\Modal;
use kartik\grid\GridView;
use yii2ajaxcrud\ajaxcrud\CrudAsset;
use yii2ajaxcrud\ajaxcrud\BulkButtonWidget;

/* @var $this yii\web\View */
/* @var $searchModel app\models\EquipamentoFamiliaSearch */
/* @var $dataProvider yii\data\ActiveDataProvider */

$this->title = 'Equipamento Familias';
$this->params['breadcrumbs'][] = $this->title;

CrudAsset::register($this);

?>
    <div class="equipamento-familia-index">
        <div id="ajaxCrudDatatable">
            <?= GridView::widget([
                'id' => 'crud-datatable',
                'dataProvider' => $dataProvider,
                'filterModel' => $searchModel,
                'pjax' => true,
                'columns' => require(__DIR__ . '/_columns.php'),
                'toolbar' => [
                    ['content' =>
                        Html::a(Yii::t('yii2-ajaxcrud', 'Create New'), ['create'],
                            ['role' => 'modal-remote', 'title' => Yii::t('yii2-ajaxcrud', 'Create New') . ' Equipamento Familias', 'class' => 'btn btn-outline-primary']) .
                        Html::a('<i class="fa fa-redo"></i>', [''],
                            ['data-pjax' => 1, 'class' => 'btn btn-outline-success', 'title' => Yii::t('yii2-ajaxcrud', 'Reset Grid')]) .
                        '{toggleData}' .
                        '{export}'
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

<?php

echo GridView::widget([
    'dataProvider' => $dataProvider,
    'filterModel' => $searchModel,
    'showPageSummary' => true,
    'pjax' => true,
    'striped' => true,
    'hover' => true,
    'panel' => ['type' => 'primary', 'heading' => 'Grid Grouping Example'],
    'toggleDataContainer' => ['class' => 'btn-group mr-2'],
    'columns' => [
        ['class' => 'kartik\grid\SerialColumn'],
        [
            'attribute' => 'familia',
            'width' => '310px',
            'value' => function ($model, $key, $index, $widget) {
                return $model->familia;
            },
            'filterType' => GridView::FILTER_SELECT2,
            'filter' => ArrayHelper::map(EquipamentoFamilia::find()->orderBy('familia')->asArray()->all(), 'id', 'familia'),
            'filterWidgetOptions' => [
                'pluginOptions' => ['allowClear' => true],
            ],
            'filterInputOptions' => ['placeholder' => 'Any supplier'],
            'group' => true,  // enable grouping
        ],
        [
            'attribute' => 'subfamilia',
            'width' => '250px',
            'value' => function ($model, $key, $index, $widget) {
                /** @var $model EquipamentoFamilia */
                return $model->id;
            },
            'filterType' => GridView::FILTER_SELECT2,
            'filter' => ArrayHelper::map(EquipamentoSubfamilia::find()->orderBy('subfamilia')->asArray()->all(), 'id', 'subfamilia'),
            'filterWidgetOptions' => [
                'pluginOptions' => ['allowClear' => true],
            ],
            'filterInputOptions' => ['placeholder' => 'Any category']
        ],




    ],
]);
?>