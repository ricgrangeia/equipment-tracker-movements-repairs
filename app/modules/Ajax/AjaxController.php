<?php

namespace app\modules\Ajax;

use Yii;
use yii\web\Controller;


final class AjaxController extends Controller {

	public function actionHtmlcall(): string {

		$function = $_POST['function'];
		$argsArray = $_POST['args'];
		if ( Yii::$app->request->isAjax ) {
			return call_user_func_array( "\\app\\modules\\Shared\\Domain\\Model\\Charts\\MyCharts::$function", $argsArray );
		}

		return print_r( $_POST, true );
	}

	public function actionHtmlContainerCallUpdateWithNavBarDateChange( string $url, array $args = []): string {

		$randomId = rand(10000, 99999);

		return $this->renderPartial( '_ajaxContainer', [ 'url' => $url, 'args' => $args, 'randomId' => $randomId ] )
			. $this->renderPartial( '_ajaxUpdateWithNavBarDateChange', [ 'randomId' => $randomId ] );
	}

	public function actionGetChartHtml( string $chartFunction, array $args = null): string {

		return $this->renderPartial( '_ajaxShowChart', ['chartFunction' => $chartFunction, 'args' => $args]);
	}







}