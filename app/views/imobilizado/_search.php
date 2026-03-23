<?php

use yii\helpers\Html;
use yii\widgets\ActiveForm;

/* @var $this yii\web\View */
/* @var $model app\models\ImobilizadoSearch */
/* @var $form yii\widgets\ActiveForm */
?>

<div class="imobilizado-search">

    <?php $form = ActiveForm::begin([
        'action' => ['index'],
        'method' => 'get',
        'options' => [
            'data-pjax' => 1
        ],
    ]); ?>

    <?= $form->field($model, 'id') ?>

    <?= $form->field($model, 'nome') ?>

    <?= $form->field($model, 'code_imo') ?>

    <?= $form->field($model, 'descricao') ?>

    <?= $form->field($model, 'data_compra') ?>

    <?php // echo $form->field($model, 'tipo_imobilizado') ?>

    <?php // echo $form->field($model, 'localizacao') ?>

    <?php // echo $form->field($model, 'tipo_estado_conservacao') ?>

    <?php // echo $form->field($model, 'num_serie') ?>

    <?php // echo $form->field($model, 'familia') ?>

    <?php // echo $form->field($model, 'sub_familia') ?>

    <?php // echo $form->field($model, 'observacoes') ?>

    <div class="form-group">
        <?= Html::submitButton(Yii::t('app', 'Search'), ['class' => 'btn btn-primary']) ?>
        <?= Html::resetButton(Yii::t('app', 'Reset'), ['class' => 'btn btn-outline-secondary']) ?>
    </div>

    <?php ActiveForm::end(); ?>

</div>
