<?php

use yii\widgets\DetailView;

/* @var $this yii\web\View */
/* @var $model app\models\FuncionarioTipo */
?>
<div class="funcionario-tipo-view">
 
    <?= DetailView::widget([
        'model' => $model,
        'attributes' => [
            'id',
            'tipo',
        ],
    ]) ?>

</div>
