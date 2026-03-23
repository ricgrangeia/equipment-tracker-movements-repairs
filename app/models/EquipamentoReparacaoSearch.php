<?php

namespace app\models;

use yii\base\Model;
use yii\data\ActiveDataProvider;

/**
 * EquipamentoReparacaoSearch represents the model behind the search form about `app\models\EquipamentoReparacao`.
 */
class EquipamentoReparacaoSearch extends EquipamentoReparacao
{
    /**
     * @inheritdoc
     */
    public function rules()
    {
        return [
            [['id', 'equipamento_id'], 'integer'],
            [['entidade_reparadora', 'data_envio', 'data_recepcao', 'num_fatura', 'data_prox_manutencao', 'observacoes'], 'safe'],
            [['valor_total'], 'number'],
        ];
    }

    /**
     * @inheritdoc
     */
    public function scenarios()
    {
        // bypass scenarios() implementation in the parent class
        return Model::scenarios();
    }

    /**
     * Creates data provider instance with search query applied
     *
     * @param array $params
     *
     * @return ActiveDataProvider
     */
    public function search($params)
    {
        $query = EquipamentoReparacao::find();

        $dataProvider = new ActiveDataProvider([
            'query' => $query,
        ]);

        $this->load($params);

        if (!$this->validate()) {
            // uncomment the following line if you do not want to return any records when validation fails
            // $query->where('0=1');
            return $dataProvider;
        }

        $query->andFilterWhere([
            'id' => $this->id,
            'equipamento_id' => $this->equipamento_id,
            'valor_total' => $this->valor_total,
        ]);

        $query->andFilterWhere(['like', 'entidade_reparadora', $this->entidade_reparadora])
            ->andFilterWhere(['like', 'data_envio', $this->data_envio])
            ->andFilterWhere(['like', 'data_recepcao', $this->data_recepcao])
            ->andFilterWhere(['like', 'num_fatura', $this->num_fatura])
            ->andFilterWhere(['like', 'data_prox_manutencao', $this->data_prox_manutencao])
            ->andFilterWhere(['like', 'observacoes', $this->observacoes]);

        $query->orderBy(["data_recepcao" => "data_recepcao NULLS FIRST , DATE(data_envio) ASC"]);


        return $dataProvider;
    }

    /**
     * Creates data provider instance with search query applied
     *
     * @param array $params
     *
     * @return ActiveDataProvider
     */
    public function searchParaReparacao($params)
    {
        $query = EquipamentoReparacao::find();

        $dataProvider = new ActiveDataProvider([
            'query' => $query,
        ]);

        $this->load($params);

        if (!$this->validate()) {
            // uncomment the following line if you do not want to return any records when validation fails
            // $query->where('0=1');
            return $dataProvider;
        }

        $query->with(['equipamento.equipamentoMovimentos']);

        $query->andFilterWhere([
            'id' => $this->id,
            'equipamento_id' => $this->equipamento_id,
            'valor_total' => $this->valor_total,
        ]);

        $query->andFilterWhere(['like', 'entidade_reparadora', $this->entidade_reparadora])
            ->andFilterWhere(['like', 'data_envio', $this->data_envio])
            ->andFilterWhere(['like', 'data_recepcao', $this->data_recepcao])
            ->andFilterWhere(['like', 'num_fatura', $this->num_fatura])
            ->andFilterWhere(['like', 'data_prox_manutencao', $this->data_prox_manutencao])
            ->andFilterWhere(['like', 'observacoes', $this->observacoes]);

//        $query->andWhere(['equipamento.equipamentoMovimentos' ]);

        $query->orderBy(['data_envio' => SORT_DESC, 'data_recepcao' => SORT_DESC]);

        return $dataProvider;
    }
}
