<?php
namespace app\models;

use yii\base\Model;
use Yii;

class RegForm extends Model{
    
    public $username;
    public $email;
    public $password;
    public $status;
    
    public function rules(){
        return [
            [['username','email','password'],'filter','filter'=>'trim'],
            [['username','email','password'],'required'],
            ['username','string','min'=>2,'max'=>255],
            ['password','string','min'=>6,'max'=>255],
            ['username','unique','targetClass'=>User::className(),
                'message'=>'This name exists already.'],
            ['email','email'],
            ['email','unique','targetClass'=>User::className(),
                'message'=>'E-mail exists already.'],
            ['status','default',
                'value'=>User::STATUS_ACTIVE, 'on'=>'default'],
            ['status','in','range'=>[
                User::STATUS_NOT_ACTIVE,
                User::STATUS_ACTIVE]]
        ];
    }
    
    public function attributeLabels(){
        return[
            'username'=>'User name',
            'email'=>'E-mail',
            'password'=>'Password'
        ];
    }
    
    /*
     * Имитация записи в базу (пока так ...)
     */
    public function reg(){
        return true;
    }
}