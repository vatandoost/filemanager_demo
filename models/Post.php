<?php

namespace app\models;

use vatandoost\filemanager\libs\FileHelper;
use Yii;

/**
 * This is the model class for table "post".
 *
 * @property int $id
 * @property string|null $title
 * @property string|null $text
 * @property string|null $files_str 
 * @property int|null $background_image_id
 */
class Post extends \yii\db\ActiveRecord
{
    use \vatandoost\filemanager\libs\FileTrait;

    public $background;

    /**
     * {@inheritdoc}
     */
    public static function tableName()
    {
        return 'post';
    }

    /**
     * {@inheritdoc}
     */
    public function rules()
    {
        return [
            [['text'], 'string'],
            [['title'], 'required'],
            [['background_image_id'], 'integer'],
            [['title', 'files_str'], 'string', 'max' => 255],
            [
                ['background'],
                'vatandoost\filemanager\libs\FileValidator', // you have to use this file validator or extend of that
                //'file_type_name' => '', // if you did not define this it will complete based on class name  
                'relation_field' => 'id', // use this attribute to save in relation field in files table 
                'target_field' => 'background_image_id', // file id will save in this attribute after save if multiple false
                'thumb' => [250, 250], // thumbnail size if files are image
                'multiple' => false, // we can add multiple files for this field
                'extensions' => ['jpg', 'jpeg', 'png',]
                // you can define any other \yii\validators\FileValidator properties here
                //'skipOnEmpty' => false
            ],
        ];
    }

    /**
     * {@inheritdoc}
     */
    public function attributeLabels()
    {
        return [
            'id' => 'ID',
            'title' => 'Title',
            'text' => 'Text',
            'background_image_id' => 'Background Image ID',
            'background' => 'Background Image',
            'files_str' => 'Files',
        ];
    }

    public function getBackground()
    {
        return FileHelper::getFileUrl($this->background_image_id);
    }
}
