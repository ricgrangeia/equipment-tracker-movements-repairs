<?php

use app\modules\Equipamento\Domain\Entity\Equipamento;
use kartik\detail\DetailView;
use kartik\grid\GridView;
use yii\helpers\Html;

/** @var Equipamento $model */
?>

<body>


<?= DetailView::widget( [
	'model' => $model,
	'bordered' => false,
	'condensed' => false,
	'responsive' => false,
	'hAlign' => 'left',
	'vAlign' => 'middle',
	'viewOptions' => [ 'style' => 'font-size=10pt;' ],
	'attributes' => [
		[
			'group' => true,
			'label' => 'Identificação',
			//            'rowOptions' => ['class' => 'table-info']
		],
		[
			'columns' => [
				[
					'attribute' => 'num_interno',
					'valueColOptions' => [ 'style' => 'width:240px' ],
				],
				[
					'attribute' => 'data',
					'label' => 'Data Compra',
					'valueColOptions' => [ 'style' => 'width:240px' ],
				],
			],
		],
		[
			'columns' => [
				[
					'attribute' => 'equipamento',
					'valueColOptions' => [ 'style' => 'width:240px' ],
				],
				[
					'attribute' => 'descricao',
					'valueColOptions' => [ 'style' => 'width:240px' ],
				],

			],
		],
		[
			'columns' => [
				[
					'attribute' => 'caixa',
					'format' => 'raw',
					'value' => ( $model->caixa ) ? 'Sim' : 'Não',
					'valueColOptions' => [ 'style' => 'width:240px' ],
				],
				[
					'attribute' => 'estado_id',
					'format' => 'raw',
					'value' => $model->estado->estado,
					'valueColOptions' => [ 'style' => 'width:240px' ],
				],
			],
		],
		[
			'columns' => [
				[
					'attribute' => 'empresa_id',
					'format' => 'raw',
					'value' => $model->empresa->empresa,
					'valueColOptions' => [ 'style' => 'width:240px' ],
				],
				[
					'attribute' => 'num_serie',
					'valueColOptions' => [ 'style' => 'width:240px' ],
				],
			],
		],
		[
			'columns' => [
				[
					'attribute' => 'familia_id',
					'format' => 'raw',
					'value' => $model->familia->familia,
					'valueColOptions' => [ 'style' => 'width:240px' ],
				],
				[
					'attribute' => 'sub_familia_id',
					'format' => 'raw',
					'value' => $model->sub_familia_id,
					'valueColOptions' => [ 'style' => 'width:240px' ],
				],
			],
		],
		[
			'columns' => [
				[
					'attribute' => 'acessorios',
					'valueColOptions' => [ 'style' => 'width:240px' ],
				],

				[
					'attribute' => 'fornecedor',
					'valueColOptions' => [ 'style' => 'width:240px' ],
				],
			],
		],
		[
			'columns' => [
				[
					'attribute' => 'modelo',
					'valueColOptions' => [ 'style' => 'width:240px' ],
				],
				[
					'attribute' => 'marca',
					'valueColOptions' => [ 'style' => 'width:240px' ],
				],
			],
		],
		[
			'columns' => [
				[
					'attribute' => 'observacoes',
					'displayOnly' => true,
				],
			],
		],
		[
			'columns' => [
				[
					'attribute' => 'image_manager_id_avatar',
					'value' => ' <img src="https://equipamentos_demo.appa8.com/assets/images/7d/7df589_AQ285II.jpg" alt="Image Description" width="200" height="150">',
				],
			],
		],



	],

] ) ?>


<?= GridView::widget( [
	'id' => 'crud-datatable',
	'caption' => "<b>Movimentos do Equipamento</b>",
	'dataProvider' => $dataProviderEqMov,
	'columns' => require( Yii::getAlias('@app').'/modules/EquipamentoMovimento/views/equipamento-movimento/_columnsReport.php' ),
	'striped' => true,
	'condensed' => true,
	'responsive' => true,
	'responsiveWrap' => false,
	'summary' => '',
	'tableOptions' => [ 'style' => 'font-size:9pt;' ],


] ) ?>

<?= GridView::widget( [
	'id' => 'crud-datatable',
	'caption' => "<b>Reparações do Equipamento</b>",
	'dataProvider' => $dataProviderEqRep,
	'columns' => require( Yii::getAlias('@app').'/views/equipamento-reparacao/_columnsReport.php' ),
	'striped' => true,
	'condensed' => true,
	'responsive' => true,
	'responsiveWrap' => false,
	'summary' => '',
	'tableOptions' => [ 'style' => 'font-size:9pt;' ],


] ) ?>

</body>