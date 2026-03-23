<?php

namespace app\modules\EquipamentoMovimentoTipo;

use Yii;

/**
 * This is the model class for table "equipamento_movimento_tipo".
 *
 * @property int $id
 * @property string $tipo_movimento
 *
 * @property EquipamentoMovimento[] $equipamentoMovimentos
 */
class EquipamentoMovimentoTipoBase extends \yii\db\ActiveRecord
{
    /**
     * {@inheritdoc}
     */
    public static function tableName()
    {
        return 'equipamento_movimento_tipo';
    }

    /**
     * {@inheritdoc}
     */
    public function rules()
    {
        return [
            [['tipo_movimento'], 'required'],
            [['tipo_movimento'], 'string', 'max' => 100],
        ];
    }

    /**
     * {@inheritdoc}
     */
    public function attributeLabels()
    {
        return [
            'id' => 'ID',
            'tipo_movimento' => 'Tipo Movimento',
        ];
    }

    /**
     * Gets query for [[EquipamentoMovimentos]].
     *
     * @return \yii\db\ActiveQuery
     */
    public function getEquipamentoMovimentos()
    {
        return $this->hasMany(EquipamentoMovimento::className(), ['tipo_movimento_id' => 'id']);
    }
}
