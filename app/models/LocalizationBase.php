<?php

namespace app\models;

use app\components\MyActiveRecord;
use Yii;

/**
 * This is the model class for table "localization".
 *
 * @property int $id
 * @property bool|null $active Ativa
 * @property string $localization Localização
 */
class LocalizationBase extends MyActiveRecord
{
    /**
     * {@inheritdoc}
     */
    public static function tableName()
    {
        return 'localization';
    }

    /**
     * {@inheritdoc}
     */
    public function rules()
    {
        return [
            [['active'], 'integer'],
            [['localization'], 'required'],
            [['localization'], 'string', 'max' => 250],
        ];
    }

    /**
     * {@inheritdoc}
     */
    public function attributeLabels()
    {
        return [
            'id' => Yii::t('app', 'ID'),
            'active' => Yii::t('app', 'Ativa'),
            'localization' => Yii::t('app', 'Localização'),
        ];
    }
}
