<?php

namespace app\controllers;


use app\modules\EquipamentoMovimento\EquipamentoMovimento;
use Yii;
use app\models\EquipamentoReparacao;
use app\models\EquipamentoReparacaoSearch;
use yii\web\Controller;
use yii\web\NotFoundHttpException;
use yii\filters\VerbFilter;
use \yii\web\Response;
use yii\helpers\Html;

/**
 * EquipamentoReparacaoController implements the CRUD actions for EquipamentoReparacao model.
 */
class EquipamentoReparacaoController extends Controller {
	/**
	 * @inheritdoc
	 */
	public function behaviors() {

		return [
			'verbs' => [
				'class' => VerbFilter::class,
				'actions' => [
					'delete' => [ 'post' ],
					'bulkdelete' => [ 'post' ],
				],
			],
		];
	}

	/**
	 * Lists all EquipamentoReparacao models.
	 * @return mixed
	 */
	public function actionIndex() {

		$searchModel = new EquipamentoReparacaoSearch();
		$dataProvider = $searchModel->search( Yii::$app->request->queryParams );

		return $this->render( 'index', [
			'searchModel' => $searchModel,
			'dataProvider' => $dataProvider,
		] );
	}


	/**
	 * Displays a single EquipamentoReparacao model.
	 * @param integer $id
	 * @return mixed
	 */
	public function actionView( $id ) {

		$request = Yii::$app->request;
		if ( $request->isAjax ) {
			Yii::$app->response->format = Response::FORMAT_JSON;

			return [
				'title' => "EquipamentoReparacao #" . $id,
				'content' => $this->renderAjax( 'view', [
					'model' => $this->findModel( $id ),
				] ),
				'footer' => Html::button( Yii::t( 'yii2-ajaxcrud', 'Close' ), [ 'class' => 'btn btn-default pull-left', 'data-dismiss' => "modal", 'data-bs-dismiss' => "modal" ] ) .
					Html::a( Yii::t( 'yii2-ajaxcrud', 'Update' ), [ 'update', 'id' => $id ], [ 'class' => 'btn btn-primary', 'role' => 'modal-remote' ] ),
			];
		} else {
			return $this->render( 'view', [
				'model' => $this->findModel( $id ),
			] );
		}
	}

