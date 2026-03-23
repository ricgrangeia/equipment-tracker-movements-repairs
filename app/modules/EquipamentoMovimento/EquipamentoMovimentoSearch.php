<?php

namespace app\modules\EquipamentoMovimento;

use Yii;
use yii\base\Model;
use yii\data\ActiveDataProvider;


/**
 * EquipamentoMovimentoSearch represents the model behind the search form about `app\modules\EquipamentoMovimento\EquipamentoMovimento`.
 */
class EquipamentoMovimentoSearch extends EquipamentoMovimento
{
    /**
     * @inheritdoc
     */
    public function rules()
    {
        return [
            [['id', 'destino_id', 'tipo_movimento_id', 'equipamento_id', 'utilizador_responsavel'], 'integer'],
            [['data', 'observacoes'], 'safe'],
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
        $query = EquipamentoMovimento::find();

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
            'destino_id' => $this->destino_id,
            'tipo_movimento_id' => $this->tipo_movimento_id,
            'equipamento_id' => $this->equipamento_id,
            'utilizador_responsavel' => $this->utilizador_responsavel,
        ]);



        $query->andFilterWhere(['like', 'data', $this->data])
            ->andFilterWhere(['like', 'observacoes', $this->observacoes]);

        $query->orderBy("id DESC");

        return $dataProvider;
    }
}
