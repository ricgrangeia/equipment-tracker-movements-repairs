<?php

namespace app\controllers;

use Yii;
use mdm\admin\models\searchs\User as UserSearch;
use yii\web\Controller;


/**
 * EquipamentoController implements the CRUD actions for Equipamento model.
 */
class EquipamentoController extends Controller
{
    /**
     * Lists all User models.
     * @return mixed
     */
    public function actionIndex()
    {
        $searchModel = new UserSearch();
        $dataProvider = $searchModel->search(Yii::$app->request->queryParams);

        return $this->render('index', [
            'searchModel' => $searchModel,
            'dataProvider' => $dataProvider,
        ]);
    }
}

