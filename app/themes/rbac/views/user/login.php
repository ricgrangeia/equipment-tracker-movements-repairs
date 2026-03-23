<?php

use yii\helpers\Html;
use yii\bootstrap4\ActiveForm;

/* @var $this yii\web\View */
/* @var $form yii\bootstrap4\ActiveForm */
/* @var $model \mdm\admin\models\form\Login */


$this->title = Yii::t( 'rbac-admin', 'Login' );
$this->params['breadcrumbs'][] = $this->title;

?>
<link rel="stylesheet" href="/css/adminlte.min.css">
<div class="login-page">


    <div class="login-box">
        <!-- /.login-logo -->
        <div class="card card-outline card-primary">
            <div class="card-header text-center">
                <h1><?= Html::encode( $this->title ) ?> <b><?= Yii::$app->name ?></h1>
            </div>
            <div class="card-body">
                <p class="login-box-msg">Faça login para iniciar a sua Sessão</p>

				<?php $form = ActiveForm::begin( [ 'id' => 'login-form' ] ); ?>

				<?= $form->field( $model, 'username', [ 'inputOptions' => [ 'class' => 'form-control', 'placeholder' => 'Username' ]
					, 'template' => '
                        <div class="input-group mb-3">
                          {input} 
                          <div class="input-group-append">
                            <div class="input-group-text">
                              <span class="fas fa-user"></span>
                            </div>
                          </div>
                          {error}{hint}
                        </div>',
				] )->label( false ) ?>

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
                <div class="row">
                    <div class="col-8">
                        <div class="icheck-primary">
							<?= $form->field( $model, 'rememberMe' )->checkbox()->label("Lembrar Dados") ?>
                        </div>
                    </div>
                    <!-- /.col -->
                    <div class="col-4">
                        <div class="form-group">
							<?= Html::submitButton( Yii::t( 'rbac-admin', 'Login' ), [ 'class' => 'btn btn-primary float-right', 'name' => 'login-button' ] ) ?>
                        </div>
                    </div>
                    <!-- /.col -->
                </div>
                <div style="color:#999;margin:1em 0">
					<?= Html::a( 'Esqueci-me da Senha. Recuperar!', [ 'user/request-password-reset' ] ) ?>
                </div>

				<?php ActiveForm::end(); ?>

            </div>
            <!-- /.card-body -->
        </div>
        <!-- /.card -->
    </div
</div>