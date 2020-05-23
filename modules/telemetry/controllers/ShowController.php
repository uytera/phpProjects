<?php
namespace app\modules\telemetry\controllers;

use app\modules\telemetry\models\Telemetry;
use yii\web\Controller;

class ShowController extends Controller
{
    /**
     * Displays telemetry page.
     *
     * @return string
     */
    public function actionList()
    {
        return $this->render('telemetryView', ['model' => new Telemetry()]);
    }
}
