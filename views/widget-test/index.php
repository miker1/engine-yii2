<?php
use yii\helpers\Html;
use yii\helpers\Url;
use yii\bootstrap\Modal;
echo Html::a('to give id=123',Url::to(['widget-test/index','id'=>'123']));
if(isset($_GET['id']))
    echo'<p>'.$_GET['id'].'</p>';
echo'<br>';
echo Html::a('Search articles from 2015 year',
        Url::to([
            'main/search',//маршрут
            'search'=>'article',//первая переменная
            'year'=>'2015'//вторая переменная
        ])
    );
/*
 *модальное окно
 */ 
echo'<br>';
// @var $this yii\web\View
Modal::begin([
    'size'=>'modal-sm',
    'header'=>'<h2>Title</h2>',
    'toggleButton'=>[
        'label'=>'Modal window',
        'tag'=>'button',
        'class'=>'btn btn-danger'
        ],
    'footer'=>'Down the window'
]);
echo 'the project is for advanced developers';
Modal::end();
?>
<!--
<div class="row">
    <div class="col-md-6" style="background-color: #96f226"> Left row</div>
    <div class="col-md-6" style="background-color: #fbcb09"> Right row
        <div class="row">
            <div class="col-md-4" style="background-color: #f0ad4e">1</div>
            <div class="col-md-4" style="background-color: #f2dede">2</div>
            <div class="col-md-4" style="background-color: #fad000">3</div>
        </div>
    </div>
    
</div>
-->
