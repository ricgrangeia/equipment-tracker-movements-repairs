<?php


use yii\helpers\Html;
use kartik\form\ActiveForm;


/* @var $this yii\web\View */
/* @var $model app\modules\Equipamento\Equipamento */
/* @var $form yii\widgets\ActiveForm */


$uploadModel = new \app\models\ImgTable();
?>

<div class="equipamento-form">

    <?php $form = ActiveForm::begin(['options' => ['enctype' => 'multipart/form-data']]); ?>

<!--    --><?//= $form->field($model, 'num_interno')->textInput(['maxlength' => true]) ?>
<!---->
<!--    --><?//= $form->field($model, 'equipamento')->textInput(['maxlength' => true]) ?>
<!---->
<!--    --><?//= $form->field($model, 'descricao')->textInput(['maxlength' => true]) ?>
<!---->
<!--    --><?//= $form->field($model, 'data')->widget(DatePicker::classname(), [
//        'options' => ['placeholder' => 'Escolher data ...'],
//        'pluginOptions' => [
//            'autoclose'=>true
//        ]
//    ]); ?>


<!---->
<!--    --><?//= $form->field($model, 'num_serie')->textInput(['maxlength' => true]) ?>
<!---->
<!--    --><?//= $form->field($model, 'marca')->textInput() ?>
<!---->
<!--    --><?//= $form->field($model, 'modelo')->textInput() ?>
<!---->
<!--    --><?//= $form->field($model, 'estado_id')->dropDownList(ArrayHelper::map(EquipamentoEstado::find()->all(),'id','estado'), ['id'=>'estado-id']);  ?>
<!---->
<!--    --><?//= $form->field($model, 'caixa')->checkbox() ?>
<!---->
<!--    --><?//= $form->field($model, 'empresa_id')->dropDownList(ArrayHelper::map(Empresa::find()->all(),'id','empresa'), ['id'=>'empresa-id']);  ?>
<!---->
<!--    --><?//= $form->field($model, 'familia_id')->dropDownList(ArrayHelper::map(EquipamentoFamilia::find()->all(),'id','familia'), ['id'=>'familia-id', 'prompt'=>'Escolher Familia...']);  ?>
<!---->
<!--    --><?//= $form->field($model, 'sub_familia_id')->widget(DepDrop::classname(), [
//        'data' => [$model->sub_familia_id=>$model->sub_familia_id],
//        'options'=>['id'=>'subfamilia-id'],
//        'pluginOptions'=>[
//            'depends'=>['familia-id'],
//            'placeholder'=>'Escolher Sub-Familia...',
//            'url'=>Url::to(['/equipamento-subfamilia/sub-familia'])
//        ]
//    ]);
//    ?>


<!--   --><?//=
//    $form->field($model, 'sub_familia_id')->widget(DepDrop::classname(), [
//    'type' => DepDrop::TYPE_SELECT2,
//    'data' => \yii\helpers\ArrayHelper::map(EquipamentoFamilia::find()->all()),
//    'options' => ['id' => 'subfamilia-id', 'placeholder' => 'Select ...'],
//    'select2Options' => ['pluginOptions' => ['allowClear' => true]],
//    'pluginOptions' => [
//    'depends' => ['familia-id'],
//    'url' => Url::to(['/equipamento-subfamilia/sub-familia']),
//    'params' => ['input-type-1', 'input-type-2']
//    ]
//    ]);
//    ?>

<!--    --><?//= $form->field($model, 'familia_id')->textInput() ?>
<!---->
<!--    --><?//= $form->field($model, 'sub_familia_id')->textInput() ?>

    <?= $form->field($model, 'acessorios')->textInput(['maxlength' => true]) ?>

    <?= $form->field($model, 'fornecedor')->textInput() ?>

    <?= $form->field($model, 'observacoes')->textarea(['rows' => 6]) ?>

  
	<?php if (!Yii::$app->request->isAjax){ ?>
	  	<div class="form-group">
	        <?= Html::submitButton($model->isNewRecord ? 'Create' : 'Update', ['class' => $model->isNewRecord ? 'btn btn-success' : 'btn btn-primary']) ?>
	    </div>
	<?php } ?>

    <?php ActiveForm::end(); ?>
    
</div>
