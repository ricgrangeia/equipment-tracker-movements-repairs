<?php

namespace app\models;

use app\components\MyActiveRecord;
use app\modules\Equipamento\Domain\Entity\Equipamento;

/**
 * This is the model class for table "equipamento_reparacao".
 *
 * @property int $id
 * @property int $equipamento_id
 * @property string $entidade_reparadora
 * @property string $data_envio
 * @property string|null $data_recepcao
 * @property string|null $num_fatura
 * @property float|null $valor_total
 * @property string|null $data_prox_manutencao
 * @property string|null $observacoes
 * @property int|null $destino_origem
 * @property int|null $movimento_id_reparacao
 * @property int|null $movimento_id_reparacao_regresso
 *
 * @property Equipamento $equipamento
 */
class EquipamentoReparacaoBase extends MyActiveRecord
{
    /**
     * {@inheritdoc}
     */
    public static function tableName()
    {
        return 'equipamento_reparacao';
    }

    /**
     * {@inheritdoc}
     */
    public function rules()
    {
        return [
            [['equipamento_id', 'entidade_reparadora', 'data_envio'], 'required'],
            [['equipamento_id', 'destino_origem', 'movimento_id_reparacao', 'movimento_id_reparacao_regresso'], 'default', 'value' => null],
            [['equipamento_id', 'destino_origem', 'movimento_id_reparacao', 'movimento_id_reparacao_regresso'], 'integer'],
            [['valor_total'], 'number'],
            [['observacoes'], 'string'],
            [['entidade_reparadora'], 'string', 'max' => 150],
            [['data_envio', 'data_recepcao', 'data_prox_manutencao'], 'string', 'max' => 10],
            [['num_fatura'], 'string', 'max' => 100],
            [['equipamento_id'], 'exist', 'skipOnError' => true, 'targetClass' => Equipamento::class, 'targetAttribute' => ['equipamento_id' => 'id']],
        ];
    }

    /**
     * {@inheritdoc}
     */
    public function attributeLabels()
    {
        return [
            'id' => 'ID',
            'equipamento_id' => 'Equipamento ID',
            'entidade_reparadora' => 'Entidade Reparadora',
            'data_envio' => 'Data Envio',
            'data_recepcao' => 'Data Recepcao',
            'num_fatura' => 'Num Fatura',
            'valor_total' => 'Valor Total',
            'data_prox_manutencao' => 'Data Prox Manutencao',
            'observacoes' => 'Observacoes',
            'destino_origem' => 'Destino Origem',
            'movimento_id_reparacao' => 'Movimento Id Reparacao',
            'movimento_id_reparacao_regresso' => 'Movimento Id Reparacao Regresso',
        ];
    }

    /**
     * Gets query for [[Equipamento]].
     *
     * @return \yii\db\ActiveQuery
     */
    public function getEquipamento()
    {
        return $this->hasOne(Equipamento::class, ['id' => 'equipamento_id']);
    }
}
