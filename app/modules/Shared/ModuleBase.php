<?php

/**
 * @author : Ricardo Grangeia Dias
 * @profile : PHP Developer
 * @email : ricardo@grangeia.pt
 * @site : https://ricardo.grangeia.pt
 */

namespace app\modules\Shared;

use Yii;

class ModuleBase extends \yii\base\Module
{



	public static function t($category, $message, $params = [], $language = null): string
	{

		if (!isset(Yii::$app->i18n->translations['modules/' . self::toCamelCase($category) . '/*'])) {
			Translations::registerModuleTranslationsUI(self::toCamelCase($category));
		}

		return Yii::t('modules/' . self::toCamelCase($category) . '/*', $message, $params, $language);
	}

	static function toCamelCase($str)
	{
		$result = str_replace('_', '', ucwords($str, '_'));
		return $result;
	}
}
