<?php
/**
 * @author Ricardo Grangeia Dias <ricardograngeia@gmail.com>
 */

use mdm\admin\components\MenuHelper;
use yii\bootstrap4\Nav;
use yii\bootstrap4\NavBar;
use yii\helpers\Html;

/* @var $this \yii\web\View */
/* @var $content string */

$controller = $this->context;
$menus = $controller->module->menus;
$route = $controller->route;
foreach ( $menus as $i => $menu ) {
	$menus[$i]['active'] = strpos( $route, trim( $menu['url'][0], '/' ) ) === 0;
}
$this->params['nav-items'] = $menus;
?>
<?php $this->beginContent( $controller->module->mainLayout ) ?>

<?php if ( Yii::$app->user->can( 'accessPermissionsManager' ) ) { ?>

    <style>
        .list-group {
            display: -ms-flexbox;
            display: inline-block;
            -ms-flex-direction: column;
            flex-direction: column;
            padding-left: 0;
            margin-bottom: 0;
        }

        .list-group-item {
            display: inline-grid;
        }
        .ui-autocomplete {
            top: 70px;
            left: 10px;
            cursor: default;
            position: absolute;
            max-height: 200px;
            overflow: auto;
        }
    </style>

    <div id="manager-menu" class="list-group">
		<?php
		$items = [];
		foreach ( $menus as $menu ) {
			$label = Html::tag( 'i', '', [ 'class' => 'glyphicon glyphicon-chevron-right pull-right' ] ) .
				Html::tag( 'span', Html::encode( $menu['label'] ), [] );
			$active = $menu['active'] ? ' active' : '';
			echo Html::a( $label, $menu['url'], [
				'class' => 'list-group-item' . $active,
			] );
		}

		?>

    </div>

<?php } ?>

<?= $content ?>


<?php
[ , $url ] = Yii::$app->assetManager->publish( '@mdm/admin/assets' );
$this->registerCssFile( $url . '/list-item.css' );
?>

<?php $this->endContent(); ?>
