<?php


namespace app\modules\webSocket\controllers;


use yii\web\Controller;
use yii\web\ForbiddenHttpException;

class AddController extends Controller
{
    public function actionShow(){

        if (!\Yii::$app->user->can('updateTelemetry')) {
            return $this->render('@app/views/site/accessDenied');
        }

        return $this->render('addTelemetry');
    }
}