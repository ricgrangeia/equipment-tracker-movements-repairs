<?php

namespace app\models;

use Yii;
use yii\db\ActiveRecord as ActiveRecordAlias;

/**
 * This is the model class for table "imobilizado".
 *
 * @property int $id
 * @property string $nome
 * @property string $code_imo
 * @property string|null $descricao
 * @property string|null $data_compra
 * @property int $tipo_imobilizado
 * @property string $localizacao
 * @property int $tipo_estado_conservacao
 * @property string $num_serie
 * @property int $familia
 * @property int $sub_familia
 * @property string|null $observacoes
 */
class ImobilizadoBase extends ActiveRecordAlias
{
    /**
     * {@inheritdoc}
     */
    public static function tableName()
    {
        return 'imobilizado';
    }

    /**
     * {@inheritdoc}
     */
    public function rules()
    {
        return [
            [['nome', 'code_imo', 'tipo_imobilizado', 'localizacao', 'tipo_estado_conservacao', 'num_serie', 'familia', 'sub_familia'], 'required'],
            [['descricao', 'observacoes'], 'string'],
            [['data_compra'], 'safe'],
            [['tipo_imobilizado', 'tipo_estado_conservacao', 'familia', 'sub_familia'], 'default', 'value' => null],
            [['tipo_imobilizado', 'tipo_estado_conservacao', 'familia', 'sub_familia'], 'integer'],
            [['nome', 'code_imo', 'localizacao'], 'string', 'max' => 150],
            [['num_serie'], 'string', 'max' => 120],
            [['code_imo'], 'unique'],
        ];
    }

    /**
     * {@inheritdoc}
     */
    public function attributeLabels()
    {
        return [
            'id' => Yii::t('app', 'ID'),
            'nome' => Yii::t('app', 'Nome'),
            'code_imo' => Yii::t('app', 'Code Imo'),
            'descricao' => Yii::t('app', 'Descricao'),
            'data_compra' => Yii::t('app', 'Data Compra'),
            'tipo_imobilizado' => Yii::t('app', 'Tipo Imobilizado'),
            'localizacao' => Yii::t('app', 'Localizacao'),
            'tipo_estado_conservacao' => Yii::t('app', 'Tipo Estado Conservacao'),
            'num_serie' => Yii::t('app', 'Num Serie'),
            'familia' => Yii::t('app', 'Familia'),
            'sub_familia' => Yii::t('app', 'Sub Familia'),
            'observacoes' => Yii::t('app', 'Observacoes'),
        ];
    }
}
