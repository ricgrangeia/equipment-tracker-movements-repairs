<?php

namespace app\models;

use yii\helpers\ArrayHelper;

class Localization extends LocalizationBase
{

	public const LOCALIZACAO_PORTUGAL = 1;
	public const LOCALIZACAO_FRANCA = 2;
	public const EM_TROCA_LOCALIZACAO = 3;

	public const SEM_LOCALIZACAO_NOVO = 4;


    static function getLocalizations()
    {
      return ArrayHelper::map(Localization::find()->all(), 'id', 'localization');
    }
}
