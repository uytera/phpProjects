<?php
namespace app\modules\telemetry\controllers;

use app\models\Telemetry;
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
        $model = new Telemetry();
        $rows = $model::find()->all();
        return $this->render('telemetryView', ['rows' => $rows]);
    }
}
