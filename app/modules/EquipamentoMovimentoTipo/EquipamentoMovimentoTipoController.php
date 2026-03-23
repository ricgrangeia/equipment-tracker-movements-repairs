<?php

namespace app\modules\EquipamentoMovimentoTipo;

use Yii;
use yii\db\StaleObjectException;
use yii\web\Controller;
use yii\web\NotFoundHttpException;
use yii\filters\VerbFilter;
use yii\web\Response;
use yii\helpers\Html;

/**
 * EquipamentoMovimentoTipoController implements the CRUD actions for EquipamentoMovimentoTipo model.
 */
class EquipamentoMovimentoTipoController extends Controller
{
    /**
     * @inheritdoc
     */
    public function behaviors(): array {
        return [
            'verbs' => [
                'class' => VerbFilter::class,
                'actions' => [
                    'delete' => ['post'],
                    'bulkdelete' => ['post'],
                ],
            ],
        ];
    }

    /**
     * Lists all EquipamentoMovimentoTipo models.
     * @return string
	 */
    public function actionIndex(): string {
        $searchModel = new EquipamentoMovimentoTipoSearch();
        $dataProvider = $searchModel->search(Yii::$app->request->queryParams);

        return $this->render('index', [
            'searchModel' => $searchModel,
            'dataProvider' => $dataProvider,
        ]);
    }


	/**
	 * Displays a single EquipamentoMovimentoTipo model.
	 * @param integer $id
	 * @return array|string
	 * @throws NotFoundHttpException
	 */
    public function actionView( int $id)
    {   
        $request = Yii::$app->request;
        if($request->isAjax){
            Yii::$app->response->format = Response::FORMAT_JSON;
            return [
                    'title'=> "EquipamentoMovimentoTipo #".$id,
                    'content'=>$this->renderAjax('view', [
                        'model' => $this->findModel($id),
                    ]),
                    'footer'=> Html::button(Yii::t('yii2-ajaxcrud', 'Close'), ['class'=>'btn btn-default pull-left', 'data-dismiss'=>"modal", 'data-bs-dismiss'=>"modal"]).
                            Html::a(Yii::t('yii2-ajaxcrud', 'Update'), ['update','id'=>$id],['class'=>'btn btn-primary','role'=>'modal-remote'])
                ];    
        }else{
            return $this->render('view', [
                'model' => $this->findModel($id),
            ]);
        }
    }

    /**
     * Creates a new EquipamentoMovimentoTipo model.
     * For ajax request will return json object
     * and for non-ajax request if creation is successful, the browser will be redirected to the 'view' page.
     * @return array|Response|string|string[]
	 */
    public function actionCreate()
    {
        $request = Yii::$app->request;
        $model = new EquipamentoMovimentoTipo();  

        if($request->isAjax){
            /*
            *   Process for ajax request
            */
            Yii::$app->response->format = Response::FORMAT_JSON;
            if($request->isGet){
                return [
                    'title'=> Yii::t('yii2-ajaxcrud', 'Create New')." EquipamentoMovimentoTipo",
                    'content'=>$this->renderAjax('create', [
                        'model' => $model,
                    ]),
                    'footer'=> Html::button(Yii::t('yii2-ajaxcrud', 'Close'), ['class'=>'btn btn-default pull-left', 'data-dismiss'=>"modal", 'data-bs-dismiss'=>"modal"]).
                                Html::button(Yii::t('yii2-ajaxcrud', 'Create'), ['class'=>'btn btn-primary','type'=>"submit"])
        
                ];         
            }else if($model->load($request->post()) && $model->save()){
                return [
                    'forceReload'=>'#crud-datatable-pjax',
                    'title'=> Yii::t('yii2-ajaxcrud', 'Create New')." EquipamentoMovimentoTipo",
                    'content'=>'<span class="text-success">'.Yii::t('yii2-ajaxcrud', 'Create').' EquipamentoMovimentoTipo '.Yii::t('yii2-ajaxcrud', 'Success').'</span>',
                    'footer'=> Html::button(Yii::t('yii2-ajaxcrud', 'Close'), ['class'=>'btn btn-default pull-left', 'data-dismiss'=>"modal", 'data-bs-dismiss'=>"modal"]).
                            Html::a(Yii::t('yii2-ajaxcrud', 'Create More'), ['create'],['class'=>'btn btn-primary','role'=>'modal-remote'])
        
                ];         
            }else{           
                return [
                    'title'=> Yii::t('yii2-ajaxcrud', 'Create New')." EquipamentoMovimentoTipo",
                    'content'=>$this->renderAjax('create', [
                        'model' => $model,
                    ]),
                    'footer'=> Html::button(Yii::t('yii2-ajaxcrud', 'Close'), ['class'=>'btn btn-default pull-left', 'data-dismiss'=>"modal", 'data-bs-dismiss'=>"modal"]).
                                Html::button(Yii::t('yii2-ajaxcrud', 'Save'), ['class'=>'btn btn-primary','type'=>"submit"])
        
                ];         
            }
        }else{
            /*
            *   Process for non-ajax request
            */
            if ($model->load($request->post()) && $model->save()) {
                return $this->redirect(['view', 'id' => $model->id]);
            } else {
                return $this->render('create', [
                    'model' => $model,
                ]);
            }
        }
       
    }

