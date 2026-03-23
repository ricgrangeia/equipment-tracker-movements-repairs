<?php

use yii\widgets\DetailView;

/* @var $this yii\web\View */
/* @var $model \app\modules\Empresa\Empresa */
?>
<div class="empresa-view">
 
    <?= DetailView::widget([
        'model' => $model,
        'attributes' => [
            'id',
            'empresa',
        ],
    ]) ?>

</div>
