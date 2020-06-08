<?php

/* @var $this yii\web\View */
/* @var $form yii\bootstrap\ActiveForm */
/* @var $model app\modules\users\models\LoginForm; */

use app\modules\webSocket\assets\TelemetryAsset;
TelemetryAsset::register($this);

$this->title = 'AddTelemetry';
$this->params['breadcrumbs'][] = $this->title;
?>
<div id="app">
    Загрузка....
</div>
<h1>Input your telemetry(Socket)</h1>
<input min="1" type="text" name="message">
<ul id="messages"></ul>