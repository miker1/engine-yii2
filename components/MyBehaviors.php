<?php
namespace app\components;

use yii\base\Behavior;
use yii\web\Controller;

class MyBehaviors extends Behavior{
    /**
     * поведение, которое перед действием Search контроллера Main
     * будет заменять все знаки почеркивания на пробелы
     */
    
    private $_controller;
    private $_action;
    private $_removeUnderscore;
    
    public function setController($value){
        $this->_controller=$value;
    }
    
    public function getController(){
        return $this->_controller;
    }
    
    public function setAction($value){
        $this->_action=$value;
    }
    
    public function getAction(){
        return $this->_action;
    }
    
    public function setRemoveUnderscore($value){
        $this->_removeUnderscore=str_replace('_',' ',$value);
    }
    
    public function getRemoveUnderscore(){
        return $this->_removeUnderscore;
    }
    
    /*
     * метод для обработки событий приложения
     * yii\base\Behavior events()
     * перед любым действием Controller::EVENT_BEFORE_ACTION
     * вызывать метод beforeAction()
     * можно проверить:
     * ActiveRecord::EVENT_BEFORE_INSERT,[$this,'nameMethod'] - не работает
     * Controller::EVENT_BEFORE_ACTION=>'beforeAction'
     */
    public function events(){
        return[
            Controller::EVENT_BEFORE_ACTION=>'beforeAction'
        ];
    }
    
    /*
     * если действием является Search контроллера Main,
     * то в сессии создается переменная search
     * и ей присваивается полученное значение из getRemoveUnderscore()
     */
    public function beforeAction(){
        if($this->controller == 'main' && $this->action == 'search'):
            \Yii::$app->session->set('search',$this->removeUnderscore);
        endif;
    }
}