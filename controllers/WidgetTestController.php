<?php

namespace app\controllers;

//use Yii;

class WidgetTestController extends BehaviorsController
{
    public function actionIndex()
    {
        $search_some='for example';
        
        return $this->render('index');
        //return Yii::$app->response->sendFile('web/files/hello.txt')->send(); скачиивание заданного файла
        /*
         * передает аргумент из одного контроллера в другой
         *
        return $this->redirect(
                [
                  'main/search',
                  'search'=>$search_some
                ]
            );
         * 
         */
    }

}