	/**
	 * Creates a new EquipamentoReparacao model.
	 * For ajax request will return json object
	 * and for non-ajax request if creation is successful, the browser will be redirected to the 'view' page.
	 * @return mixed
	 */
	public function actionCreate() {

		$request = Yii::$app->request;
		$model = new EquipamentoReparacao();


		if ( $request->isAjax ) {
			/*
			*   Process for ajax request
			*/


			Yii::$app->response->format = Response::FORMAT_JSON;
			if ( $request->isGet ) {
				return [
					'title' => Yii::t( 'app-equipamento-reparacao', 'Create New' ),
					'content' => $this->renderAjax( 'create', [
						'model' => $model,
					] ),
					'footer' => Html::button( Yii::t( 'app-forms', 'Close' ), [ 'class' => 'btn btn-default pull-left', 'data-dismiss' => "modal", 'data-bs-dismiss' => "modal" ] ) .
						Html::button( Yii::t( 'yii2-ajaxcrud', 'Create' ), [ 'class' => 'btn btn-primary', 'type' => "submit" ] ),

				];
			} else if ( $model->load( $request->post() ) && $model->save() ) {

				# Verifica se foi criada reparação para o equipamento
				# TODO: fazer com que se crie movimento Saída para reparação automático
				if ( !empty( $model->data_envio ) ) {

					$movimentoAnterior = EquipamentoMovimento::find()
						->where( "equipamento_id = $model->equipamento_id" )
						->orderBy( [ 'id' => SORT_DESC ] )
						->one();
					# Guarda o destino origem para der inserido quando o equipamento regressar
					$model->destino_origem = $movimentoAnterior->destino_id;

					$movimento = new EquipamentoMovimento();
					$movimento->equipamento_id = $model->equipamento_id;
					$movimento->data = $model->data_envio;
					$movimento->utilizador_responsavel = Yii::$app->user->id;
					$movimento->observacoes = "Para reparação na $model->entidade_reparadora";
					$movimento->destino_id = 4;
					# Movimento Reparação # 3
					$movimento->tipo_movimento_id = 3;
					$movimento->save( false );

					# Guarda o id do movimento para ser mais fácil alguma acção ao movimento
					$model->movimento_id_reparacao = $movimento->id;
					$model->save();
				}


				# Verifica se foi criada reparação para o equipamento
				# TODO: fazer com que se crie movimento entrada da reparação automático
				if ( !empty( $model->data_recepcao ) ) {

					$movimentoRegresso = new EquipamentoMovimento();
					$movimentoRegresso->equipamento_id = $model->equipamento_id;
					$movimentoRegresso->data = $model->data_recepcao;
					$movimentoRegresso->utilizador_responsavel = Yii::$app->user->id;
					$movimentoRegresso->observacoes = "Regresso de reparação da $model->entidade_reparadora";
					if ( empty( $model->destino_origem ) ) $model->destino_origem = 3; # Sede
					$movimentoRegresso->destino_id = $model->destino_origem;
					# Movimento Entrada # 2
					$movimentoRegresso->tipo_movimento_id = 2;
					$movimentoRegresso->validate();
					$movimentoRegresso->save( false );

					$model->movimento_id_reparacao_regresso = $movimentoRegresso->id;
					$model->save();
				} else {
					if ( !empty( $model->movimento_id_reparacao_regresso ) ) {
						$movimento = EquipamentoMovimento::findOne( $model->movimento_id_reparacao_regresso );
						$movimento->delete();
						$model->movimento_id_reparacao_regresso = null;
						$model->save();
					}
				}


				return [
					'forceReload' => '#crud-datatable-pjax',
					'title' => Yii::t( 'app-equipamento-reparacao', 'Create New' ),
					'content' => '<span class="text-success">' . Yii::t( 'rbac-admin', 'Create' ) . ' EquipamentoReparacao ' . Yii::t( 'yii2-ajaxcrud', 'Success' ) . '</span>',
					'footer' => Html::button( Yii::t( 'app-forms', 'Close' ), [ 'class' => 'btn btn-default pull-left', 'data-dismiss' => "modal", 'data-bs-dismiss' => "modal" ] ) .
						Html::a( Yii::t( 'rbac-admin', 'Create More' ), [ 'create' ], [ 'class' => 'btn btn-primary', 'role' => 'modal-remote' ] ),

				];
			} else {
				return [
					'title' => Yii::t( 'yii2-ajaxcrud', 'Create New' ) . " EquipamentoReparacao",
					'content' => $this->renderAjax( 'create', [
						'model' => $model,
					] ),
					'footer' => Html::button( Yii::t( 'app-forms', 'Close' ), [ 'class' => 'btn btn-default pull-left', 'data-dismiss' => "modal", 'data-bs-dismiss' => "modal" ] ) .
						Html::button( Yii::t( 'yii2-ajaxcrud', 'Save' ), [ 'class' => 'btn btn-primary', 'type' => "submit" ] ),

				];
			}


		} else {
			/*
			*   Process for non-ajax request
			*/
			if ( $model->load( $request->post() ) && $model->save() ) {
				return $this->redirect( [ 'view', 'id' => $model->id ] );
			} else {
				return $this->render( 'create', [
					'model' => $model,
				] );
			}
		}

	}

