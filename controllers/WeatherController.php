<?php

namespace app\controllers;

use app\models\Weather;
use yii\web\Controller;


class WeatherController extends Controller
{
    /**
     * Displays weather page.
     *
     * @return string
     */
    public function actionWeather()
    {
        return $this->render('weather', ['$model' => new Weather()]);
    }
}
