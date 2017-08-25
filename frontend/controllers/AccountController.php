<?php

namespace frontend\controllers;

use Yii;
use common\models\Account;
use common\models\AccountSearch;
use common\models\AccountReport;
use common\models\AccountReportSearch;
use yii\web\Controller;
use yii\web\NotFoundHttpException;
use yii\filters\VerbFilter;

/**
 * AccountController implements the CRUD actions for Account model.
 */
class AccountController extends Controller {

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
     * Lists all Account models.
     * @return mixed
     */
    public function actionIndex() {
        $searchDaily = new AccountReportSearch();
        $dataDaily = $searchDaily->search(Yii::$app->request->queryParams);
        $dataDaily->query->groupBy('date');
        
        $searchMonthly = new AccountReportSearch();
        $dataMonthly = $searchMonthly->search(Yii::$app->request->queryParams);
        $dataMonthly->query->groupBy('month');

        $searchYearly = new AccountReportSearch();
        $dataYearly = $searchYearly->search(Yii::$app->request->queryParams);
        $dataYearly->query->groupBy('year');

        $searchModel = new AccountSearch();
        $dataProvider = $searchModel->search(Yii::$app->request->queryParams);
        $dataProvider->sort->defaultOrder = ['id' => SORT_DESC];
        $model = new Account();
        if ($model->load(Yii::$app->request->post()) && $model->save()) {
            Yii::$app->session['date'] = $model->date;
            $model = new Account();
            return $this->redirect(['index']);
        }

        return $this->render('index', [
                    'model' => $model,
                    'searchModel' => $searchModel,
                    'dataProvider' => $dataProvider,
                    'searchDaily' => $searchDaily,
                    'dataDaily' => $dataDaily,
                    'searchMonthly' => $searchMonthly,
                    'dataMonthly' => $dataMonthly,
                    'searchYearly' => $searchYearly,
                    'dataYearly' => $dataYearly,
        ]);
    }

    /**
     * Displays a single Account model.
     * @param integer $id
     * @return mixed
     */
    public function actionView($id) {
        return $this->render('view', [
                    'model' => $this->findModel($id),
        ]);
    }

    /**
     * Creates a new Account model.
     * If creation is successful, the browser will be redirected to the 'view' page.
     * @return mixed
     */
    public function actionCreate() {
        $model = new Account();

        if ($model->load(Yii::$app->request->post()) && $model->save()) {
            return $this->redirect(['view', 'id' => $model->id]);
        } else {
            return $this->render('create', [
                        'model' => $model,
            ]);
        }
    }

    /**
     * Updates an existing Account model.
     * If update is successful, the browser will be redirected to the 'view' page.
     * @param integer $id
     * @return mixed
     */
    public function actionUpdate($id) {
        $model = $this->findModel($id);

        if ($model->load(Yii::$app->request->post()) && $model->save()) {
            // return $this->redirect(['view', 'id' => $model->id]);
            return $this->redirect(['index']);
        } else {
            return $this->render('update', [
                        'model' => $model,
            ]);
        }
    }

    /**
     * Deletes an existing Account model.
     * If deletion is successful, the browser will be redirected to the 'index' page.
     * @param integer $id
     * @return mixed
     */
    public function actionDelete($id) {
        $this->findModel($id)->delete();

        return $this->redirect(['index']);
    }

    /**
     * Finds the Account model based on its primary key value.
     * If the model is not found, a 404 HTTP exception will be thrown.
     * @param integer $id
     * @return Account the loaded model
     * @throws NotFoundHttpException if the model cannot be found
     */
    protected function findModel($id) {
        if (($model = Account::findOne($id)) !== null) {
            return $model;
        } else {
            throw new NotFoundHttpException('The requested page does not exist.');
        }
    }

}
