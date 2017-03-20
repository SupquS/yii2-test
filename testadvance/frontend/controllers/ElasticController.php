<?php

namespace frontend\controllers;

use frontend\models\Elastic;
use frontend\models\Search;
use frontend\models\ElasticSearch;
use Yii;
use yii\elasticsearch\ActiveDataProvider;
use yii\elasticsearch\Query;
use yii\web\Controller;
use yii\web\NotFoundHttpException;

class ElasticController extends Controller
{

    public function actionIndex()
    {
        $searchModel = new ElasticSearch();
        $dataProvider = $searchModel->search(Yii::$app->request->queryParams);
        $query = Yii::$app->request->queryParams;

        return $this->render('index', [
            'searchModel' => $searchModel,
            'dataProvider' => $dataProvider,
            'query' => $query,
        ]);
    }

    public function actionCreate()
    {

        $model = new Elastic();
        if ($model->load(Yii::$app->request->post())) {

            $model->save();
            $model->setAttribute('_id', $model->primaryKey);

            return $this->redirect(['view', 'id' => (string)$model->_id]);
        } else {
            return $this->render('create', [
                'model' => $model,
            ]);
        }
    }

    public function actionView($id)
    {
        return $this->render('view', [
            'model' => $this->findElastic($id),
        ]);
    }

    /**
     * Updates an existing Elastic model.
     * If update is successful, the browser will be redirected to the 'view' page.
     * @param integer $id
     * @return mixed
     */
    public function actionUpdate($id)
    {
        $model = $this->findElastic($id);

        if ($model->load(Yii::$app->request->post()) && $model->save()) {
            return $this->redirect(['view', 'id' => (string)$model->primaryKey]);
        } else {
            return $this->render('update', [
                'model' => $model,
            ]);
        }
    }

    public function actionIndexSearch()
    {

        return $this->render('searching');

    }

    public function actionSearch()
    {
        $elastic = new Search();
        $result = $elastic->SearchAny(Yii::$app->request->queryParams);
        $query = Yii::$app->request->queryParams;
        return $this->render('search', [
            'searchModel' => $elastic,
            'dataProvider' => $result,
            'query' => $query['search'],
        ]);
    }

    public function actionDelete($id)
    {
        $this->findElastic($id)->delete();

        return $this->redirect(['index']);
    }

    /**
     * Finds the Elastic model based on its primary key value.
     * If the model is not found, a 404 HTTP exception will be thrown.
     * @param integer $id
     * @return Elastic the loaded model
     * @throws NotFoundHttpException if the model cannot be found
     */
    protected function findElastic($id)
    {
        if (($model = Elastic::findOne($id)) !== null) {
            return $model;
        } else {
            throw new NotFoundHttpException('The requested page does not exist.');
        }
    }

}