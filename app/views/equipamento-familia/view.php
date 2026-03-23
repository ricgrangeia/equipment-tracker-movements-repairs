<?php

use yii\widgets\DetailView;

/* @var $this yii\web\View */
/* @var $model app\models\EquipamentoFamilia */
?>
<div class="equipamento-familia-view">
 
    <?= DetailView::widget([
        'model' => $model,
        'attributes' => [
            'id',
            'familia',
        ],
    ]) ?>

</div>
