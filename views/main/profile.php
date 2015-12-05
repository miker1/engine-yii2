<?php

use yii\helpers\Html;
use yii\widgets\ActiveForm;

/* @var $this yii\web\View */
/* @var $model app\models\Profile */
/* @var $form ActiveForm */
//echo '<h1>'. $model->user->username.'</h1>';
//echo '<h1>'. $model->user->profile->first_name.'</h1>';//развернутая запись обращения 
//echo '<h1>'. $model->first_name.'</h1>';//так проще, но сложнее понять
?>
<div class="main-profile">

    <?php $form = ActiveForm::begin(); ?>
    <?php if($model->user)
        echo $form->field($model->user, 'username');?>
        <?= $form->field($model, 'first_name') ?>
        <?= $form->field($model, 'second_name') ?>
        <?= $form->field($model, 'middle_name') ?>
    
        <div class="form-group">
            <?= Html::submitButton('Update', ['class' => 'btn btn-primary']) ?>
        </div>
    <?php ActiveForm::end(); ?>

</div><!-- main-profile -->
