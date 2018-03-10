<?php

namespace app\controllers;

use Yii;
use yii\web\Controller;
use app\models\UploadForm;
use yii\web\UploadedFile;

class ImagesController extends Controller
{
    public $defaultAction = 'upload';
    
    public function actionUpload()
    {
        $model = new UploadForm();

        if(Yii::$app->request->isPost) {
            $model->imageFile = UploadedFile::getInstance($model, 'imageFile');
            if($model->upload()) {
                Yii::$app->session->setFlash('success', "Изображение успешно загружено");
                return $this->redirect(['info', 'id' => $model->name ]);
            } else {
                Yii::$app->session->setFlash('error', "Ошибка загрузки");
                return $this->redirect(['upload']);
            }
        }

        return $this->render('upload', ['model' => $model]);
    }

    public function actionInfo($id)
    {
        return $this->render('info', ['model' => $id]);
    }
}