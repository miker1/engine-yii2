<?php
use yii\helpers\Html;
use yii\bootstrap\Nav;
use yii\bootstrap\Modal;
use yii\bootstrap\NavBar;
use yii\bootstrap\ActiveForm;
use yii\widgets\Breadcrumbs;
use app\assets\AppAsset;

/* @var $this \yii\web\View */
/* @var $content string */

AppAsset::register($this);
?>
<?php $this->beginPage() ?>
<!DOCTYPE html>
<html lang="<?= Yii::$app->language ?>">
<head>
    <?php echo Html::csrfMetaTags()?>
    <meta charset="<?= Yii::$app->charset ?>">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <?php echo Html::csrfMetaTags() ?>
    <title><?= Html::encode($this->title) ?></title>
    <?php $this->head() ?>
</head>
<body>

<?php $this->beginBody() ?>
    <div class="wrap">
        <?php
            NavBar::begin([
                'brandLabel' => 'My Blog',
                'brandUrl'=>['/main/index'],
                //'brandUrl' => Yii::$app->homeUrl,
                'options' => [
                    'class' => 'navbar-inverse navbar-fixed-top',
                ],
            ]);
            
            $menuItems=[
                [
                        'label'=>'Home <span class="glyphicon glyphicon-home"></span>', 'url'=>['/main/index']
                    ],
                    /*
                     * не закрывается модальное окно
                    '<li>
                        <a data-toggle="modal" data-target="#modal" style="cursor:pointer">
                        About <span class="glyphicon glyphicon-question-sign"></span>
                    </li>'
                     * 
                     */
                    [
                        'label'=>'From Box <span class="glyphicon glyphicon-inbox"></span>',
                        'items'=>[
                            '<li class="dropdown-headwr">Extensions</li>',
                            '<li class="divider"></li>',
                            [
                                'label'=>'Go to the overview', 'url'=>['/widget-test/index']
                            ]
                        ]
                    ],
                [
                        'label'=>'About <span class="glyphicon glyphicon-question-sign"></span>',
                        'url'=>['#'],                        
                        'linkOptions'=>[
                            'data-toggle'=>'modal',
                            'data-target'=>'#modal',
                            'style'=>'cursor:pointer; outline:none;'
                        ],
                    ]
            ];
            
            /*
             * формируем элементы в навигационном меню по условию
             */
            if(Yii::$app->user->isGuest):
                $menuItems[]=['label'=>'Registration','url'=>['/main/reg']];
                $menuItems[]=['label'=>'Go in','url'=>['/main/log']];
            else:
                $menuItems[]=['label'=>'Profile',
                    'url'=>['/main/profile'],
                    'linkOptions'=>['data-method'=>'post']];
                $menuItems[]=['label'=>'LogOut('.Yii::$app->user->identity['username'].')',
                    'url'=>['/main/logout'],
                    'linkOptions'=>['data-method'=>'post']];
            endif;
            
            /*
             * меню по умолчанию
            echo Nav::widget([
                'options' => ['class' => 'navbar-nav navbar-right'],
                'items' => [
                    ['label' => 'Home', 'url' => ['/site/index']],
                    ['label' => 'About', 'url' => ['/site/about']],
                    ['label' => 'Contact', 'url' => ['/site/contact']],
                    Yii::$app->user->isGuest ?
                        ['label' => 'Login', 'url' => ['/site/login']] :
                        ['label' => 'Logout (' . Yii::$app->user->identity->username . ')',
                            'url' => ['/site/logout'],
                            'linkOptions' => ['data-method' => 'post']],
                ],
            ]);
             */
            echo Nav::widget([
                'items'=>$menuItems,
                'activateParents'=>true,
                'encodeLabels'=>false,
                'options'=>[
                    'class'=>'navbar-nav navbar-right' 
                ]
            ]);
            Modal::begin([
                'header'=>'<h2>Content</h2>',
                'id'=>'modal',
                //'toggleButton'=>['label'=>'Modal window about'],
                'footer'=>'Down the window'
            ]);
            echo 'the project is for advanced developers';
            Modal::end();
            ActiveForm::begin(
                    [
                        'action'=>['main/search'],
                        'method'=>'get',
                        'options'=>['class'=>'navbar-form navbar-right']
                    ]);
            echo'<div class="input-group input-group-sm">'; //объединяем поле поиска и кнопку отправки
            echo Html::input(
                    'type: text',
                    'search', //имя поля, передаваемого post  or get 
                    '',
                    [
                        'placeholder'=>'Search...',
                        'class'=>'form-control'
                    ]);
            echo'<span class="input-group-btn">';
            echo Html::submitButton(
                    '<span class="glyphicon glyphicon-search"></span>',
                    [
                        'class'=>'btn btn-success'
                    ]
            );
            echo'</span></div>';
            ActiveForm::end();
            NavBar::end();             
        ?>

        <div class="container">
            <?= Breadcrumbs::widget([
                'links' => isset($this->params['breadcrumbs']) ? $this->params['breadcrumbs'] : [],
            ]) ?>
            <?= $content ?>
        </div>
    </div>

    <footer class="footer">
        <div class="container">
            <span class="glyphicon glyphicon-copyright-mark"> MyBlog <?= date('Y') ?></span>
            
        </div>
    </footer>

<?php $this->endBody() ?>
</body>
</html>
<?php $this->endPage() ?>
