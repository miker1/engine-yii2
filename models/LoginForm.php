<?php
namespace app\models;

use yii\base\Model;
use Yii;

class LoginForm extends Model{
    
    public $username;
    public $password;
    public $email;
    public $rememberMe=true;
    public $status;
    
    public function rules(){
        return [
          [['username','password'],'required','on'=>'default'],
          ['email','email'],
            ['rememberMe','boolean'],
            ['password','validatePassword']
        ];
    }
    
    public function validatePassword($attribute){
        
    }
    
    public function attributeLabels(){
        return[
            'username'=>'User name',
            'password'=>'Password',
            'rememberMe'=>'Remember me'
        ];
    }
    
    public function login(){
        return true;
    }
}