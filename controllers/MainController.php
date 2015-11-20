<?php
namespace app\controllers;

use Yii;
use app\models\LoginForm;
use app\models\RegForm;

class MainController extends \yii\web\Controller{
    
    public $layout='main';//change the main of a project pattern 
    
    /*
     * изменение действия по умолчанию вместо <index> будет <search>
     */
    public $defaultAction='search';
    
    /*
     * метод <GET> передается в контроллер автоматически
     */
    public function actionSearch($search=null){
        //$search=Yii::$app->request->post('search');
    
        return $this->render('search',['search'=>$search]);
    }
    
    public function actionLog(){
        $model=new LoginForm();        
        if($model->load(Yii::$app->request->post())&&$model->login()):
            return $this->goBack();
        endif;
        
        
        return $this->render('login',['model'=>$model]);
    }
    
    public function actionReg(){
        $model=new RegForm();        
        if($model->load(Yii::$app->request->post())&&$model->validate()):
            if($model->reg()):
                return $this->goHome();
            else:
                Yii::$app->session->setFlash('error','Error is while registration');
                Yii::error('Error is while registration');
                return $this->refresh();
            endif;
        endif;
        return $this->render('reg',['model'=>$model]);
    }
}