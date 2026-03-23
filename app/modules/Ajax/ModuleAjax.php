<?php

namespace app\modules\Ajax;

use app\modules\Shared\ModuleBase;
use Yii;
use yii\i18n\PhpMessageSource;

/**
 * reports module definition class
 */
class ModuleAjax extends ModuleBase
{
	/**
	 * {@inheritdoc}
	 */
	public $controllerNamespace = 'app\modules\Ajax';


	/**
	 * {@inheritdoc}
	 */
	public function init(): void {

		parent::init();
		$this->registerTranslations();

	}

	public function registerTranslations(): void {
		Yii::$app->i18n->translations['modules/Ajax/*'] = [
			'class' => PhpMessageSource::class,
			'sourceLanguage' => 'pt-PT',
			'basePath' => '@app/modules/Ajax/messages',
			'fileMap' => [
				'modules/Ajax/ajax' => 'ajax.php',
			],
		];
	}

	public static function t($category, $message, $params = [], $language = null): string {
		return Yii::t('modules/Ajax/' . $category, $message, $params, $language);
	}
}
