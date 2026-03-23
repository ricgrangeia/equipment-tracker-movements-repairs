<?php
use yii\helpers\Html;
use yii\bootstrap4\ActiveForm;
use yii\helpers\ArrayHelper;
use app\models\EquipamentoFamilia;

/* @var $this yii\web\View */
/* @var $model app\models\EquipamentoSubfamilia */
/* @var $form yii\widgets\ActiveForm */
?>

<div class="equipamento-subfamilia-form">

    <?php $form = ActiveForm::begin(); ?>

    <?= $form->field($model, 'familia_id')->dropDownList(ArrayHelper::map(EquipamentoFamilia::find()->all(),'id','familia'), ['id'=>'familia-id']);  ?>

    <?= $form->field($model, 'subfamilia')->textInput(['maxlength' => true]) ?>

  
	<?php if (!Yii::$app->request->isAjax){ ?>
	  	<div class="form-group">
	        <?= Html::submitButton($model->isNewRecord ? 'Create' : 'Update', ['class' => $model->isNewRecord ? 'btn btn-success' : 'btn btn-primary']) ?>
	    </div>
	<?php } ?>

    <?php ActiveForm::end(); ?>
    
</div>
