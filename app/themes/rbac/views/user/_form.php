<?php
use yii\helpers\Html;
use yii\widgets\ActiveForm;

/* @var $this yii\web\View */
/* @var $form yii\bootstrap4\ActiveForm */
/* @var $model \mdm\admin\models\User */

$this->title = Yii::t('rbac-admin', 'Signup');
$this->params['breadcrumbs'][] = $this->title;
?>
<div class="site-signup">
    <h1>Actualizar Utilizador</h1>

    <p>Por favor insira as seguintes informações para actualizar:</p>
	<?= Html::errorSummary($model)?>
    <div class="row">
        <div class="col-lg-5">
			<?php $form = ActiveForm::begin(['id' => 'form-update']); ?>
			<?= $form->field($model, 'username') ?>
			<?= $form->field($model, 'email') ?>
			<?= $form->field($model, 'password')->passwordInput() ?>
			<?= $form->field($model, 'retypePassword')->passwordInput() ?>
            <div class="form-group">
				<?= Html::submitButton(Yii::t('rbac-admin', 'Update'), ['class' => 'btn btn-primary', 'name' => 'signup-button']) ?>
            </div>
			<?php ActiveForm::end(); ?>
        </div>
    </div>
</div>
