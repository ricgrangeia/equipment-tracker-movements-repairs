<?php

/**
 * @author : Ricardo Grangeia Dias
 * @profile : PHP Developer
 * @email : ricardo@grangeia.pt
 * @site : https://ricardo.grangeia.pt
 */

namespace app\modules\Equipamento\Domain\Entity;

use app\models\EquipamentoFamilia;
use app\models\EquipamentoSubfamilia;
use app\models\Localization;
use app\modules\Empresa\Empresa;
use app\modules\Equipamento\ModuleEquipamento;
use app\modules\EquipamentoEstado\EquipamentoEstado;
use app\modules\EquipamentoMovimento\EquipamentoMovimento;
use yii\db\ActiveQuery;

/**
 * This is the model class for table "equipamento".
 *
 * @property int $id
 * @property string|null $num_serie
 * @property string|null $data
 * @property string $num_interno
 * @property int|null $localization_id Localização
 * @property string $equipamento
 * @property string|null $descricao
 * @property int $estado_id
 * @property int|null $caixa
 * @property int $empresa_id
 * @property int|null $familia_id
 * @property int|null $sub_familia_id
 * @property string|null $acessorios
 * @property string $fornecedor
 * @property string|null $observacoes
 * @property string|null $modelo
 * @property string|null $marca
 * @property string|null $avaliacao_estado Avaliação Estado
 * @property string|null $avaliacao_observacoes Avaliação Observações
 * @property string|null $avaliacao_data_ultima Avaliação Última
 * @property string|null $avaliacao_data_proxima Avaliação Próxima
 * @property string|null $image_manager_id_avatar
 *
 * @property Localization $localization
 * @property \app\modules\Empresa\Empresa $empresa
 * @property EquipamentoEstado $estado
 * @property EquipamentoFamilia $familia
 * @property EquipamentoSubfamilia $subFamilia
 * @property EquipamentoMovimento[] $equipamentoMovimentos
 */
class EquipamentoActiveRecord extends \app\components\MyActiveRecord
{
    /**
     * {@inheritdoc}
     */
    public static function tableName()
    {
        return 'equipamento';
    }

    /**
     * {@inheritdoc}
     */
    public function rules()
    {
        return [
            [['num_interno', 'equipamento', 'estado_id', 'empresa_id', 'fornecedor'], 'required'],
            [['localization_id', 'estado_id', 'caixa', 'empresa_id', 'familia_id', 'sub_familia_id'], 'integer'],
            [['acessorios', 'observacoes', 'avaliacao_observacoes'], 'string'],
            [['num_serie', 'num_interno', 'equipamento', 'fornecedor', 'modelo', 'marca'], 'string', 'max' => 150],
            [['data', 'avaliacao_data_ultima', 'avaliacao_data_proxima'], 'string', 'max' => 10],
            [['descricao', 'image_manager_id_avatar'], 'string', 'max' => 300],
            [['avaliacao_estado'], 'string', 'max' => 50],
            [['num_interno'], 'unique'],
            [['localization_id'], 'exist', 'skipOnError' => true, 'targetClass' => Localization::class, 'targetAttribute' => ['localization_id' => 'id']],
            [['empresa_id'], 'exist', 'skipOnError' => true, 'targetClass' => Empresa::class, 'targetAttribute' => ['empresa_id' => 'id']],
            [['estado_id'], 'exist', 'skipOnError' => true, 'targetClass' => EquipamentoEstado::class, 'targetAttribute' => ['estado_id' => 'id']],
            [['familia_id'], 'exist', 'skipOnError' => true, 'targetClass' => EquipamentoFamilia::class, 'targetAttribute' => ['familia_id' => 'id']],
            [['sub_familia_id'], 'exist', 'skipOnError' => true, 'targetClass' => EquipamentoSubfamilia::class, 'targetAttribute' => ['sub_familia_id' => 'id']],
        ];
    }

    /**
     * {@inheritdoc}
     */
    public function attributeLabels()
    {
        return [
            'id' => ModuleEquipamento::t('equipamento', 'ID'),
            'num_serie' => ModuleEquipamento::t('equipamento', 'Num Serie'),
            'data' => ModuleEquipamento::t('equipamento', 'Data'),
            'num_interno' => ModuleEquipamento::t('equipamento', 'Num Interno'),
            'localization_id' => ModuleEquipamento::t('equipamento', 'Localização'),
            'equipamento' => ModuleEquipamento::t('equipamento', 'Equipamento'),
            'descricao' => ModuleEquipamento::t('equipamento', 'Descricao'),
            'estado_id' => ModuleEquipamento::t('equipamento', 'Estado ID'),
            'caixa' => ModuleEquipamento::t('equipamento', 'Caixa'),
            'empresa_id' => ModuleEquipamento::t('equipamento', 'Empresa ID'),
            'familia_id' => ModuleEquipamento::t('equipamento', 'Familia ID'),
            'sub_familia_id' => ModuleEquipamento::t('equipamento', 'Sub Familia ID'),
            'acessorios' => ModuleEquipamento::t('equipamento', 'Acessorios'),
            'fornecedor' => ModuleEquipamento::t('equipamento', 'Fornecedor'),
            'observacoes' => ModuleEquipamento::t('equipamento', 'Observacoes'),
            'modelo' => ModuleEquipamento::t('equipamento', 'Modelo'),
            'marca' => ModuleEquipamento::t('equipamento', 'Marca'),
            'avaliacao_estado' => ModuleEquipamento::t('equipamento', 'Avaliação Estado'),
            'avaliacao_observacoes' => ModuleEquipamento::t('equipamento', 'Avaliação Observações'),
            'avaliacao_data_ultima' => ModuleEquipamento::t('equipamento', 'Avaliação Última'),
            'avaliacao_data_proxima' => ModuleEquipamento::t('equipamento', 'Avaliação Próxima'),
            'image_manager_id_avatar' => ModuleEquipamento::t('equipamento', 'Image Manager Id Avatar'),
        ];
    }


    /**
     * Gets query for [[Localization]].
     *
     * @return ActiveQuery
     */
    public function getLocalization()
    {
        return $this->hasOne(Localization::class, ['id' => 'localization_id']);
    }

    /**
     * Gets query for [[Empresa]].
     *
     * @return ActiveQuery
     */
    public function getEmpresa()
    {
        return $this->hasOne(Empresa::class, ['id' => 'empresa_id']);
    }

    /**
     * Gets query for [[Estado]].
     *
     * @return ActiveQuery
     */
    public function getEstado()
    {
        return $this->hasOne(EquipamentoEstado::class, ['id' => 'estado_id']);
    }

    /**
     * Gets query for [[Familia]].
     *
     * @return ActiveQuery
     */
    public function getFamilia()
    {
        return $this->hasOne(EquipamentoFamilia::class, ['id' => 'familia_id']);
    }

    /**
     * Gets query for [[SubFamilia]].
     *
     * @return ActiveQuery
     */
    public function getSubFamilia()
    {
        return $this->hasOne(EquipamentoSubfamilia::class, ['id' => 'sub_familia_id']);
    }

    /**
     * Gets query for [[EquipamentoMovimentos]].
     *
     * @return ActiveQuery
     */
    public function getEquipamentoMovimentos()
    {
        return $this->hasMany(EquipamentoMovimento::class, ['equipamento_id' => 'id']);
    }
}
