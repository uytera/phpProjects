<?php
namespace app\modules\api\controllers;

use app\models\Telemetry;
use Yii;
use yii\base\InvalidConfigException;
use yii\data\ActiveDataProvider;
use yii\filters\AccessControl;
use yii\filters\auth\HttpBearerAuth;

/**
 * Class ApiTelemetryController
 * @package app\modules\api\controllers
 * Управление телеметрией через api
 */

class TelemetryController extends \yii\rest\Controller
{
    public function behaviors()
    {
        $behaviors = parent::behaviors();
        $behaviors['authenticator'] = [
            'class' => HttpBearerAuth::class,
        ];

        $behaviors['access'] = [
            'class' => AccessControl::class,
            'rules' => [
                [
                    'allow' => true,
                    'roles' => ['@'],
                ],
            ]
        ];

        return $behaviors;
    }

    /**
     * @return ActiveDataProvider
     */
    public function actionIndex(){
        $dataProvider = new \yii\data\ActiveDataProvider([
            'query' => \app\models\Telemetry::find()
        ]);

        return $dataProvider;
    }

    /**
     * @return Telemetry
     */

    public function actionCreate(){
        try {
            $data = Yii::$app->request->getBodyParams();
        } catch (InvalidConfigException $e) {
        }

        $telemetry = new Telemetry();
        if($telemetry->load($data, '') && $telemetry->validate()) {
            if($telemetry->save()){
                Yii::$app->response->headers->add('Location', 'http://localhost:8500/api/telemetry/create');
                Yii::$app->response->setStatusCode(201);
            }
        }

        return $telemetry;
    }
}