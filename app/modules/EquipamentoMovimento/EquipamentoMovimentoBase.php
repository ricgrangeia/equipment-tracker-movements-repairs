<?php

namespace app\modules\EquipamentoMovimento;

use app\components\MyActiveRecord;
use app\models\Funcionario;
use app\modules\Equipamento\Domain\Entity\Equipamento;
use app\modules\EquipamentoMovimentoTipo\EquipamentoMovimentoTipo;
use Yii;

/**
 * This is the model class for table "equipamento_movimento".
 *
 * @property int $id
 * @property string $data
 * @property int $destino_id
 * @property int $tipo_movimento_id
 * @property string|null $observacoes
 * @property int $equipamento_id
 * @property int|null $utilizador_responsavel Utilizador responsável
 *
 * @property Equipamento $equipamento
 * @property EquipamentoMovimentoTipo $tipoMovimento
 * @property Funcionario $destino
 */
class EquipamentoMovimentoBase extends MyActiveRecord
{
    /**
     * {@inheritdoc}
     */
    public static function tableName()
    {
        return 'equipamento_movimento';
    }

    /**
     * {@inheritdoc}
     */
    public function rules()
    {
        return [
            [['data', 'destino_id', 'tipo_movimento_id', 'equipamento_id'], 'required'],
            [['destino_id', 'tipo_movimento_id', 'equipamento_id', 'utilizador_responsavel'], 'default', 'value' => null],
            [['destino_id', 'tipo_movimento_id', 'equipamento_id', 'utilizador_responsavel'], 'integer'],
            [['observacoes'], 'string'],
            [['data'], 'string', 'max' => 10],
            [['equipamento_id'], 'exist', 'skipOnError' => true, 'targetClass' => Equipamento::className(), 'targetAttribute' => ['equipamento_id' => 'id']],
            [['tipo_movimento_id'], 'exist', 'skipOnError' => true, 'targetClass' => EquipamentoMovimentoTipo::className(), 'targetAttribute' => ['tipo_movimento_id' => 'id']],
            [['destino_id'], 'exist', 'skipOnError' => true, 'targetClass' => Funcionario::className(), 'targetAttribute' => ['destino_id' => 'id']],
        ];
    }

    /**
     * {@inheritdoc}
     */
    public function attributeLabels()
    {
        return [
            'id' => 'ID',
            'data' => 'Data',
            'destino_id' => 'Destino ID',
            'tipo_movimento_id' => 'Tipo Movimento ID',
            'observacoes' => 'Observacoes',
            'equipamento_id' => 'Equipamento ID',
            'utilizador_responsavel' => 'Utilizador responsável',
        ];
    }

    /**
     * Gets query for [[Equipamento]].
     *
     * @return \yii\db\ActiveQuery
     */
    public function getEquipamento()
    {
        return $this->hasOne(Equipamento::className(), ['id' => 'equipamento_id']);
    }

    /**
     * Gets query for [[TipoMovimento]].
     *
     * @return \yii\db\ActiveQuery
     */
    public function getTipoMovimento()
    {
        return $this->hasOne(EquipamentoMovimentoTipo::className(), ['id' => 'tipo_movimento_id']);
    }

    /**
     * Gets query for [[Destino]].
     *
     * @return \yii\db\ActiveQuery
     */
    public function getDestino()
    {
        return $this->hasOne(Funcionario::className(), ['id' => 'destino_id']);
    }
}
