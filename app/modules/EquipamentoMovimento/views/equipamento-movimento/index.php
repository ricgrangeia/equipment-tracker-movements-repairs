<?php

use app\modules\EquipamentoMovimento\EquipamentoMovimentoSearch;
use yii\helpers\Html;
use yii\bootstrap4\Modal;
use kartik\grid\GridView;
use yii2ajaxcrud\ajaxcrud\CrudAsset;


/* @var $this yii\web\View */
/* @var $searchModel EquipamentoMovimentoSearch */
/* @var $dataProvider yii\data\ActiveDataProvider */

$this->title = 'Equipamento Movimentos';
$this->params['breadcrumbs'][] = $this->title;

CrudAsset::register($this);

?>
<div class="equipamento-movimento-index">
    <div id="ajaxCrudDatatable">
        <?=GridView::widget([
            'id'=>'crud-datatable',
            'dataProvider' => $dataProvider,
            'filterModel' => $searchModel,
            'pjax'=>true,
            'columns' => require( __DIR__ . '/_columns.php' ),
            'toolbar'=> [
                ['content'=>
                    Html::a( Yii::t( 'app', 'Movimentar Equipamento' ), [ 'create' ],
						[ 'role' => 'modal-remote', 'title' => Yii::t( 'yii2-ajaxcrud', 'Create New' ) . ' Equipamento Movimentos', 'class' => 'btn btn-outline-primary' ] ) .
					Html::a( '<i class="fa fa-redo"></i>', [ '' ],
						[ 'data-pjax' => 1, 'class' => 'btn btn-outline-success', 'title' => Yii::t( 'yii2-ajaxcrud', 'Reset Grid' ) ] ) .
                    '{toggleData}'.
                    '{export}'
                ],
            ],          
            'striped' => true,
            'condensed' => true,
            'responsive' => true,
            'responsiveWrap' => false,
            'panel' => [
                'type' => 'default', 
                'heading' => '<i class="fa fa-list"></i> <b>'.$this->title.'</b>',
                'before'=>'<em>* '.Yii::t('yii2-ajaxcrud', 'Resize Column').'</em>',
                'after'=> '<div class="clearfix"></div>',
            ]
        ])?>
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
])?>
<?php Modal::end(); ?>
