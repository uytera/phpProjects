<?php

/* @var $this yii\web\View */
/* @var \yii\debug\models\timeline\DataProvider $rows */
/* @var $model app\modules\admin\models\BannedForm; */

use yii\grid\GridView;
use yii\helpers\Html;
use yii\bootstrap\ActiveForm;

$this->title = 'Admin page';
$this->params['breadcrumbs'][] = $this->title;
?>
<div class="admin">
    <a href="http://localhost:8500/admin/add-user/show">Add new user</a>

    <?php $form = ActiveForm::begin([
        'id' => 'banned-form',
        'action' => ['admin/banned'],
        'layout' => 'horizontal',
        'fieldConfig' => [
            'template' => "{label}\n<div class=\"col-lg-3\">{input}</div>\n<div class=\"col-lg-8\">{error}</div>",
            'labelOptions' => ['class' => 'col-lg-1 control-label'],
        ],
    ]); ?>

    <?= $form->field($model, 'username')->textInput(['autofocus' => true]) ?>

    <?= $form->field($model, 'banned')->textInput() ?>

    <div class="form-group">
        <div class="col-lg-offset-1 col-lg-11", href="http://localhost:8500/admin/admin/show">
            <?= Html::submitButton('Ban acces', ['class' => 'btn btn-primary', 'name' => 'ban-button']);?>
        </div>
    </div>

    <?php ActiveForm::end(); ?>

    <?php
    echo GridView::widget([
        'dataProvider' => $rows,
    ]);
    ?>
</div>