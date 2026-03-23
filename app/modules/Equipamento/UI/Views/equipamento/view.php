<?php

use app\modules\Equipamento\Domain\Entity\Equipamento;
use yii\widgets\DetailView;
use yii\helpers\Html;

/* @var $this yii\web\View */
/* @var $model Equipamento */
?>
<div class="equipamento-view">

    <?= DetailView::widget([
        'model' => $model,
        'attributes' => [
//            'id',
            'num_interno',
            'data',
            'equipamento',
            'descricao',
            'num_serie',
            'estado.estado',
            'caixa:boolean',
            'empresa.empresa',
            'familia.familia',
            'subFamilia.subfamilia',
            'acessorios',
            'fornecedor',
            'observacoes:ntext',
            'modelo',
            'marca',
			[
				'attribute' => 'image_manager_id_avatar',
				'format' => 'html', // Use HTML format
				'value' => static function (Equipamento $model) {

					$image_path = Yii::$app->imagemanager->getImagePath( $model->image_manager_id_avatar );
					return Html::img($image_path, ['width' => '200']);
				},
			],

        ],
    ]) ?>

</div>
