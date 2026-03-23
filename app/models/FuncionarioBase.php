<?php

namespace app\models;

use app\components\MyActiveRecord;
use Yii;

/**
 * This is the model class for table "funcionario".
 *
 * @property int $id
 * @property int|null $ativo
 * @property string $nome
 * @property string $tipo
 * @property int $localization Localização
 *
 * @property Localization $localization0
 */
class FuncionarioBase extends MyActiveRecord
{
    /**
     * {@inheritdoc}
     */
    public static function tableName()
    {
        return 'funcionario';
    }

    /**
     * {@inheritdoc}
     */
    public function rules()
    {
        return [
            [['ativo', 'localization'], 'integer'],
            [['nome', 'localization'], 'required'],
            [['nome'], 'string', 'max' => 150],
            [['tipo'], 'string', 'max' => 100],
            [['localization'], 'exist', 'skipOnError' => true, 'targetClass' => Localization::class, 'targetAttribute' => ['localization' => 'id']],
        ];
    }

    /**
     * {@inheritdoc}
     */
    public function attributeLabels()
    {
        return [
            'id' => Yii::t('app', 'ID'),
            'ativo' => Yii::t('app', 'Ativo'),
            'nome' => Yii::t('app', 'Nome'),
            'tipo' => Yii::t('app', 'Tipo'),
            'localization' => Yii::t('app', 'Localização'),
        ];
    }

    /**
     * Gets query for [[Localization0]].
     *
     * @return \yii\db\ActiveQuery
     */
    public function getLocalization0()
    {
        return $this->hasOne(Localization::class, ['id' => 'localization']);
    }
}
