<?php

namespace backend\controllers;

use Yii;
use backend\models\Category;
use backend\models\search\CategorySearch;
use backend\components\AdminController;
use yii\web\NotFoundHttpException;
use yii\web\UploadedFile;
use yii\web\Response;
use yii\web\BadRequestHttpException;
use yii\web\HttpException;
use backend\models\Language;


/**
 * CategoryController implements the CRUD actions for Category model.
 */
class CategoryController extends AdminController
{

    public function actionDel()
    {
        Yii::$app->response->format = Response::FORMAT_JSON;
        if(!Yii::$app->request->isAjax){
            throw new BadRequestHttpException();
        }
        $id = Yii::$app->request->post('id');
        if(!$id){
            throw new HttpException(404, 'Not id found');
        }
        $menu = Category::findOne($id);
        if(!$menu){
            throw new HttpException(404, 'Not menu found');
        }
        $menuAll = Category::find()->where(['=', 'classify', $menu->classify])->all();
        foreach ($menuAll AS $m){
            Category::updateAll(['parent' => null], ['=', 'parent', $m->id]);
            $m->delete();
        }
        return [];
    }

    public function actionMove()
    {
        Yii::$app->response->format = Response::FORMAT_JSON;
        if(!Yii::$app->request->isAjax){
            throw new BadRequestHttpException();
        }
        $id = Yii::$app->request->post('id');
        if(!$id){
            throw new HttpException(404, 'Not id found');
        }
        $menu = Category::findOne($id);
        if(!$menu){
            throw new HttpException(404, 'Not menu found');
        }
        $parents = Yii::$app->request->post('parents');
        $parent = $parents[sizeof($parents) - 2];
        $parent = Category::findOne($parent);
        $menu->parent = isset($parent->id) ? $parent->id : null;
        $menu->save();

        $classifies = Category::find()->where("classify = :classify AND id != :id", [
            ':classify' => $menu->classify,
            ':id' => $menu->id,
        ])->all();
        foreach ($classifies AS $classify){
            $classifyParent = Category::find()->where("classify = :classify AND language = :language", [
                ':classify' => $parent->classify,
                ':language' => $classify->language,
            ])->one();
            $classify->parent = isset($classifyParent->id) ? $classifyParent->id : null;
            $classify->save();
        }

        return [];
    }

    public function actionTree()
    {
        $lang = Language::find()->orderBy('id')->one();
        $models = Category::find()->where(['=', 'language', $lang->id])->orderBy('id')->all();
        return $this->render('tree', [
            'models' => $models,
            'lang' => $lang,
        ]);
    }

    /**
     * Lists all Category models.
     * @return mixed
     */
    public function actionIndex()
    {
        $searchModel = new CategorySearch();
        $dataProvider = $searchModel->search(Yii::$app->request->queryParams);

        return $this->render('index', [
            'searchModel' => $searchModel,
            'dataProvider' => $dataProvider,
        ]);
    }

    /**
     * Displays a single Category model.
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
     * Creates a new Category model.
     * If creation is successful, the browser will be redirected to the 'view' page.
     * @return mixed
     */
    public function actionCreate()
    {
        $model = new Category();

        if ($model->load(Yii::$app->request->post())) {
            $model->imageFile = UploadedFile::getInstance($model, 'imageFile');
            if($model->validate()){
                $model->save(false);
                return $this->redirect(['view', 'id' => $model->id]);
            }
        }
        return $this->render('create', [
            'model' => $model,
        ]);
    }

    /**
     * Updates an existing Category model.
     * If update is successful, the browser will be redirected to the 'view' page.
     * @param string $id
     * @return mixed
     */
    public function actionUpdate($id)
    {
        $model = $this->findModel($id);

        if ($model->load(Yii::$app->request->post())) {
            $model->imageFile = UploadedFile::getInstance($model, 'imageFile');
            if($model->validate()){
                $model->save(false);
                Yii::$app->session->setFlash('success', Yii::t('app', 'Saved successfully'));
                return $this->refresh();
            }
        }
        return $this->render('update', [
            'model' => $model,
        ]);
    }

    /**
     * Deletes an existing Category model.
     * If deletion is successful, the browser will be redirected to the 'index' page.
     * @param string $id
     * @return mixed
     */
    public function actionDelete($id)
    {
        $model = $this->findModel($id);
        $model->delete();
        return $this->redirect(['index']);
    }

    /**
     * Finds the Category model based on its primary key value.
     * If the model is not found, a 404 HTTP exception will be thrown.
     * @param string $id
     * @return Category the loaded model
     * @throws NotFoundHttpException if the model cannot be found
     */
    protected function findModel($id)
    {
        if (($model = Category::findOne($id)) !== null) {
            return $model;
        } else {
            throw new NotFoundHttpException(Yii::t('app', 'The requested page does not exist.'));
        }
    }
}
