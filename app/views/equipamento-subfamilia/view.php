<?php

use yii\widgets\DetailView;

/* @var $this yii\web\View */
/* @var $model app\models\EquipamentoSubfamilia */
?>
<div class="equipamento-subfamilia-view">
 
    <?= DetailView::widget([
        'model' => $model,
        'attributes' => [
            'id',
            'familia_id',
            'subfamilia',
        ],
    ]) ?>

</div>
