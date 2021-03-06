<?php
namespace app\controllers;

use Yii;
use app\models\LoginForm;
use app\models\RegForm;
use app\models\User;
use app\models\Profile;


class MainController extends BehaviorsController{
    
    //public $layout='basic';
    public $layout='main';//change the main of a project pattern 
    
    /*
     * изменение действия по умолчанию вместо <index> будет <search>
     */
    //public $defaultAction='search';
    
    /**
     * 
     * public function actions(){
        return [
            'error' => [
                'class' => 'yii\web\ErrorAction',
            ],
        ];
    }
    */
    public function actionIndex(){
        //Yii::$app->view->params['breadcrumbs'][] = 'Index';//лучше указать в представлении
        return $this->render('index');
    }
    
    /*
     * метод <GET> передается в контроллер автоматически
     * 
     * MyBehaviors из контроллера Behaviors запускается перед каждым действием приложения.
     * В поведении происходит проверка, если запущено действие Search контроллера Main,
     * меняються символы подчеркивания на пробелы
     */
    public function actionSearch(){
        //Yii::$app->view->params['breadcrumbs'][] = 'Search';
        $search=Yii::$app->session->get('search');//забирает из сессии уже измененный с помощью event(а) запрос. Работа поведения.
        Yii::$app->session->remove('search');
        if($search):
            Yii::$app->session->setFlash('success', 'Result of search');            
        else:
            Yii::$app->session->setFlash('error', 'The form of search was not filled');
        endif;
        //$search=Yii::$app->request->post('search');
        return $this->render('search',['search'=>$search]);
    }
    
    /*
     * Creating an action by Logout
     */
    public function actionLogout(){
        Yii::$app->user->logout();/**если Logout(false) - сессии не уничтожаются*/
        //return $this->goHome();
        return $this->redirect(['/main/log']);
    }
    
    
    public function actionLog(){
        if(!Yii::$app->user->isGuest):
            return $this->goHome();
        endif;
        $model=new LoginForm();        
        if($model->load(Yii::$app->request->post())&&$model->login()):
            return $this->goBack();
            //return $this->redirect(['/main/index']);
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
                        //return $this->redirect(['/main/index']);
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
    
    public function actionProfile(){
        $model=($model=Profile::findOne(Yii::$app->user->id)) ? $model : new Profile;
        if($model->load(Yii::$app->request->post()) && $model->validate()) :
            if($model->updateProfile()):
                Yii::$app->session->setFlash('success','Your profile was changed');
            else:
                Yii::$app->session->setFlash('error','Your profile was not changed');
                Yii::error('Error recording');
            return $this->refresh();
            endif;
        endif;
    return $this->render('profile', ['model' => $model,]);
    }
    
    public function actionError(){
        $exception = \Yii::$app->errorHandler->exception;
        if ($exception !== null) {
            return $this->render('error', ['exception' => $exception]);
        }
    }
    
}