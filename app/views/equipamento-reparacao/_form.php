<?php

use yii\helpers\Html;
use yii\bootstrap4\ActiveForm;
use yii\helpers\ArrayHelper;
use app\modules\Equipamento\Domain\Entity\Equipamento;
use kartik\widgets\Typeahead;
use kartik\select2\Select2;
use app\models\EquipamentoMovimentoTipo;
use kartik\date\DatePicker;
use kartik\depdrop\DepDrop;
use yii\helpers\Url;

/* @var $this yii\web\View */
/* @var $model app\models\EquipamentoReparacao */
/* @var $form yii\widgets\ActiveForm */
?>

<div class="equipamento-reparacao-form">

    <?php $form = ActiveForm::begin(); ?>

    <?= $form->field($model, 'equipamento_id')->widget(\kartik\select2\Select2::class, [
        'data' => ArrayHelper::map(\app\modules\Equipamento\Domain\Entity\Equipamento::find()->all(), 'id', function ($model) {
            return $model['num_interno'] . ' - ' . $model['equipamento'] . ' - ' . $model['marca'];
        }),
        'options' => ['placeholder' => 'Escolher equipamento...'],
        'pluginOptions' => [
            'allowClear' => true,
        ],
    ]);
    ?>


    <!-- <?= $form->field($model, 'equipamento_id')->widget(Select2::class, [
                'data' => ArrayHelper::map(\app\modules\Equipamento\Domain\Entity\Equipamento::find()->all(), 'id', function ($model) {
                    return $model['num_interno'] . ' - ' . $model['equipamento'] . ' - ' . $model['marca'];
                }),

                'options' => ['id' => 'equipamento-id', 'placeholder' => 'Escolher equipamento...'],
                'pluginOptions' => [
                    'allowClear' => true

                ],
            ]);

            ?>

    <?= $form->field($model, 'equipamento_id')->widget(Typeahead::class, [
        'options' => ['placeholder' => 'Escreva algo ...'],
        'pluginOptions' => ['highlight' => true],
        'dataset' => [
            [
                'local' => ArrayHelper::getColumn(\app\models\EquipamentoReparacao::find()->select('entidade_reparadora')->distinct()->asArray()->all(), 'entidade_reparadora'),
                'limit' => 10
            ]
        ]
    ]); ?>


    <?= $form->field($model, 'entidade_reparadora')->textInput(['maxlength' => true]) ?>

    <?php var_dump(ArrayHelper::getColumn(\app\models\EquipamentoReparacao::find()->select('entidade_reparadora')->distinct()->asArray()->all(), 'entidade_reparadora')); ?> -->

    <?= $form->field($model, 'entidade_reparadora')->widget(Typeahead::class, [
        'options' => ['placeholder' => 'Escreva algo ...'],
        'pluginOptions' => ['highlight' => true],
        'dataset' => [
            [
                'local' => ArrayHelper::getColumn(\app\models\EquipamentoReparacao::find()->select('entidade_reparadora')->distinct()->asArray()->all(), 'entidade_reparadora'),
                'limit' => 10
            ]
        ]
    ]); ?>

    <?= $form->field($model, 'data_envio')->widget(\kartik\date\DatePicker::class, [
        'options' => ['placeholder' => 'Escolher data ...'],
        'pluginOptions' => [
            'autoclose' => true,
            'todayHighlight' => true,
            'format' => 'dd-mm-yyyy',
        ]
    ]); ?>

    <?= $form->field($model, 'data_recepcao')->widget(\kartik\date\DatePicker::class, [
        'options' => ['placeholder' => 'Escolher data ...'],
        'pluginOptions' => [
            'autoclose' => true,
            'todayHighlight' => true,
            'format' => 'dd-mm-yyyy',
        ]
    ]); ?>

    <?= $form->field($model, 'data_prox_manutencao')->widget(\kartik\date\DatePicker::class, [
        'options' => ['placeholder' => 'Escolher data ...'],
        'pluginOptions' => [
            'autoclose' => true,
            'todayHighlight' => true,
            'format' => 'dd-mm-yyyy',
        ]
    ]); ?>

    <?= $form->field($model, 'num_fatura')->textInput(['maxlength' => true]) ?>

    <?= $form->field($model, 'valor_total')->textInput() ?>




    <?= $form->field($model, 'observacoes')->textarea(['rows' => 6]) ?>


    <?php if (!Yii::$app->request->isAjax) { ?>
        <div class="form-group">
            <?= Html::submitButton($model->isNewRecord ? 'Create' : 'Update', ['class' => $model->isNewRecord ? 'btn btn-success' : 'btn btn-primary']) ?>
        </div>
    <?php } ?>

    <?php ActiveForm::end(); ?>

</div>