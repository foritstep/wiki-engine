<?php

namespace app\controllers;

use Yii;
use app\models\Editor;
use yii\data\ActiveDataProvider;
use yii\web\Controller;
use yii\web\NotFoundHttpException;
use yii\filters\AccessControl;
use yii\filters\VerbFilter;

/**
 * EditorController implements the CRUD actions for Editor model.
 */
class EditorController extends Controller
{
    /**
     * @inheritdoc
     */
    public function behaviors()
    {
        return [
            'verbs' => [
                'class' => VerbFilter::className(),
                'actions' => [
                    'delete' => ['POST'],
                ],
            ],
            'access' => [
                'class' => AccessControl::className(),
                'only' => ['view', 'create', 'update', 'delete'],
                'rules' => [
                    [
                        'allow' => true,
                        'actions' => ['view', 'create'],
                        'roles' => ['?'],
                    ],
                    [
                        'allow' => true,
                        'actions' => ['update', 'delete'],
                        'roles' => ['@'],
                    ],
                ],
            ],
        ];
    }

    /**
     * Lists all Editor models.
     * @return mixed
     */
    public function actionIndex()
    {
        $dataProvider = new ActiveDataProvider([
            'query' => Editor::find(),
        ]);

        return $this->render('index', [
            'dataProvider' => $dataProvider,
        ]);
    }

    /**
     * Displays a single Editor model.
     * @param string $id
     * @return mixed
     */
    public function actionView($id)
    {
        return $this->render('view', [
            'model' => $this->findModel($id),
        ]);
    }

    /**
     * Creates a new Editor model.
     * If creation is successful, the browser will be redirected to the 'view' page.
     * @return mixed
     */
    public function actionCreate()
    {
        $model = new Editor();

        if ($model->load(Yii::$app->request->post())) {
            $model->password = Yii::$app->getSecurity()->generatePasswordHash($model->password);
            if($model->save()) {
                return $this->redirect(['view', 'id' => $model->nick]);
            }
        } else {
            return $this->render('create', [
                'model' => $model,
            ]);
        }
    }

    /**
     * Updates an existing Editor model.
     * If update is successful, the browser will be redirected to the 'view' page.
     * @param string $id
     * @return mixed
     */
    public function actionUpdate($id)
    {
        if(Yii::$app->user->identity->id !== $id) {
            Yii::$app->session->setFlash('error', "Невозможно изменить чужую учётную запись");
            return $this->redirect(['index']);
        }
        $model = $this->findModel($id);

        if ($model->load(Yii::$app->request->post())) {
            $model->password = Yii::$app->getSecurity()->generatePasswordHash($model->password);
            if($model->save()) {
                return $this->redirect(['view', 'id' => $model->nick]);
            }
        } else {
            $model->password = '';
            return $this->render('update', [
                'model' => $model,
            ]);
        }
    }

    /**
     * Deletes an existing Editor model.
     * If deletion is successful, the browser will be redirected to the 'index' page.
     * @param string $id
     * @return mixed
     */
    public function actionDelete($id)
    {
        if(Yii::$app->user->identity->id !== $id) {
            Yii::$app->session->setFlash('error', "Невозможно удалить чужую учётную запись");
            return $this->redirect(['index']);
        }
        $this->findModel($id)->delete();

        return $this->redirect(['index']);
    }

    /**
     * Finds the Editor model based on its primary key value.
     * If the model is not found, a 404 HTTP exception will be thrown.
     * @param string $id
     * @return Editor the loaded model
     * @throws NotFoundHttpException if the model cannot be found
     */
    protected function findModel($id)
    {
        if (($model = Editor::findOne($id)) !== null) {
            return $model;
        } else {
            throw new NotFoundHttpException('The requested page does not exist.');
        }
    }
}
