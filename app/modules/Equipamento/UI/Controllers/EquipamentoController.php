<?php

/**
 * @author : Ricardo Grangeia Dias
 * @profile : PHP Developer
 * @email : ricardo@grangeia.pt
 * @site : https://ricardo.grangeia.pt
 */

namespace app\modules\Equipamento\UI\Controllers;

use app\models\EquipamentoReparacaoSearch;
use app\modules\Equipamento\Domain\Entity\Equipamento;
use app\modules\Equipamento\Domain\Entity\EquipamentoSearch;
use app\modules\EquipamentoMovimento\EquipamentoMovimentoSearch;
use kartik\grid\EditableColumnAction;
use kartik\mpdf\Pdf;
use Yii;
use yii\db\Query;
use yii\filters\VerbFilter;
use yii\helpers\ArrayHelper;
use yii\helpers\Html;
use yii\helpers\Json;
use yii\web\Controller;
use yii\web\NotFoundHttpException;
use yii\web\Response;

/**
 * EquipamentoController implements the CRUD actions for Equipamento model.
 */
class EquipamentoController extends Controller
{
	/**
	 * @inheritdoc
	 */
	public function behaviors()
	{

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

	public function actions()
	{

		return ArrayHelper::merge(parent::actions(), [
			'editequipamento' => [                                       // identifier for your editable column action
				'class' => EditableColumnAction::class,     // action class name
				'modelClass' => Equipamento::class,                // the model for the record being edited
				'outputValue' => function ($model, $attribute, $key, $index) {

					return (int)$model->$attribute / 100;      // return any custom output value if desired
				},
				'outputMessage' => function ($model, $attribute, $key, $index) {

					return '';                                  // any custom error to return after model save
				},
				'showModelErrors' => true,                        // show model validation errors after save
				'errorOptions' => ['header' => ''],                // error summary HTML options
				// 'postOnly' => true,
				// 'ajaxOnly' => true,
				// 'findModel' => function($id, $action) {},
				// 'checkAccess' => function($action, $model) {}
			],
		]);
	}

	/**
	 * Lists all Equipamento models.
	 * @return mixed
	 */
	public function actionIndex()
	{

		$searchModel = new EquipamentoSearch();
		$dataProvider = $searchModel->search(Yii::$app->request->queryParams);

		return $this->render('index', [
			'searchModel' => $searchModel,
			'dataProvider' => $dataProvider,
		]);
	}

	/**
	 * Lists all Equipamento models.
	 * @return mixed
	 */
	public function actionVerificarAvaliacao()
	{

		$searchModel = new EquipamentoSearch();
		$dataProvider = $searchModel->search(Yii::$app->request->queryParams);


		return $this->render('index_avaliacao', [
			'searchModel' => $searchModel,
			'dataProvider' => $dataProvider,
		]);
	}


	/**
	 * Handle updates for fields using editable widgets.
	 */
	public function actionEditableUpdate()
	{

		if (isset($_POST['hasEditable'])) {

			yii::debug(Yii::$app->request->post());
			//             Grab existing model
			$id = Yii::$app->request->post('editableKey');
			$model = $this->findModel($id);

			// use Yii's response format to encode output as JSON
			Yii::$app->response->format = \yii\web\Response::FORMAT_JSON;

			// Grab the post parameters array (as attribute => value)
			$modelClassName = \yii\helpers\StringHelper::basename(get_class($model));
			$params = Yii::$app->request->post($modelClassName);
			// Pull the first value from the array (there should only be one)
			$value = reset($params);
			yii::debug($value);
			$model->attributes = $value;
			//            $model->avaliacao_data_ultima = date('Y-m-d');
			yii::debug($model);

			// Save posted model attributes
			if ($model->load(Yii::$app->request->post()) && $model->save()) {

				// Return JSON encoded output in the below format
				return ['output' => $model->id, 'message' => 'Gravado com Sucesso!'];
			} else {
				// Else if nothing to do always return an empty JSON encoded output.
				// Alternatively, return a validation error.
				return ['output' => '', 'message' => 'Failed to validate or save'];
			}
		}
	}


	/**
	 * Lists all Equipamento models.
	 * @return mixed
	 */
	public function actionAvaliacao($id)
	{

		$request = Yii::$app->request;
		$model = $this->findModel($id);

		if ($request->isAjax) {
			/*
			*   Process for ajax request
			*/
			Yii::$app->response->format = Response::FORMAT_JSON;
			if ($request->isGet) {
				return [
					'title' => Yii::t('yii2-ajaxcrud', 'Update') . " Equipamento " . $model->num_interno,
					'content' => $this->renderAjax('update', [
						'model' => $model,
					]),
					'footer' => Html::button(Yii::t('yii2-ajaxcrud', 'Close'), ['class' => 'btn btn-default pull-left', 'data-dismiss' => "modal", 'data-bs-dismiss' => "modal"]) .
						Html::button(Yii::t('yii2-ajaxcrud', 'Save'), ['class' => 'btn btn-primary', 'type' => "submit"]),
				];
			} else if ($model->load($request->post()) && $model->save()) {
				return [
					'forceReload' => '#crud-datatable-pjax',
					'title' => "Equipamento #" . $id,
					'content' => $this->renderAjax('view', [
						'model' => $model,
					]),
					'footer' => Html::button(Yii::t('yii2-ajaxcrud', 'Close'), ['class' => 'btn btn-default pull-left', 'data-dismiss' => "modal", 'data-bs-dismiss' => "modal"]) .
						Html::a(Yii::t('yii2-ajaxcrud', 'Update'), ['update', 'id' => $id], ['class' => 'btn btn-primary', 'role' => 'modal-remote']),
				];
			} else {
				return [
					'title' => Yii::t('yii2-ajaxcrud', 'Update') . " Equipamento #" . $id,
					'content' => $this->renderAjax('update', [
						'model' => $model,
					]),
					'footer' => Html::button(Yii::t('yii2-ajaxcrud', 'Close'), ['class' => 'btn btn-default pull-left', 'data-dismiss' => "modal", 'data-bs-dismiss' => "modal"]) .
						Html::button(Yii::t('yii2-ajaxcrud', 'Save'), ['class' => 'btn btn-primary', 'type' => "submit"]),
				];
			}
		} else {
			/*
			*   Process for non-ajax request
			*/
			if ($model->load($request->post()) && $model->save()) {
				\app\modules\Equipamento\ImgTable::moduloImagens($model, $_FILES['imgFicheiros']);
				//                return $this->redirect(['view', 'id' => $model->id]);
			} else {
				return $this->render('update', [
					'model' => $model,
				]);
			}
		}
	}

	/**
	 * Displays a single Equipamento model.
	 * @param integer $id
	 * @return mixed
	 */
	public function actionView($id)
	{

		$request = Yii::$app->request;
		if ($request->isAjax) {
			Yii::$app->response->format = Response::FORMAT_JSON;

			return [
				'title' => "Equipamento #" . $id,
				'content' => $this->renderAjax('view', [
					'model' => $this->findModel($id),
				]),
				'footer' => Html::button(Yii::t('yii2-ajaxcrud', 'Close'), ['class' => 'btn btn-default pull-left', 'data-dismiss' => "modal", 'data-bs-dismiss' => "modal"]) .
					Html::a(Yii::t('yii2-ajaxcrud', 'Update'), ['update', 'id' => $id], ['class' => 'btn btn-primary', 'role' => 'modal-remote']),
			];
		} else {
			return $this->render('view', [
				'model' => $this->findModel($id),
			]);
		}
	}

	/**
	 * Creates a new Equipamento model.
	 * For ajax request will return json object
	 * and for non-ajax request if creation is successful, the browser will be redirected to the 'view' page.
	 * @return mixed
	 */
	public function actionCreate()
	{

		$request = Yii::$app->request;
		$model = new Equipamento();

		if ($request->isAjax) {
			/*
			*   Process for ajax request
			*/
			Yii::$app->response->format = Response::FORMAT_JSON;
			if ($request->isGet) {
				return [
					'title' => Yii::t('yii2-ajaxcrud', 'Create New') . " Equipamento",
					'content' => $this->renderAjax('create', [
						'model' => $model,
					]),
					'footer' => Html::button(Yii::t('yii2-ajaxcrud', 'Close'), ['class' => 'btn btn-default pull-left', 'data-dismiss' => "modal", 'data-bs-dismiss' => "modal"]) .
						Html::button(Yii::t('yii2-ajaxcrud', 'Create'), ['class' => 'btn btn-primary', 'type' => "submit"]),

				];
			} else if ($model->load($request->post()) && $model->save()) {


				return [
					'forceReload' => '#crud-datatable-pjax',
					'title' => Yii::t('yii2-ajaxcrud', 'Create New') . " Equipamento",
					'content' => '<span class="text-success">' . Yii::t('yii2-ajaxcrud', 'Create') . ' Equipamento ' . Yii::t('yii2-ajaxcrud', 'Success') . '</span>',
					'footer' => Html::button(Yii::t('yii2-ajaxcrud', 'Close'), ['class' => 'btn btn-default pull-left', 'data-dismiss' => "modal", 'data-bs-dismiss' => "modal"]) .
						Html::a(Yii::t('yii2-ajaxcrud', 'Create More'), ['create'], ['class' => 'btn btn-primary', 'role' => 'modal-remote']),

				];
			} else {
				return [
					'title' => Yii::t('yii2-ajaxcrud', 'Create New') . " Equipamento",
					'content' => $this->renderAjax('create', [
						'model' => $model,
					]),
					'footer' => Html::button(Yii::t('yii2-ajaxcrud', 'Close'), ['class' => 'btn btn-default pull-left', 'data-dismiss' => "modal", 'data-bs-dismiss' => "modal"]) .
						Html::button(Yii::t('yii2-ajaxcrud', 'Save'), ['class' => 'btn btn-primary', 'type' => "submit"]),

				];
			}
		} else {
			/*
			*   Process for non-ajax request
			*/
			if ($model->load($request->post()) && $model->save()) {

				//                ImgTable::moduloImagens($model, $_FILES['imgFicheiros']);
				//                return $this->redirect(['view', 'id' => $model->id]);
			} else {
				return $this->render('create', [
					'model' => $model,
				]);
			}
		}
	}

	/**
	 * Updates an existing Equipamento model.
	 * For ajax request will return json object
	 * and for non-ajax request if update is successful, the browser will be redirected to the 'view' page.
	 * @param integer $id
	 * @return mixed
	 */
	public function actionUpdate($id)
	{

		$request = Yii::$app->request;
		$model = $this->findModel($id);

		if ($request->isAjax) {
			/*
			*   Process for ajax request
			*/


			Yii::$app->response->format = Response::FORMAT_JSON;
			if ($request->isGet) {
				return [
					'title' => Yii::t('yii2-ajaxcrud', 'Update') . " Equipamento " . $model->num_interno,
					'content' => $this->renderAjax('update', [
						'model' => $model,
					]),
					'footer' => Html::button(Yii::t('yii2-ajaxcrud', 'Close'), ['class' => 'btn btn-default pull-left', 'data-dismiss' => "modal", 'data-bs-dismiss' => "modal"]) .
						Html::button(Yii::t('yii2-ajaxcrud', 'Save'), ['class' => 'btn btn-primary', 'type' => "submit"]),
				];
			}

			if ($model->load($request->post()) && $model->save()) {

				return [
					'forceReload' => '#crud-datatable-pjax',
					'title' => "Equipamento #" . $id,
					'content' => $this->renderAjax('view', [
						'model' => $model,
					]),
					'footer' => Html::button(Yii::t('yii2-ajaxcrud', 'Close'), ['class' => 'btn btn-default pull-left', 'data-dismiss' => "modal", 'data-bs-dismiss' => "modal"]) .
						Html::a(Yii::t('yii2-ajaxcrud', 'Update'), ['update', 'id' => $id], ['class' => 'btn btn-primary', 'role' => 'modal-remote']),
				];
			}

			return [
				'title' => Yii::t('yii2-ajaxcrud', 'Update') . " Equipamento #" . $id,
				'content' => $this->renderAjax('update', [
					'model' => $model,
				]),
				'footer' => Html::button(Yii::t('yii2-ajaxcrud', 'Close'), ['class' => 'btn btn-default pull-left', 'data-dismiss' => "modal", 'data-bs-dismiss' => "modal"]) .
					Html::button(Yii::t('yii2-ajaxcrud', 'Save'), ['class' => 'btn btn-primary', 'type' => "submit"]),
			];
		} else {
			/*
			*   Process for non-ajax request
			*/
			if ($model->load($request->post()) && $model->save()) {
				\app\modules\Equipamento\ImgTable::moduloImagens($model, $_FILES['imgFicheiros']);
				//                return $this->redirect(['view', 'id' => $model->id]);
			} else {
				return $this->render('update', [
					'model' => $model,
				]);
			}
		}
	}

	/**
	 * Delete an existing Equipamento model.
	 * For ajax request will return json object
	 * and for non-ajax request if deletion is successful, the browser will be redirected to the 'index' page.
	 * @param integer $id
	 * @return mixed
	 */
	public function actionDelete($id)
	{

		$request = Yii::$app->request;
		$this->findModel($id)->delete();

		if ($request->isAjax) {
			/*
			*   Process for ajax request
			*/
			Yii::$app->response->format = Response::FORMAT_JSON;

			return ['forceClose' => true, 'forceReload' => '#crud-datatable-pjax'];
		} else {
			/*
			*   Process for non-ajax request
			*/
			return $this->redirect(['index']);
		}
	}


	/**
	 * Delete multiple existing Equipamento model.
	 * For ajax request will return json object
	 * and for non-ajax request if deletion is successful, the browser will be redirected to the 'index' page.
	 * @param integer $id
	 * @return mixed
	 */
	public function actionBulkdelete()
	{

		$request = Yii::$app->request;
		$pks = explode(',', $request->post('pks')); // Array or selected records primary keys
		foreach ($pks as $pk) {
			$model = $this->findModel($pk);
			$model->delete();
		}

		if ($request->isAjax) {
			/*
			*   Process for ajax request
			*/
			Yii::$app->response->format = Response::FORMAT_JSON;

			return ['forceClose' => true, 'forceReload' => '#crud-datatable-pjax'];
		} else {
			/*
			*   Process for non-ajax request
			*/
			return $this->redirect(['index']);
		}
	}

	public function actionReport($id)
	{

		Yii::$app->response->format = \yii\web\Response::FORMAT_RAW;

		$model = $this->findModel($id);


		$dataProviderEqMov = (new EquipamentoMovimentoSearch(['equipamento_id' => $id]))->search(Yii::$app->request->queryParams);


		$dataProviderEqRep = (new EquipamentoReparacaoSearch(['equipamento_id' => $id]))->search(Yii::$app->request->queryParams);


		$pdf = new Pdf([
			'mode' => Pdf::MODE_CORE, // leaner size using standard fonts
			'destination' => Pdf::DEST_BROWSER,
			'content' => $this->renderPartial('pdfReport', [
				'model' => $model,
				'dataProviderEqMov' => $dataProviderEqMov,
				'dataProviderEqRep' => $dataProviderEqRep,
			]),
			'options' => [
				// any mpdf options you wish to set
			],
			'methods' => [
				'SetTitle' => 'Relatório Equipamentos',
				//                'SetSubject' => 'Generating PDF files via yii2-mpdf extension has never been easy',
				'SetHeader' => ['Relatório Equipamento'],
				'SetFooter' => ['|Página {PAGENO}|'],
				//                'SetAuthor' => 'Kartik Visweswaran',
				//                'SetCreator' => 'Kartik Visweswaran',
				//                'SetKeywords' => 'Krajee, Yii2, Export, PDF, MPDF, Output, Privacy, Policy, yii2-mpdf',
			],
		]);

		return $pdf->render();
	}


	/**
	 * Your controller action to fetch the list
	 */
	public function actionMarcaList($marca = null)
	{

		$query = new Query;
		$query->select('marca')
			->distinct()
			->from('equipamento')
			->where(" LOWER( marca ) LIKE '%$marca%' ")
			->orderBy('marca');
		$command = $query->createCommand();
		$data = $command->queryAll();
		$out = [];
		foreach ($data as $d) {
			$out[] = $d['marca'];
		}
		echo Json::encode($out);
	}

	/**
	 * Your controller action to fetch the list
	 */
	public function actionEquipamentoList($equipamento = null)
	{

		$query = new Query;
		$query->select('equipamento')
			->distinct()
			->from('equipamento')
			->where(" LOWER( equipamento ) LIKE '%$equipamento%' ")
			->orderBy('equipamento');
		$command = $query->createCommand();
		$data = $command->queryAll();
		$out = [];
		foreach ($data as $d) {
			$out[] = $d['equipamento'];
		}
		echo Json::encode($out);
	}


	/**
	 * @param $id
	 * @return string|null
	 * @throws NotFoundHttpException
	 */
	public function actionGetDescricao($id)
	{

		Yii::$app->response->format = Response::FORMAT_JSON;

		$model = $this->findModel($id);

		return $model->descricao;
	}

	public function actionGetAcessorios($id)
	{

		Yii::$app->response->format = Response::FORMAT_JSON;

		$model = $this->findModel($id);

		return $model->acessorios;
	}

	public function actionGetObservacoes($id)
	{

		Yii::$app->response->format = Response::FORMAT_JSON;

		$model = $this->findModel($id);

		return $model->observacoes;
	}

	/**
	 * Finds the Equipamento model based on its primary key value.
	 * If the model is not found, a 404 HTTP exception will be thrown.
	 * @param integer $id
	 * @return Equipamento the loaded model
	 * @throws NotFoundHttpException if the model cannot be found
	 */
	protected function findModel($id)
	{

		if (($model = Equipamento::findOne($id)) !== null) {
			return $model;
		} else {
			throw new NotFoundHttpException('The requested page does not exist.');
		}
	}
}
