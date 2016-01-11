<?php

namespace app\modules\blog\controllers;

use Yii;
use app\modules\blog\models\Posts;
use app\modules\blog\models\PostsSearch;
use yii\web\Controller;
use yii\web\NotFoundHttpException;
use yii\filters\VerbFilter;
use yii\filters\AccessControl;
use yii\data\Pagination;
use yii\web\UploadedFile;

/**
 * DefaultController implements the CRUD actions for Posts model.
 */
class DefaultController extends Controller
{
    public function behaviors()
    {
        return [
            'verbs' => [
                'class' => VerbFilter::className(),
                'actions' => [
                    'delete' => ['post'],
                ],
            ],
            /**
             * пока осталю так, возможно наследоваться от BehavioursController
             */
            'access'=>[
                'class'=>  AccessControl::className(),
                'only'=>['index','view','create','update','delete'],
                'rules'=>[
                    [
                        'actions'=>['index','view','create','update','delete'],
                        'allow'=>true,
                        'roles'=>['@'],
                    ],
                ],
            ],
        ];
    }

    /**
     * Lists all Posts models.
     * @return mixed
     */
    public function actionIndex()
    {
        //$searchModel = new PostsSearch();
        //$dataProvider = $searchModel->search(Yii::$app->request->queryParams);
        /**
        $AllPosts=Posts::find()->all();
        
        if($AllPosts){
            return $this->render('index', [
                'posts'=>$AllPosts,
            ]);
        }else {
            $AllPosts=new Posts;
            return $this->render('index', [
                'posts'=>$AllPosts,
            ]);
        }
        */
        $AllPosts=Posts::find();
        
        if($AllPosts){
            $pages=new Pagination(['totalCount'=>$AllPosts->count(), 'pageSize'=>10]);
            $posts=$AllPosts->offset($pages->offset)->limit($pages->limit)->all();
            return $this->render('index',['posts'=>$posts,'pages'=>$pages]);
        }
    }

    /**
     * Displays a single Posts model.
     * @param integer $id
     * @return mixed
     */
    public function actionView($id)
    {
        return $this->render('view', [
            'model' => $this->findModel($id),
        ]);
    }

    /**
     * Creates a new Posts model.
     * If creation is successful, the browser will be redirected to the 'view' page.
     * @return mixed
     */
    public function actionCreate()
    {
        /**
         * 09.01.2016
         
        $model = new Posts();
        //$model = $this->findModel(Yii::$app->user->id);
        //if($model->birthday=='0000-00-00') $model->birthday = NULL;

        if ($model->load(Yii::$app->request->post())) {
            $model->string=substr(uniqid('image'),0,12);
            $model->image = UploadedFile::getInstance($model, 'img');
            //var_dump($model->image);
                if ($model->validate()) {
                    //if ($model->image != NULL){
                        //var_dump($model->image);
                        $model->filename='web/static/images/'.$model->string.'.'.$model->image->extension;
                        //var_dump($model->filename);
                        //$model->img='/'.$this->filename;
                        $model->image->saveAs($model->filename);
                        //echo"OK";
                        //exit;
                        
                        //save
                        
                        
                        
                        
                    //}
                    //$model->image = NULL;
                    //$model->image = time();
                    $model->save(false);
                    return $this->redirect(['view', 'id' => $model->id]);
                }
        }
        return $this->render('create', [
            'model' => $model,
        ]);
        
        
        /**
         * 08.01.2016
        $model = new Posts();
        if ($model->load(Yii::$app->request->post())) {
            $model->image = UploadedFile::getInstance($model, 'img');
            //if($image&&$image->tempName){
                //var_dump($model->image);exit;
               if($model->validate()){
                    var_dump($model->image);exit;
                    $model->string=substr(uniqid('img'),0,12);
                    $model->image->saveAs('web/static/images/'.$model->string.'.'.$model->image->extension);
                    //$model->image= $filename;
                    //$model->image = '/'.$dir . $fileName;
               }
        
                    
                //}
                //var_dump($model->image);exit;
            
               //if($model->save()){
                return $this->redirect(['view', 'id' => $model->id]);
            
        
        } 
               else{
            return $this->render('create', [
                'model' => $model,
            ]);
        }
        */
    
        
    
            //if ($model->upload()) {
                // file is uploaded successfully
                //var_dump($model);exit;
                
                //return $this->redirect(['view', 'id' => $model->id]);
                
           // }
        //return $this->render('create', ['model' => $model]);
        //}
    
        /**
         * 08.01.2016
         * 
         */
        $model = new Posts();
        if ($model->load(Yii::$app->request->post()) && $model->save()) {
            return $this->redirect(['view', 'id' => $model->id]);
        } else {
            return $this->render('create', [
                'model' => $model,
            ]);
        }
        
        
        /**
         * create 11.01.2016
         
        $model = new Posts();

        if (Yii::$app->request->isPost) {
            $model->image = UploadedFile::getInstance($model, 'img');
            $model->string=substr(uniqid('img'),0,12);
            if ($model->image && $model->validate()) {                
                $model->image->saveAs('web/static/images/'.$model->string.'.'.$model->image->extension);
                //var_dump($model->image);exit;
                return $this->goHome();
                //$this->redirect(['view', 'id' => $model->id]);
            }
        }

        return $this->render('create', ['model' => $model]);
        */
    }
    
    /**
     * Updates an existing Posts model.
     * If update is successful, the browser will be redirected to the 'view' page.
     * @param integer $id
     * @return mixed
     */
    public function actionUpdate($id)
    {
        $model = $this->findModel($id);

        if ($model->load(Yii::$app->request->post()) && $model->save()) {
            return $this->redirect(['view', 'id' => $model->id]);
        } else {
            return $this->render('update', [
                'model' => $model,
            ]);
        }
    }

    /**
     * Deletes an existing Posts model.
     * If deletion is successful, the browser will be redirected to the 'index' page.
     * @param integer $id
     * @return mixed
     */
    public function actionDelete($id)
    {
        $this->findModel($id)->delete();

        return $this->redirect(['index']);
    }

    /**
     * Finds the Posts model based on its primary key value.
     * If the model is not found, a 404 HTTP exception will be thrown.
     * @param integer $id
     * @return Posts the loaded model
     * @throws NotFoundHttpException if the model cannot be found
     */
    protected function findModel($id)
    {
        if (($model = Posts::findOne($id)) !== null) {
            return $model;
        } else {
            throw new NotFoundHttpException('The requested page does not exist.');
        }
    }
}
