<?php

namespace app\models;

use yii\imagine\Image as Img;
use Imagine\Image\Box;

class Image
{

    const THUMBNAIL_MAX_WIDTH = 270;
    const THUMBNAIL_MAX_HEIGHT = 270;

    const SMALL_MAX_WIDTH = 70;
    const SMALL_MAX_HEIGHT = 70;

    const IMAGE_MAX_WIDTH = 610;
    const IMAGE_MAX_HEIGHT = 610;

    const URL = 'images/item/';
    const URL_THUMBNAIL = 'images/item/thumbnail/';
    const URL_SMALL = 'images/item/70x70/';

    const URL_AVATAR = 'images/avatar/';


    public static function createThumbnail($url, $urlSave, $width, $height)
    {
        Img::getImagine()->open($url)->thumbnail(new Box($width, $height))
            ->save($urlSave, ['quality' => 99]);
    }

    public static function changeSize($url, $width, $height)
    {
        Img::getImagine()->open($url)->thumbnail(new Box($width, $height))
            ->save($url, ['quality' => 99]);
    }

    public static function createSmall($url, $urlSave, $width = self::SMALL_MAX_WIDTH, $height = self::SMALL_MAX_HEIGHT)
    {
        Img::getImagine()->open($url)->thumbnail(new Box($width, $height))
            ->save($urlSave, ['quality' => 99]);
    }
}
