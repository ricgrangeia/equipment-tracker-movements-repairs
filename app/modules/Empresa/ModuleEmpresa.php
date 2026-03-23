<?php

namespace app\modules\Empresa;

use app\modules\Shared\ModuleBase;
use app\modules\Shared\Translations;

/**
 * reports module definition class
 */
class ModuleEmpresa extends ModuleBase
{
	/**
	 * {@inheritdoc}
	 */
	public $controllerNamespace = 'app\modules\Empresa';

	/**
	 * {@inheritdoc}
	 */
	public function init(): void {

		parent::init();
		Translations::registerModuleTranslations('Empresa');
	}



}
