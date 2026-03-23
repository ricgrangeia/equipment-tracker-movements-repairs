<?php
use yii\helpers\Html;
use yii\bootstrap4\ActiveForm;
use kartik\file\FileInput;
use yii\helpers\Url;

/* @var $this yii\web\View */
/* @var $model app\models\Imobilizado */
/* @var $form yii\widgets\ActiveForm */
?>

<div class="imobilizado-form">

    <?php $form = ActiveForm::begin(['options' => ['enctype' => 'multipart/form-data']]); ?>

    <?= $form->field($model, 'nome')->textInput(['maxlength' => true]) ?>

    <?= $form->field($model, 'code_imo')->textInput(['maxlength' => true]) ?>


<!--    --><?//=  FileInput::widget([
//        'name' => 'attachment_48[]',
//        'options'=>[
//            'multiple'=>true,
//            'accept' => 'image/*',
//        ],
//        'pluginOptions' => [
//            'uploadUrl' => Url::to(['/img-table/upload']),
//            'uploadExtraData' => [
//                'album_id' => 20,
//                'cat_id' => 'Nature'
//            ],
//            'maxFileCount' => 10
//        ]
//    ]);
//    ?>
<!---->
<!--    --><?//= Html::fileInput('dasdas', 'fffff', ['multiple' => true]); ?>

    <?= $form->field($model, 'descricao')->textarea(['rows' => 6]) ?>

    <?= $form->field($model, 'data_compra')->textInput() ?>

    <?= $form->field($model, 'tipo_imobilizado')->textInput() ?>

    <?= $form->field($model, 'localizacao')->textInput(['maxlength' => true]) ?>

    <?= $form->field($model, 'tipo_estado_conservacao')->textInput() ?>

    <?= $form->field($model, 'num_serie')->textInput(['maxlength' => true]) ?>

    <?= $form->field($model, 'familia')->textInput() ?>

    <?= $form->field($model, 'sub_familia')->textInput() ?>

    <?= $form->field($model, 'observacoes')->textarea(['rows' => 6]) ?>

  
	<?php if (!Yii::$app->request->isAjax){ ?>
	  	<div class="form-group">
	        <?= Html::submitButton($model->isNewRecord ? Yii::t('app', 'Create') : Yii::t('app', 'Update'), ['class' => $model->isNewRecord ? 'btn btn-success' : 'btn btn-primary']) ?>
	    </div>
	<?php } ?>

    <?php ActiveForm::end(); ?>
    
</div>
