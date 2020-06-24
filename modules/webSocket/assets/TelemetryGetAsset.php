<?php

namespace app\modules\webSocket\assets;

use yii\web\AssetBundle;

class TelemetryGetAsset extends AssetBundle
{
    public $sourcePath = '@app/modules/webSocket/assets/';
    public $js = [
        'listGet.js'
    ];
    public $css = [
        'list.css'
    ];
}