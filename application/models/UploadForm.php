<?php

namespace app\models;

use yii\base\Model;
use yii\web\UploadedFile;

class UploadForm extends Model
{
    const DIR = 'uploads/';
    
    /**
     * @var UploadedFile
     */
    public $imageFile;

    public function rules()
    {
        return [
            [['imageFile'], 'file', 'skipOnEmpty' => false, 'extensions' => 'png, jpg, jpeg, giff, tiff'],
        ];
    }
    
    public function upload()
    {
        if ($this->validate()) {
            if(!is_dir(self::DIR)) {
                mkdir(self::DIR);
            }
            $this->imageFile->saveAs(self::DIR . $this->imageFile->baseName . '.' . $this->imageFile->extension);
            return true;
        } else {
            return false;
        }
    }

    public function getName()
    {
        return self::DIR . $this->imageFile->baseName . '.' . $this->imageFile->extension;
    }

    public function attributeLabels()
    {
        return [
            'imageFile' => 'Выберите изображение',
        ];
    }
}