	/**
	 * Updates an existing EquipamentoMovimentoTipo model.
	 * For ajax request will return json object
	 * and for non-ajax request if update is successful, the browser will be redirected to the 'view' page.
	 * @param integer $id
	 * @return array|Response|string
	 * @throws NotFoundHttpException
	 */
    public function actionUpdate( int $id)
    {
        $request = Yii::$app->request;
        $model = $this->findModel($id);       

        if($request->isAjax){
            /*
            *   Process for ajax request
            */
            Yii::$app->response->format = Response::FORMAT_JSON;
            if($request->isGet){
                return [
                    'title'=> Yii::t('yii2-ajaxcrud', 'Update')." EquipamentoMovimentoTipo #".$id,
                    'content'=>$this->renderAjax('update', [
                        'model' => $model,
                    ]),
                    'footer'=> Html::button(Yii::t('yii2-ajaxcrud', 'Close'), ['class'=>'btn btn-default pull-left', 'data-dismiss'=>"modal", 'data-bs-dismiss'=>"modal"]).
                                Html::button(Yii::t('yii2-ajaxcrud', 'Save'), ['class'=>'btn btn-primary','type'=>"submit"])
                ];         
            }else if($model->load($request->post()) && $model->save()){
                return [
                    'forceReload'=>'#crud-datatable-pjax',
                    'title'=> "EquipamentoMovimentoTipo #".$id,
                    'content'=>$this->renderAjax('view', [
                        'model' => $model,
                    ]),
                    'footer'=> Html::button(Yii::t('yii2-ajaxcrud', 'Close'), ['class'=>'btn btn-default pull-left', 'data-dismiss'=>"modal", 'data-bs-dismiss'=>"modal"]).
                            Html::a(Yii::t('yii2-ajaxcrud', 'Update'), ['update','id'=>$id],['class'=>'btn btn-primary','role'=>'modal-remote'])
                ];    
            }else{
                 return [
                    'title'=> Yii::t('yii2-ajaxcrud', 'Update')." EquipamentoMovimentoTipo #".$id,
                    'content'=>$this->renderAjax('update', [
                        'model' => $model,
                    ]),
                    'footer'=> Html::button(Yii::t('yii2-ajaxcrud', 'Close'), ['class'=>'btn btn-default pull-left', 'data-dismiss'=>"modal", 'data-bs-dismiss'=>"modal"]).
                                Html::button(Yii::t('yii2-ajaxcrud', 'Save'), ['class'=>'btn btn-primary','type'=>"submit"])
                ];        
            }
        }else{
            /*
            *   Process for non-ajax request
            */
            if ($model->load($request->post()) && $model->save()) {
                return $this->redirect(['view', 'id' => $model->id]);
            } else {
                return $this->render('update', [
                    'model' => $model,
                ]);
            }
        }
    }

	/**
	 * Delete an existing EquipamentoMovimentoTipo model.
	 * For ajax request will return json object
	 * and for non-ajax request if deletion is successful, the browser will be redirected to the 'index' page.
	 * @param integer $id
	 * @return array|Response
	 * @throws NotFoundHttpException
	 * @throws StaleObjectException
	 */
    public function actionDelete( int $id)
    {
        $request = Yii::$app->request;
        $this->findModel($id)->delete();

        if($request->isAjax){
            /*
            *   Process for ajax request
            */
            Yii::$app->response->format = Response::FORMAT_JSON;
            return ['forceClose'=>true,'forceReload'=>'#crud-datatable-pjax'];
        }else{
            /*
            *   Process for non-ajax request
            */
            return $this->redirect(['index']);
        }


    }

	/**
	 * Delete multiple existing EquipamentoMovimentoTipo model.
	 * For ajax request will return json object
	 * and for non-ajax request if deletion is successful, the browser will be redirected to the 'index' page.
	 * @return array|Response
	 * @throws NotFoundHttpException
	 * @throws StaleObjectException
	 */
    public function actionBulkdelete()
    {        
        $request = Yii::$app->request;
        $pks = explode(',', $request->post( 'pks' )); // Array or selected records primary keys
        foreach ( $pks as $pk ) {
            $model = $this->findModel($pk);
            $model->delete();
        }

        if($request->isAjax){
            /*
            *   Process for ajax request
            */
            Yii::$app->response->format = Response::FORMAT_JSON;
            return ['forceClose'=>true,'forceReload'=>'#crud-datatable-pjax'];
        }else{
            /*
            *   Process for non-ajax request
            */
            return $this->redirect(['index']);
        }
       
    }

    public function actionMovimentoTipo(): array {


        Yii::$app->response->format = Response::FORMAT_JSON;
        if (isset($_POST['depdrop_parents'])) {
            $parents = $_POST['depdrop_parents'];
            if ($parents != null) {
                $equipamento_id = $parents[0];
                $out = EquipamentoMovimentoTipo::getMovimentoTipoForEquipamento($equipamento_id);
                return ['output'=>$out, 'selected'=>''];
            }
        }
//        $params = [];
//        if (!empty($_POST['depdrop_params'])) {
//            foreach ($_POST['depdrop_params'] as $id => $value) {
//                $param1 = $params[0]; // the first parameter value you passed
//                $out = EquipamentoMovimentoTipo::getMovimentoTipoForEquipamento($param1);
//                return ['output'=>$out, 'selected'=>''];
//            }
//        }
        return ['output'=>'', 'selected'=>''];

    }


    /**
     * Finds the EquipamentoMovimentoTipo model based on its primary key value.
     * If the model is not found, a 404 HTTP exception will be thrown.
     * @param integer $id
     * @return EquipamentoMovimentoTipo the loaded model
     * @throws NotFoundHttpException if the model cannot be found
     */
    protected function findModel( int $id): EquipamentoMovimentoTipo {
        if (($model = EquipamentoMovimentoTipo::findOne($id)) !== null) {
            return $model;
        } else {
            throw new NotFoundHttpException('The requested page does not exist.');
        }
    }
}
