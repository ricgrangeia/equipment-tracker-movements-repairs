<?php

use yii\helpers\Html;
use yii\bootstrap4\ActiveForm;

/* @var $this yii\web\View */
/* @var $form yii\bootstrap\ActiveForm */
/* @var $model mdm\admin\models\form\ChangePassword */

$this->title = Yii::t( 'rbac-admin', 'Change Password' );
$this->params['breadcrumbs'][] = $this->title;
?>
<div class="login-page">
    <div class="login-box">
        <div class="card card-outline card-primary">
            <div class="card-header text-center">
                <h1><b><?= Yii::$app->name ?></b></h1>
            </div>
            <div class="card-body">
                <p class="login-box-msg">Altere a sua senha.</p>
				<?php $form = ActiveForm::begin( [ 'id' => 'form-change' ] ); ?>

				<?= $form->field( $model, 'oldPassword', [ 'inputOptions' => [ 'class' => 'form-control', 'placeholder' => Yii::t( 'rbac-admin', 'Old Password' ) ]
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
				<?= $form->field( $model, 'newPassword', [ 'inputOptions' => [ 'class' => 'form-control', 'placeholder' => Yii::t( 'rbac-admin', 'New Password' ) ]
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


				<?= $form->field( $model, 'retypePassword', [ 'inputOptions' => [ 'class' => 'form-control', 'placeholder' => Yii::t( 'rbac-admin', 'Confirm Password' ) ]
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
						<?= Html::submitButton( Yii::t( 'rbac-admin', 'Change' ), [ 'class' => 'btn btn-primary', 'name' => 'change-button' ] ) ?>
                    </div>
                    <!-- /.col -->
                </div>
				<?php ActiveForm::end(); ?>
            </div>
            <!-- /.login-card-body -->
        </div>
    </div>
</div>
