<?php


namespace app\modules\admin\controllers;


use app\models\User;
use app\modules\admin\models\RegForm;
use Yii;
use yii\web\Controller;

class AddUserController extends Controller
{
    public function actionShow(){
        return $this->render('addUserPage', ['model' => new RegForm()]);
    }

    public function actionAdd(){

        $form_model = new RegForm();
        if($form_model->load(\Yii::$app->request->post()) && $form_model->add()){
            return $this->render('addUserPage', ['model' => new RegForm()]);
        }

        return $this->render('addUserPage', ['model' => $form_model]);
    }
}