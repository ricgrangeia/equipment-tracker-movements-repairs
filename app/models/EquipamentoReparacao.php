<?php

namespace app\models;


use app\modules\Equipamento\Domain\Entity\Equipamento;
use app\modules\EquipamentoMovimento\EquipamentoMovimento;

class EquipamentoReparacao extends EquipamentoReparacaoBase
{

    public function rules()
    {
        return array_merge(parent::rules(),
            [
                [['equipamento_id'], 'validateEquipamentoEmArmazem'],
                [['equipamento_id', 'data_recepcao'], 'validateEquipamentoJaEmReparacao'],
            ]);
    }

    /**
     * Verifica se o equipamento está em armazém o em reparação para validar.
     * @param $attribute
     * @param $params
     * @param $validator
     * @param $value
     */
    public function validateEquipamentoEmArmazem($attribute, $params, $validator, $value)
    {
        $lastMovimento = EquipamentoMovimento::find()
            ->where(['equipamento_id' => $value])
            ->orderBy(['id' => SORT_DESC])
            ->one();

        # Significa que o equipamento já returnou de reparação e que pode ser actualizado por exemplo fatura mais tarde
        if(!empty($this->oldAttributes['data_recepcao']))
            return true;

        if (empty($lastMovimento))
                    $this->addError($attribute, 'Este Equipamento é novo ou adicionado recentemente, criar primeiro um movimento de entrada para um armazém!');
                else
                    if (!Equipamento::isEmReparacao($value))
                        if (!Equipamento::isEmArmazem($value)) {
                                $this->addError($attribute, 'Este Equipamento está fora, não pode ir para reparação!');
                            }
    }


    /**
     * Verifica se o equipamento está em armazém o em reparação para validar.
     * @param $attribute
     * @param $params
     * @param $validator
     * @param $value
     */
    public function validateEquipamentoJaEmReparacao($attribute, $params, $validator, $value)
    {

//        $reparacao = \app\models\EquipamentoReparacao::find()
//            ->where(['equipamento_id'=>$value])
//            ->andWhere(['OR', ['data_recepcao' => null],["data_recepcao" =>'']])
//            ->one();

//        Yii::debug($attribute[0]);
//        Yii::debug($value);
//        if(! empty($reparacao))
//                    $this->addError($attribute, 'Já existe ordem de reparação para equipamento! Não pode criar nova orderm de reparação sem concluir anterior!');
    }

    /**
     * Devolve todos Equipamentos que estão em reparação
     */
    public function getEquipamentoEmReparacao()
    {

        return EquipamentoReparacao::find()->select(['equipamento_id'])->where("data_envio <> '' AND data_recepcao = ''")->asArray()->all();

    }


}
