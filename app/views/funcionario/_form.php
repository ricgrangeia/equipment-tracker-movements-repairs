<?php

use kartik\widgets\SwitchInput;
use yii\helpers\ArrayHelper;
use yii\helpers\Html;
use yii\bootstrap4\ActiveForm;


/* @var $this yii\web\View */
/* @var $model app\models\Funcionario */
/* @var $form kartik\form\ActiveForm */
?>

<div class="funcionario-form">

    <?php $form = ActiveForm::begin(); ?>

    <?= $form->field($model, 'ativo')->widget(SwitchInput::class, [
        'pluginOptions'=>[
            'onText'=>'Sim',
            'offText'=>'Não',
            'onColor' => 'success',
            'offColor' => 'danger',
        ]
    ]); ?>

    <?= $form->field($model, 'nome')->textInput(['maxlength' => true]) ?>

    <?= $form->field($model, 'localization')->dropDownList($data = \app\models\Localization::getLocalizations() ) ?>

    <?= $form->field($model, 'tipo')->dropDownList(ArrayHelper::map(\app\models\FuncionarioTipo::find()->asArray()->all(), 'tipo', 'tipo')); ?>

  
	<?php if (!Yii::$app->request->isAjax){ ?>
	  	<div class="form-group">
	        <?= Html::submitButton($model->isNewRecord ? 'Create' : 'Update', ['class' => $model->isNewRecord ? 'btn btn-success' : 'btn btn-primary']) ?>
	    </div>
	<?php } ?>

    <?php ActiveForm::end(); ?>
    
</div>
