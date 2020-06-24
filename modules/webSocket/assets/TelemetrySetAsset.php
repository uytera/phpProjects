<?php

namespace app\modules\webSocket\assets;

use yii\web\AssetBundle;

class TelemetrySetAsset extends AssetBundle
{
    public $sourcePath = '@app/modules/webSocket/assets/';
    public $js = [
        'listSet.js'
    ];
    public $css = [
        'list.css'
    ];
}