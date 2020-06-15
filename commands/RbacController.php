<?php

namespace app\commands;

use Yii;
use yii\console\Controller;
/**
 * Инициализатор RBAC выполняется в консоли php yii rbac/init
 */
class RbacController extends Controller {

    public function actionInit() {
        $auth = Yii::$app->authManager;

        $auth->removeAll();

        $admin = $auth->createRole('admin');
        $editor = $auth->createRole('editor');
        $blocked = $auth->createRole('blocked');

        $auth->add($admin);
        $auth->add($editor);
        $auth->add($blocked);

        $viewAdminPage = $auth->createPermission('viewAdminPage');
        $viewAdminPage->description = 'View admin';

        $updateTelemetry = $auth->createPermission('updateTelemetry');
        $updateTelemetry->description = 'Edit telemetry';

        $auth->add($viewAdminPage);
        $auth->add($updateTelemetry);


        $auth->addChild($editor, $updateTelemetry);

        $auth->addChild($admin, $editor);
        $auth->addChild($admin, $viewAdminPage);

        $auth->assign($admin, 1);
        $auth->assign($blocked, 6);
        $auth->assign($editor, 7);
    }
}