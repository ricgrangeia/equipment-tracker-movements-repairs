<?php

namespace app\models;

use Yii;
use yii\base\Model;
use yii\data\ActiveDataProvider;
use app\models\Imobilizado;

/**
 * ImobilizadoSearch represents the model behind the search form about `app\models\Imobilizado`.
 */
class ImobilizadoSearch extends Imobilizado
{
    /**
     * @inheritdoc
     */
    public function rules()
    {
        return [
            [['id', 'tipo_imobilizado', 'tipo_estado_conservacao', 'familia', 'sub_familia'], 'integer'],
            [['nome', 'code_imo', 'descricao', 'data_compra', 'localizacao', 'num_serie', 'observacoes'], 'safe'],
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
        $query = Imobilizado::find();

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
            'data_compra' => $this->data_compra,
            'tipo_imobilizado' => $this->tipo_imobilizado,
            'tipo_estado_conservacao' => $this->tipo_estado_conservacao,
            'familia' => $this->familia,
            'sub_familia' => $this->sub_familia,
        ]);

        $query->andFilterWhere(['like', 'nome', $this->nome])
            ->andFilterWhere(['like', 'code_imo', $this->code_imo])
            ->andFilterWhere(['like', 'descricao', $this->descricao])
            ->andFilterWhere(['like', 'localizacao', $this->localizacao])
            ->andFilterWhere(['like', 'num_serie', $this->num_serie])
            ->andFilterWhere(['like', 'observacoes', $this->observacoes]);

        return $dataProvider;
    }
}
