<?php

namespace app\modules\Equipamento;

use app\modules\Shared\ModuleBase;
use app\modules\Shared\Translations;
use Yii;

/**
 * reports module definition class
 */
class ModuleEquipamento extends ModuleBase
{
	/**
	 * {@inheritdoc}
	 */
	public $controllerNamespace = 'app\modules\Equipamento\UI\Controllers';

	/**
	 * {@inheritdoc}
	 */
	public function init(): void {

		parent::init();
		$this->setViewPath( '@app/modules/Equipamento/UI/Views' );
		Translations::registerModuleTranslationsUI('Equipamento');
	}



}
