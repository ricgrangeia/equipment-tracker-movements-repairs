<?php

use yii\bootstrap4\ActiveForm;
use yii\helpers\Html;

/* @var $this yii\web\View */
/* @var $model \app\modules\EquipamentoEstado\EquipamentoEstado */
/* @var $form yii\widgets\ActiveForm */
?>

<div class="equipamento-estado-form">

    <?php $form = ActiveForm::begin(); ?>

    <?= $form->field($model, 'estado')->textInput(['maxlength' => true]) ?>

  
	<?php if (!Yii::$app->request->isAjax){ ?>
	  	<div class="form-group">
	        <?= Html::submitButton($model->isNewRecord ? 'Create' : 'Update', ['class' => $model->isNewRecord ? 'btn btn-success' : 'btn btn-primary']) ?>
	    </div>
	<?php } ?>

    <?php ActiveForm::end(); ?>
    
</div>