	/**
	 * Updates an existing EquipamentoReparacao model.
	 * For ajax request will return json object
	 * and for non-ajax request if update is successful, the browser will be redirected to the 'view' page.
	 * @param integer $id
	 * @return mixed
	 */
	public function actionUpdate( $id ) {

		$request = Yii::$app->request;
		$model = $this->findModel( $id );

		if ( $request->isAjax ) {
			/*
			*   Process for ajax request
			*/
			Yii::$app->response->format = Response::FORMAT_JSON;
			if ( $request->isGet ) {
				return [
					'title' => Yii::t( 'yii2-ajaxcrud', 'Update' ) . " EquipamentoReparacao #" . $id,
					'content' => $this->renderAjax( 'update', [
						'model' => $model,
					] ),
					'footer' => Html::button( Yii::t( 'yii2-ajaxcrud', 'Close' ), [ 'class' => 'btn btn-default pull-left', 'data-dismiss' => "modal", 'data-bs-dismiss' => "modal" ] ) .
						Html::button( Yii::t( 'yii2-ajaxcrud', 'Save' ), [ 'class' => 'btn btn-primary', 'type' => "submit" ] ),
				];
			} else if ( $model->load( $request->post() ) && $model->save() ) {


				if ( !empty( $model->data_envio ) ) {


					if ( empty( $model->movimento_id_reparacao ) )
						$movimentoReparacao = new EquipamentoMovimento();
					else
						$movimentoReparacao = EquipamentoMovimento::findOne( $model->movimento_id_reparacao );

					$movimentoReparacao->equipamento_id = $model->equipamento_id;
					$movimentoReparacao->data = $model->data_envio;
					$movimentoReparacao->utilizador_responsavel = Yii::$app->user->id;
					$movimentoReparacao->observacoes = "Para reparação na $model->entidade_reparadora";
					$movimentoReparacao->destino_id = 4;
					# Movimento Reparação # 3
					$movimentoReparacao->tipo_movimento_id = 3;
					$movimentoReparacao->save( false );

					# Guarda o id do movimento para ser mais fácil alguma acção ao movimento
					$model->movimento_id_reparacao = $movimentoReparacao->id;
					$model->save();
				}

				# Verifica se foi criada reparação para o equipamento
				# TODO: fazer com que se crie movimento entrada da reparação automático
				if ( !empty( $model->data_recepcao ) ) {


					if ( empty( $model->movimento_id_reparacao_regresso ) )
						$movimentoRegresso = new EquipamentoMovimento();
					else
						$movimentoRegresso = EquipamentoMovimento::findOne( $model->movimento_id_reparacao_regresso );

					$movimentoRegresso->equipamento_id = $model->equipamento_id;
					$movimentoRegresso->data = $model->data_recepcao;
					$movimentoRegresso->utilizador_responsavel = Yii::$app->user->id;
					$movimentoRegresso->observacoes = "Regresso de reparação da $model->entidade_reparadora";
					if ( empty( $model->destino_origem ) ) $model->destino_origem = 3; # Sede
					$movimentoRegresso->destino_id = $model->destino_origem;
					# Movimento Entrada # 2
					$movimentoRegresso->tipo_movimento_id = 2;
					$movimentoRegresso->save( false );

					$model->movimento_id_reparacao_regresso = $movimentoRegresso->id;
					$model->save();
				} else {
					if ( !empty( $model->movimento_id_reparacao_regresso ) ) {
						$movimento = EquipamentoMovimento::findOne( $model->movimento_id_reparacao_regresso );
						$movimento->delete();
						$model->movimento_id_reparacao_regresso = null;
						$model->save();
					}
				}


				return [
					'forceReload' => '#crud-datatable-pjax',
					'title' => "EquipamentoReparacao #" . $id,
					'content' => $this->renderAjax( 'view', [
						'model' => $model,
					] ),
					'footer' => Html::button( Yii::t( 'yii2-ajaxcrud', 'Close' ), [ 'class' => 'btn btn-default pull-left', 'data-dismiss' => "modal", 'data-bs-dismiss' => "modal" ] ) .
						Html::a( Yii::t( 'yii2-ajaxcrud', 'Update' ), [ 'update', 'id' => $id ], [ 'class' => 'btn btn-primary', 'role' => 'modal-remote' ] ),
				];
			} else {
				return [
					'title' => Yii::t( 'yii2-ajaxcrud', 'Update' ) . " EquipamentoReparacao #" . $id,
					'content' => $this->renderAjax( 'update', [
						'model' => $model,
					] ),
					'footer' => Html::button( Yii::t( 'yii2-ajaxcrud', 'Close' ), [ 'class' => 'btn btn-default pull-left', 'data-dismiss' => "modal", 'data-bs-dismiss' => "modal" ] ) .
						Html::button( Yii::t( 'yii2-ajaxcrud', 'Save' ), [ 'class' => 'btn btn-primary', 'type' => "submit" ] ),
				];
			}
		} else {
			/*
			*   Process for non-ajax request
			*/
			if ( $model->load( $request->post() ) && $model->save() ) {
				return $this->redirect( [ 'view', 'id' => $model->id ] );
			} else {
				return $this->render( 'update', [
					'model' => $model,
				] );
			}
		}
	}

