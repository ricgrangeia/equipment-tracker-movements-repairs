<?php

namespace app\models;

use app\modules\Equipamento\Domain\Entity\Equipamento;

/**
 * This is the model class for table "equipamento_subfamilia".
 *
 * @property int $id
 * @property int $familia_id
 * @property string $subfamilia
 *
 * @property Equipamento[] $equipamentos
 * @property EquipamentoFamilia $familia
 */
class EquipamentoSubfamiliaBase extends \yii\db\ActiveRecord
{
    /**
     * {@inheritdoc}
     */
    public static function tableName()
    {
        return 'equipamento_subfamilia';
    }

    /**
     * {@inheritdoc}
     */
    public function rules()
    {
        return [
            [['familia_id', 'subfamilia'], 'required'],
            [['familia_id'], 'default', 'value' => null],
            [['familia_id'], 'integer'],
            [['subfamilia'], 'string', 'max' => 150],
            [['familia_id', 'subfamilia'], 'unique', 'targetAttribute' => ['familia_id', 'subfamilia']],
            [['familia_id'], 'exist', 'skipOnError' => true, 'targetClass' => EquipamentoFamilia::class, 'targetAttribute' => ['familia_id' => 'id']],
        ];
    }

    /**
     * {@inheritdoc}
     */
    public function attributeLabels()
    {
        return [
            'id' => 'ID',
            'familia_id' => 'Familia ID',
            'subfamilia' => 'Subfamilia',
        ];
    }

    /**
     * Gets query for [[Equipamentos]].
     *
     * @return \yii\db\ActiveQuery
     */
    public function getEquipamentos()
    {
        return $this->hasMany(Equipamento::class, ['sub_familia_id' => 'id']);
    }

    /**
     * Gets query for [[Familia]].
     *
     * @return \yii\db\ActiveQuery
     */
    public function getFamilia()
    {
        return $this->hasOne(EquipamentoFamilia::class, ['id' => 'familia_id']);
    }
}
