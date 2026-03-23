<?php
use yii\helpers\Html;
use yii\bootstrap4\ActiveForm;

/* @var $this yii\web\View */
/* @var $form yii\bootstrap4\ActiveForm */
/* @var $model \mdm\admin\models\form\ResetPassword */

$this->title = 'Reset password';
$this->params['breadcrumbs'][] = $this->title;
?>
<div class="login-page">
    <div class="login-box">
        <div class="card card-outline card-primary">
            <div class="card-header text-center">
                <h1><b><?= Yii::$app->name ?></b></h1>
            </div>
            <div class="card-body">
                <p class="login-box-msg">Você está a apenas um passo da sua nova senha, recupere a sua senha agora.</p>
				<?php $form = ActiveForm::begin(['id' => 'reset-password-form']); ?>

				<?= $form->field( $model, 'password', [ 'inputOptions' => [ 'class' => 'form-control', 'placeholder' => 'Password' ]
					, 'template' => '
                        <div class="input-group mb-3">
                          {input} 
                          <div class="input-group-append">
                            <div class="input-group-text">
                              <span class="fas fa-lock"></span>
                            </div>
                          </div>
                          {error}{hint}
                        </div>',
				] )->label( false )->passwordInput() ?>


				<?= $form->field( $model, 'retypePassword', [ 'inputOptions' => [ 'class' => 'form-control', 'placeholder' => 'Confirmar Password' ]
					, 'template' => '
                        <div class="input-group mb-3">
                          {input} 
                          <div class="input-group-append">
                            <div class="input-group-text">
                              <span class="fas fa-lock"></span>
                            </div>
                          </div>
                          {error}{hint}
                        </div>',
				] )->label( false )->passwordInput() ?>
                <div class="row">
                    <div class="form-group">
						<?= Html::submitButton(Yii::t('rbac-admin', 'Gravar'), ['class' => 'btn btn-primary']) ?>
                    </div>
                    <!-- /.col -->
                </div>
				<?php ActiveForm::end(); ?>
                <p class="mt-3 mb-1">
                    <a href="/admin/user/login">Login</a>
                </p>
            </div>
            <!-- /.login-card-body -->
        </div>
    </div>
</div>
