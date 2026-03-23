<?php
/**
 * @author Ricardo Grangeia Dias
 * @profile PHP Developer
 * @email ricardograngeia@gmail.com
 */

namespace app\modules\EquipamentoMovimentoTipo;

use app\modules\EquipamentoMovimento\EquipamentoMovimento;
use Yii;
use yii\db\ActiveRecord;


class EquipamentoMovimentoTipo extends EquipamentoMovimentoTipoBase {


	public const MOVIMENTO_SAIDA = 1;
	public const MOVIMENTO_ENTRADA = 2;
	public const MOVIMENTO_REPARACAO = 3;
	public const MOVIMENTO_FIM_VIDA = 4;
	public const MOVIMENTO_RE_AVALIACAO = 6;
	public const MOVIMENTO_SAIDA_ARMAZEM = 7;
	public const MOVIMENTO_ENTRADA_ARMAZEM = 8;


	/**
	 * Ao receber um Equipamento conforme o último movimento devolve o tipo movimento permitido.
	 * @param $equipamento_id
	 * @return EquipamentoMovimentoTipo[]|array|ActiveRecord[]
	 */
	public static function getMovimentoTipoForEquipamento( $equipamento_id ): array {

		#Vai buscar o último movimento
		$lastMovimento = EquipamentoMovimento::find()
			->where( [ 'equipamento_id' => $equipamento_id ] )
			->orderBy( [ 'id' => SORT_DESC ] )
			->one();

		if ( empty( $lastMovimento ) ) {
			#Se não existir último movimento consulta todas as possibilidades
			return  EquipamentoMovimentoTipo::find()
				->where( [ 'in', 'id', [ self::MOVIMENTO_ENTRADA_ARMAZEM ] ] )
				->select( [ 'id', 'tipo_movimento AS name' ] )->asArray()->all();
		}

		#Se existir consulta o tipo de movimento disponivel
		if ( Yii::$app->user->can( 'MovimentarEquipamentoEntreArmazens' ) ) {

			if ( $lastMovimento->tipo_movimento_id === self::MOVIMENTO_SAIDA_ARMAZEM ) {
				return EquipamentoMovimentoTipo::find()
					->where( [ '<>', 'id', $lastMovimento->tipo_movimento_id ] )
					->andWhere( [ 'in', 'id', [ self::MOVIMENTO_ENTRADA_ARMAZEM ] ] )
					->select( [ 'id', 'tipo_movimento AS name' ] )->asArray()->all();
			}

			if ( $lastMovimento->tipo_movimento_id === self::MOVIMENTO_ENTRADA
				|| $lastMovimento->tipo_movimento_id === self::MOVIMENTO_ENTRADA_ARMAZEM ) {

				return EquipamentoMovimentoTipo::find()
					->where( [ 'in', 'id', [ self::MOVIMENTO_SAIDA, self::MOVIMENTO_SAIDA_ARMAZEM ] ] )
					->select( [ 'id', 'tipo_movimento AS name' ] )->asArray()->all();

			}
		}

		return EquipamentoMovimentoTipo::find()
			->where( [ '<>', 'id', $lastMovimento->tipo_movimento_id ] )
			->andWhere( [ 'in', 'id', [ self::MOVIMENTO_ENTRADA, self::MOVIMENTO_SAIDA ] ] )
			->select( [ 'id', 'tipo_movimento AS name' ] )->asArray()->all();


	}

}
