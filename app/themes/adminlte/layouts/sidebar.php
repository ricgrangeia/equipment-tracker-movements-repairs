<aside class="main-sidebar sidebar-dark-primary elevation-4">
    <!-- Brand Logo -->
    <a href="/" class="brand-link">
        <img src="<?= $assetDir ?>/img/AdminLTELogo.png" alt="AdminLTE Logo" class="brand-image img-circle elevation-3"
             style="opacity: .8">
        <span class="brand-text font-weight-light">EQUIPAMENTOS</span>
    </a>

    <!-- Sidebar -->
    <div class="sidebar">
        <!-- Sidebar user panel (optional) -->
        <div class="user-panel mt-3 pb-3 mb-3 d-flex">
            <div class="image">
                <img src="<?= $assetDir ?>/img/user2-160x160.jpg" class="img-circle elevation-2" alt="User Image">
            </div>
            <div class="info">
                <a href="#" class="d-block"><?= \Yii::$app->user->identity->username ?></a>
            </div>
        </div>

        <!-- SidebarSearch Form -->
        <!-- href be escaped -->
        <div class="form-inline">
            <div class="input-group" data-widget="sidebar-search">
                <input class="form-control form-control-sidebar" type="search" placeholder="Search" aria-label="Search">
                <div class="input-group-append">
                    <button class="btn btn-sidebar">
                        <i class="fas fa-search fa-fw"></i>
                    </button>
                </div>
            </div>
        </div>

        <!-- Sidebar Menu -->
        <nav class="mt-2">
            <?php

            echo \hail812\adminlte\widgets\Menu::widget([
                'items' => [
                    [
                        'label' => 'Global',
                        'icon' => 'tachometer-alt',
                        'url' => ['/site/index'],
//                        'badge' => '<span class="right badge badge-info">2</span>',
                    ],
                    [
                        'label' => 'Equipamentos',
                        'icon' => 'boxes',
                        //'badge' => '<span class="right badge badge-info">2</span>',
                        'items' => [
                            ['label' => 'Equipamentos', 'url' => ['/Equipamento/equipamento/index'], 'icon' => 'toolbox'],
                            ['label' => 'Movimentos', 'url' => ['/EquipamentoMovimento/equipamento-movimento/index'], 'icon' => 'truck-pickup'],
                            ['label' => 'Reparações', 'url' => ['/equipamento-reparacao/index'], 'icon' => 'wrench'],
                            ['label' => 'Avaliações', 'url' => ['/Equipamento/equipamento/verificar-avaliacao'], 'icon' => 'clipboard-check'],

                            [
                                'label' => 'Opções',
                                'icon' => 'sitemap',
                                //'badge' => '<span class="right badge badge-info">2</span>',
                                'items' => [

                                    ['label' => 'Famílias', 'url' => ['/equipamento-familia/index'],  'icon' => 'object-ungroup'],
                                    ['label' => 'Sub-Famílias', 'url' => ['/equipamento-subfamilia/index'],  'icon' => 'object-group'],
                                    ['label' => 'Tipo Movimento', 'url' => ['/EquipamentoMovimentoTipo/equipamento-movimento-tipo/index'], 'icon' => 'list'],
                                    ['label' => 'Estados Equip.', 'url' => ['/EquipamentoEstado/equipamento-estado/index'],  'icon' => 'list'],
                                ]

                            ],

                        ]

                    ],
                    [
                        'label' => 'Funcionários',
                        'icon' => 'users',
                        'url' => ['/funcionario/index'],
                        //'badge' => '<span class="right badge badge-info">2</span>',

                    ],
                    [
                        'label' => Yii::t('app', 'Empresas'),
                        'icon' => 'building',

                        'items' => [
                            ['label' => Yii::t('app', 'Empresa'), 'url' => ['/Empresa/empresa/index'], 'iconStyle' => 'far', 'icon' => 'building',],
                            ['label' => Yii::t('app', 'Localizações'), 'url' => ['/localization/index'], 'iconStyle' => 'far', 'icon' => 'building',],
                        ]

                    ],
                    [
                        'label' => Yii::t('app-img-table', 'Images'),
                        'icon' => 'images',
                        'url' => ['/imagemanager'],
                        //'badge' => '<span class="right badge badge-info">2</span>',

                    ],

                    [
                        'label' => 'Sistema',
                        'icon' => 'cogs',
                        //'url' => ['/img-table'],
                        //'badge' => '<span class="right badge badge-info">2</span>',
                        'items' => [
                            ['label' => 'Login', 'url' => ['site/login'], 'icon' => 'sign-in-alt', 'visible' => Yii::$app->user->isGuest],
                            ['label' => 'Gii', 'icon' => 'file-code', 'url' => ['/gii'], 'target' => '_blank', 'badge' => '<span class="badge badge-info badge-light">3</span>'],
                            ['label' => 'Admin', 'icon' => 'file-code', 'url' => ['/admin'], 'target' => '_blank',
                                'items' => [
                                    ['label' => 'Utilizadores', 'url' => ['/admin/user/index'], 'iconStyle' => 'far', 'icon' => 'dot-circle'],
                                    ['label' => 'Atribuições', 'url' => ['/admin/assignment/index'], 'iconStyle' => 'far', 'icon' => 'dot-circle'],
                                    ['label' => 'Perfis', 'url' => ['/admin/role/index'], 'iconStyle' => 'far', 'icon' => 'dot-circle'],
                                    ['label' => 'Permissões', 'url' => ['/admin/permission/index'], 'iconStyle' => 'far', 'icon' => 'dot-circle'],
                                    ['label' => 'Routes\Acessos', 'url' => ['/admin/route/index'], 'iconStyle' => 'far', 'icon' => 'dot-circle'],
                                ]
                            ],
                            ['label' => 'Debug', 'icon' => 'bug', 'url' => ['/debug'], 'target' => '_blank']
                        ]

                    ],


                ],
            ]);
            ?>
        </nav>
        <!-- /.sidebar-menu -->
    </div>
    <!-- /.sidebar -->
</aside>