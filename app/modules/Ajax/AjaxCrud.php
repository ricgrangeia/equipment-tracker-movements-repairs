<?php

namespace app\modules\Ajax;

use Yii;
use yii\helpers\Html;

class AjaxCrud {

	public static function returnUpdateSuccessAjaxCrud( string $title, int $id = null): array {

		return [
			'forceReload' => '#crud-datatable-pjax',
			'title' => ModuleAjax::t( 'ajax', 'Updated With' ) . " $title # $id",
			'content' => '<span class="text-success">' . ModuleAjax::t( 'ajax', 'Updated With' ) . ' ' . ModuleAjax::t( 'ajax', 'Success' ) . '</span>',
			'footer' => Html::button( ModuleAjax::t( 'ajax', 'Close' ), [ 'class' => 'btn btn-default pull-left', 'data-dismiss' => "modal" ] ) .
				Html::a( ModuleAjax::t( 'ajax', 'Create More' ), [ 'create' ], [ 'class' => 'btn btn-primary', 'role' => 'modal-remote' ] ),

		];
	}


	public static function returnCreateSuccessAjaxCrud( string $title): array {

		return [
			'forceReload' => '#crud-datatable-pjax',
			'title' => ModuleAjax::t( 'ajax', 'Create New' ) ,
			'content' => '<span class="text-success">' . ModuleAjax::t( 'ajax', 'Create' ) . " $title " . ModuleAjax::t( 'ajax', 'Success' ) . '</span>',
			'footer' => Html::button( ModuleAjax::t( 'ajax', 'Close' ), [ 'class' => 'btn btn-default pull-left', 'data-dismiss' => "modal" ] ) .
				Html::a( ModuleAjax::t( 'ajax', 'Create More' ), [ 'create' ], [ 'class' => 'btn btn-primary', 'role' => 'modal-remote' ] ),

		];
	}


	public static function returnCreateRenderAjaxCrud( $controller, $model, string $title ): array {

		return [
			'title' => ModuleAjax::t( 'ajax', 'Create New' ) . " AjaxCrud.php",
			'content' => $controller->renderAjax( 'create', [
				'model' => $model,
			] ),
			'footer' => Html::button( ModuleAjax::t( 'ajax', 'Close' ), [ 'class' => 'btn btn-default pull-left', 'data-dismiss' => "modal" ] ) .
				Html::button( ModuleAjax::t( 'ajax', 'Save' ), [ 'class' => 'btn btn-primary', 'type' => "submit" ] ),

		];
	}


	public static function returnUpdateRenderAjaxCrud( $controller, $model): array {

		self::reloadPjaxFlashMessages();
		self::reloadPjaxCrud();

		return [
			'title' => ModuleAjax::t( 'ajax', 'Update' ) . " Procedimento #" . $model->id ?? '',
			'content' => $controller->renderAjax( 'update', [
				'model' => $model,
			] ),
			'footer' => Html::button( ModuleAjax::t( 'ajax', 'Close' ), [ 'class' => 'btn btn-default pull-left', 'data-dismiss' => "modal" ] ) .
				Html::button( ModuleAjax::t( 'ajax', 'Save' ), [ 'class' => 'btn btn-primary', 'type' => "submit" ] ),
		];

	}

	private static function reloadPjaxFlashMessages(): void {

		Yii::$app->view->registerJs( <<<JS
			$.pjax.reload({container: '#pjax-flash-messages'});
		JS
		);
	}

	private static function reloadPjaxCrud(): void {

		Yii::$app->view->registerJs( <<<JS
			$.pjax.reload({container: '#pjax-crud'});
		JS
		);
	}


}