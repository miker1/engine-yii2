<?php
use app\assets\AppAsset;
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
        <title><?=Yii::$app->name?></title>
    <?php $this->head()?>
    </head>
    <body>
        <?php $this->beginBody()?>
        <p>Up the site</p>
        <?=$content?>
        <p>Down the site</p>
        <?php $this->endBody()?>
    </body>
</html>
<?php
$this->endPage();
?>