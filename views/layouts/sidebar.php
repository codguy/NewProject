<?php
use app\models\Users;
use yii\helpers\Html;
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
                <?php $username = !empty(Yii::$app->user->identity->username) ? Yii::$app->user->identity->username : Yii::$app->name;
                echo Html::a($username,['user/view','id'=>Yii::$app->user->identity->id]);?>
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
                        'label' => 'Home',
                        'url' => [
                            'site/index'
                        ],
                        'icon' => 'fa fa-home',
                    ],
                    [
                        'label' => 'Add users',
                        'url' => [
                            'user/create'
                        ],
                        'iconStyle' => 'fas fa-user',
                        'visible' => Users::isAdmin() || Users::isManager()
                    ],
                        
                    [
                        'label' => 'All users',
                        'url' => [
                            'user/index'
                        ],
                        'iconStyle' => 'fas fa-users'
                    ],
                    [
                        'label' => 'Create course',
                        'url' => [
                            'course/create'
                        ],
                        'iconStyle' => 'fas fa-plus',
                        'visible' => Users::isTrainer()
                    ],
                    [
                        'label' => 'Courses',
                        'url' => [
                            'course/index'
                        ],
                        'iconStyle' => 'fas fa-desktop'
                    ]
                ]
            ]);
            ?>
        </nav>
        <!-- /.sidebar-menu -->
    </div>
    <!-- /.sidebar -->
</aside>
