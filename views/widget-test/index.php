<?php
use yii\helpers\Html;
use yii\helpers\Url;
use yii\bootstrap\Modal;
use yii\bootstrap\Nav;
use yii\bootstrap\ActiveForm;

echo Nav::widget([
    
        /*
         * передача HTML атрибутов всему меню через options
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
echo Html::a(
        'Modal window',
        ['#'],//маршрут
        [
            'data-toggle'=>'modal',//модальное окно
            'data-target'=>'#search',//id окна, которое нужно открыть
            'class'=>'btn btn-warning'//стиль bootstrap
        ]
);
Modal::begin([
    'options'=>[//задает id для тега '<a>'
        'id'=>'search'
    ],
    'size'=>'modal-sm',/*modal-lg*/
    'header'=>'<h2>Title</h2>',
    /*
     * Так можно вынести кнопку за пределы модального окна
     * по ссылке '<a>'
    'toggleButton'=>[/*при нажатии на кнопку появляется модальное окно
        'label'=>'Modal window',
        'tag'=>'button',
        'class'=>'btn btn-danger'
        ],
    */
    'footer'=>'Down the window'
]);
echo 'the project is for advanced developers';
            ActiveForm::begin(
                    [
                        'action'=>['/search'],
                        'method'=>'get',
                        'options'=>['class'=>'']
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
                        'class'=>'btn btn-success',
                        'onClick'=>'window.location.href=this.form.action+"-"+this.form.search.value.replace(/[^\w\а-яё\А-ЯЁ]+/g,"_")+".php";'
                    ]
            );
            echo'</span></div>';
            ActiveForm::end();
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
