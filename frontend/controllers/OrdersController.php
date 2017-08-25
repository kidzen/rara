<?php

namespace frontend\controllers;

use Yii;
use common\models\Orders;
use common\models\Model;
use common\models\OrdersSearch;
use common\models\OrderItems;
use common\models\OrderItemsSearch;
use yii\web\Controller;
use yii\web\NotFoundHttpException;
use yii\filters\VerbFilter;

/**
 * OrdersController implements the CRUD actions for Orders model.
 */
class OrdersController extends Controller {

    /**
     * @inheritdoc
     */
    public function behaviors() {
        return [
            'verbs' => [
                'class' => VerbFilter::className(),
                'actions' => [
                    'delete' => ['POST'],
                ],
            ],
        ];
    }

    /**
     * Lists all Orders models.
     * @return mixed
     */
    public function actionIndex() {
        $searchModel = new OrderItemsSearch();
        $dataProvider = $searchModel->search(Yii::$app->request->queryParams);
        $model = new Orders();
        $modelItems = [new OrderItems()];

        if ($model->load(Yii::$app->request->post())) {
            $modelItems = \common\models\Model::createMultiple(OrderItems::classname());
            Model::loadMultiple($modelItems, Yii::$app->request->post());
            $valid = $model->validate();
            $valid = Model::validateMultiple($modelItems) && $valid;
            if ($valid) {
                $dbtransac = \Yii::$app->db->beginTransaction();
                try {
                    if (!$model->save()) {
                        Throw new Exception(' Detail transaksi tidak dapat disimpan.');
                    }
                    foreach ($modelItems as $modelItem) {
                        $modelItem->order_id = $model->id;
                        if (!$modelItem->save(false))
                            Throw new Exception(' Detail item pesanan tidak dapat disimpan.');
                    }
                    $dbtransac->commit();
                    $model = new Orders();
                    $modelItems = [new OrderItems()];
                    return $this->redirect(['index']);
                } catch (Exception $e) {
//                    \Yii::$app->notify->fail($e->getMessage());
                    $dbtransac->rollBack();
                } catch (\yii\db\Exception $e) {
                    \Yii::$app->notify->fail($e->getMessage());
                    $dbtransac->rollBack();
                }
            }
        }

        return $this->render('index', [
                    'searchModel' => $searchModel,
                    'dataProvider' => $dataProvider,
                    'model' => $model,
                    'modelItems' => $modelItems,
        ]);
    }

    /**
     * Displays a single Orders model.
     * @param integer $id
     * @return mixed
     */
    public function actionView($id) {
        return $this->render('view', [
                    'model' => $this->findModel($id),
        ]);
    }

    /**
     * Creates a new Orders model.
     * If creation is successful, the browser will be redirected to the 'view' page.
     * @return mixed
     */
    public function actionCreate() {
        $model = new Orders();

        if ($model->load(Yii::$app->request->post()) && $model->save()) {
            return $this->redirect(['view', 'id' => $model->id]);
        } else {
            return $this->render('create', [
                        'model' => $model,
            ]);
        }
    }

    /**
     * Updates an existing Orders model.
     * If update is successful, the browser will be redirected to the 'view' page.
     * @param integer $id
     * @return mixed
     */
    public function actionUpdate($id) {
        $model = $this->findModel($id);

        if ($model->load(Yii::$app->request->post()) && $model->save()) {
            return $this->redirect(['view', 'id' => $model->id]);
        } else {
            return $this->render('update', [
                        'model' => $model,
            ]);
        }
    }

    /**
     * Deletes an existing Orders model.
     * If deletion is successful, the browser will be redirected to the 'index' page.
     * @param integer $id
     * @return mixed
     */
    public function actionDelete($id) {
        $this->findModel($id)->delete();

        return $this->redirect(['index']);
    }

    /**
     * Finds the Orders model based on its primary key value.
     * If the model is not found, a 404 HTTP exception will be thrown.
     * @param integer $id
     * @return Orders the loaded model
     * @throws NotFoundHttpException if the model cannot be found
     */
    protected function findModel($id) {
        if (($model = Orders::findOne($id)) !== null) {
            return $model;
        } else {
            throw new NotFoundHttpException('The requested page does not exist.');
        }
    }

}
