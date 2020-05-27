<?php

/* @var $this yii\web\View */
/* @var $rows app\models\Telemetry*/
use yii\helpers\Html;

$this->title = 'Telemetry';
$this->params['breadcrumbs'][] = $this->title;
?>
<div class="weather">
    <h1><?= Html::encode($this->title) ?></h1>

    <p>
        This is the Telemetry page.
    </p>
    <?php
    foreach ($rows as $row): ?>
        <p>Время: <?php echo $row->time; ?> | Телеметрия: <?php echo $row->telemetry; ?></p>
    <?php endforeach; ?>
</div>
