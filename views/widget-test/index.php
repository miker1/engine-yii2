<?php
use yii\bootstrap\Modal;
/* @var $this yii\web\View */
Modal::begin([
    'size'=>'modal-sm',
    'header'=>'<h2>Title</h2>',
    'toggleButton'=>[
        'label'=>'Modal window',
        'tag'=>'button',
        'class'=>'btn btn-danger'
        ],
    'footer'=>'Down the window'
]);
echo 'the project is for advanced developers';
Modal::end();
?>
<!--
<div class="row">
    <div class="col-md-6" style="background-color: #96f226"> Left row</div>
    <div class="col-md-6" style="background-color: #fbcb09"> Right row
        <div class="row">
            <div class="col-md-4" style="background-color: #f0ad4e">1</div>
            <div class="col-md-4" style="background-color: #f2dede">2</div>
            <div class="col-md-4" style="background-color: #fad000">3</div>
        </div>
    </div>
    
</div>
-->
