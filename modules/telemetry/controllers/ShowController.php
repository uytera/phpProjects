<?php
namespace app\modules\telemetry\controllers;

use app\models\Telemetry;
use yii\web\Controller;
use yii\web\ForbiddenHttpException;

class ShowController extends Controller
{
    /**
     * Displays telemetry page.
     *
     * @return string
     * @throws ForbiddenHttpException
     */
    public function actionList()
    {
        $dataProvider = new \yii\data\ActiveDataProvider([
            'query' => \app\models\Telemetry::find()
        ]);

        return $this->render('telemetryView', ['rows' => $dataProvider]);
    }
}
