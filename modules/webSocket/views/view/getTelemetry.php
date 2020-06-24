<?php

/* @var $this yii\web\View */
/* @var $form yii\bootstrap\ActiveForm */
/* @var $model app\modules\users\models\LoginForm; */

use app\modules\webSocket\assets\TelemetryGetAsset;
TelemetryGetAsset::register($this);

$this->title = 'GetTelemetryById';
$this->params['breadcrumbs'][] = $this->title;
?>
<h1>Input id of your telemetry(Socket)</h1>
<input min="1" type="text" name="message">
<ul id="messages"></ul>