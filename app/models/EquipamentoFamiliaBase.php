<?php

namespace app\models;
use app\modules\Equipamento\Domain\Entity\Equipamento;
use yii\db\ActiveQuery;
use yii\db\ActiveRecord;

/**
 * This is the model class for table "equipamento_familia".
 *
 * @property int $id
 * @property string $familia
 *
 * @property Equipamento[] $equipamentos
 * @property EquipamentoSubfamilia[] $equipamentoSubfamilias
 */
class EquipamentoFamiliaBase extends ActiveRecord
{
    /**
     * {@inheritdoc}
     */
    public static function tableName()
    {
        return 'equipamento_familia';
    }

    /**
     * {@inheritdoc}
     */
    public function rules()
    {
        return [
            [['familia'], 'required'],
            [['familia'], 'string', 'max' => 150],
            [['familia'], 'unique'],
        ];
    }

    /**
     * {@inheritdoc}
     */
    public function attributeLabels()
    {
        return [
            'id' => 'ID',
            'familia' => 'Familia',
        ];
    }

    /**
     * Gets query for [[Equipamentos]].
     *
     * @return ActiveQuery
     */
    public function getEquipamentos()
    {
        return $this->hasMany(Equipamento::class, ['familia_id' => 'id']);
    }

    /**
     * Gets query for [[EquipamentoSubfamilias]].
     *
     * @return ActiveQuery
     */
    public function getEquipamentoSubfamilias()
    {
        return $this->hasMany(EquipamentoSubfamilia::class, ['familia_id' => 'id']);
    }
}
