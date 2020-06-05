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
        $dataProvider = new \yii\data\ActiveDataProvider([
            'query' => \app\models\Telemetry::find()
        ]);

        return $this->render('telemetryView', ['rows' => $dataProvider]);
    }
}
