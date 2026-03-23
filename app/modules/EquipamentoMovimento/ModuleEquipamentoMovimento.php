<?php

namespace app\modules\EquipamentoMovimento;

use app\modules\Shared\ModuleBase;
use app\modules\Shared\Translations;

/**
 * reports module definition class
 */
class ModuleEquipamentoMovimento extends ModuleBase
{
	/**
	 * {@inheritdoc}
	 */
	public $controllerNamespace = 'app\modules\EquipamentoMovimento';

	/**
	 * {@inheritdoc}
	 */
	public function init(): void {

		parent::init();
		Translations::registerModuleTranslations('EquipamentoMovimento');

	}

}
