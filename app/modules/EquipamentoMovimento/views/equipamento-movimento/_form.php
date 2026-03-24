<?php


use app\models\EquipamentoReparacao;
use app\modules\Equipamento\Domain\Entity\Equipamento;
use app\modules\EquipamentoMovimento\EquipamentoMovimento;
use kartik\date\DatePicker;
use kartik\select2\Select2;
use yii\helpers\ArrayHelper;
use yii\helpers\Html;
use yii\bootstrap4\ActiveForm;
use kartik\depdrop\DepDrop;
use yii\helpers\Url;


/* @var $this yii\web\View */
/* @var $model EquipamentoMovimento */
/* @var $form yii\widgets\ActiveForm */
?>

<div class="equipamento-movimento-form">

	<?php $form = ActiveForm::begin(); ?>

	<?php /** @var EquipamentoMovimento $model */ ?>
	<?php if ( $model->isNewRecord ) { ?>

		<?= $form->field( $model, 'data' )->widget( DatePicker::class, [
			'options' => [ 'placeholder' => 'Escolher data ...' ],
			'pluginOptions' => [
				'autoclose' => true,
				'todayHighlight' => true,
			],
		] ); ?>

	<?php } ?>


	<?php if ( $model->isNewRecord ) { ?>
		<?php
		# Vai buscar os Equipamentos que não regressaram de Reparação, para não serem escolhidos
		$equipamentosEmReparacao = ArrayHelper::map( EquipamentoReparacao::find()->where( "data_recepcao IS NULL OR data_recepcao = ''" )->all(), 'equipamento_id', 'equipamento_id' ); ?>

		<?= $form->field( $model, 'equipamento_id' )->widget( Select2::class, [
			//            'data' => ArrayHelper::map(\app\modules\Equipamento\Domain\Entity\Equipamento::find()->where("estado_id <> 3")->andWhere(['not in', 'id', $equipamentosEmReparacao])->all(), 'id', function($model) {
			'data' => ArrayHelper::map( Equipamento::find()->all(), 'id', function ( $model ) {

				return $model['num_interno'] . ' - ' . $model['equipamento'] . ' - ' . $model['marca']. ' - ' . $model['acessorios'];
			} ),

			'options' => [ 'id' => 'equipamento-id', 'placeholder' => 'Escolher equipamento...' ],
			'pluginOptions' => [
				'allowClear' => true,

			],
			'pluginEvents' => [
				"change" => "function() { 
               
                  var equipamento_id = $('#equipamento-id').val();
                  
                  console.log(equipamento_id);
                 var ajaxUrl = '/EquipamentoMovimento/equipamento-movimento/get-observacao';
                
                     $.ajax({
                    url: ajaxUrl,
                    data: {
                         equipamento_id  : equipamento_id,
                    },
                    type: 'get',
                    cache: false,
                    success: function(msg){
                             $('#equipamentomovimento-observacoes').text(msg);
                    }
                });
                }",
			],
		] );

		?>


	<?php } ?>

	<?= Html::textarea( 'descricao-equipamento', '', [ 'id' => 'descricao-equipamento', 'placeholder'=>'Descrição Equipamento', 'class' => 'form-control', 'rows' => 3, 'readonly' => true
    ] ) ?>

    <script>

        //On equipamento-id change update descricao-equipamento
        $('#equipamento-id').on('change', function () {
            var equipamento_id = $('#equipamento-id').val();
            console.log(equipamento_id);
            var ajaxUrl = '/Equipamento/equipamento/get-descricao';
            $.ajax({
                url: ajaxUrl,
                data: {
                        id: equipamento_id,
                },
                type: 'get',
                cache: false,
                success: function (msg) {
                    $('#descricao-equipamento').text(msg);
                }
            });
        });

    </script>

	<?= Html::textarea( 'acessorios-equipamento', '', [ 'id' => 'acessorios-equipamento', 'placeholder'=>'Acessórios Equipamento', 'class' => 'form-control', 'rows' => 3, 'readonly' =>
        true ] ) ?>

    <script>

        //On equipamento-id change update descricao-equipamento
        $('#equipamento-id').on('change', function () {
            var equipamento_id = $('#equipamento-id').val();
            console.log(equipamento_id);
            var ajaxUrl = '/Equipamento/equipamento/get-acessorios';
            $.ajax({
                url: ajaxUrl,
                data: {
                    id: equipamento_id,
                },
                type: 'get',
                cache: false,
                success: function (msg) {
                    $('#acessorios-equipamento').text(msg);
                }
            });
        });

    </script>

	<?= Html::textarea( 'observacoes-equipamento', '', [ 'id' => 'observacoes-equipamento', 'placeholder'=>'Observações Equipamento', 'class' => 'form-control', 'rows' => 3, 'readonly' =>
		true ] ) ?>

    <script>

        //On equipamento-id change update descricao-equipamento
        $('#equipamento-id').on('change', function () {
            var equipamento_id = $('#equipamento-id').val();
            console.log(equipamento_id);
            var ajaxUrl = '/Equipamento/equipamento/get-observacoes';
            $.ajax({
                url: ajaxUrl,
                data: {
                        id: equipamento_id,
                },
                type: 'get',
                cache: false,
                success: function (msg) {
                    $('#observacoes-equipamento').text(msg);
                }
            });
        });

    </script>

	<?php if ( $model->isNewRecord ) { ?>
        

		<?= $form->field( $model, 'tipo_movimento_id' )->widget( DepDrop::class, [
			'type' => DepDrop::TYPE_SELECT2,
			// 'data' => [ $model->tipo_movimento_id => $model->tipo_movimento_id ],
			'options' => [ 'id' => 'tipo-movimento-id' ],
			'pluginOptions' => [
				'depends' => [ 'equipamento-id' ],
				'placeholder' => 'Escolher tipo movimento...',
				'url' => Url::to( [ '/EquipamentoMovimentoTipo/equipamento-movimento-tipo/movimento-tipo' ] ),
				'initialize' => true,
				'params' => [ $model->equipamento_id ],
			],
		] );
		?>
	<?php } ?>
	<?php if ( $model->isNewRecord ) { ?>
       

		<?= $form->field( $model, 'destino_id' )->widget( DepDrop::class, [
			'type' => DepDrop::TYPE_SELECT2,
			// 'data' => [ $model->tipo_movimento_id => $model->tipo_movimento_id ],
			'options' => [ 'id' => 'destino-id' ],
			'pluginOptions' => [
				'depends' => [ 'equipamento-id', 'tipo-movimento-id' ],
				'placeholder' => 'Escolher destino...',
				'url' => Url::to( [ '/funcionario/destinos-permitidos' ] ),
				'initialize' => true,

			],
		] );
		?>

	<?php } else { ?>


		<?php if ( $model->isLastMovimento() ) { ?>
              <!-- <? $form->field($model, 'destino_id')->dropDownList(ArrayHelper::map(\app\models\Funcionario::find()->orderBy(['nome'=>SORT_ASC])->all(), 'id', 'nome')); ?> -->


            <!-- <? Html::hiddenInput('equipamento-id', $model->equipamento_id, ['id' => 'equipamento-id']); ?> -->
            
            
            <!-- <? $form->field($model, 'destino_id')->widget(DepDrop::classname(), [
			            'type' => DepDrop::TYPE_SELECT2,
			            'data' => [$model->tipo_movimento_id => $model->tipo_movimento_id],
			            'options' => ['id' => 'destino-id'],
			            'pluginOptions' => [
			                'depends' => ['equipamento-id'],
			                'placeholder' => 'Escolher destino...',
			                'url' => Url::to(['funcionario/destinos-permitidos']),
			                'initialize' => true,
			                'params' => [$model->equipamento_id, $model->destino_id]
			            ]
			        ]);
			        
            ?> -->

		<?php }
	} ?>

	<?= $form->field( $model, 'observacoes' )->textarea( [ 'rows' => 6 ] ) ?>


	<?php if ( !Yii::$app->request->isAjax ) { ?>
        <div class="form-group">
			<?= Html::submitButton( $model->isNewRecord ? 'Create' : 'Update', [ 'class' => $model->isNewRecord ? 'btn btn-success' : 'btn btn-primary' ] ) ?>
        </div>
	<?php } ?>

	<?php ActiveForm::end(); ?>

</div>
