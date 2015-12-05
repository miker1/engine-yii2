<?php

namespace app\models;

use Yii;

/**
 * This is the model class for table "profile".
 *
 * @property integer $user_id
 * @property string $avatar
 * @property string $first_name
 * @property string $second_name
 * @property string $middle_name
 * @property integer $birthday
 * @property integer $gender
 *
 * @property User $user
 */
class Profile extends \yii\db\ActiveRecord
{
    /**
     * @inheritdoc
     */
    public static function tableName()
    {
        return 'profile';
    }

    /**
     * @inheritdoc
     */
    public function rules()
    {
        return [
            [['birthday', 'gender'], 'integer'],
            [['avatar'], 'string', 'max' => 255],
            [['first_name', 'second_name', 'middle_name'], 'string', 'max' => 32]
        ];
    }

    /**
     * @inheritdoc
     */
    public function attributeLabels()
    {
        return [
            'user_id' => 'User ID',
            'avatar' => 'Avatar',
            'first_name' => 'First Name',
            'second_name' => 'Second Name',
            'middle_name' => 'Middle Name',
            'birthday' => 'Birthday',
            'gender' => 'Gender',
        ];
    }

    /**
     * @return \yii\db\ActiveQuery
     */
    public function getUser()
    {
        return $this->hasOne(User::className(), ['id' => 'user_id']);
    }
    
    /*
     * запись введенных пользователем данных
     * вызывается из действия Profile контроллера Main
     */
    public function updateProfile(){
        $profile=($profile=Profile::findOne(Yii::$app->user->id)) ? $profile : new Profile();
        $profile->user_id=Yii::$app->user->id;
        $profile->first_name=$this->first_name;
        $profile->second_name=$this->second_name;
        $profile->middle_name=$this->middle_name;
        if($profile->save()):
            $user=$this->user ? $this->user : User::findOne(Yii::$app->user->id);
            $username=Yii::$app->request->post('User')['username'];
            $user->username=isset($username) ? $username : $user->username;
            return $user->save() ? true : false;
        endif;
        return false;
    }
}