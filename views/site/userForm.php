<?php

/* 
 * To change this license header, choose License Headers in Project Properties.
 * To change this template file, choose Tools | Templates
 * and open the template in the editor.
 */

use yii\helpers\Html;
use yii\widgets\ActiveForm;
?>
<?php if (Yii::$app->session->hasFlash('success')){
    echo "<div class='alert alert-success'>".Yii::$app->session->getFlash('success')."</div>";
}
?>
<?php $form=ActiveForm::begin();?>
<?php echo $form->field($model,'name');?>
<?php echo $form->field($model,'pass');?>
<?php echo Html::submitButton('Submit',['class'=>'btn btn-success']);?>
<?php //echo Html::submitButton('Submit', ['class' => 'btn btn-primary']) ?>
<?php ActiveForm::end();?>