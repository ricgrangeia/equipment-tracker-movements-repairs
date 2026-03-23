<?php

use app\modules\EquipamentoMovimentoTipo\EquipamentoMovimentoTipo;
use yii\helpers\Html;
use yii\bootstrap4\ActiveForm;

/* @var $this yii\web\View */
/* @var $model EquipamentoMovimentoTipo */
/* @var $form yii\widgets\ActiveForm */
?>

<div class="equipamento-movimento-tipo-form">

    <?php $form = ActiveForm::begin(); ?>

    <?= $form->field($model, 'tipo_movimento')->textInput(['maxlength' => true]) ?>

  
	<?php if (!Yii::$app->request->isAjax){ ?>
	  	<div class="form-group">
	        <?= Html::submitButton($model->isNewRecord ? 'Create' : 'Update', ['class' => $model->isNewRecord ? 'btn btn-success' : 'btn btn-primary']) ?>
	    </div>
	<?php } ?>

    <?php ActiveForm::end(); ?>
    
</div>
