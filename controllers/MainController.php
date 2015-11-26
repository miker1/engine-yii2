<?php
namespace app\controllers;

use Yii;
use app\models\LoginForm;
use app\models\RegForm;
use app\models\User;

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
    
    /*
     * 6:00 http://www.youtube.com/watch?v=pKq_iiAL_dA&index=14&list=PLqhDXdp6EGpGrW2HzEVIzBDzFSCwX8eup
     */
    
    
    
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
            if($user=$model->reg()):
                if($user->status===User::STATUS_ACTIVE):
                    if(Yii::$app->getUser()->login($user)):
                        return $this->goHome();
                    endif;
                endif;
            else:
                Yii::$app->session->setFlash('error','Error is while registration');
                Yii::error('Error is while registration');
                return $this->refresh();
            endif;
        endif;
        return $this->render('reg',['model'=>$model]);
    }
}