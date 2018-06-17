<?php

namespace app\modules\admin\models\forms;

use app\modules\admin\models\Image;
use app\modules\admin\models\Item;
use app\modules\admin\models\Tag;

class ItemForm extends Item
{
    const SCENARIO_CREATE = 'create';
    const SCENARIO_UPDATE = 'update';

    public $tags;
    public $categories;
    public $myFile;

    /**
     * {@inheritdoc}
     */
    public function rules()
    {
        return [
            [['title', 'status', 'tags', 'categories'], 'required'],
            [['description'], 'string'],
            [['status'], 'integer'],
            [['status'], 'in', 'range' => array_keys(static::getStatuses())],
            [['title', 'image'], 'string', 'max' => 255],

            ['tags', 'tag'],

            [['myFile'], 'file', 'extensions' => 'png, jpg, jpeg', 'maxSize' => 1024 * 1024],
            [['myFile'], 'required', 'on' => static::SCENARIO_CREATE],
        ];
    }

    public function uploadItemImage()
    {
        $url = Image::URL . $this->image;
        $urlThumb = Image::URL_THUMBNAIL . $this->image;
        $urlSmall = Image::URL_SMALL . $this->image;
        if (!$this->myFile->saveAs($url)) {
            $this->addError('myFile', 'Unable to save the uploaded file');
            return false;
        }
        $this->myFile = $url;
        Image::createThumbnail($url, $urlThumb, Image::THUMBNAIL_MAX_WIDTH, Image::THUMBNAIL_MAX_HEIGHT);
        Image::createThumbnail($url, $urlSmall, Image::SMALL_MAX_WIDTH, Image::SMALL_MAX_HEIGHT);
        Image::changeSize($url, Image::IMAGE_MAX_WIDTH, Image::IMAGE_MAX_HEIGHT);
    }

    public function tag($attribute)
    {
        foreach ($this->tags as $tag) {
            /* @var Tag $t */
            $t = Tag::find()->where(['name' => $tag])->one();
            $text = '';
            if (!empty($t) && !$t->isActive()) {
                $text .= '[' . $tag . ']';
            }
        }

        if (!empty($text)) {
            $this->addError('tags', 'Tagi: ' . $text . ' są niedozwolone.');
        }
    }
}