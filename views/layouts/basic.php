<?php
use app\assets\AppAsset;
use yii\widgets\Breadcrumbs;
use yii\helpers\Html;
use yii\bootstrap\Nav;
use yii\bootstrap\Modal;
use yii\bootstrap\NavBar;
use yii\bootstrap\ActiveForm;
/* 
 * miker_v
 */
/* @var $content string*/
/* @var $this \yii\web\View*/
AppAsset::register($this);
$this->beginPage();
?>

<!DOCTYPE html>
<html lang ="<?= Yii::$app->charset?>">
    <head>
        <meta charset="<?=Yii::$app->charset?>">
        <?php
        $this->registerMetaTag(['name'=>'viewport','content'=>'width=device-width, initial-scale=1']);
        ?>
        <title><?=Yii::$app->name?></title>
    <?php $this->head()?>
    </head>
    <body>
        <?php $this->beginBody()?>
        <?php
            NavBar::begin([
                'brandLabel' => 'My Blog',
                //'renderInnerContainer'=>false,//растянется на всю ширину
                'brandUrl'=>['/main/index'],
                //'brandUrl' => Yii::$app->homeUrl,
                'options' => [
                    //'class' => 'navbar navbar-inverse',
                    'class' => 'navbar navbar-inverse navbar-fixed-top',
                ],
            ]);
            NavBar::end();
            ?>
        <?php
        echo Breadcrumbs::widget([
            'itemTemplate' => "<li><i>{link}</i></li>\n", // template for all links
            'links' => [
                [
                    'label' => 'Post Category',
                    'url' => ['post-category/view', 'id' => 10],
                    'template' => "<li><b>{link}</b></li>\n", // template for this link only
                ],
                    ['label' => 'Sample Post', 'url' => ['post/edit', 'id' => 1]],
                        'Edit',
                ],
            ]);
        ?>
        <p>Up the site</p>
        <?=$content?>
        <p>Down the site</p>
        <?= Breadcrumbs::widget([
                'links' => isset($this->params['breadcrumbs']) ? $this->params['breadcrumbs'] : [],
            ]) ?>
        <?php $this->endBody()?>
    </body>
</html>
<?php
$this->endPage();
?>