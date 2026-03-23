<?php
use yii\helpers\Html;
use yii\bootstrap4\ActiveForm;

/* @var $this yii\web\View */
/* @var $form yii\bootstrap4\ActiveForm */
/* @var $model \mdm\admin\models\form\PasswordResetRequest */

$this->title = 'Request password reset';
$this->params['breadcrumbs'][] = $this->title;
?>
<link rel="stylesheet" href="/css/adminlte.min.css">
<div class="login-page">
<div class="login-box">
    <div class="card card-outline card-primary">
        <div class="card-header text-center">
            <h1><b><?= Yii::$app->name ?></b></h1>
        </div>
        <div class="card-body">
            <p class="login-box-msg">Você esqueceu a sua senha? Aqui pode facilmente recuperar uma nova senha.</p>
			<?php $form = ActiveForm::begin(['id' => 'request-password-reset-form']); ?>

			<?= $form->field( $model, 'email', [ 'inputOptions' => [ 'class' => 'form-control', 'placeholder' => 'Email' ]
				, 'template' => '
                        <div class="input-group mb-3">
                          {input} 
                          <div class="input-group-append">
                            <div class="input-group-text">
                              <span class="fas fa-envelope"></span>
                            </div>
                          </div>
                          {error}{hint}
                        </div>',
			] )->label( false ) ?>


                <div class="row">
                    <div class="form-group">
						<?= Html::submitButton(Yii::t('rbac-admin', 'Enviar'), ['class' => 'btn btn-primary']) ?>
                    </div>
                    <!-- /.col -->
                </div>
			<?php ActiveForm::end(); ?>
            <p class="mt-3 mb-1">
				<?= Html::a( 'Login', [ '/admin/user/login' ] ) ?>
            </p>
        </div>
        <!-- /.login-card-body -->
    </div>
</div>
</div>
