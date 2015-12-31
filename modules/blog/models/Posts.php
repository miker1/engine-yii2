<?php

namespace app\modules\blog\models;

use Yii;
use yii\web\UploadedFile;
use yii\helpers\BaseStringHelper;
/**
 * This is the model class for table "posts".
 *
 * @property integer $id
 * @property string $title
 * @property string $text
 * @property string $text_preview
 * @property string $img
 */
class Posts extends \yii\db\ActiveRecord
{
    public $image;
    public $filename;
    public $string;
        
    /**
     * @inheritdoc
     */
    public static function tableName()
    {
        return 'posts';
    }

    /**
     * @inheritdoc
     */
    public function rules()
    {
        return [
            [['title', 'text'], 'required'],
            [['text'], 'string'],
            [['title'], 'string', 'max' => 150],
            [['text_preview'], 'string', 'max' => 250],
            //[['img'],'file'],
        ];
    }

    /**
     * @inheritdoc
     */
    public function attributeLabels()
    {
        return [
            'id' => 'ID',
            'title' => 'Title',
            'text' => 'Text',
            'text_preview' => 'Text Preview',
            'img' => 'Img',
        ];
    }
    
    public function beforeSave($insert){
        if($this->isNewRecord){
            //generate & upload
            $this->string=substr(uniqid('img'),0,12);
            $this->image=UploadedFile::getInstance($this,'img');
            //\Yii::$app->request->baseUrl.'/web/static/images/'
            $this->filename='web/static/images/'.$this->string.'.'.$this->image->extension;
            $this->image->saveAs($this->filename);
            
            $this->text_preview=  BaseStringHelper::truncate($this->text,250,'...');
                
            //save
            $this->img='/'.$this->filename;
        }else{
            $this->image=UploadedFile::getInstance($this,'img');
            if($this->image){
                $this->image->saveAs(substr($this->img,1));
            }
        }
        return parent::beforeSave($insert);
    }
}
