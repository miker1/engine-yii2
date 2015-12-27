<?php
namespace app\controllers;

use Yii;
use yii\web\Controller; //основной класс контроллеров
use yii\filters\AccessControl;
use app\components\MyBehaviors;

class BehaviorsController extends Controller{
    
    public function behaviors() {
        return[
            'access'=>[
                //альтернативное задание пути 'app\components\FileBehavior'
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
                        'allow'=>true,//правило "разрешить для profile"
                        'controllers'=>['main'],//для контроллера <main>
                        'actions'=>['profile'],//для действий
                        'verbs'=>['GET','POST'],//и для запросов
                        'roles'=>['@']//доступ пользователям (@ - метка идентифицированного пользователя)
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
                        
                         * если функция возвратит true - действие доступно, если false - нет.
                         * @var $rule текущее правило
                         * @var $action текущее действие
                         * 
                         * 'matchCallback'=>function($rule,$action){
                            return date('d-m')==='27-11';//true - если сегодня 27.11 или сделать !==
                        }
                        */
                    ],
                    
                ]
            ],
            'removeUnderscore'=>[//имя поведения
                'class'=>MyBehaviors::className(),//класс поведения
                'controller'=>Yii::$app->controller->id,//текущий контроллер
                'action'=>Yii::$app->controller->action->id,//текущее действие
                'removeUnderscore'=>Yii::$app->request->get('search')//в сеттер setRemoveUnderscore отправляется переменная search из $_GET
            ]
        ];
    }
}