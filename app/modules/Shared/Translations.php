<?php

/**
 *
 * @author : Ricardo Grangeia Dias
 * @profile : PHP Developer
 * @email : ricardo@grangeia.pt
 * @site : https://ricardo.grangeia.pt
 */

namespace app\modules\Shared;

use Yii;

class Translations
{

	public static function registerModuleTranslations($moduleName): void
	{
		Yii::$app->i18n->translations['modules/' . $moduleName . '/*'] = [
			'class' => 'yii\i18n\PhpMessageSource',
			'sourceLanguage' => 'pt-PT',
			'basePath' => '@app/modules/' . $moduleName . '/messages',
			'fileMap' => [
				'modules/' . $moduleName . '/' . self::toUnderscoreCase($moduleName) => self::toUnderscoreCase($moduleName) . '.php',
			],
		];
	}

	public static function registerModuleTranslationsUI($moduleName): void
	{
		Yii::$app->i18n->translations['modules/' . $moduleName . '/*'] = [
			'class' => 'yii\i18n\PhpMessageSource',
			'sourceLanguage' => 'pt-PT',
			'basePath' => '@app/modules/' . $moduleName . '/UI/messages',
			'fileMap' => [
				'modules/' . $moduleName . '/' . self::toUnderscoreCase($moduleName) => self::toUnderscoreCase($moduleName) . '.php',
			],
		];
	}

	static function toUnderscoreCase($str): string
	{
		return strtolower(preg_replace('/([a-z0-9])([A-Z])/', '$1_$2', $str));
	}
}
