<?php

namespace app\assets;

use yii\web\AssetBundle;

class AdminAsset extends AssetBundle
{
    public $basePath = '@webroot';
    public $baseUrl = '@web';
    public $css = [
        'admin/css/sb-admin.css',
        'admin/css/plugins/morris.css',
        'css/font-awesome.min.css',
        'admin/css/site.css',
    ];
    public $js = [
        'admin/js/bootstrap.min.js',
        'admin/js/plugins/morris/raphael.min.js',
        'admin/js/plugins/morris/morris.min.js',
        'admin/js/plugins/morris/morris-data.js',
        'admin/js/custom.js',
    ];
    public $depends = [
        'yii\web\YiiAsset',
        'yii\bootstrap\BootstrapAsset',
    ];
}