<?php

/* @var $this yii\web\View */
/* @var \yii\debug\models\timeline\DataProvider $rows */

use yii\grid\GridView;
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

    echo GridView::widget([
        'dataProvider' => $rows,
    ]);
    ?>
</div>