	/**
	 * Delete an existing EquipamentoReparacao model.
	 * For ajax request will return json object
	 * and for non-ajax request if deletion is successful, the browser will be redirected to the 'index' page.
	 * @param integer $id
	 * @return mixed
	 */
	public function actionDelete( $id ) {

		$request = Yii::$app->request;
		$reparacao = $this->findModel( $id );

		# Elimina o Movimentos automáticos criados e associados à reparacao
		if ( !empty( $reparacao->movimento_id_reparacao_regresso ) )
			$movimento_reparacao_regresso = EquipamentoMovimento::findOne( $reparacao->movimento_id_reparacao_regresso );
		if ( !empty( $movimento_reparacao_regresso ) )
			EquipamentoMovimento::findOne( $reparacao->movimento_id_reparacao_regresso )->delete();

		if ( !empty( $reparacao->movimento_id_reparacao ) )
			$movimento_reparacao = EquipamentoMovimento::findOne( $reparacao->movimento_id_reparacao );
		if ( !empty( $movimento_reparacao ) )
			EquipamentoMovimento::findOne( $reparacao->movimento_id_reparacao )->delete();

		$reparacao->delete();

		if ( $request->isAjax ) {
			/*
			*   Process for ajax request
			*/
			Yii::$app->response->format = Response::FORMAT_JSON;

			return [ 'forceClose' => true, 'forceReload' => '#crud-datatable-pjax' ];
		} else {
			/*
			*   Process for non-ajax request
			*/
			return $this->redirect( [ 'index' ] );
		}


	}

	/**
	 * Delete multiple existing EquipamentoReparacao model.
	 * For ajax request will return json object
	 * and for non-ajax request if deletion is successful, the browser will be redirected to the 'index' page.
	 * @param integer $id
	 * @return mixed
	 */
	public function actionBulkdelete() {

		$request = Yii::$app->request;
		$pks = explode( ',', $request->post( 'pks' ) ); // Array or selected records primary keys
		foreach ( $pks as $pk ) {
			$model = $this->findModel( $pk );
			$model->delete();
		}

		if ( $request->isAjax ) {
			/*
			*   Process for ajax request
			*/
			Yii::$app->response->format = Response::FORMAT_JSON;

			return [ 'forceClose' => true, 'forceReload' => '#crud-datatable-pjax' ];
		} else {
			/*
			*   Process for non-ajax request
			*/
			return $this->redirect( [ 'index' ] );
		}

	}

	/**
	 * Finds the EquipamentoReparacao model based on its primary key value.
	 * If the model is not found, a 404 HTTP exception will be thrown.
	 * @param integer $id
	 * @return EquipamentoReparacao the loaded model
	 * @throws NotFoundHttpException if the model cannot be found
	 */
	protected function findModel( $id ) {

		if ( ( $model = EquipamentoReparacao::findOne( $id ) ) !== null ) {
			return $model;
		} else {
			throw new NotFoundHttpException( 'The requested page does not exist.' );
		}
	}
}
