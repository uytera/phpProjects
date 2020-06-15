<?php

namespace app\modules\admin\controllers;

use app\models\User;
use app\modules\admin\models\BannedForm;
use yii\web\Controller;

class AdminController extends Controller
{
    private function getDataProvider(){
        $dataProvider = new \yii\data\ActiveDataProvider([
            'query' => \app\models\User::find()
        ]);
        return $dataProvider;
    }

    public function actionShow()
    {
        if (!\Yii::$app->user->can('viewAdminPage')) {
            return $this->render('@app/views/site/accessDenied');
        }

        $dataProvider = $this->getDataProvider();

        return $this->render('adminPage', ['rows' => $dataProvider, 'model' => new BannedForm()]);
    }

    public function actionBanned()
    {
        if (!\Yii::$app->user->can('viewAdminPage')) {
            return $this->render('@app/views/site/accessDenied');
        }

        $dataProvider = $this->getDataProvider();

        $form_model = new BannedForm();
        if($form_model->load(\Yii::$app->request->post()) && $form_model->banned()){
            return $this->render('adminPage', ['model' => new BannedForm()]);
        }

        return $this->render('adminPage', ['rows' => $dataProvider, 'model' => $form_model]);
    }
}