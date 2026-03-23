<?php

/**
 *
 * @author : Ricardo Grangeia Dias
 * @profile : PHP Developer
 * @email : ricardo@grangeia.pt
 * @site : https://ricardo.grangeia.pt
 */

namespace app\modules\Empresa;

use yii\db\ActiveRecord;

/**
 * This is the model class for table "empresa".
 *
 * @property int $id
 * @property string $empresa Nome Empresa
 */
class EmpresaBase extends ActiveRecord
{
    /**
     * {@inheritdoc}
     */
    public static function tableName()
    {
        return 'empresa';
    }

    /**
     * {@inheritdoc}
     */
    public function rules()
    {
        return [
            [['empresa'], 'required'],
            [['empresa'], 'string', 'max' => 250],
        ];
    }

    /**
     * {@inheritdoc}
     */
    public function attributeLabels()
    {
        return [
            'id' => 'ID',
            'empresa' => 'Nome Empresa',
        ];
    }
}
