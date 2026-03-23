<?php

/* @var $this yii\web\View */

$this->title = 'Global Inicio';
$this->params['breadcrumbs'] = [['label' => $this->title]];


use app\modules\Equipamento\Domain\Entity\EquipamentoSearch;
use app\modules\Equipamento\Domain\Entity\Equipamento;

?>
<div class="container-fluid">



    <!-- Small boxes (Stat box) -->
    <div class="row">
        <!-- ./col -->
        <div class="col-lg-3 col-6">
            <!-- small box -->
            <?= \hail812\adminlte\widgets\SmallBox::widget([
                'title' =>count( Equipamento::getEquipamentosActivos()),
                'text' => "Total Equipamentos",
                'icon' => 'nav-icon fas fa-wrench',
                'linkText' => 'Ver Equipamentos',
                'linkUrl' => ['/Equipamento/equipamento/index'],

            ]) ?>
        </div>
        <!-- ./col -->
        <div class="col-lg-3 col-6">
            <!-- small box -->
            <?= \hail812\adminlte\widgets\SmallBox::widget([
                'theme' => 'warning',
                'title' =>\app\models\Funcionario::find()->count(),
                'text' => "Total Funcionários / Destinos",
                'icon' => 'nav-icon fas fa-users',
                'linkText' => 'Ver Destinos',
                'linkUrl' => ['/funcionario'],

            ]) ?>
        </div>
        <!-- ./col -->
        <!-- ./col -->
        <div class="col-lg-3 col-6">
            <!-- small box -->
            <?= \hail812\adminlte\widgets\SmallBox::widget([
                'theme' => 'warning',
                'title' =>\app\models\EquipamentoReparacao::find()->where(['data_recepcao' => ''])->count(),
                'text' => "Equipamentos em Reparação",
                'icon' => 'nav-icon fas fa-wrench',
                'linkText' => 'Ver Reparações',
                'linkUrl' => ['/equipamento-reparacao'],

            ]) ?>
        </div>
        <!-- ./col -->
        <!-- ./col -->
        <div class="col-lg-3 col-6">
            <!-- small box -->
            <?= \hail812\adminlte\widgets\SmallBox::widget([
                'theme' => 'warning',
                'title' => (new EquipamentoSearch())->searchEquipamentoActivo()->count,
                'text' => "Equipamentos Fora",
                'icon' => 'nav-icon fas fa-wrench',
                'linkText' => ' ',
                'linkUrl' => '#',

            ]) ?>
        </div>
        <!-- ./col -->
       <?php if(Yii::$app->user->can('SoArmazemPortugal')){ ?>
        <!-- ./col -->
        <div class="col-lg-3 col-6">
            <!-- small box -->
            <?= \hail812\adminlte\widgets\SmallBox::widget([
                'title' => "Utilizador",
                'text' => "de Portugal",
                'icon' => 'nav-icon fas fa-wrench',
                'linkText' => ' ',
                'linkUrl' => '#',

            ]) ?>
        </div>
        <!-- ./col -->
        <?php } ?>
        <?php if(Yii::$app->user->can('SoArmazemFranca')){ ?>
            <!-- ./col -->
            <div class="col-lg-3 col-6">
                <!-- small box -->
                <?= \hail812\adminlte\widgets\SmallBox::widget([
                    'title' => "Utilizador",
                    'text' => "de França",
                    'icon' => 'nav-icon fas fa-wrench',
                    'linkText' => ' ',
                    'linkUrl' => '#',

                ]) ?>
            </div>
            <!-- ./col -->
        <?php } ?>
    </div>
    <!-- /.row -->
    <!-- Main row -->
    <!-- /.row (main row) -->
</div>