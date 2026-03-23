<?php

use yii\widgets\DetailView;

/* @var $this yii\web\View */
/* @var $model app\models\Localization */
?>
<div class="localization-view">
 
    <?= DetailView::widget([
        'model' => $model,
        'attributes' => [
            'id',
            'active:boolean',
            'localization',
        ],
    ]) ?>

</div>
