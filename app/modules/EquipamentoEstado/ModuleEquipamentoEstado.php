<?php

namespace app\modules\EquipamentoEstado;

use app\modules\Shared\ModuleBase;
use app\modules\Shared\Translations;

/**
 * reports module definition class
 */
class ModuleEquipamentoEstado extends ModuleBase
{
	/**
	 * {@inheritdoc}
	 */
	public $controllerNamespace = 'app\modules\EquipamentoEstado';

	/**
	 * {@inheritdoc}
	 */
	public function init(): void {

		parent::init();
		Translations::registerModuleTranslations('EquipamentoEstado');

	}


}
