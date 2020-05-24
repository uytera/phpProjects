<?php

namespace app\modules\webSocket\assets;

use yii\web\AssetBundle;

class TelemetryAsset extends AssetBundle
{
    public $sourcePath = '@app/modules/webSocket/assets/';
    public $js = [
        'khodavandgar.js'
    ];
}