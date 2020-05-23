<?php


namespace app\modules\webSocket\controllers;


use yii\web\Controller;

class AddController extends Controller
{
    public function actionShow(){
        return $this->render('addTelemetry');
    }
}