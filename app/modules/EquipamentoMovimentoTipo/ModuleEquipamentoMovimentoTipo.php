<?php

namespace app\modules\EquipamentoMovimentoTipo;

use app\modules\Shared\ModuleBase;
use app\modules\Shared\Translations;

/**
 * reports module definition class
 */
class ModuleEquipamentoMovimentoTipo extends ModuleBase
{
	/**
	 * {@inheritdoc}
	 */
	public $controllerNamespace = 'app\modules\EquipamentoMovimentoTipo';

	/**
	 * {@inheritdoc}
	 */
	public function init(): void {

		parent::init();
		Translations::registerModuleTranslations('EquipamentoMovimentoTipo');

	}

}
