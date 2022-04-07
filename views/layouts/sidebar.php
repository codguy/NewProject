<?php
use app\models\Users;
?>
<aside class="main-sidebar sidebar-dark-primary elevation-4">
    <!-- Brand Logo -->

    <!-- Sidebar -->
    <div class="sidebar">
        <!-- Sidebar user panel (optional) -->
        <div class="user-panel mt-3 pb-3 mb-3 d-flex">
            <div class="image">
            	<?php $model = new Users()?>
                <img src="<?=  !empty(Yii::$app->user->identity->profile_picture) ? Yii::$app->request->baseUrl . '/../uploads/' .Yii::$app->user->identity->profile_picture : $model->getImageUrl() ?>" class="elevation-2 profile_pic" alt="User Image" height="40px" width="40px" >
            </div>
            <div class="info">
                <a href="#" class="d-block"><?php echo !empty(Yii::$app->user->identity->username) ? Yii::$app->user->identity->username : Yii::$app->name ?></a>
            </div>
        </div>

        <!-- SidebarSearch Form -->
        <!-- href be escaped -->
        <!-- <div class="form-inline">
            <div class="input-group" data-widget="sidebar-search">
                <input class="form-control form-control-sidebar" type="search" placeholder="Search" aria-label="Search">
                <div class="input-group-append">
                    <button class="btn btn-sidebar">
                        <i class="fas fa-search fa-fw"></i>
                    </button>
                </div>
            </div>
        </div> -->

        <!-- Sidebar Menu -->
        <nav class="mt-2">
            <?php
            echo \hail812\adminlte\widgets\Menu::widget([
                'items' => [
                    [
                        'label' => 'Login',
                        'url' => [
                            'site/login'
                        ],
                        'icon' => 'sign-in-alt',
                        'visible' => Yii::$app->user->isGuest
                    ],
                    [
                        'label' => 'Gii',
                        'icon' => 'file-code',
                        'url' => [
                            '/gii'
                        ],
                        'target' => '_blank'
                    ],
                    [
                        'label' => 'Modules',
                        'header' => true
                    ],
                    [
                        'label' => 'Users',
                        'icon' => 'user',
                        'items' => [
                            [
                                'label' => 'Add',
                                'url' => [
                                    'user/create'
                                ],
                                'iconStyle' => 'fas fa-plus'
                            ],
                            [
                                'label' => 'Show',
                                'url' => [
                                    'user/index'
                                ],
                                'iconStyle' => 'fas fa-table'
                            ]
                        ]
                    ],
                    [
                        'label' => 'Department',
                        'icon' => 'fa fa-building',
                        'items' => [
                            [
                                'label' => 'Add',
                                'url' => [
                                    'dept/create'
                                ],
                                'iconStyle' => 'fas fa-plus'
                            ],
                            [
                                'label' => 'Show',
                                'url' => [
                                    'dept/index'
                                ],
                                'iconStyle' => 'fas fa-table'
                            ]
                        ]
                    ]
                ]
            ]);
            ?>
        </nav>
        <!-- /.sidebar-menu -->
    </div>
    <!-- /.sidebar -->
</aside>