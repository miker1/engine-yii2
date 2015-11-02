<?php

namespace app\models;

use Yii;
use yii\base\Model;


class UserForm extends Model{
    public $name;
    public $pass;
    
    public function rules(){
        return [
                [['name','pass'],'required'],
                ];
    }
}
?>