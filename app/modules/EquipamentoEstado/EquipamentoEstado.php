<?php

/**
 * @author : Ricardo Grangeia Dias
 * @profile : PHP Developer
 * @email : ricardo@grangeia.pt
 * @site : https://ricardo.grangeia.pt
 */

namespace app\modules\EquipamentoEstado;

class EquipamentoEstado extends EquipamentoEstadoBase
{

	public const ESTADO_FIM_DE_VIDA = 3;
	public const ESTADO_EXTRAVIADO = 5;

	public function shouldNotify(): bool
	{

		return $this->id === self::ESTADO_FIM_DE_VIDA || $this->id === self::ESTADO_EXTRAVIADO;
	}
	public function shouldBeHighlighted(): bool
	{

		return $this->shouldNotify();
	}
}
