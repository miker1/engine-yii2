<?php
namespace app\controllers;

use Yii;
use yii\web\Controller; //основной класс контроллеров
use yii\filters\AccessControl;

class BehaviorsController extends Controller{
    
    public function behaviors() {
        return[
            'access'=>[
                'class'=>  AccessControl::className(),//класс поведения - фильтр контроля доступа
                /*
                 * Вывод исключения при отказе доступа
                'denyCallback'=>function($rule,$action){
                    throw new Exception('No access');
                },
                 * 
                 */
                'rules'=>[
                    [
                        'allow'=>true,//правило "разрешить"
                        'controllers'=>['main'],//для контроллера <main>
                        'actions'=>['reg','log'],//для действий
                        'verbs'=>['GET','POST'],//и для запросов
                        'roles'=>['?']//доступ пользователям (? - метка гостя)
                    ],
                    [
                        'allow'=>true,//правило для выхода пользователя
                        'controllers'=>['main'],
                        'actions'=>['logout'],
                        'verbs'=>['POST'],
                        'roles'=>['@']//доступ пользователям (@ - метка идентифицированного пользователя)
                    ],
                    [
                        'allow'=>true,//для всех котроллеров, без доп. условий
                        'controllers'=>['main'],
                        'actions'=>['index','search']
                    ],
                    [
                        'allow'=>true,//правило "разрешить"
                        'controllers'=>['widget-test'],
                        'actions'=>['index'],
                        /*
                        'ips'=>['127.0.0.1'],//['127.1.*'] диапазон адресов
                        'matchCallback'=>function($rule,$action){
                            return date('d-m')==='27-11';//true - если сегодня 27.11 или сделать !==
                        }
                        */
                    ]
                    
                ]
            ]
        ];
    }
}