<?php
use yii\helpers\Html;

$this->registerJsFile('@web/js/main-index.js',['position'=>$this::POS_HEAD],'main-index');
//$this->registerJs('alert("HELLO!")',$this::POS_READY,'hello-message');
$this->registerJsFile('@web/css/main.css');
//$this->registerCss("body{background:#ff0;}");
?>
<?php
//$this->title = 'home';
$this->params['breadcrumbs'][] = ['label' => 'Index', 'url' => ['/main/index']];
$this->params['breadcrumbs'][] = $this->title;
?>
<h1>Main</h1>