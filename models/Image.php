<?php

namespace app\models;

use yii\imagine\Image as Img;
use Imagine\Image\Box;

class Image
{

    const THUMBNAIL_MAX_WIDTH = 250;
    const THUMBNAIL_MAX_HEIGHT = 250;

    const IMAGE_MAX_WIDTH = 700;
    const IMAGE_MAX_HEIGHT = 700;

    const IMAGE_REVIEW_MAX_WIDTH = 1400;
    const IMAGE_REVIEW_MAX_HEIGHT = 1400;

    const IMAGE_AVATAR_MAX_WIDTH = 150;
    const IMAGE_AVATAR_MAX_HEIGHT = 150;

    const URL = 'images/item/';
    const URL_THUMBNAIL = 'images/item/thumbnail/';

    const URL_AVATAR = 'images/avatar/';


    public static function createThumbnail($url, $urlSave ,$width, $height)
    {
        Img::getImagine()->open($url)->thumbnail(new Box($width, $height))
            ->save($urlSave, ['quality' => 90]);
    }

    public static function changeSize($url, $width, $height)
    {
        Img::getImagine()->open($url)->thumbnail(new Box($width, $height))
            ->save($url, ['quality' => 99]);
    }
}
