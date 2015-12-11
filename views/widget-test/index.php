<?php
use yii\helpers\Html;
use yii\helpers\Url;
use yii\bootstrap\Modal;
use yii\bootstrap\Nav;

echo Nav::widget([
    
        /*
         * передача HTML атрибутов всему мену через options
         * если в навигационной панели - основной класс navbar
         * если не в навигационной панели - nav
         * если в виде вкладок - nav-tabs
         * в виде кнопок - nav-pills
         * для вертикального меню nav-stacked
         * для выравнивания меню по ширине контейнера - nav-justified
         */
        'activateItems'=>false,/*ссылки на текущую страницу - не активны*/
        'activateParents'=>true,/*выделяется не только элемент, но и выпадающий список*/
        'encodeLabels'=>false,/*экранирует HTML код в названии элемента*/
        'options'=>[
            'class'=>'nav nav-pills nav-justified'
        ],
        'items'=>[
            [
                'label'=>'Refer #1<span class="glyphicon glyphicon-alert">',/*Bootstrap icon*/
                'url'=>['/main/index'],
                'options'=>[
                    'class'=>'disabled'/*класс не кликабельности ссылки*/
                ],
                'linkOptions'=>[
                    'onClick'=>'return false;'/*кликабельная ссылка*/
                ]
            ],
            [
                'label'=>'Refer #2',
                'url'=>['/widget-test/index']
            ],
            [
                'label'=>'Drpo-Down List',
                'items'=>[
                    [
                        'label'=>'Refer #1_1',
                        'url'=>['/main/index'],
                    ],
                    '<li class="divider"></li>',
                    '<li class="dropdown-header">Describe</li>',
                    [
                        'label'=>'Refer #2_2',
                        "url"=>['/widget-test/index']
                    ]
                ]
            ]
        ]
    ]);

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
настройка изображения для различных устройств
col-xs- for phone (<768px)
col-sm- for tables (>=768px)
col-md- for PC (>=992px)
col-lg- for TVset (>=1200px)
-->
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
