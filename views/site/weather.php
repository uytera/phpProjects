<?php

/* @var $this yii\web\View */
/* @var $model app\models\Weather */
use yii\helpers\Html;

$this->title = 'Weather';
$this->params['breadcrumbs'][] = $this->title;
?>
<div class="weather">
    <h1><?= Html::encode($this->title) ?></h1>

    <p>
        This is the Weather page.
    </p>
    <?php $rows = $model::GetCityWeatherList('Paris');
    foreach ($rows as $row): ?>
        <p>Время: <?php echo $row->time; ?> | Город: <?php echo $row->city; ?> | Температура: <?php echo $row->temp; ?>° | Ветер: <?php echo $row->wind; ?>м/с</p>
    <?php endforeach; ?>
</div>
