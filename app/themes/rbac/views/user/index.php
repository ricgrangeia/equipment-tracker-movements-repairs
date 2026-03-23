<?php

use kartik\editable\Editable;
use yii\helpers\Html;
use kartik\grid\GridView;

use mdm\admin\components\Helper;

/* @var $this yii\web\View */
/* @var $searchModel mdm\admin\models\searchs\User */
/* @var $dataProvider yii\data\ActiveDataProvider */

$this->title = Yii::t('rbac-admin', 'Users');
$this->params['breadcrumbs'][] = $this->title;
?>
<div class="user-index">

    <h1><?= Html::encode($this->title) ?></h1>

	<?=
	GridView::widget([
		'dataProvider' => $dataProvider,
		'filterModel' => $searchModel,

		'columns' => [
			['class' => 'yii\grid\SerialColumn'],
			'username',
			'email:email',
			[
				'class' => 'kartik\grid\EditableColumn',
				'filter' => [
					0 => 'Inactive',
					10 => 'Active'
				],
				'attribute' => 'status',
				'pageSummary' => 'Total',
				'vAlign' => 'middle',
				'width' => '210px',
				'value' => function ($model, $key, $index, $widget) {
					if($model->status == 0) return "Inativo";
					return "Ativo";
				},
				'refreshGrid' => true,

				'editableOptions' =>  function ($model, $key, $index) {
					return [
						'asPopover' => false,
						'header' => 'status',
						'inputType' => Editable::INPUT_DROPDOWN_LIST,
						'data' => ['10' => 'Activo', '0' => 'Inactivo'],
						'options' => ['class'=>'form-control', 'prompt'=>'Select status...'],
						'formOptions' => [ 'action' => ['user/editable-update']],
					];
				}
			],
			[
				'class' => 'yii\grid\ActionColumn',
				'template' => Helper::filterActionColumn(['view', 'activate', 'delete']),
				'buttons' => [
					'activate' => function($url, $model) {
						if ($model->status == 10) {
							return '';
						}
						$options = [
							'title' => Yii::t('rbac-admin', 'Activate'),
							'aria-label' => Yii::t('rbac-admin', 'Activate'),
							'data-confirm' => Yii::t('rbac-admin', 'Are you sure you want to activate this user?'),
							'data-method' => 'post',
							'data-pjax' => '0',
						];
						return Html::a('<span class="glyphicon glyphicon-ok"></span>', $url, $options);
					}
				]
			],
		],
		'toolbar'=> [
			['content'=>
				Html::a(Yii::t('yii2-ajaxcrud', 'Create New'), ['user/signup'],
					['role'=>'modal-remote','title'=> Yii::t('yii2-ajaxcrud', 'Create New').' Utilizador','class'=>'btn btn-outline-primary']).
				Html::a('<i class="fa fa-redo"></i>', [''],
					['data-pjax'=>1, 'class'=>'btn btn-outline-success', 'title' => Yii::t('yii2-ajaxcrud', 'Reset Grid')]).
				'{toggleData}'.
				'{export}'
			],
		],
		'panel' => [
			'type' => 'default',
			'heading' => '<i class="fa fa-list"></i> <b>'.$this->title.'</b>',
			'before'=>'<em>* '.Yii::t('yii2-ajaxcrud', 'Resize Column').'</em>',
		]
	]);
	?>
</div>
