<?php

use app\models\EquipamentoFamilia;
use app\models\Localization;
use app\modules\Empresa\Empresa;
use app\modules\Equipamento\Domain\Entity\Equipamento;
use app\modules\EquipamentoEstado\EquipamentoEstado;
use kartik\date\DatePicker;
use kartik\depdrop\DepDrop;
use kartik\form\ActiveForm;
use kartik\widgets\Select2;
use petersonsilvadejesus\imagemanager\components\ImageManagerInputWidget;
use yii\helpers\ArrayHelper;
use yii\helpers\Html;
use yii\helpers\Url;

/* @var $this yii\web\View */
/* @var $model app\modules\Equipamento\Equipamento */
/* @var $form yii\widgets\ActiveForm */


?>

<div class="equipamento-form">

	<?php $form = ActiveForm::begin( [ 'options' => [ 'enctype' => 'multipart/form-data' ] ] ); ?>



	<?= $form->field( $model, 'image_manager_id_avatar' )->widget( ImageManagerInputWidget::class, [
		'aspectRatio' => ( 16 / 9 ), //set the aspect ratio
		'cropViewMode' => 1, //crop mode, option info: https://github.com/fengyuanchen/cropper/#viewmode
		'showPreview' => true, //false to hide the preview
		'showDeletePickedImageConfirm' => true, //on true show warning before detach image
	] ); ?>


	<?php if ( $model->isNewRecord ) { ?>
		<?= $form->field( $model, 'num_interno' )->widget( Select2::class, [
			'data' => ArrayHelper::map( Equipamento::find()->all(), 'id', function ( $model ) {

				return $model['num_interno'] . ' - ' . $model['equipamento'] . ' - ' . $model['marca'];
			} ),
			'options' => [ 'id' => 'equipamento-id', 'placeholder' => 'Escolher Num. Interno para equipamento...' ],
			'pluginOptions' => [
				'allowClear' => true,
				'multiple' => false, // Allow only one selection
				'tags' => true, // Enable the tags feature
			],

		] ); ?>

	<?php } else { ?>

		<?= $form->field( $model, 'num_interno' )->textInput( [ 'maxlength' => true ] ) ?>

	<?php } ?>

	<?= $form->field( $model, 'equipamento' )->textInput( [ 'maxlength' => true ] ) ?>

	<?= $form->field( $model, 'descricao' )->textInput( [ 'maxlength' => true ] ) ?>

	<?= $form->field( $model, 'data' )->widget( DatePicker::class, [
		'options' => [ 'placeholder' => 'Escolher data ...' ],
		'pluginOptions' => [
			'autoclose' => true,
			'todayHighlight' => true,
		],
	] ); ?>



	<?= $form->field( $model, 'num_serie' )->textInput( [ 'maxlength' => true ] ) ?>

	<?= $form->field( $model, 'marca' )->textInput() ?>

	<?= $form->field( $model, 'modelo' )->textInput() ?>

	<?= $form->field( $model, 'estado_id' )->dropDownList( ArrayHelper::map( EquipamentoEstado::find()->all(), 'id', 'estado' ), [ 'id' => 'estado-id', 'prompt' => 'Escolher Estado...' ] ); ?>

	<?= $form->field( $model, 'caixa' )->checkbox() ?>

	<?= $form->field( $model, 'empresa_id' )->dropDownList( ArrayHelper::map( Empresa::find()->all(), 'id', 'empresa' ), [ 'id' => 'empresa-id', 'prompt' => 'Escolher Empresa...' ] ); ?>

	<?php //= $form->field($model, 'localization_id')->dropDownList(ArrayHelper::map( Localization::find()->all(), 'id', 'localization'), ['id' => 'localization_id', 'prompt' => 'Escolher Localização Inicial...']); ?>

	<?= $form->field( $model, 'familia_id' )->dropDownList( ArrayHelper::map( EquipamentoFamilia::find()->all(), 'id', 'familia' ), [ 'id' => 'familia-id', 'prompt' => 'Escolher Familia...' ] ); ?>

	<?= $form->field( $model, 'sub_familia_id' )->widget( DepDrop::class, [
		'data' => [ $model->sub_familia_id => $model->sub_familia_id ],
		'options' => [ 'id' => 'subfamilia-id' ],
		'pluginOptions' => [
			'depends' => [ 'familia-id' ],
			'placeholder' => 'Escolher Sub-Familia...',
			'url' => Url::to( [ '/equipamento-subfamilia/sub-familia' ] ),
		],
	] );
	?>


	<?= $form->field( $model, 'acessorios' )->textarea( [ 'rows' => 6 ] ) ?>

	<?= $form->field( $model, 'fornecedor' )->textInput() ?>

	<?= $form->field( $model, 'observacoes' )->textarea( [ 'rows' => 6 ] ) ?>


	<?php if ( !Yii::$app->request->isAjax ) { ?>
        <div class="form-group">
			<?= Html::submitButton( $model->isNewRecord ? 'Create' : 'Update', [ 'class' => $model->isNewRecord ? 'btn btn-success' : 'btn btn-primary' ] ) ?>
        </div>
	<?php } ?>

	<?php ActiveForm::end(); ?>

</div>

<script>
    $('{modal}').on('hidden.bs.modal', function (e) {
        $('body').addClass('modal-open');
    })
    ';
</script>