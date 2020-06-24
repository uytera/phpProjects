<?php


namespace app\modules\webSocket\controllers;


use yii\web\Controller;
use yii\web\ForbiddenHttpException;

class ViewController extends Controller
{
    public function actionShowSet(){

        if (!\Yii::$app->user->can('updateTelemetry')) {
            return $this->render('@app/views/site/accessDenied');
        }

        return $this->render('addTelemetry');
    }

    public function actionShowGet(){

        if (!\Yii::$app->user->can('updateTelemetry')) {
            return $this->render('@app/views/site/accessDenied');
        }

        return $this->render('getTelemetry');
    }
}